<?php

namespace App\Controllers;

use App\Libraries\MonitoringData;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class Dashboard extends Controller
{
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(site_url('/'));
        }

        $availableYears = MonitoringData::getAvailableYears();
        $yearlyData     = MonitoringData::getYearlyData();

        $selectedYearParam = (string) ($this->request->getGet('tahun') ?? 'all');
        $selectedYear      = ($selectedYearParam !== 'all' && in_array((int) $selectedYearParam, $availableYears, true))
            ? (string) ((int) $selectedYearParam)
            : 'all';

        $yearlySummary = [];
        foreach ($availableYears as $yr) {
            $key = (string) $yr;
            $yearlySummary[$key] = $yearlyData[$key]['stats'];
        }

        if ($selectedYear === 'all') {
            $stats       = ['total' => 0, 'positive' => 0, 'neutral' => 0, 'negative' => 0];
            $mediaCounts = [];
            $articles    = [];

            foreach ($availableYears as $yr) {
                $key = (string) $yr;
                $stats['total']    += $yearlyData[$key]['stats']['total'];
                $stats['positive'] += $yearlyData[$key]['stats']['positive'];
                $stats['neutral']  += $yearlyData[$key]['stats']['neutral'];
                $stats['negative'] += $yearlyData[$key]['stats']['negative'];

                foreach ($yearlyData[$key]['top_media'] as $m) {
                    $mediaCounts[$m['name']] = ($mediaCounts[$m['name']] ?? 0) + $m['count'];
                }

                foreach ($yearlyData[$key]['articles'] as $article) {
                    $articles[] = $article;
                }
            }

            arsort($mediaCounts);
            $topMedia = [];
            foreach (array_slice($mediaCounts, 0, 5, true) as $name => $count) {
                $topMedia[] = ['name' => $name, 'count' => $count];
            }
        } else {
            $stats    = $yearlyData[$selectedYear]['stats'];
            $topMedia = $yearlyData[$selectedYear]['top_media'];
            $articles = $yearlyData[$selectedYear]['articles'];
        }

        $data = [
            'user_name'      => session()->get('user_name') ?? 'Admin',
            'user_email'     => session()->get('user_email') ?? 'admin@ebdesk.com',
            'availableYears' => $availableYears,
            'selectedYear'   => $selectedYear,
            'yearlySummary'  => $yearlySummary,
            'articles'       => $articles,
            'stats'          => $stats,
            'top_media'      => $topMedia,
        ];

        return view('dashboard', $data);
    }

    public function exportPdf()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(site_url('/'));
        }

        $availableYears = MonitoringData::getAvailableYears();
        $yearlyData     = MonitoringData::getYearlyData();

        $selectedYearParam = (string) ($this->request->getGet('tahun') ?? 'all');
        $selectedYear      = ($selectedYearParam !== 'all' && in_array((int) $selectedYearParam, $availableYears, true))
            ? (string) ((int) $selectedYearParam)
            : 'all';

        $sections = [];
        if ($selectedYear === 'all') {
            foreach ($availableYears as $yr) {
                $key            = (string) $yr;
                $sections[$key] = $yearlyData[$key];
            }
            $filename = 'rekap-monitoring-berita-semua-tahun.pdf';
        } else {
            $sections[$selectedYear] = $yearlyData[$selectedYear];
            $filename                = 'rekap-monitoring-berita-' . $selectedYear . '.pdf';
        }

        $html = view('pdf_rekap', [
            'sections'   => $sections,
            'user_email' => session()->get('user_email') ?? 'admin@ebdesk.com',
            'printed_at' => date('d M Y H:i'),
        ]);

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', false);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($dompdf->output());
    }
}
