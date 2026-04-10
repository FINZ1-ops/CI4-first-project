<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1">Data Suplai</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Data Suplai</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('modalSupplier').classList.remove('d-none')">
                        <i class="ti ti-building me-1"></i> Daftar Supplier
                    </button>
                    <span class="text-muted small align-self-center"><?= date('l, d F Y') ?></span>
                </div>
            </div>
        </div>

        <?php
            $totalSuplai    = count($suplai);
            $totalProduk    = count(array_unique(array_column(iterator_to_array($suplai), 'produk')));
            $totalSupplier  = count(array_unique(array_column(iterator_to_array($suplai), 'supplier')));
            $totalNilai     = array_sum(array_column(iterator_to_array($suplai), 'subtotal'));
            // reset pointer setelah iterator_to_array
            $suplai = array_values((array)$suplai);
        ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-primary bg-opacity-10">
                                <i class="ti ti-truck text-primary"></i>
                            </div>
                            <span class="badge bg-primary bg-opacity-10 text-primary">Total</span>
                        </div>
                        <div class="text-muted small mb-1">Total Suplai</div>
                        <div class="stat-value"><?= $totalSuplai ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-success bg-opacity-10">
                                <i class="ti ti-box text-success"></i>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success">Produk</span>
                        </div>
                        <div class="text-muted small mb-1">Jenis Produk</div>
                        <div class="stat-value"><?= $totalProduk ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-warning bg-opacity-10">
                                <i class="ti ti-building text-warning"></i>
                            </div>
                            <span class="badge bg-warning bg-opacity-10 text-warning">Supplier</span>
                        </div>
                        <div class="text-muted small mb-1">Jumlah Supplier</div>
                        <div class="stat-value"><?= $totalSupplier ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon bg-danger bg-opacity-10">
                                <i class="ti ti-cash text-danger"></i>
                            </div>
                            <span class="badge bg-danger bg-opacity-10 text-danger">Nilai</span>
                        </div>
                        <div class="text-muted small mb-1">Total Nilai Suplai</div>
                        <div class="stat-value" style="font-size:18px">Rp <?= number_format($totalNilai, 0, ',', '.') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="mb-0 fw-semibold">Filter Data Suplai</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="/suplai" class="row g-3 align-items-end">
                    <div class="col-sm-6 col-lg-4">
                        <label class="form-label small fw-semibold">Cari Produk</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Nama produk..."
                               value="<?= $search ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control"
                               value="<?= $dari_tanggal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control"
                               value="<?= $sampai_tanggal ?? '' ?>">
                    </div>
                    <div class="col-6 col-lg-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ti ti-filter"></i>
                        </button>
                    </div>
                    <div class="col-6 col-lg-1">
                        <a href="/suplai" class="btn btn-outline-secondary w-100">
                            <i class="ti ti-refresh"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Suplai -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 fw-semibold">Daftar Suplai Produk</h6>
                <span class="badge bg-primary bg-opacity-10 text-primary">
                    <?= $totalSuplai ?> data
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama Produk</th>
                                <th>Supplier</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($suplai)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="ti ti-inbox" style="font-size:48px;opacity:.3"></i>
                                        <p class="mt-2 text-muted">Tidak ada data suplai ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($suplai as $s): ?>
                                <tr>
                                    <td class="ps-4"><?= $no++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="stat-icon bg-primary bg-opacity-10"
                                                 style="width:36px;height:36px;border-radius:8px;font-size:16px">
                                                <i class="ti ti-box text-primary"></i>
                                            </div>
                                            <span class="fw-semibold"><?= esc($s['produk']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                            <i class="ti ti-building me-1"></i><?= esc($s['supplier']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold"><?= number_format($s['jumlah']) ?></span>
                                        <small class="text-muted ms-1">unit</small>
                                    </td>
                                    <td class="text-muted"><?= date('d M Y', strtotime($s['tanggal'])) ?></td>
                                    <td class="text-end pe-4 fw-semibold text-success">
                                        Rp <?= number_format($s['subtotal'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <?php if (!empty($suplai)): ?>
                        <tfoot>
                            <tr style="border-top: 2px solid var(--border)">
                                <td colspan="5" class="ps-4 fw-bold">Total Keseluruhan</td>
                                <td class="text-end pe-4 fw-bold text-success">
                                    Rp <?= number_format($totalNilai, 0, ',', '.') ?>
                                </td>
                            </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Daftar Supplier -->
<div id="modalSupplier" class="d-none" style="position:fixed;inset:0;z-index:1100;  place-items:center">
    <div style="position:absolute;inset:0;background:rgba(15,23,42,.55)" onclick="document.getElementById('modalSupplier').classList.add('d-none')"></div>
    <div style="position:relative;width:min(480px,calc(100% - 32px));background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:1.5rem;z-index:1">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="mb-0 fw-semibold">Daftar Perusahaan Supplier</h6>
            <button class="btn-close" onclick="document.getElementById('modalSupplier').classList.add('d-none')"></button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Perusahaan</th>
                        <th>Kategori</th>
                        <th class="text-end">Suplai Aktif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $suppliers = [
                            ['nama' => 'Apple',     'kategori' => 'Electronics', 'aktif' => 3],
                            ['nama' => 'Samsung',   'kategori' => 'Electronics', 'aktif' => 1],
                            ['nama' => 'Sony',      'kategori' => 'Audio',       'aktif' => 1],
                            ['nama' => 'Dell',      'kategori' => 'Laptop',      'aktif' => 1],
                            ['nama' => 'Google',    'kategori' => 'Electronics', 'aktif' => 1],
                            ['nama' => 'LG',        'kategori' => 'Electronics', 'aktif' => 1],
                            ['nama' => 'Nintendo',  'kategori' => 'Gaming',      'aktif' => 1],
                            ['nama' => 'Lenovo',    'kategori' => 'Laptop',      'aktif' => 1],
                        ];
                        foreach ($suppliers as $sup):
                    ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="stat-icon bg-primary bg-opacity-10"
                                     style="width:32px;height:32px;border-radius:8px;font-size:14px">
                                    <i class="ti ti-building text-primary"></i>
                                </div>
                                <span class="fw-semibold"><?= $sup['nama'] ?></span>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary bg-opacity-10 text-secondary"><?= $sup['kategori'] ?></span></td>
                        <td class="text-end">
                            <span class="badge bg-success bg-opacity-10 text-success"><?= $sup['aktif'] ?> aktif</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .modal-overlay { display: none; }
    .modal-overlay:not(.d-none) { display: grid; }
</style>

<?= view('layout/footer') ?>