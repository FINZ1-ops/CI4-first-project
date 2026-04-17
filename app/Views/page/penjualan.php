<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<style>
/* ===== PENJUALAN MOBILE ===== */
@media (max-width: 768px) {
    .card-body { padding: 12px !important; }
    .form-label { font-size: 12px; }
    .row.g-3 { --bs-gutter-y: 12px; }
}

@media (max-width: 576px) {
    .col-sm-6 { flex: 0 0 100%; max-width: 100%; }
    .form-control-sm { font-size: 12px; }
    .table { font-size: 12px; }
    .table th { font-size: 10px; padding: 6px 4px !important; }
    .table td { padding: 6px 4px !important; }
    .badge { font-size: 10px; }
}

@media (max-width: 480px) {
    .table { font-size: 11px; }
    .table th { font-size: 9px; padding: 4px 2px !important; }
    .table td { padding: 4px 2px !important; }
    .ps-4 { padding-left: 6px !important; }
    .badge { padding: 2px 6px; }
}
</style>

<div class="pc-container">
    <div class="pc-content">
        <!-- Page Header -->
        <div class="mb-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold text-dark mb-2"><i class="bi bi-graph-up-arrow"></i> Laporan Penjualan</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '→';">
                        <ol class="breadcrumb breadcrumb-dots small mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Penjualan</li>
                        </ol>
                    </nav>
                </div>
                <span class="text-muted small"><i class="bi bi-calendar3-week"></i> <span id="currentDate"><?= date('d M Y') ?></span></span>
            </div>
        </div>

        <!-- KPI Cards Row -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-white p-3 p-sm-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="d-flex align-items-start justify-content-between gap-2">
                            <div style="min-width: 0;">
                                <p class="card-text small opacity-75 mb-2">Total Pendapatan</p>
                                <h6 class="fw-bold mb-0">Rp 32.5 JT</h6>
                            </div>
                            <i class="bi bi-graph-up opacity-50" style="flex-shrink: 0; font-size: 1.25rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-white p-3 p-sm-4" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="d-flex align-items-start justify-content-between gap-2">
                            <div style="min-width: 0;">
                                <p class="card-text small opacity-75 mb-2">Total Pesanan</p>
                                <h6 class="fw-bold mb-0">1,745</h6>
                            </div>
                            <i class="bi bi-cart-fill opacity-50" style="flex-shrink: 0; font-size: 1.25rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-white p-3 p-sm-4" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <div class="d-flex align-items-start justify-content-between gap-2">
                            <div style="min-width: 0;">
                                <p class="card-text small opacity-75 mb-2">Pesanan Selesai</p>
                                <h6 class="fw-bold mb-0">68%</h6>
                            </div>
                            <i class="bi bi-check-circle-fill opacity-50" style="flex-shrink: 0; font-size: 1.25rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-white p-3 p-sm-4" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <div class="d-flex align-items-start justify-content-between gap-2">
                            <div style="min-width: 0;">
                                <p class="card-text small opacity-75 mb-2">Avg Order Value</p>
                                <h6 class="fw-bold mb-0">Rp 18.6 M</h6>
                            </div>
                            <i class="bi bi-wallet2 opacity-50" style="flex-shrink: 0; font-size: 1.25rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik + Produk Terlaris -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2">
                            <div>
                                <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-graph-up text-primary"></i> Grafik Penjualan</h6>
                                <small class="text-muted d-block">Tren pendapatan & volume pesanan</small>
                            </div>
                            <div class="btn-group btn-group-sm flex-wrap" id="periodeBtns" role="group">
                                <input type="radio" class="btn-check" name="periode" id="periode_minggu" value="minggu" checked onchange="gantiPeriode(event)">
                                <label class="btn btn-outline-secondary" for="periode_minggu">
                                    <i class="bi bi-calendar-week"></i> Minggu
                                </label>

                                <input type="radio" class="btn-check" name="periode" id="periode_bulan" value="bulan" onchange="gantiPeriode(event)">
                                <label class="btn btn-outline-secondary" for="periode_bulan">
                                    <i class="bi bi-calendar-month"></i> Bulan
                                </label>

                                <input type="radio" class="btn-check" name="periode" id="periode_tahun" value="tahun" onchange="gantiPeriode(event)">
                                <label class="btn btn-outline-secondary" for="periode_tahun">
                                    <i class="bi bi-calendar-year"></i> Tahun
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 pt-md-4" style="position: relative; height: 300px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-star-fill text-warning"></i> Produk Terlaris</h6>
                        <small class="text-muted d-block">Top 5 produk minggu ini</small>
                    </div>
                    <div class="card-body" id="terlarisList">
                        <div class="text-center text-muted py-5">
                            <small><i class="bi bi-hourglass-split"></i> Loading...</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Tabel -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-table text-info"></i> Detail Penjualan Produk</h6>
                    <small class="text-muted d-block">Rincian lengkap penjualan per produk</small>
                </div>
                <div class="btn-group btn-group-sm" id="tablePeriodeBtns" role="group">
                    <input type="radio" class="btn-check" name="tablePeriode" id="tabel_minggu" value="minggu" checked onchange="gantiTabelPeriode(event)">
                    <label class="btn btn-outline-secondary" for="tabel_minggu">
                        <i class="bi bi-calendar-week"></i> Minggu
                    </label>

                    <input type="radio" class="btn-check" name="tablePeriode" id="tabel_bulan" value="bulan" onchange="gantiTabelPeriode(event)">
                    <label class="btn btn-outline-secondary" for="tabel_bulan">
                        <i class="bi bi-calendar-month"></i> Bulan
                    </label>

                    <input type="radio" class="btn-check" name="tablePeriode" id="tabel_tahun" value="tahun" onchange="gantiTabelPeriode(event)">
                    <label class="btn btn-outline-secondary" for="tabel_tahun">
                        <i class="bi bi-calendar-year"></i> Tahun
                    </label>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold text-uppercase small ps-4">
                                    <i class="bi bi-box"></i> Nama Produk
                                </th>
                                <th class="fw-semibold text-uppercase small text-center">
                                    <i class="bi bi-bag-check"></i> Terjual
                                </th>
                                <th class="fw-semibold text-uppercase small text-end">
                                    <i class="bi bi-cash-coin"></i> Pendapatan
                                </th>
                                <th class="fw-semibold text-uppercase small text-center">
                                    <i class="bi bi-graph-up"></i> Performa
                                </th>
                            </tr>
                        </thead>
                        <tbody id="produkTable">
                            <tr>
                                <td colspan="10" class="text-center text-muted py-5">
                                    <small><i class="bi bi-hourglass-split"></i> Loading...</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 d-flex align-items-center flex-wrap gap-2 py-3" id="pag-penjualan"></div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chartInstance = null;

    function formatNominal(n) {
        if (!Number.isFinite(n)) return 'Rp 0';
        const a = Math.abs(n);
        if (a >= 1e12) return 'Rp ' + (n/1e12).toFixed(1) + 'T';
        if (a >= 1e9)  return 'Rp ' + (n/1e9).toFixed(1) + 'M';
        if (a >= 1e6)  return 'Rp ' + (n/1e6).toFixed(1) + 'JT';
        if (a >= 1e3)  return 'Rp ' + (n/1e3).toFixed(1) + 'K';
        return 'Rp ' + Math.floor(n);
    }

    const produk_minggu = <?= json_encode($produk_minggu ?? []) ?>;
    const produk_bulan  = <?= json_encode($produk_bulan ?? []) ?>;
    const produk_tahun  = <?= json_encode($produk_tahun ?? []) ?>;

    const chartData = {
        minggu: {
            labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
            pendapatan: [3200000,4100000,3800000,5200000,4800000,6100000,5500000],
            pesanan: [120,180,160,210,195,240,220]
        },
        bulan: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            pendapatan: [42000000,38000000,51000000,47000000,55000000,62000000,58000000,70000000,65000000,72000000,68000000,80000000],
            pesanan: [1200,1100,1400,1350,1600,1800,1700,2000,1900,2100,2000,2400]
        },
        tahun: {
            labels: ['2021','2022','2023','2024','2025','2026'],
            pendapatan: [320000000,410000000,480000000,520000000,610000000,250000000],
            pesanan: [9800,12400,14200,15800,18600,7200]
        }
    };

    function initChart() {
        const ctx = document.getElementById('salesChart');
        if (!ctx) return;

        if (chartInstance) chartInstance.destroy();

        const isMobile = window.innerWidth < 768;
        const pointRadius = isMobile ? 2 : 3.5;
        const pointHoverRadius = isMobile ? 3 : 5;
        const fontSize = isMobile ? 9 : 11;

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.minggu.labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: chartData.minggu.pendapatan,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102,126,234,0.08)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#667eea',
                    pointRadius: pointRadius,
                    pointHoverRadius: pointHoverRadius,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    borderWidth: 2
                },{
                    label: 'Pesanan',
                    data: chartData.minggu.pesanan,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40,167,69,0.08)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#28a745',
                    pointRadius: pointRadius,
                    pointHoverRadius: pointHoverRadius,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    borderWidth: 2,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: isMobile ? 'bottom' : 'top',
                        labels: {
                            usePointStyle: true,
                            padding: isMobile ? 8 : 15,
                            font: { size: fontSize, weight: 500 }
                        }
                    },
                    filler: { propagate: true }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: {
                            callback: v => formatNominal(v),
                            font: { size: fontSize - 1 }
                        }
                    },
                    y1: {
                        position: 'right',
                        beginAtZero: true,
                        grid: { drawOnChartArea: false },
                        ticks: {
                            callback: v => v.toLocaleString('id-ID'),
                            font: { size: fontSize - 1 }
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { font: { size: fontSize - 1 } }
                    }
                }
            }
        });
    }

    function gantiPeriode(e) {
        const periode = e.target.value;
        const d = chartData[periode];

        if (chartInstance) {
            chartInstance.data.labels = d.labels;
            chartInstance.data.datasets[0].data = d.pendapatan;
            chartInstance.data.datasets[1].data = d.pesanan;
            chartInstance.update('active');
        }

        tampilkanTerlaris(periode);
    }

    function tampilkanTerlaris(periode) {
        const d = periode === 'minggu' ? produk_minggu : periode === 'bulan' ? produk_bulan : produk_tahun;

        if (!Array.isArray(d) || d.length === 0) {
            document.getElementById('terlarisList').innerHTML = '<p class="text-center text-muted py-5">Tidak ada data</p>';
            return;
        }

        const colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#fdbb2d'];
        document.getElementById('terlarisList').innerHTML = d.slice(0, 5).map((p, i) => `
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill" style="background-color: ${colors[i]}">#${i+1}</span>
                    <div>
                        <div class="fw-semibold small">${p.nama || 'N/A'}</div>
                        <small class="text-muted"><i class="bi bi-bag"></i> ${p.terjual || 0} unit</small>
                    </div>
                </div>
                <span class="fw-semibold text-success small">${formatNominal(p.pendapatan || 0)}</span>
            </div>
        `).join('');
    }

    // Simpan pilihan periode untuk tabel produk, supaya saat window resize
    // kita bisa merender ulang dengan per-page yang sesuai (5/8).
    var currentTabelPeriode = 'minggu';

    function tampilkanTabelProduk(periode) {
        const d = periode === 'minggu' ? produk_minggu : periode === 'bulan' ? produk_bulan : produk_tahun;

        if (!Array.isArray(d) || d.length === 0) {
            document.getElementById('produkTable').innerHTML = '<tr><td colspan="4" class="text-center text-muted py-5">Tidak ada data</td></tr>';
            return;
        }

        const colors = ['#667eea', '#f093fb', '#4facfe', '#fa709a', '#fdbb2d', '#fd7e14', '#e83e8c', '#20c997', '#6f42c1', '#17a2b8'];
        const maxRevenue = Math.max(...d.map(p => p.pendapatan));

        // Pagination for table "Detail Penjualan Produk".
        // per-page dipilih dari viewport width saat tabel dirender.
        var _pjData = d;
        var _pjPer = window.innerWidth < 768 ? 5 : 8;
        function renderPJ(page) {
            var tot = _pjData.length;
            var totPg = Math.ceil(tot / _pjPer);
            var cur = Math.max(1, Math.min(page, totPg));
            var slice = _pjData.slice((cur-1)*_pjPer, cur*_pjPer);
            const maxRevenue = Math.max(..._pjData.map(p => p.pendapatan));
            const colors = ['#667eea','#f093fb','#4facfe','#fa709a','#fdbb2d','#fd7e14','#e83e8c','#20c997','#6f42c1','#17a2b8'];
            document.getElementById('produkTable').innerHTML = slice.map((p, i) => {
                const gi = (cur-1)*_pjPer + i;
                const pct = (p.pendapatan / maxRevenue) * 100;
                return `<tr>
                    <td class="ps-4"><div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-circle" style="background-color:${colors[gi%colors.length]};width:24px;height:24px;display:flex;align-items:center;justify-content:center;font-size:10px">${gi+1}</span>
                        <span class="fw-500">${p.nama||'N/A'}</span></div></td>
                    <td class="text-center"><span class="badge bg-light text-dark">${p.terjual||0} unit</span></td>
                    <td class="text-end"><span class="fw-semibold text-success">${formatNominal(p.pendapatan||0)}</span></td>
                    <td><div class="progress" style="height:5px"><div class="progress-bar" style="background-color:${colors[gi%colors.length]};width:${pct}%"></div></div></td>
                </tr>`;
            }).join('');
            var el = document.getElementById('pag-penjualan');
            if (!el) return;
            if (totPg <= 1) { el.innerHTML=''; return; }
            var from=(cur-1)*_pjPer+1, to=Math.min(cur*_pjPer,tot), btns='';
            btns+='<li class="page-item'+(cur===1?' disabled':'')+'"><a class="page-link pjp" href="#" data-p="'+(cur-1)+'">&laquo;</a></li>';
            for(var pg=1;pg<=totPg;pg++){
                if(pg===1||pg===totPg||(pg>=cur-1&&pg<=cur+1)) btns+='<li class="page-item'+(pg===cur?' active':'')+'"><a class="page-link pjp" href="#" data-p="'+pg+'">'+pg+'</a></li>';
                else if(pg===cur-2||pg===cur+2) btns+='<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
            btns+='<li class="page-item'+(cur===totPg?' disabled':'')+'"><a class="page-link pjp" href="#" data-p="'+(cur+1)+'">&raquo;</a></li>';
            el.innerHTML='<nav><ul class="pagination pagination-sm mb-0">'+btns+'</ul></nav><small class="text-muted ms-3">Menampilkan '+from+'–'+to+' dari '+tot+'</small>';
            el.querySelectorAll('a.pjp').forEach(function(a){a.addEventListener('click',function(e){e.preventDefault();renderPJ(parseInt(this.getAttribute('data-p')));});});
        }
        renderPJ(1);
    }

    function gantiTabelPeriode(e) {
        const periode = e.target.value;
        currentTabelPeriode = periode;
        tampilkanTabelProduk(periode);
        tampilkanTerlaris(periode);
    }

    document.addEventListener('DOMContentLoaded', function() {
        initChart();
        tampilkanTerlaris('minggu');
        tampilkanTabelProduk('minggu');
        currentTabelPeriode = 'minggu';
    });

    window.addEventListener('resize', function() {
        if (chartInstance) {
            chartInstance.resize();
        }
        // Reset halaman ke 1, agar per-page (5/8) sesuai lebar layar saat ini.
        tampilkanTabelProduk(currentTabelPeriode);
    });
</script>

<?= view('layout/footer') ?>