<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="mb-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold text-dark mb-2"><i class="bi bi-box2-fill"></i> Data Produk</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '→';">
                        <ol class="breadcrumb breadcrumb-dots small mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Produk</li>
                        </ol>
                    </nav>
                </div>
                <span class="text-muted small"><i class="bi bi-calendar3-week"></i> <?= date('d M Y') ?></span>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="/produk">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0"
                               placeholder="Cari nama produk..."
                               value="<?= $search ?? '' ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                        <a href="/produk" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <?php
                $categories = array_unique(array_column($product, 'category'));
                $statCards  = [
                    ['label' => 'Total Produk', 'icon' => 'bi-box2', 'gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)', 'count' => count($product)],
                    ['label' => 'Smartphone', 'icon' => 'bi-phone', 'gradient' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)', 'count' => count(array_filter($product, fn($p) => $p['category'] === 'Smartphone'))],
                    ['label' => 'Laptop', 'icon' => 'bi-laptop', 'gradient' => 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)', 'count' => count(array_filter($product, fn($p) => $p['category'] === 'Laptop'))],
                    ['label' => 'Lainnya', 'icon' => 'bi-boxes', 'gradient' => 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)', 'count' => count(array_filter($product, fn($p) => !in_array($p['category'], ['Smartphone','Laptop'])))],
                ];
            ?>
            <?php foreach ($statCards as $s): ?>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 bg-gradient text-white" style="background: <?= $s['gradient'] ?>;">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1"><?= $s['label'] ?></p>
                                <h5 class="fw-bold mb-0"><?= $s['count'] ?></h5>
                            </div>
                            <i class="bi <?= $s['icon'] ?> fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Tabel -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-table text-info"></i> Daftar Produk</h6>
                    <small class="text-muted d-block">Informasi lengkap produk yang tersedia</small>
                </div>
                <span class="badge bg-primary">
                    <?= count($product) ?> produk
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold text-uppercase small ps-4">
                                    <i class="bi bi-box2"></i> Nama Produk
                                </th>
                                <th class="fw-semibold text-uppercase small">
                                    <i class="bi bi-tag"></i> Kategori
                                </th>
                                <th class="fw-semibold text-uppercase small text-end">
                                    <i class="bi bi-cash-coin"></i> Harga
                                </th>
                                <th class="fw-semibold text-uppercase small text-center">
                                    <i class="bi bi-check-circle"></i> Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($product)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size:48px;opacity:.2"></i>
                                        <p class="mt-3 text-muted">Tidak ada produk ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php
                                    $categoryMap = [
                                        'Smartphone' => ['icon' => 'bi-phone', 'color' => '#667eea'],
                                        'Laptop'     => ['icon' => 'bi-laptop',  'color' => '#28a745'],
                                        'Tablet'     => ['icon' => 'bi-tablet',  'color' => '#ffc107'],
                                        'Headphone'  => ['icon' => 'bi-headphones', 'color' => '#dc3545'],
                                        'Smartwatch' => ['icon' => 'bi-smartwatch', 'color' => '#17a2b8'],
                                        'Speaker'    => ['icon' => 'bi-speaker', 'color' => '#fd7e14'],
                                        'Gaming Console' => ['icon' => 'bi-controller', 'color' => '#6f42c1'],
                                        'Smart Home' => ['icon' => 'bi-house', 'color' => '#20c997'],
                                        'Earbuds'    => ['icon' => 'bi-earbuds', 'color' => '#e83e8c'],
                                    ];
                                ?>
                                <?php foreach ($product as $p):
                                    $cat = $categoryMap[$p['category']] ?? ['icon' => 'bi-box', 'color' => '#6c757d'];
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="badge rounded-circle me-2" style="background-color: <?= $cat['color'] ?>; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi <?= $cat['icon'] ?> text-white" style="font-size: 14px;"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold small"><?= esc($p['name_product']) ?></div>
                                                <small class="text-muted">SKU-<?= substr(md5($p['name_product']), 0, 6) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill" style="background-color: <?= $cat['color'] ?>; opacity: 0.9; color: white;">
                                            <?= esc($p['category']) ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-end text-success">Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill bg-success text-white">
                                            <i class="bi bi-check-circle me-1"></i>Tersedia
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?= view('layout/footer') ?>