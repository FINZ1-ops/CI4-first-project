<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <div class="page-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1">Data Produk</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data Produk</li>
                        </ol>
                    </nav>
                </div>
                <span class="text-muted small"><?= date('l, d F Y') ?></span>
            </div>
        </div>

        <!-- Search -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="/produk" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama produk..."
                           value="<?= $search ?? '' ?>">
                    <button type="submit" class="btn btn-primary px-4">Cari</button>
                    <a href="/produk" class="btn btn-outline-secondary px-4">Reset</a>
                </form>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <?php
                $categories = array_unique(array_column($product, 'category'));
                $statCards  = [
                    ['label' => 'Total Produk', 'icon' => 'ti ti-box',           'color' => 'primary',  'count' => count($product)],
                    ['label' => 'Smartphone',   'icon' => 'ti ti-device-mobile', 'color' => 'info',     'count' => count(array_filter($product, fn($p) => $p['category'] === 'Smartphone'))],
                    ['label' => 'Laptop',       'icon' => 'ti ti-device-laptop', 'color' => 'success',  'count' => count(array_filter($product, fn($p) => $p['category'] === 'Laptop'))],
                    ['label' => 'Lainnya',      'icon' => 'ti ti-package',       'color' => 'warning',  'count' => count(array_filter($product, fn($p) => !in_array($p['category'], ['Smartphone','Laptop'])))],
                ];
            ?>
            <?php foreach ($statCards as $s): ?>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-<?= $s['color'] ?> bg-opacity-10">
                                <i class="<?= $s['icon'] ?> text-<?= $s['color'] ?>"></i>
                            </div>
                        </div>
                        <div class="text-muted small mb-1"><?= $s['label'] ?></div>
                        <div class="stat-value"><?= $s['count'] ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Tabel -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 fw-semibold">Daftar Produk</h6>
                <span class="badge bg-primary bg-opacity-10 text-primary">
                    <?= count($product) ?> produk
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($product)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <i class="ti ti-inbox" style="font-size:48px;opacity:.3"></i>
                                        <p class="mt-2 text-muted">Tidak ada produk ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php
                                    $categoryMap = [
                                        'Smartphone' => ['icon' => 'ti ti-device-mobile', 'color' => 'primary'],
                                        'Laptop'     => ['icon' => 'ti ti-device-laptop',  'color' => 'success'],
                                        'Tablet'     => ['icon' => 'ti ti-tablet',          'color' => 'warning'],
                                        'Headphone'  => ['icon' => 'ti ti-headphones',      'color' => 'danger'],
                                        'Smartwatch' => ['icon' => 'ti ti-watch',           'color' => 'info'],
                                    ];
                                ?>
                                <?php foreach ($product as $p):
                                    $cat = $categoryMap[$p['category']] ?? ['icon' => 'ti ti-box', 'color' => 'secondary'];
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="stat-icon bg-<?= $cat['color'] ?> bg-opacity-10"
                                                 style="width:40px;height:40px;border-radius:10px">
                                                <i class="<?= $cat['icon'] ?> text-<?= $cat['color'] ?>"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold"><?= esc($p['name_product']) ?></div>
                                                <small class="text-muted">SKU-<?= substr(md5($p['name_product']), 0, 6) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?= $cat['color'] ?> bg-opacity-10 text-<?= $cat['color'] ?>">
                                            <?= esc($p['category']) ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold">Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="ti ti-circle-filled me-1" style="font-size:8px"></i>Tersedia
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