<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="mb-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold text-dark mb-2"><i class="bi bi-truck"></i> Data Suplai</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '→';">
                        <ol class="breadcrumb breadcrumb-dots small mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Suplai</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <button class="btn btn-outline-primary btn-sm" onclick="document.getElementById('modalSupplier').classList.remove('d-none')">
                        <i class="bi bi-building me-1"></i> Supplier
                    </button>
                    <span class="text-muted small"><i class="bi bi-calendar3-week"></i> <?= date('d M Y') ?></span>
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

            // Format nominal K, M, B, T
            function formatNominal($n) {
                if ($n >= 1000000000000) {
                    return 'Rp ' . number_format($n / 1000000000000, 1, ',', '.') . 'T';
                } elseif ($n >= 1000000000) {
                    return 'Rp ' . number_format($n / 1000000000, 1, ',', '.') . 'M';
                } elseif ($n >= 1000000) {
                    return 'Rp ' . number_format($n / 1000000, 1, ',', '.') . 'JT';
                } elseif ($n >= 1000) {
                    return 'Rp ' . number_format($n / 1000, 1, ',', '.') . 'K';
                }
                return 'Rp ' . number_format($n, 0, ',', '.');
            }
        ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Total Suplai</p>
                                <h5 class="fw-bold mb-0"><?= $totalSuplai ?></h5>
                            </div>
                            <i class="bi bi-truck fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Jenis Produk</p>
                                <h5 class="fw-bold mb-0"><?= $totalProduk ?></h5>
                            </div>
                            <i class="bi bi-box2 fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Jumlah Supplier</p>
                                <h5 class="fw-bold mb-0"><?= $totalSupplier ?></h5>
                            </div>
                            <i class="bi bi-building fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #dc3545 0%, #e74c3c 100%);">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="card-text small opacity-75 mb-1">Total Nilai</p>
                                <h5 class="fw-bold mb-0" style="font-size: 16px;"><?= formatNominal($totalNilai) ?></h5>
                            </div>
                            <i class="bi bi-cash-coin fa-lg opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h6 class="mb-1 fw-semibold text-dark"><i class="bi bi-funnel text-primary"></i> Filter Data Suplai</h6>
                <small class="text-muted d-block">Cari berdasarkan produk atau tanggal</small>
            </div>
            <div class="card-body">
                <form method="GET" action="/suplai" class="row g-3 align-items-end">
                    <div class="col-sm-6 col-lg-4">
                        <label class="form-label small fw-semibold"><i class="bi bi-search me-1"></i>Cari Produk</label>
                        <input type="text" name="search" class="form-control form-control-sm"
                               placeholder="Nama produk..."
                               value="<?= $search ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-calendar-range me-1"></i>Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control form-control-sm"
                               value="<?= $dari_tanggal ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold"><i class="bi bi-calendar-range me-1"></i>Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control form-control-sm"
                               value="<?= $sampai_tanggal ?? '' ?>">
                    </div>
                    <div class="col-6 col-lg-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="col-6 col-lg-1">
                        <a href="/suplai" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Suplai -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-table text-info"></i> Daftar Suplai Produk</h6>
                    <small class="text-muted d-block">Data suplai dari supplier</small>
                </div>
                <span class="badge bg-primary">
                    <?= $totalSuplai ?> data
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold text-uppercase small ps-4">#</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-box2"></i> Produk</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-building"></i> Supplier</th>
                                <th class="fw-semibold text-uppercase small text-center"><i class="bi bi-boxes"></i> Jumlah</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-calendar3"></i> Tanggal</th>
                                <th class="fw-semibold text-uppercase small text-end pe-4"><i class="bi bi-cash-coin"></i> Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-suplai">
                            <?php if (empty($suplai)): ?>
                                <tr data-row="1">
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox" style="font-size:48px;opacity:.2"></i>
                                        <p class="mt-3 text-muted">Tidak ada data suplai ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($suplai as $s): ?>
                                <tr data-row="1">
                                    <td class="ps-4">
                                        <span class="badge bg-light text-dark"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="badge rounded-circle" style="background-color: #667eea; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-box2 text-white" style="font-size: 14px;"></i>
                                            </div>
                                            <span class="fw-semibold small"><?= esc($s['produk']) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary text-white" style="min-width: 120px; display: inline-block;">
                                            <i class="bi bi-building me-1"></i><?= esc($s['supplier']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-semibold"><?= number_format($s['jumlah']) ?></span>
                                        <small class="text-muted ms-1">unit</small>
                                    </td>
                                    <td class="text-muted small"><?= date('d M Y', strtotime($s['tanggal'])) ?></td>
                                    <td class="text-end pe-4 fw-semibold text-success">
                                        <?= formatNominal($s['subtotal']) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <?php if (!empty($suplai)): ?>
                        <tfoot>
                            <tr class="fw-bold" style="border-top: 2px solid var(--border)">
                                <td colspan="5" class="ps-4">Total Keseluruhan</td>
                                <td class="text-end pe-4 text-success">
                                    <?= formatNominal($totalNilai) ?>
                                </td>
                            </tr>
                        </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
                <!-- Pagination controls -->
                <div class="px-3 pb-3" id="pag-suplai"></div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Daftar Supplier -->
<div id="modalSupplier" class="d-none" style="position:fixed;inset:0;z-index:1100;display:grid;place-items:center">
    <div style="position:absolute;inset:0;background:rgba(15,23,42,.55)" onclick="document.getElementById('modalSupplier').classList.add('d-none')"></div>
    <div style="position:relative;width:min(600px,calc(100% - 32px));background:var(--surface);border:1px solid var(--border);border-radius:12px;padding:1.5rem;z-index:1">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h6 class="mb-0 fw-semibold text-dark">Daftar Perusahaan Supplier</h6>
                <small class="text-muted d-block">Perusahaan supplier yang aktif bekerja sama</small>
            </div>
            <button class="btn-close" onclick="document.getElementById('modalSupplier').classList.add('d-none')"></button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small fw-semibold">Perusahaan</th>
                        <th class="small fw-semibold">Kategori</th>
                        <th class="small fw-semibold text-end">Suplai Aktif</th>
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
                                <div class="badge rounded-circle" style="background-color: #667eea; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-building text-white" style="font-size: 14px;"></i>
                                </div>
                                <span class="fw-semibold small"><?= $sup['nama'] ?></span>
                            </div>
                        </td>
                        <td><span class="badge rounded-pill bg-success text-white"><?= $sup['kategori'] ?></span></td>
                        <td class="text-end">
                            <span class="badge rounded-pill bg-success text-white"><?= $sup['aktif'] ?> aktif</span>
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
     * - `perPage` is computed on initial page load.
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
        window._paginate("tbody-suplai", "pag-suplai", perPage);
    });
</script>

<?= view('layout/footer') ?>