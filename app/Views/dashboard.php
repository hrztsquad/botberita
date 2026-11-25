<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Media Monitoring Berita</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .stat-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        .table-card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        .article-excerpt {
            font-size: 0.85rem;
            color: #555;
            line-height: 1.45;
        }
        .modal-backdrop-custom {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1050;
            padding: 1rem;
        }
        .modal-backdrop-custom.show {
            display: flex;
        }
        .modal-dialog-custom {
            background: #fff;
            border-radius: 0.75rem;
            max-width: 680px;
            width: 100%;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?= site_url('dashboard') ?>">IMA Media Monitoring</a>
        <div class="d-flex align-items-center gap-3 ms-auto">
            <span class="text-white-50 small d-none d-sm-inline"><?= esc($user_email) ?></span>
            <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h4 mb-1">Dashboard Monitoring Berita</h1>
            <p class="text-muted mb-0 small">
                Selamat datang, <?= esc($user_name) ?>.
                Menampilkan <strong><?= count($articles) ?> berita lengkap</strong> untuk:
                <strong><?= $selectedYear === 'all' ? 'Semua Tahun (' . min($availableYears) . '–' . max($availableYears) . ')' : 'Tahun ' . esc($selectedYear) ?></strong>
            </p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <div class="btn-group" role="group" aria-label="Filter Tahun">
                <a href="<?= site_url('dashboard?tahun=all') ?>"
                   class="btn btn-sm <?= $selectedYear === 'all' ? 'btn-primary' : 'btn-outline-primary' ?>">
                    Semua Tahun
                </a>
                <?php foreach ($availableYears as $yr): ?>
                    <a href="<?= site_url('dashboard?tahun=' . $yr) ?>"
                       class="btn btn-sm <?= $selectedYear === (string) $yr ? 'btn-primary' : 'btn-outline-primary' ?>">
                        <?= esc((string) $yr) ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <a href="<?= site_url('dashboard/pdf?tahun=' . urlencode($selectedYear)) ?>"
               class="btn btn-sm btn-danger">
                Export PDF <?= $selectedYear === 'all' ? '(Per Tahun)' : '(' . esc($selectedYear) . ')' ?>
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Total Berita</div>
                    <div class="h3 mb-0 fw-bold text-primary"><?= number_format($stats['total']) ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Sentimen Positif</div>
                    <div class="h3 mb-0 fw-bold text-success"><?= number_format($stats['positive']) ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Sentimen Netral</div>
                    <div class="h3 mb-0 fw-bold text-secondary"><?= number_format($stats['neutral']) ?></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Sentimen Negatif</div>
                    <div class="h3 mb-0 fw-bold text-danger"><?= number_format($stats['negative']) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card table-card">
                <div class="card-header bg-white border-0 pt-3 pb-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h2 class="h6 mb-0 fw-semibold">Daftar Berita Lengkap (<span id="visibleCount"><?= count($articles) ?></span>)</h2>
                    <div class="d-flex gap-2">
                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari judul, isi, atau media...">
                        <select id="sentimentFilter" class="form-select form-select-sm" style="width: auto;">
                            <option value="">Semua Sentimen</option>
                            <option value="Positif">Positif</option>
                            <option value="Netral">Netral</option>
                            <option value="Negatif">Negatif</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush" id="newsList">
                        <?php foreach ($articles as $article): ?>
                            <?php
                                $badgeClass = match ($article['sentiment']) {
                                    'Positif' => 'bg-success',
                                    'Negatif' => 'bg-danger',
                                    default   => 'bg-secondary',
                                };
                            ?>
                            <div class="list-group-item py-3 px-3 news-item" data-sentiment="<?= esc($article['sentiment']) ?>">
                                <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-1">
                                    <h3 class="h6 mb-0 fw-semibold"><?= esc($article['title']) ?></h3>
                                    <span class="badge <?= $badgeClass ?>"><?= esc($article['sentiment']) ?></span>
                                </div>
                                <div class="small text-muted mb-2">
                                    <strong><?= esc($article['media']) ?></strong>
                                    &bull; <?= esc($article['category']) ?>
                                    &bull; <?= esc($article['author']) ?>
                                    &bull; <?= esc($article['date']) ?>
                                </div>
                                <p class="article-excerpt mb-2"><?= esc($article['content']) ?></p>
                                <button type="button"
                                        class="btn btn-outline-primary btn-sm py-0 px-2 read-detail-btn"
                                        data-title="<?= esc($article['title']) ?>"
                                        data-media="<?= esc($article['media']) ?>"
                                        data-category="<?= esc($article['category']) ?>"
                                        data-sentiment="<?= esc($article['sentiment']) ?>"
                                        data-author="<?= esc($article['author']) ?>"
                                        data-date="<?= esc($article['date']) ?>"
                                        data-content="<?= esc($article['content']) ?>">
                                    Baca Detail
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column gap-4">
            <div class="card table-card">
                <div class="card-header bg-white border-0 pt-3 pb-2">
                    <h2 class="h6 mb-0 fw-semibold">Rekapitulasi Per Tahun</h2>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Tahun</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end text-success">+</th>
                                    <th class="text-end text-secondary">=</th>
                                    <th class="text-end text-danger">-</th>
                                    <th class="text-end pe-3">PDF</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($yearlySummary as $yr => $sum): ?>
                                    <tr class="<?= $selectedYear === (string) $yr ? 'table-primary' : '' ?>">
                                        <td class="ps-3">
                                            <a href="<?= site_url('dashboard?tahun=' . $yr) ?>" class="text-decoration-none fw-semibold">
                                                <?= esc((string) $yr) ?>
                                            </a>
                                        </td>
                                        <td class="text-end fw-medium"><?= number_format($sum['total']) ?></td>
                                        <td class="text-end text-success"><?= number_format($sum['positive']) ?></td>
                                        <td class="text-end text-secondary"><?= number_format($sum['neutral']) ?></td>
                                        <td class="text-end text-danger"><?= number_format($sum['negative']) ?></td>
                                        <td class="text-end pe-3">
                                            <a href="<?= site_url('dashboard/pdf?tahun=' . $yr) ?>" class="btn btn-outline-danger btn-sm py-0 px-2" title="Unduh PDF Tahun <?= esc((string) $yr) ?>">
                                                PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card table-card">
                <div class="card-header bg-white border-0 pt-3 pb-2">
                    <h2 class="h6 mb-0 fw-semibold">Sumber Media Teratas</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($top_media as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span><?= esc($item['name']) ?></span>
                                <span class="badge bg-primary rounded-pill"><?= number_format($item['count']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal-backdrop-custom" id="articleModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-dialog-custom">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-start gap-2">
            <div>
                <h2 class="h5 mb-1" id="modalTitle"></h2>
                <div class="small text-muted" id="modalMeta"></div>
            </div>
            <button type="button" class="btn-close" id="closeModalBtn" aria-label="Tutup"></button>
        </div>
        <div class="p-3">
            <p class="mb-0" id="modalContent" style="line-height: 1.65;"></p>
        </div>
        <div class="p-3 border-top bg-light text-end">
            <button type="button" class="btn btn-secondary btn-sm" id="closeModalFooterBtn">Tutup</button>
        </div>
    </div>
</div>

<script>
(function () {
    const searchInput = document.getElementById('searchInput');
    const sentimentFilter = document.getElementById('sentimentFilter');
    const items = document.querySelectorAll('#newsList .news-item');
    const visibleCountEl = document.getElementById('visibleCount');

    function filterItems() {
        const q = searchInput.value.toLowerCase().trim();
        const sentiment = sentimentFilter.value;
        let visible = 0;

        items.forEach((item) => {
            const text = item.textContent.toLowerCase();
            const itemSentiment = item.getAttribute('data-sentiment');
            const matchesSearch = !q || text.includes(q);
            const matchesSentiment = !sentiment || itemSentiment === sentiment;
            const show = matchesSearch && matchesSentiment;
            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        visibleCountEl.textContent = visible;
    }

    searchInput.addEventListener('input', filterItems);
    sentimentFilter.addEventListener('change', filterItems);

    const modal = document.getElementById('articleModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMeta = document.getElementById('modalMeta');
    const modalContent = document.getElementById('modalContent');

    document.querySelectorAll('.read-detail-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            modalTitle.textContent = btn.getAttribute('data-title');
            modalMeta.textContent = [
                btn.getAttribute('data-media'),
                btn.getAttribute('data-category'),
                btn.getAttribute('data-sentiment'),
                btn.getAttribute('data-author'),
                btn.getAttribute('data-date'),
            ].join(' • ');
            modalContent.textContent = btn.getAttribute('data-content');
            modal.classList.add('show');
        });
    });

    function closeModal() {
        modal.classList.remove('show');
    }

    document.getElementById('closeModalBtn').addEventListener('click', closeModal);
    document.getElementById('closeModalFooterBtn').addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
})();
</script>

</body>
</html>
