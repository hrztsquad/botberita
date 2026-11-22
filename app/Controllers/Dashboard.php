<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(site_url('/'));
        }

        $currentYear = (int) date('Y');
        $availableYears = [$currentYear, $currentYear - 1, $currentYear - 2];

        $selectedYearParam = (string) ($this->request->getGet('tahun') ?? 'all');
        $selectedYear = ($selectedYearParam !== 'all' && in_array((int) $selectedYearParam, $availableYears, true))
            ? (string) ((int) $selectedYearParam)
            : 'all';

        $yearlyData = [
            (string) $currentYear => [
                'stats' => [
                    'total'    => 1284,
                    'positive' => 764,
                    'neutral'  => 382,
                    'negative' => 138,
                ],
                'top_media' => [
                    ['name' => 'Kompas.com', 'count' => 312],
                    ['name' => 'Detik.com', 'count' => 284],
                    ['name' => 'Tempo.co', 'count' => 219],
                    ['name' => 'Antara News', 'count' => 195],
                ],
                'articles' => [
                    [
                        'title'     => 'Transformasi Digital Kampus Dorong Riset AI dan Otomasi Layanan',
                        'media'     => 'Kompas.com',
                        'category'  => 'Teknologi',
                        'sentiment' => 'Positif',
                        'year'      => (string) $currentYear,
                        'date'      => $currentYear . '-11-22 09:40',
                    ],
                    [
                        'title'     => 'Kementerian Komdigi Bahas Regulasi Keamanan Data Nasional',
                        'media'     => 'Tempo.co',
                        'category'  => 'Kebijakan',
                        'sentiment' => 'Netral',
                        'year'      => (string) $currentYear,
                        'date'      => $currentYear . '-10-14 14:15',
                    ],
                    [
                        'title'     => 'Lonjakan Trafik Layanan Publik Picu Evaluasi Infrastruktur Cloud',
                        'media'     => 'Detik.com',
                        'category'  => 'Infrastruktur',
                        'sentiment' => 'Negatif',
                        'year'      => (string) $currentYear,
                        'date'      => $currentYear . '-08-03 11:20',
                    ],
                    [
                        'title'     => 'Kolaborasi Universitas dan Industri Tingkatkan Kesiapan Talenta Digital',
                        'media'     => 'Antara News',
                        'category'  => 'Pendidikan',
                        'sentiment' => 'Positif',
                        'year'      => (string) $currentYear,
                        'date'      => $currentYear . '-05-19 16:05',
                    ],
                ],
            ],
            (string) ($currentYear - 1) => [
                'stats' => [
                    'total'    => 2410,
                    'positive' => 1412,
                    'neutral'  => 718,
                    'negative' => 280,
                ],
                'top_media' => [
                    ['name' => 'Detik.com', 'count' => 615],
                    ['name' => 'Kompas.com', 'count' => 580],
                    ['name' => 'CNBC Indonesia', 'count' => 412],
                    ['name' => 'Tempo.co', 'count' => 360],
                ],
                'articles' => [
                    [
                        'title'     => 'Laporan Tren Media Sosial: Topik Layanan Cerdas Menguat Sepanjang Tahun',
                        'media'     => 'CNBC Indonesia',
                        'category'  => 'Media',
                        'sentiment' => 'Positif',
                        'year'      => (string) ($currentYear - 1),
                        'date'      => ($currentYear - 1) . '-12-10 10:30',
                    ],
                    [
                        'title'     => 'Diskusi Publik Soroti Transparansi Informasi di Portal Pemerintah',
                        'media'     => 'CNN Indonesia',
                        'category'  => 'Pemerintahan',
                        'sentiment' => 'Netral',
                        'year'      => (string) ($currentYear - 1),
                        'date'      => ($currentYear - 1) . '-09-21 15:45',
                    ],
                    [
                        'title'     => 'Gangguan Jaringan Daerah Hambat Akses Sistem Pelaporan Berita',
                        'media'     => 'Detik.com',
                        'category'  => 'Infrastruktur',
                        'sentiment' => 'Negatif',
                        'year'      => (string) ($currentYear - 1),
                        'date'      => ($currentYear - 1) . '-06-11 08:50',
                    ],
                    [
                        'title'     => 'Inovasi Monitoring Media Berbasis NLP Mulai Diterapkan di Lembaga Publik',
                        'media'     => 'Kompas.com',
                        'category'  => 'Teknologi',
                        'sentiment' => 'Positif',
                        'year'      => (string) ($currentYear - 1),
                        'date'      => ($currentYear - 1) . '-03-17 13:10',
                    ],
                ],
            ],
            (string) ($currentYear - 2) => [
                'stats' => [
                    'total'    => 1895,
                    'positive' => 1040,
                    'neutral'  => 610,
                    'negative' => 245,
                ],
                'top_media' => [
                    ['name' => 'Kompas.com', 'count' => 490],
                    ['name' => 'Antara News', 'count' => 430],
                    ['name' => 'Detik.com', 'count' => 398],
                    ['name' => 'Republika.co.id', 'count' => 290],
                ],
                'articles' => [
                    [
                        'title'     => 'Digitalisasi Arsip Berita Nasional Masuk Tahap Integrasi Lintas Portal',
                        'media'     => 'Antara News',
                        'category'  => 'Media',
                        'sentiment' => 'Positif',
                        'year'      => (string) ($currentYear - 2),
                        'date'      => ($currentYear - 2) . '-11-28 17:00',
                    ],
                    [
                        'title'     => 'Evaluasi Kinerja Layanan Informasi Publik Tahun Berjalan',
                        'media'     => 'Republika.co.id',
                        'category'  => 'Pemerintahan',
                        'sentiment' => 'Netral',
                        'year'      => (string) ($currentYear - 2),
                        'date'      => ($currentYear - 2) . '-07-15 12:25',
                    ],
                    [
                        'title'     => 'Peningkatan Isu Hoaks Jelang Akhir Tahun Jadi Sorotan Media Daring',
                        'media'     => 'Kompas.com',
                        'category'  => 'Kebijakan',
                        'sentiment' => 'Negatif',
                        'year'      => (string) ($currentYear - 2),
                        'date'      => ($currentYear - 2) . '-04-09 09:15',
                    ],
                ],
            ],
        ];

        $yearlySummary = [];
        foreach ($availableYears as $yr) {
            $key = (string) $yr;
            $yearlySummary[$key] = $yearlyData[$key]['stats'];
        }

        if ($selectedYear === 'all') {
            $stats = ['total' => 0, 'positive' => 0, 'neutral' => 0, 'negative' => 0];
            $mediaCounts = [];
            $articles = [];

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
}
