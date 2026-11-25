<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Media Monitoring Berita</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
            margin: 20px;
        }
        .year-section {
            width: 100%;
        }
        .page-break {
            page-break-before: always;
        }
        .header {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0 0 4px 0;
            color: #0d6efd;
        }
        .meta {
            font-size: 10px;
            color: #555;
        }
        .kpi-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin: 0 -8px 14px -8px;
        }
        .kpi-box {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 8px 10px;
            background: #f8f9fa;
            width: 25%;
        }
        .kpi-label {
            font-size: 9px;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .kpi-value {
            font-size: 16px;
            font-weight: bold;
        }
        .text-primary { color: #0d6efd; }
        .text-success { color: #198754; }
        .text-secondary { color: #6c757d; }
        .text-danger { color: #dc3545; }
        h2 {
            font-size: 12px;
            margin: 14px 0 6px 0;
            color: #333;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        table.data-table th,
        table.data-table td {
            border: 1px solid #dee2e6;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #f1f3f5;
            font-weight: bold;
            font-size: 10px;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            color: #fff;
            font-weight: bold;
        }
        .badge-positif { background-color: #198754; }
        .badge-netral { background-color: #6c757d; }
        .badge-negatif { background-color: #dc3545; }
        .footer {
            margin-top: 12px;
            font-size: 9px;
            color: #777;
            border-top: 1px solid #e9ecef;
            padding-top: 6px;
        }
    </style>
</head>
<body>
<?php $isFirst = true; ?>
<?php foreach ($sections as $year => $section): ?>
    <div class="year-section <?= $isFirst ? '' : 'page-break' ?>">
        <?php $isFirst = false; ?>
        <div class="header">
            <h1>Rekapitulasi Media Monitoring Berita — Tahun <?= esc((string) $year) ?></h1>
            <div class="meta">
                IMA Media Monitoring (uinsuku.cloud/beritabot) &bull; Dicetak oleh: <?= esc($user_email) ?> &bull; Tanggal Cetak: <?= esc($printed_at) ?>
            </div>
        </div>

        <table class="kpi-table">
            <tr>
                <td class="kpi-box">
                    <div class="kpi-label">Total Berita</div>
                    <div class="kpi-value text-primary"><?= number_format($section['stats']['total']) ?></div>
                </td>
                <td class="kpi-box">
                    <div class="kpi-label">Sentimen Positif</div>
                    <div class="kpi-value text-success"><?= number_format($section['stats']['positive']) ?></div>
                </td>
                <td class="kpi-box">
                    <div class="kpi-label">Sentimen Netral</div>
                    <div class="kpi-value text-secondary"><?= number_format($section['stats']['neutral']) ?></div>
                </td>
                <td class="kpi-box">
                    <div class="kpi-label">Sentimen Negatif</div>
                    <div class="kpi-value text-danger"><?= number_format($section['stats']['negative']) ?></div>
                </td>
            </tr>
        </table>

        <h2>Sumber Media Teratas (<?= esc((string) $year) ?>)</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 70%;">Media</th>
                    <th class="text-right" style="width: 30%;">Jumlah Berita</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($section['top_media'] as $media): ?>
                    <tr>
                        <td><?= esc($media['name']) ?></td>
                        <td class="text-right"><?= number_format($media['count']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Daftar Berita Terpantau (<?= esc((string) $year) ?>)</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 42%;">Judul Berita</th>
                    <th style="width: 16%;">Media</th>
                    <th style="width: 14%;">Kategori</th>
                    <th style="width: 12%;">Sentimen</th>
                    <th style="width: 16%;">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($section['articles'] as $article): ?>
                    <?php
                        $badgeClass = match ($article['sentiment']) {
                            'Positif' => 'badge-positif',
                            'Negatif' => 'badge-negatif',
                            default   => 'badge-netral',
                        };
                    ?>
                    <tr>
                        <td><?= esc($article['title']) ?></td>
                        <td><?= esc($article['media']) ?></td>
                        <td><?= esc($article['category']) ?></td>
                        <td><span class="badge <?= $badgeClass ?>"><?= esc($article['sentiment']) ?></span></td>
                        <td><?= esc($article['date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="footer">
            Laporan Rekap Tahunan <?= esc((string) $year) ?> &mdash; IMA Media Monitoring
        </div>
    </div>
<?php endforeach; ?>
</body>
</html>
