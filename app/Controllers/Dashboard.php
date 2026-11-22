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

        $articles = [
            [
                'title'     => 'Transformasi Digital Kampus Dorong Riset AI dan Otomasi Layanan',
                'media'     => 'Kompas.com',
                'category'  => 'Teknologi',
                'sentiment' => 'Positif',
                'date'      => date('Y-m-d H:i', strtotime('-25 minutes')),
            ],
            [
                'title'     => 'Kementerian Komdigi Bahas Regulasi Keamanan Data Nasional',
                'media'     => 'Tempo.co',
                'category'  => 'Kebijakan',
                'sentiment' => 'Netral',
                'date'      => date('Y-m-d H:i', strtotime('-1 hour')),
            ],
            [
                'title'     => 'Lonjakan Trafik Layanan Publik Picu Evaluasi Infrastruktur Cloud',
                'media'     => 'Detik.com',
                'category'  => 'Infrastruktur',
                'sentiment' => 'Negatif',
                'date'      => date('Y-m-d H:i', strtotime('-2 hours')),
            ],
            [
                'title'     => 'Kolaborasi Universitas dan Industri Tingkatkan Kesiapan Talenta Digital',
                'media'     => 'Antara News',
                'category'  => 'Pendidikan',
                'sentiment' => 'Positif',
                'date'      => date('Y-m-d H:i', strtotime('-3 hours')),
            ],
            [
                'title'     => 'Laporan Tren Media Sosial: Topik Layanan Cerdas Menguat Pekan Ini',
                'media'     => 'CNBC Indonesia',
                'category'  => 'Media',
                'sentiment' => 'Positif',
                'date'      => date('Y-m-d H:i', strtotime('-5 hours')),
            ],
            [
                'title'     => 'Diskusi Publik Soroti Transparansi Informasi di Portal Pemerintah',
                'media'     => 'CNN Indonesia',
                'category'  => 'Pemerintahan',
                'sentiment' => 'Netral',
                'date'      => date('Y-m-d H:i', strtotime('-7 hours')),
            ],
        ];

        $data = [
            'user_name'  => session()->get('user_name') ?? 'Admin',
            'user_email' => session()->get('user_email') ?? 'admin@ebdesk.com',
            'articles'   => $articles,
            'stats'      => [
                'total'    => 1284,
                'positive' => 764,
                'neutral'  => 382,
                'negative' => 138,
            ],
            'top_media'  => [
                ['name' => 'Kompas.com', 'count' => 312],
                ['name' => 'Detik.com', 'count' => 284],
                ['name' => 'Tempo.co', 'count' => 219],
                ['name' => 'Antara News', 'count' => 195],
            ],
        ];

        return view('dashboard', $data);
    }
}
