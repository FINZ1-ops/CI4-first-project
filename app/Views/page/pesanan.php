<?php
function formatNominalPHP($n) {
    if ($n >= 1000000000000) return 'Rp ' . number_format($n/1000000000000, 1, ',', '.') . 'T';
    if ($n >= 1000000000)    return 'Rp ' . number_format($n/1000000000, 1, ',', '.') . 'M';
    if ($n >= 1000000)       return 'Rp ' . number_format($n/1000000, 1, ',', '.') . 'JT';
    if ($n >= 1000)          return 'Rp ' . number_format($n/1000, 1, ',', '.') . 'K';
    return 'Rp ' . number_format($n, 0, ',', '.');
} ?>

<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">
    
        <!-- Page Header -->
        <div class="mb-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold text-dark mb-2"><i class="bi bi-basket2-fill"></i> Data Pesanan</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '→';">
                        <ol class="breadcrumb breadcrumb-dots small mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Pesanan</li>
                        </ol>
                    </nav>
                </div>
                <span class="text-muted small"><i class="bi bi-calendar-event"></i> <?= date('d M Y') ?></span>
            </div>
        </div>

        <?php
            $totalOrders  = count($pesanan);
            $totalNominal = array_sum(array_column($pesanan, 'nominal'));
        ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Total Pesanan</p>
                                <h5 class="fw-bold mb-0"><?= $totalOrders ?></h5>
                            </div>
                            <i class="bi bi-bag-check fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Total Nominal</p>
                                <h5 class="fw-bold mb-0"><?= formatNominalPHP($totalNominal) ?></h5>
                            </div>
                            <i class="bi bi-cash-coin fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Rata-rata Nilai</p>
                                <h5 class="fw-bold mb-0">Rp <?= number_format($totalNominal / max(1, $totalOrders) / 1000000, 1, ',', '.') ?>M</h5>
                            </div>
                            <i class="bi bi-graph-up fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Status Terlaris</p>
                                <h5 class="fw-bold mb-0">Proses</h5>
                            </div>
                            <i class="bi bi-fire fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h6 class="mb-1 fw-semibold text-dark"><i class="bi bi-funnel text-primary"></i> Filter Pesanan</h6>
                <small class="text-muted d-block">Cari pesanan berdasarkan kriteria</small>
            </div>
            <div class="card-body">
                <form method="GET" action="/pesanan" class="row g-3 align-items-end">
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-currency-exchange me-1"></i>Min Nominal</label>
                        <input type="number" name="min_nominal" class="form-control form-control-sm"
                               placeholder="0" value="<?= $min_nominal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-currency-exchange me-1"></i>Max Nominal</label>
                        <input type="number" name="max_nominal" class="form-control form-control-sm"
                               placeholder="999999999" value="<?= $max_nominal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <label class="form-label small fw-semibold"><i class="bi bi-calendar-range me-1"></i>Dari</label>
                        <input type="date" name="dari_tanggal" class="form-control form-control-sm"
                               value="<?= $dari_tanggal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <label class="form-label small fw-semibold"><i class="bi bi-calendar-range me-1"></i>Sampai</label>
                        <input type="date" name="sampai_tanggal" class="form-control form-control-sm"
                               value="<?= $sampai_tanggal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="col-sm-6 col-lg-1">
                        <a href="/pesanan" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-table text-info"></i> Daftar Pesanan</h6>
                    <small class="text-muted d-block">Rincian pesanan pelanggan</small>
                </div>
                <span class="badge bg-primary">
                    <i class="bi bi-list-check me-1"></i><?= $totalOrders ?> pesanan
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold text-uppercase small ps-4"><i class="bi bi-hash me-1"></i>No. Pesanan</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-person-circle me-1"></i>Pelanggan</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-box-seam me-1"></i>Produk</th>
                                <th class="fw-semibold text-uppercase small text-end"><i class="bi bi-cash me-1"></i>Nominal</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-calendar3 me-1"></i>Tanggal</th>
                                <th class="fw-semibold text-uppercase small text-center"><i class="bi bi-check2-circle me-1"></i>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-pesanan">
                            <?php if (empty($pesanan)): ?>
                                <tr data-row="1">
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size:48px;opacity:.2"></i>
                                        <p class="mt-3 text-muted">Pesanan tidak ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pesanan as $p): ?>
                                <tr data-row="1">
                                    <td class="ps-4 fw-semibold">
                                        <span class="badge bg-light text-dark text-set"><?= esc($p['id']) ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($p['pelanggan']) ?>&size=32&background=667eea&color=fff"
                                                 class="rounded-circle" width="32" height="32" alt="Avatar">
                                            <span class="small"><?= esc($p['pelanggan']) ?></span>
                                        </div>
                                    </td>
                                    <td><small><?= esc($p['produk']) ?></small></td>
                                    <td class="fw-semibold text-end text-success small">Rp <?= number_format($p['nominal'], 0, ',', '.') ?></td>
                                    <td class="text-muted small"><?= esc($p['tanggal']) ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-success text-white text-info"><?= esc($p['jumlah']) ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination controls -->
                <div class="px-3 pb-3" id="pag-pesanan"></div>
            </div>
        </div>

    </div>
</div>


<script>
(function() {
    /**
     * Client-side pagination helper (no server calls).
     *
     * Contract HTML:
     * - `tbodyId` is a <tbody> element.
     * - Each row that must be paginated must have attribute `data-row`.
     * - Pagination buttons are rendered inside element `pagId`.
     *
     * Notes:
     * - Pagination "page size" (`perPage`) is chosen on initial page load.
     */
    function paginate(tbodyId, pagId, perPage) {
        var tbody = document.getElementById(tbodyId);
        if (!tbody) return;
        var rows = Array.from(tbody.querySelectorAll('tr[data-row]'));
        var total = rows.length;
        var totalPages = Math.ceil(total / perPage);
        var cur = 1;
        function show(page) {
            cur = Math.max(1, Math.min(page, totalPages));
            rows.forEach(function(r, i) {
                r.style.display = (i >= (cur-1)*perPage && i < cur*perPage) ? '' : 'none';
            });
            render();
        }
        function render() {
            var el = document.getElementById(pagId);
            if (!el) return;
            if (totalPages <= 1) { el.innerHTML = ''; return; }
            var from = (cur-1)*perPage + 1;
            var to = Math.min(cur*perPage, total);
            var btns = '';
            btns += '<li class="page-item' + (cur===1?' disabled':'') + '"><a class="page-link" href="#" data-p="' + (cur-1) + '">&laquo;</a></li>';
            for (var p = 1; p <= totalPages; p++) {
                if (p === 1 || p === totalPages || (p >= cur-1 && p <= cur+1)) {
                    btns += '<li class="page-item' + (p===cur?' active':'') + '"><a class="page-link" href="#" data-p="' + p + '">' + p + '</a></li>';
                } else if (p === cur-2 || p === cur+2) {
                    btns += '<li class="page-item disabled"><span class="page-link">…</span></li>';
                }
            }
            btns += '<li class="page-item' + (cur===totalPages?' disabled':'') + '"><a class="page-link" href="#" data-p="' + (cur+1) + '">&raquo;</a></li>';
            el.innerHTML = '<nav><ul class="pagination pagination-sm mb-0">' + btns + '</ul></nav>' +
                '<small class="text-muted ms-3">Menampilkan ' + from + '–' + to + ' dari ' + total + '</small>';
            el.querySelectorAll('a.page-link').forEach(function(a) {
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    var pg = parseInt(this.getAttribute('data-p'));
                    if (!isNaN(pg)) show(pg);
                });
            });
        }
        show(1);
    }
    window._paginate = paginate;
})();
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 5-8 baris per halaman: mobile 5, desktop 8
        var perPage = window.innerWidth < 768 ? 5 : 8;
        window._paginate("tbody-pesanan", "pag-pesanan", perPage);
    });
</script>

<?= view('layout/footer') ?>