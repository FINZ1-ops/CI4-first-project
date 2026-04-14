<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<style>
/* ===== DASHBOARD MOBILE ===== */
@media (max-width: 576px) {
    .stat-card .card-body { padding: 14px !important; }
    .stat-card .stat-value { font-size: 22px !important; }
    .stat-card .stat-badge-text { font-size: 11px !important; }
    .stat-card .stat-bg-icon { font-size: 55px !important; }
    .chart-wrap { height: 220px !important; }
    .donut-wrap { height: 180px !important; }
    .hide-mobile { display: none !important; }
}
@media (max-width: 768px) {
    .chart-wrap { height: 250px; }
    .donut-wrap { height: 200px; }
}
.chart-wrap { position: relative; height: 300px; }
.donut-wrap { position: relative; height: 280px; }

/* Legend warna ikut tema */
.legend-box { display: flex; align-items: center; justify-content: space-between; padding: 8px 12px; border-radius: 8px; margin-bottom: 8px; }
</style>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h4 class="mb-1 fw-bold" style="color:var(--text-strong)">
                        <i class="bi bi-speedometer2 me-2" style="color:var(--accent)"></i>Dashboard
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb small mb-0">
                            <li class="breadcrumb-item"><a href="#" style="color:var(--accent)">Home</a></li>
                            <li class="breadcrumb-item active" style="color:var(--text-muted)">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <span style="color:var(--text-muted);font-size:13px">
                    <i class="bi bi-calendar3 me-1"></i><?= date('d M Y') ?>
                </span>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">

            <!-- Total Pengguna -->
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 position-relative overflow-hidden"
                     style="background:linear-gradient(135deg,#667eea,#764ba2)">
                    <div class="card-body text-white position-relative" style="z-index:2">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Total Pengguna</div>
                            <i class="bi bi-people-fill" style="font-size:20px;opacity:.6"></i>
                        </div>
                        <div class="stat-value fw-bold" style="font-size:26px;line-height:1.1">
                            <?= number_format($total_user) ?>
                        </div>
                        <div class="stat-badge-text mt-2" style="font-size:12px;opacity:.75">
                            <i class="bi bi-graph-up"></i> +12% minggu ini
                        </div>
                    </div>
                    <div class="stat-bg-icon position-absolute text-white"
                         style="font-size:70px;opacity:.08;bottom:-10px;right:-10px;z-index:1;line-height:1">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>

            <!-- Total Pesanan -->
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 position-relative overflow-hidden"
                     style="background:linear-gradient(135deg,#f093fb,#f5576c)">
                    <div class="card-body text-white position-relative" style="z-index:2">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Total Pesanan</div>
                            <i class="bi bi-basket2-fill" style="font-size:20px;opacity:.6"></i>
                        </div>
                        <div class="stat-value fw-bold" style="font-size:26px;line-height:1.1">
                            <?= number_format($total_order) ?>
                        </div>
                        <div class="stat-badge-text mt-2" style="font-size:12px;opacity:.75">
                            <i class="bi bi-graph-up"></i> +8% minggu ini
                        </div>
                    </div>
                    <div class="stat-bg-icon position-absolute text-white"
                         style="font-size:70px;opacity:.08;bottom:-10px;right:-10px;z-index:1;line-height:1">
                        <i class="bi bi-basket2-fill"></i>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 position-relative overflow-hidden"
                     style="background:linear-gradient(135deg,#4facfe,#00f2fe)">
                    <div class="card-body text-white position-relative" style="z-index:2">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Pendapatan</div>
                            <i class="bi bi-cash-coin" style="font-size:20px;opacity:.6"></i>
                        </div>
                        <div class="stat-value fw-bold" style="font-size:22px;line-height:1.1">
                            <?= $total_income ?>
                        </div>
                        <div class="stat-badge-text mt-2" style="font-size:12px;opacity:.75">
                            <i class="bi bi-graph-up"></i> +24% minggu ini
                        </div>
                    </div>
                    <div class="stat-bg-icon position-absolute text-white"
                         style="font-size:70px;opacity:.08;bottom:-10px;right:-10px;z-index:1;line-height:1">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
            </div>

            <!-- Total Produk -->
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 position-relative overflow-hidden"
                     style="background:linear-gradient(135deg,#fa709a,#fee140)">
                    <div class="card-body text-white position-relative" style="z-index:2">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Total Produk</div>
                            <i class="bi bi-box2-fill" style="font-size:20px;opacity:.6"></i>
                        </div>
                        <div class="stat-value fw-bold" style="font-size:26px;line-height:1.1">
                            <?= number_format($total_produk) ?>
                        </div>
                        <div class="stat-badge-text mt-2" style="font-size:12px;opacity:.75">
                            <i class="bi bi-graph-down"></i> -3% minggu ini
                        </div>
                    </div>
                    <div class="stat-bg-icon position-absolute text-white"
                         style="font-size:70px;opacity:.08;bottom:-10px;right:-10px;z-index:1;line-height:1">
                        <i class="bi bi-box2-fill"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Charts Row -->
        <div class="row g-3 mb-4">

            <!-- Grafik Penjualan -->
            <div class="col-12 col-xl-8">
                <div class="card border-0" style="border:1px solid var(--border)!important">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap gap-2"
                         style="background:transparent;border-color:var(--border)">
                        <div>
                            <h6 class="mb-0 fw-semibold" style="color:var(--text-strong)">
                                <i class="bi bi-graph-up me-2" style="color:var(--accent)"></i>Grafik Penjualan
                            </h6>
                            <small style="color:var(--text-muted)">Tren pendapatan & volume pesanan</small>
                        </div>
                        <div class="btn-group btn-group-sm" id="periodeBtns">
                            <button class="btn btn-outline-primary active" onclick="gantiPeriode('minggu',this)">
                                <i class="bi bi-calendar-week d-sm-none"></i>
                                <span class="d-none d-sm-inline">Minggu</span>
                            </button>
                            <button class="btn btn-outline-primary" onclick="gantiPeriode('bulan',this)">
                                <i class="bi bi-calendar-month d-sm-none"></i>
                                <span class="d-none d-sm-inline">Bulan</span>
                            </button>
                            <button class="btn btn-outline-primary" onclick="gantiPeriode('tahun',this)">
                                <i class="bi bi-calendar3 d-sm-none"></i>
                                <span class="d-none d-sm-inline">Tahun</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrap">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Pesanan -->
            <div class="col-12 col-xl-4">
                <div class="card border-0 h-100" style="border:1px solid var(--border)!important">
                    <div class="card-header py-3" style="background:transparent;border-color:var(--border)">
                        <h6 class="mb-0 fw-semibold" style="color:var(--text-strong)">
                            <i class="bi bi-pie-chart-fill me-2" style="color:var(--accent)"></i>Status Pesanan
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="donut-wrap w-100">
                            <canvas id="donutChart"></canvas>
                        </div>
                        <div class="w-100 mt-3">
                            <div class="legend-box" style="background:var(--accent-soft)">
                                <span class="d-flex align-items-center gap-2">
                                    <span style="width:10px;height:10px;border-radius:50%;background:#4680FF;display:inline-block"></span>
                                    <small style="color:var(--text)">Selesai</small>
                                </span>
                                <span class="fw-bold small" style="color:var(--text-strong)">68%</span>
                            </div>
                            <div class="legend-box" style="background:rgba(255,171,45,.1)">
                                <span class="d-flex align-items-center gap-2">
                                    <span style="width:10px;height:10px;border-radius:50%;background:#FFAB2D;display:inline-block"></span>
                                    <small style="color:var(--text)">Proses</small>
                                </span>
                                <span class="fw-bold small" style="color:var(--text-strong)">22%</span>
                            </div>
                            <div class="legend-box" style="background:rgba(255,82,82,.1)">
                                <span class="d-flex align-items-center gap-2">
                                    <span style="width:10px;height:10px;border-radius:50%;background:#FF5252;display:inline-block"></span>
                                    <small style="color:var(--text)">Batal</small>
                                </span>
                                <span class="fw-bold small" style="color:var(--text-strong)">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel + Produk Terlaris -->
        <div class="row g-3">

            <!-- Pesanan Terbaru -->
            <div class="col-12 col-xl-8">
                <div class="card border-0" style="border:1px solid var(--border)!important">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between"
                         style="background:transparent;border-color:var(--border)">
                        <h6 class="mb-0 fw-semibold" style="color:var(--text-strong)" >
                            <i class="bi bi-cart-fill me-2" style="color:var(--accent)"></i>Pesanan Terbaru
                        </h6>
                        <a href="/pesanan" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye me-1"></i>Lihat Semua
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="min-width:500px">
                                <thead style="background:var(--bg)">
                                    <tr>
                                        <th class="ps-3" style="color:var(--text-muted);font-size:11px">ORDER</th>
                                        <th style="color:var(--text-muted);font-size:11px">PELANGGAN</th>
                                        <th class="hide-mobile" style="color:var(--text-muted);font-size:11px">PRODUK</th>
                                        <th style="color:var(--text-muted);font-size:11px">TOTAL</th>
                                        <th style="color:var(--text-muted);font-size:11px">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $orders = [
                                        ['id'=>'#021','name'=>'Andi S','bg'=>'4680FF','produk'=>'iPhone 15','total'=>'Rp 8.5M','status'=>'Selesai','sc'=>'success','color'=>'#28a745'],
                                        ['id'=>'#020','name'=>'Budi R','bg'=>'FFAB2D','produk'=>'Mouse Logitech','total'=>'Rp 450K','status'=>'Proses','sc'=>'warning','color'=>'#ffc107'],
                                        ['id'=>'#019','name'=>'Citra D','bg'=>'2dca72','produk'=>'Monitor 24"','total'=>'Rp 2.8M','status'=>'Selesai','sc'=>'success','color'=>'#28a745'],
                                        ['id'=>'#018','name'=>'Deni P','bg'=>'dc3545','produk'=>'Keyboard Mech','total'=>'Rp 750K','status'=>'Batal','sc'=>'danger','color'=>'#dc3545'],
                                        ['id'=>'#017','name'=>'Eka W','bg'=>'6610f2','produk'=>'Sony WH-1000','total'=>'Rp 1.2M','status'=>'Dikirim','sc'=>'info','color'=>'#17a2b8'],
                                    ];
                                    foreach($orders as $o):
                                    ?>
                                    <tr>
                                        <td class="ps-3">
                                            <span class="badge bg-secondary text-white" style="background:var(--accent-soft);color:var(--accent);font-size:11px">
                                                <?= $o['id'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($o['name']) ?>&size=28&background=<?= $o['bg'] ?>&color=fff"
                                                     class="rounded-circle" width="28" height="28">
                                                <small class="fw-semibold" style="color:var(--text-strong)"><?= $o['name'] ?></small>
                                            </div>
                                        </td>
                                        <td class="hide-mobile">
                                            <small style="color:var(--text)"><?= $o['produk'] ?></small>
                                        </td>
                                        <td>
                                            <small class="fw-bold" style="color:var(--accent)"><?= $o['total'] ?></small>
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: rgba(<?= implode(',',array_map('hexdec',str_split($o['color'],2))) ?>, 0.15); color: <?= $o['color'] ?>; font-size:11px; font-weight: 500;">
                                                <?= $o['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produk Terlaris -->
            <div class="col-12 col-xl-4">
                <div class="card border-0 h-100" style="border:1px solid var(--border)!important">
                    <div class="card-header py-3" style="background:transparent;border-color:var(--border)">
                        <h6 class="mb-0 fw-semibold" style="color:var(--text-strong)">
                            <i class="bi bi-star-fill me-2" style="color:#f5a623"></i>Produk Terlaris
                        </h6>
                    </div>
                    <div class="card-body">
                        <?php
                        $produkTerlaris = [
                            ['nama'=>'Apple iPhone 15',     'terjual'=>324, 'persen'=>82, 'color'=>'primary'],
                            ['nama'=>'Samsung Galaxy S24',  'terjual'=>210, 'persen'=>60, 'color'=>'warning'],
                            ['nama'=>'MacBook Pro',         'terjual'=>186, 'persen'=>48, 'color'=>'success'],
                            ['nama'=>'Xiaomi 14 Ultra',     'terjual'=>142, 'persen'=>38, 'color'=>'info'],
                            ['nama'=>'Sony WH-1000XM5',     'terjual'=>98,  'persen'=>25, 'color'=>'danger'],
                        ];
                        foreach($produkTerlaris as $p):
                        ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="fw-semibold" style="color:var(--text-strong)"><?= $p['nama'] ?></small>
                                <span class="badge bg-<?= $p['color'] ?> bg-opacity-10 text-<?= $p['color'] ?>"
                                      style="font-size:10px"><?= $p['terjual'] ?> terjual</span>
                            </div>
                            <div class="progress" style="height:6px;background:var(--bg);border-radius:10px">
                                <div class="progress-bar bg-<?= $p['color'] ?>"
                                     style="width:<?= $p['persen'] ?>%;border-radius:10px"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function formatNominal(n) {
    const a = Math.abs(n);
    if (a >= 1e12) return 'Rp '+(n/1e12).toFixed(1)+'T';
    if (a >= 1e9)  return 'Rp '+(n/1e9).toFixed(1)+'B';
    if (a >= 1e6)  return 'Rp '+(n/1e6).toFixed(1)+'M';
    if (a >= 1e3)  return 'Rp '+(n/1e3).toFixed(1)+'K';
    return 'Rp '+n;
}

const dataMingguan = {
    labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
    pendapatan: [3200000,4100000,3800000,5200000,4800000,6100000,5500000],
    pesanan: [120,180,160,210,195,240,220]
};
const dataBulanan = {
    labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
    pendapatan: [42e6,38e6,51e6,47e6,55e6,62e6,58e6,70e6,65e6,72e6,68e6,80e6],
    pesanan: [1200,1100,1400,1350,1600,1800,1700,2000,1900,2100,2000,2400]
};
const dataTahunan = {
    labels: ['2021','2022','2023','2024','2025','2026'],
    pendapatan: [320e6,410e6,480e6,520e6,610e6,250e6],
    pesanan: [9800,12400,14200,15800,18600,7200]
};

let salesChart, donutChart;

function buildSales() {
    const el = document.getElementById('salesChart');
    if (!el) return;
    if (salesChart) salesChart.destroy();
    const mob = window.innerWidth < 576;
    salesChart = new Chart(el, {
        type: 'line',
        data: {
            labels: dataMingguan.labels,
            datasets: [{
                label: 'Pendapatan', data: dataMingguan.pendapatan,
                borderColor: '#4680FF', backgroundColor: 'rgba(70,128,255,0.1)',
                tension: 0.4, fill: true, borderWidth: 2,
                pointRadius: mob?2:4, pointHoverRadius: mob?4:6,
                pointBackgroundColor: '#4680FF'
            },{
                label: 'Pesanan', data: dataMingguan.pesanan,
                borderColor: '#2dca72', backgroundColor: 'rgba(45,202,114,0.1)',
                tension: 0.4, fill: true, borderWidth: 2,
                pointRadius: mob?2:4, pointHoverRadius: mob?4:6,
                pointBackgroundColor: '#2dca72', yAxisID: 'y2'
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    position: mob ? 'bottom' : 'top',
                    labels: { usePointStyle: true, padding: mob?8:15, font:{size: mob?10:12} }
                }
            },
            scales: {
                y: { beginAtZero:true, grid:{color:'rgba(128,128,128,0.1)'},
                     ticks:{callback:v=>formatNominal(v), font:{size: mob?9:11}, maxTicksLimit:5} },
                y2: { position:'right', beginAtZero:true, grid:{drawOnChartArea:false},
                      ticks:{font:{size: mob?9:11}, maxTicksLimit:5} },
                x: { ticks:{font:{size: mob?9:11}, maxTicksLimit: mob?5:7} }
            }
        }
    });
}

function buildDonut() {
    const el = document.getElementById('donutChart');
    if (!el) return;
    if (donutChart) donutChart.destroy();
    donutChart = new Chart(el, {
        type: 'doughnut',
        data: {
            labels: ['Selesai','Proses','Batal'],
            datasets: [{ data:[68,22,10], backgroundColor:['#4680FF','#FFAB2D','#FF5252'], borderWidth:0, hoverOffset:8 }]
        },
        options: { responsive:true, maintainAspectRatio:false, cutout:'72%', plugins:{legend:{display:false}} }
    });
}

function gantiPeriode(p, btn) {
    const d = p==='minggu'?dataMingguan:p==='bulan'?dataBulanan:dataTahunan;
    if (salesChart) {
        salesChart.data.labels = d.labels;
        salesChart.data.datasets[0].data = d.pendapatan;
        salesChart.data.datasets[1].data = d.pesanan;
        salesChart.update();
    }
    document.querySelectorAll('#periodeBtns button').forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() { buildSales(); buildDonut(); });

let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() { buildSales(); buildDonut(); }, 200);
});
</script>

<?= view('layout/footer') ?>