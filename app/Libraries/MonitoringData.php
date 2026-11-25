<?php

namespace App\Libraries;

class MonitoringData
{
    /**
     * Mengembalikan daftar tahun yang tersedia (terbaru ke terlama).
     *
     * @return list<int>
     */
    public static function getAvailableYears(): array
    {
        $currentYear = (int) date('Y');

        return [$currentYear, $currentYear - 1, $currentYear - 2];
    }

    /**
     * Mengembalikan seluruh data monitoring berita per tahun (Januari - Desember).
     *
     * @return array<string, array<string, mixed>>
     */
    public static function getYearlyData(): array
    {
        $y0 = (int) date('Y');
        $y1 = $y0 - 1;
        $y2 = $y0 - 2;

        $rawArticlesByYear = [
            (string) $y0 => [
                [
                    'title'     => 'Transformasi Digital Kampus Dorong Riset AI dan Otomasi Layanan Akademik',
                    'media'     => 'Kompas.com',
                    'category'  => 'Teknologi',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Redaksi Teknologi',
                    'date'      => "$y0-11-22 09:40",
                    'content'   => 'Sejumlah perguruan tinggi di Indonesia mempercepat adopsi kecerdasan buatan untuk mendukung riset mahasiswa dan otomasi layanan administrasi akademik. Integrasi sistem informasi terpadu dinilai mampu memangkas waktu layanan hingga 60 persen sekaligus meningkatkan akurasi pelaporan data.',
                ],
                [
                    'title'     => 'Kementerian Komdigi Bahas Regulasi Keamanan Data Nasional Bersama Akademisi',
                    'media'     => 'Tempo.co',
                    'category'  => 'Kebijakan',
                    'sentiment' => 'Netral',
                    'author'    => 'Biro Nasional',
                    'date'      => "$y0-10-14 14:15",
                    'content'   => 'Kementerian Komunikasi dan Digital menggelar forum konsultasi publik bersama pakar keamanan siber dan perwakilan kampus untuk merumuskan aturan turunan perlindungan data pribadi. Pembahasan difokuskan pada standar enkripsi dan tata kelola insiden kebocoran data.',
                ],
                [
                    'title'     => 'Program Beasiswa Talenta Digital Dibuka untuk Mahasiswa Daerah 3T',
                    'media'     => 'Antara News',
                    'category'  => 'Pendidikan',
                    'sentiment' => 'Positif',
                    'author'    => 'Pewarta Pendidikan',
                    'date'      => "$y0-09-27 10:05",
                    'content'   => 'Pemerintah kembali membuka program beasiswa pelatihan talenta digital bagi mahasiswa dari wilayah tertinggal, terdepan, dan terluar. Materi pelatihan mencakup rekayasa perangkat lunak, analisis data, serta keamanan jaringan.',
                ],
                [
                    'title'     => 'Lonjakan Trafik Layanan Publik Picu Evaluasi Infrastruktur Cloud Nasional',
                    'media'     => 'Detik.com',
                    'category'  => 'Infrastruktur',
                    'sentiment' => 'Negatif',
                    'author'    => 'Redaksi Inet',
                    'date'      => "$y0-08-03 11:20",
                    'content'   => 'Sejumlah portal layanan publik mengalami perlambatan akses saat masa puncak pendaftaran daring. Pengelola infrastruktur diminta melakukan peningkatan kapasitas server dan penyeimbangan beban agar gangguan serupa tidak berulang.',
                ],
                [
                    'title'     => 'Forum Media Daerah Sepakati Standar Verifikasi Berita Berbasis Fakta',
                    'media'     => 'Republika.co.id',
                    'category'  => 'Media',
                    'sentiment' => 'Positif',
                    'author'    => 'Meja Redaksi',
                    'date'      => "$y0-07-18 15:30",
                    'content'   => 'Asosiasi media daring daerah menandatangani komitmen bersama untuk memperkuat verifikasi berlapis sebelum publikasi berita. Langkah ini diambil guna menekan peredaran informasi keliru di tengah cepatnya arus media sosial.',
                ],
                [
                    'title'     => 'Penggunaan Analitik Sentimen Mulai Diadopsi Humas Instansi Pemerintah',
                    'media'     => 'CNBC Indonesia',
                    'category'  => 'Teknologi',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Tech',
                    'date'      => "$y0-06-22 13:10",
                    'content'   => 'Divisi kehumasan di berbagai kementerian dan universitas kini memanfaatkan perangkat pemantauan media untuk membaca tren opini publik secara real-time. Data sentimen membantu pimpinan merespons isu strategis lebih cepat.',
                ],
                [
                    'title'     => 'Rapat Koordinasi Keterbukaan Informasi Publik Bahas Standar Portal Resmi',
                    'media'     => 'CNN Indonesia',
                    'category'  => 'Pemerintahan',
                    'sentiment' => 'Netral',
                    'author'    => 'Tim Nasional',
                    'date'      => "$y0-05-19 16:05",
                    'content'   => 'Komisi Informasi menggelar evaluasi berkala terhadap keterbukaan dokumen publik pada situs resmi lembaga negara. Penilaian mencakup kemudahan akses data tahunan, kecepatan respons permohonan, dan kejelasan kanal pengaduan.',
                ],
                [
                    'title'     => 'Kolaborasi Universitas dan Industri Tingkatkan Kesiapan Lulusan di Era AI',
                    'media'     => 'Kompas.com',
                    'category'  => 'Pendidikan',
                    'sentiment' => 'Positif',
                    'author'    => 'Redaksi Edukasi',
                    'date'      => "$y0-04-11 08:45",
                    'content'   => 'Kemitraan kampus dengan perusahaan teknologi memperluas program magang riset terapan bagi mahasiswa semester akhir. Kurikulum bersama disusun agar lulusan siap menangani proyek sistem informasi skala produksi.',
                ],
                [
                    'title'     => 'Serangan Siber Phishing Meningkat pada Awal Kuartal, Pengguna Diminta Waspada',
                    'media'     => 'Detik.com',
                    'category'  => 'Keamanan',
                    'sentiment' => 'Negatif',
                    'author'    => 'Tim Keamanan Siber',
                    'date'      => "$y0-03-25 17:20",
                    'content'   => 'Lembaga pemantau keamanan siber mencatat kenaikan upaya phishing yang menyasar akun email institusi pendidikan dan perkantoran. Pengelola TI diimbau menerapkan autentikasi multifaktor secara menyeluruh.',
                ],
                [
                    'title'     => 'Audit Kinerja Sistem Arsip Berita Elektronik Berjalan Sesuai Jadwal',
                    'media'     => 'Tempo.co',
                    'category'  => 'Pemerintahan',
                    'sentiment' => 'Netral',
                    'author'    => 'Tim Liputan',
                    'date'      => "$y0-02-14 11:00",
                    'content'   => 'Tim audit internal menyelesaikan pemeriksaan berkala pada repositori arsip berita digital lintas unit kerja. Hasil sementara menunjukkan pencadangan data harian berjalan stabil tanpa kehilangan berkas.',
                ],
                [
                    'title'     => 'Peluncuran Dashboard Pemantauan Berita Terintegrasi Permudah Evaluasi Tahunan',
                    'media'     => 'Antara News',
                    'category'  => 'Media',
                    'sentiment' => 'Positif',
                    'author'    => 'Redaksi Ekonomi & Tech',
                    'date'      => "$y0-01-09 09:30",
                    'content'   => 'Sistem pemantauan berita generasi baru resmi diluncurkan dengan fitur pengelompokan laporan tahunan dan ekspor dokumen PDF. Fitur ini memudahkan tim analis menyusun laporan kinerja komunikasi secara berkala.',
                ],
            ],
            (string) $y1 => [
                [
                    'title'     => 'Laporan Tren Media Sosial: Topik Layanan Cerdas Menguat Sepanjang Tahun',
                    'media'     => 'CNBC Indonesia',
                    'category'  => 'Media',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Riset Media',
                    'date'      => "$y1-12-10 10:30",
                    'content'   => 'Riset tahunan menunjukkan percakapan publik mengenai digitalisasi layanan kampus dan pemerintahan meningkat signifikan dibanding tahun sebelumnya. Sentimen positif terutama datang dari kemudahan akses layanan berbasis web.',
                ],
                [
                    'title'     => 'Diskusi Publik Soroti Transparansi Informasi di Portal Pemerintah Daerah',
                    'media'     => 'CNN Indonesia',
                    'category'  => 'Pemerintahan',
                    'sentiment' => 'Netral',
                    'author'    => 'Redaksi Politik',
                    'date'      => "$y1-11-21 15:45",
                    'content'   => 'Para pengamat tata kelola informasi menekankan pentingnya pembaruan data berkala di portal resmi daerah. Ketersediaan arsip laporan tahunan dinilai menjadi indikator utama transparansi publik.',
                ],
                [
                    'title'     => 'Optimalisasi Jaringan Serat Optik Perluas Akses Internet Kampus Mitra',
                    'media'     => 'Kompas.com',
                    'category'  => 'Infrastruktur',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Tekno',
                    'date'      => "$y1-10-08 12:15",
                    'content'   => 'Peningkatan kapasitas bandwidth serat optik di sejumlah kampus daerah mendukung kelancaran perkuliahan hybrid dan akses jurnal internasional. Kecepatan unduh rata-rata meningkat dua kali lipat.',
                ],
                [
                    'title'     => 'Gangguan Jaringan Daerah Hambat Akses Sistem Pelaporan Berita Sementara',
                    'media'     => 'Detik.com',
                    'category'  => 'Infrastruktur',
                    'sentiment' => 'Negatif',
                    'author'    => 'Tim Daerah',
                    'date'      => "$y1-09-11 08:50",
                    'content'   => 'Pemadaman listrik regional sempat memengaruhi konektivitas beberapa simpul jaringan di wilayah timur. Tim teknis segera mengalihkan jalur cadangan sehingga layanan kembali normal dalam empat jam.',
                ],
                [
                    'title'     => 'Seminar Literasi Digital Ajak Mahasiswa Kritis Memilah Sumber Berita',
                    'media'     => 'Antara News',
                    'category'  => 'Pendidikan',
                    'sentiment' => 'Positif',
                    'author'    => 'Redaksi Kampus',
                    'date'      => "$y1-08-19 14:00",
                    'content'   => 'Ratusan mahasiswa mengikuti seminar nasional literasi media yang membahas teknik pengecekan fakta dan pengenalan bias pemberitaan. Kegiatan ini menjadi bagian dari program penguatan budaya akademik.',
                ],
                [
                    'title'     => 'Penyusunan Pedoman Etika Pemanfaatan AI di Ruang Redaksi Nasional',
                    'media'     => 'Tempo.co',
                    'category'  => 'Kebijakan',
                    'sentiment' => 'Netral',
                    'author'    => 'Dewan Pers & Redaksi',
                    'date'      => "$y1-07-04 16:40",
                    'content'   => 'Organisasi jurnalis bersama akademisi komunikasi menyusun draf pedoman penggunaan kecerdasan buatan dalam penyuntingan berita. Transparansi sumber dan tanggung jawab editorial tetap menjadi prinsip utama.',
                ],
                [
                    'title'     => 'Inovasi Monitoring Media Berbasis NLP Mulai Diterapkan di Lembaga Publik',
                    'media'     => 'Kompas.com',
                    'category'  => 'Teknologi',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Inovasi',
                    'date'      => "$y1-05-17 13:10",
                    'content'   => 'Teknologi pemrosesan bahasa alami dimanfaatkan untuk mengklasifikasikan ribuan artikel berita setiap hari berdasarkan topik dan sentimen. Akurasi klasifikasi mencapai di atas 88 persen pada uji coba tahap awal.',
                ],
                [
                    'title'     => 'Kebocoran Data Aplikasi Pihak Ketiga Jadi Peringatan Pengelola Sistem',
                    'media'     => 'Detik.com',
                    'category'  => 'Keamanan',
                    'sentiment' => 'Negatif',
                    'author'    => 'Tim Siber',
                    'date'      => "$y1-04-02 09:20",
                    'content'   => 'Insiden kebocoran data pada salah satu layanan vendor eksternal mendorong instansi memperketat audit keamanan aplikasi mitra. Pengujian kerentanan berkala kini diwajibkan sebelum integrasi API.',
                ],
                [
                    'title'     => 'Konsolidasi Data Berita Lintas Portal Masuk Fase Uji Coba Terbatas',
                    'media'     => 'Republika.co.id',
                    'category'  => 'Media',
                    'sentiment' => 'Netral',
                    'author'    => 'Tim Redaksi',
                    'date'      => "$y1-02-23 11:35",
                    'content'   => 'Tim pengembang memulai uji coba pengumpulan umpan berita otomatis dari dua puluh portal berita nasional. Tahap ini bertujuan memastikan format tanggal dan metadata artikel tersimpan seragam.',
                ],
                [
                    'title'     => 'Pengembangan Portal Informasi Terpadu Raih Apresiasi Layanan Publik',
                    'media'     => 'CNBC Indonesia',
                    'category'  => 'Pemerintahan',
                    'sentiment' => 'Positif',
                    'author'    => 'Biro Publikasi',
                    'date'      => "$y1-01-15 10:00",
                    'content'   => 'Portal informasi terpadu dinilai berhasil menyederhanakan akses pengumuman resmi dan ringkasan berita kelembagaan bagi masyarakat luas.',
                ],
            ],
            (string) $y2 => [
                [
                    'title'     => 'Digitalisasi Arsip Berita Nasional Masuk Tahap Integrasi Lintas Portal',
                    'media'     => 'Antara News',
                    'category'  => 'Media',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Arsip Nasional',
                    'date'      => "$y2-11-28 17:00",
                    'content'   => 'Proyek digitalisasi arsip pemberitaan nasional berhasil menghubungkan indeks berita dari berbagai media arus utama. Peneliti dan jurnalis kini dapat menelusuri riwayat isu strategis lebih cepat.',
                ],
                [
                    'title'     => 'Peningkatan Isu Hoaks Jelang Akhir Tahun Jadi Sorotan Media Daring',
                    'media'     => 'Kompas.com',
                    'category'  => 'Kebijakan',
                    'sentiment' => 'Negatif',
                    'author'    => 'Tim Cek Fakta',
                    'date'      => "$y2-10-09 09:15",
                    'content'   => 'Tim pemeriksa fakta mencatat lonjakan konten disinformasi yang beredar melalui pesan berantai. Masyarakat diimbau merujuk pada kanal media terverifikasi sebelum membagikan informasi.',
                ],
                [
                    'title'     => 'Evaluasi Kinerja Layanan Informasi Publik Tahun Berjalan',
                    'media'     => 'Republika.co.id',
                    'category'  => 'Pemerintahan',
                    'sentiment' => 'Netral',
                    'author'    => 'Redaksi Nasional',
                    'date'      => "$y2-08-15 12:25",
                    'content'   => 'Kementerian dan lembaga terkait menggelar rapat evaluasi tahunan untuk mengukur ketepatan waktu penyampaian informasi publik. Sejumlah perbaikan antarmuka portal direncanakan untuk tahun berikutnya.',
                ],
                [
                    'title'     => 'Pelatihan Analisis Data Berita Digelar untuk Tim Komunikasi Kampus',
                    'media'     => 'Tempo.co',
                    'category'  => 'Pendidikan',
                    'sentiment' => 'Positif',
                    'author'    => 'Tim Edukasi',
                    'date'      => "$y2-06-20 14:50",
                    'content'   => 'Pelatihan intensif selama tiga hari membekali pengelola humas kampus dengan keterampilan membaca metrik pemberitaan dan menyusun ringkasan eksekutif bulanan.',
                ],
                [
                    'title'     => 'Keterlambatan Pembaruan Indeks Berita Sempat Terjadi Saat Migrasi Server',
                    'media'     => 'Detik.com',
                    'category'  => 'Infrastruktur',
                    'sentiment' => 'Negatif',
                    'author'    => 'Tim Infrastruktur',
                    'date'      => "$y2-04-12 07:45",
                    'content'   => 'Proses pemindahan basis data ke klaster server baru menyebabkan jeda pembaruan indeks berita selama beberapa jam. Setelah migrasi selesai, seluruh antrean artikel berhasil diproses kembali.',
                ],
                [
                    'title'     => 'Standarisasi Format Laporan Monitoring Media Mulai Diterapkan',
                    'media'     => 'CNN Indonesia',
                    'category'  => 'Media',
                    'sentiment' => 'Netral',
                    'author'    => 'Tim Redaksi',
                    'date'      => "$y2-02-05 10:15",
                    'content'   => 'Penggunaan format baku laporan pemantauan berita memudahkan perbandingan tren pemberitaan antarperiode. Setiap laporan kini wajib mencantumkan ringkasan sentimen dan daftar sumber media utama.',
                ],
            ],
        ];

        $result = [];
        foreach ($rawArticlesByYear as $year => $articles) {
            $total    = count($articles);
            $positive = 0;
            $neutral  = 0;
            $negative = 0;
            $mediaMap = [];

            foreach ($articles as $idx => &$article) {
                $article['id']   = $year . '-' . ($idx + 1);
                $article['year'] = $year;

                if ($article['sentiment'] === 'Positif') {
                    $positive++;
                } elseif ($article['sentiment'] === 'Negatif') {
                    $negative++;
                } else {
                    $neutral++;
                }

                $mediaName            = $article['media'];
                $mediaMap[$mediaName] = ($mediaMap[$mediaName] ?? 0) + 1;
            }
            unset($article);

            arsort($mediaMap);
            $topMedia = [];
            foreach ($mediaMap as $name => $count) {
                $topMedia[] = ['name' => $name, 'count' => $count];
            }

            $result[$year] = [
                'stats' => [
                    'total'    => $total,
                    'positive' => $positive,
                    'neutral'  => $neutral,
                    'negative' => $negative,
                ],
                'top_media' => $topMedia,
                'articles'  => $articles,
            ];
        }

        return $result;
    }
}
