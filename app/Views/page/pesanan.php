<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <div class="page-header mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1"><i class="bi bi-basket2-fill me-2"></i>Data Pesanan</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="bi bi-house-door me-1"></i>Home</a></li>
                            <li class="breadcrumb-item active"><i class="bi bi-receipt me-1"></i>Data Pesanan</li>
                        </ol>
                    </nav>
                </div>
                <span class="badge bg-light text-dark"><i class="bi bi-calendar-event me-1"></i><?= date('d F Y') ?></span>
            </div>
        </div>

        <?php
            $totalOrders  = count($pesanan);
            $totalNominal = array_sum(array_column($pesanan, 'nominal'));
        ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small" style="color: var(--text-muted);">Total Pesanan</p>
                                <h4 class="mb-0 fw-bold" style="color: var(--accent);"><?= $totalOrders ?></h4>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3" style="background-color: var(--accent-soft) !important;">
                                <i class="bi bi-bag-check" style="font-size:28px; color: var(--accent);"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small" style="color: var(--text-muted);">Total Nominal</p>
                                <h4 class="mb-0 fw-bold" style="color: var(--text-strong);">Rp <?= number_format($totalNominal, 0, ',', '.') ?></h4>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded-3" style="background-color: rgba(45, 202, 114, 0.1) !important;">
                                <i class="bi bi-cash-coin" style="font-size:28px; color: #2dca72;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-funnel me-2"></i>Filter Pesanan</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="/pesanan" class="row g-3 align-items-end">
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-currency-exchange me-1"></i>Min Nominal</label>
                        <input type="number" name="min_nominal" class="form-control"
                               placeholder="0" value="<?= $min_nominal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-currency-exchange me-1"></i>Max Nominal</label>
                        <input type="number" name="max_nominal" class="form-control"
                               placeholder="999999999" value="<?= $max_nominal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-calendar-range me-1"></i>Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control"
                               value="<?= $dari_tanggal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-calendar-range me-1"></i>Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control"
                               value="<?= $sampai_tanggal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Filter
                        </button>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <a href="/pesanan" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-table me-2"></i>Daftar Pesanan</h6>
                <span class="badge bg-primary">
                    <i class="bi bi-list-check me-1"></i><?= $totalOrders ?> pesanan
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4"><i class="bi bi-hash me-1"></i>No. Pesanan</th>
                                <th><i class="bi bi-person-circle me-1"></i>Pelanggan</th>
                                <th><i class="bi bi-box-seam me-1"></i>Produk</th>
                                <th><i class="bi bi-cash me-1"></i>Nominal</th>
                                <th><i class="bi bi-calendar3 me-1"></i>Tanggal</th>
                                <th><i class="bi bi-check2-circle me-1"></i>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pesanan)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size:64px;opacity:.2"></i>
                                        <p class="mt-3 text-muted">pesanan ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pesanan as $p): ?>
                                <tr class="align-middle">
                                    <td class="ps-4 fw-semibold text-primary"><?= esc($p['id']) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($p['pelanggan']) ?>&size=32&background=4680FF&color=fff"
                                                 class="rounded-circle" width="32" height="32" alt="Avatar">
                                            <span><?= esc($p['pelanggan']) ?></span>
                                        </div>
                                    </td>
                                    <td><?= esc($p['produk']) ?></td>
                                    <td class="fw-semibold text-success">Rp <?= number_format($p['nominal'], 0, ',', '.') ?></td>
                                    <td class="text-muted"><?= esc($p['tanggal']) ?></td>
                                    <td class="text-center"><?= esc($p['jumlah']) ?></td>
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