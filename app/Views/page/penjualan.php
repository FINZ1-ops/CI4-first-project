<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <div class="page-header">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="mb-1"><i class="bi bi-graph-up"></i> Laporan Penjualan</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="bi bi-house-door"></i> Home</a></li>
                            <li class="breadcrumb-item active">Laporan Penjualan</li>
                        </ol>
                    </nav>
                </div>
                <span class="text-muted small"><i class="bi bi-calendar3"></i> <?= date('l, d F Y') ?></span>
            </div>
        </div>

        <!-- Grafik + Produk Terlaris -->
        <div class="row g-3 mb-4">
            <div class="col-xl-8">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between py-3 border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-bar-chart"></i> Grafik Penjualan</h6>
                        <div class="btn-group btn-group-sm" id="periodeBtns" role="group">
                            <button class="btn btn-outline-secondary active" onclick="gantiPeriode(event, 'minggu')">
                                <i class="bi bi-calendar-week"></i> Minggu
                            </button>
                            <button class="btn btn-outline-secondary" onclick="gantiPeriode(event, 'bulan')">
                                <i class="bi bi-calendar-month"></i> Bulan
                            </button>
                            <button class="btn btn-outline-secondary" onclick="gantiPeriode(event, 'tahun')">
                                <i class="bi bi-calendar-year"></i> Tahun
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header py-3 border-bottom">
                        <h6 class="mb-0 fw-semibold"><i class="bi bi-star"></i> Produk Terlaris</h6>
                    </div>
                    <div class="card-body" id="terlarisList">
                        <div class="text-center text-muted py-3">
                            <small>Loading...</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Tabel -->
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between py-3 border-bottom">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-table"></i> Detail Penjualan Produk</h6>
                <div class="btn-group btn-group-sm" id="tablePeriodeBtns" role="group">
                    <button class="btn btn-outline-secondary active" onclick="gantiTabelPeriode(event, 'minggu')">
                        <i class="bi bi-calendar-week"></i> Minggu
                    </button>
                    <button class="btn btn-outline-secondary" onclick="gantiTabelPeriode(event, 'bulan')">
                        <i class="bi bi-calendar-month"></i> Bulan
                    </button>
                    <button class="btn btn-outline-secondary" onclick="gantiTabelPeriode(event, 'tahun')">
                        <i class="bi bi-calendar-year"></i> Tahun
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4"><i class="bi bi-box"></i> Nama Produk</th>
                                <th><i class="bi bi-bag-check"></i> Terjual</th>
                                <th><i class="bi bi-cash-coin"></i> Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody id="produkTable">
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    <small>Loading...</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let chartInstance = null;
    const PERIODE_MAP = { minggu: 0, bulan: 1, tahun: 2 };

    function formatNominal(n) {
        if (!Number.isFinite(n)) return 'Rp 0';
        const a = Math.abs(n);
        if (a >= 1e12) return 'Rp ' + (n/1e12).toFixed(1) + 'T';
        if (a >= 1e9)  return 'Rp ' + (n/1e9).toFixed(1) + 'B';
        if (a >= 1e6)  return 'Rp ' + (n/1e6).toFixed(1) + 'M';
        if (a >= 1e3)  return 'Rp ' + (n/1e3).toFixed(1) + 'K';
        return 'Rp ' + Math.floor(n);
    }

    const produk_minggu = <?= json_encode($produk_minggu ?? []) ?>;
    const produk_bulan  = <?= json_encode($produk_bulan ?? []) ?>;
    const produk_tahun  = <?= json_encode($produk_tahun ?? []) ?>;

    const dataMingguan = {
        labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        pendapatan: [3200000,4100000,3800000,5200000,4800000,6100000,5500000],
        pesanan: [120,180,160,210,195,240,220]
    };
    const dataBulanan = {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        pendapatan: [42000000,38000000,51000000,47000000,55000000,62000000,58000000,70000000,65000000,72000000,68000000,80000000],
        pesanan: [1200,1100,1400,1350,1600,1800,1700,2000,1900,2100,2000,2400]
    };
    const dataTahunan = {
        labels: ['2021','2022','2023','2024','2025','2026'],
        pendapatan: [320000000,410000000,480000000,520000000,610000000,250000000],
        pesanan: [9800,12400,14200,15800,18600,7200]
    };

    function initChart() {
        const ctx = document.getElementById('salesChart');
        if (!ctx) return;
        
        if (chartInstance) chartInstance.destroy();
        
        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataMingguan.labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: dataMingguan.pendapatan,
                    borderColor: '#4680FF', 
                    backgroundColor: 'rgba(70,128,255,0.08)',
                    tension: 0.4, 
                    fill: true, 
                    pointBackgroundColor: '#4680FF',
                    pointRadius: 4, 
                    pointHoverRadius: 6,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                },{
                    label: 'Pesanan',
                    data: dataMingguan.pesanan,
                    borderColor: '#2dca72', 
                    backgroundColor: 'rgba(45,202,114,0.08)',
                    tension: 0.4, 
                    fill: true, 
                    pointBackgroundColor: '#2dca72',
                    pointRadius: 4, 
                    pointHoverRadius: 6,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    yAxisID: 'y2'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: { mode: 'index', intersect: false },
                plugins: { 
                    legend: { position: 'top', labels: { usePointStyle: true, padding: 15 } },
                    filler: { propagate: true }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        grid: { color: 'rgba(128,128,128,0.08)' }, 
                        ticks: { callback: v => formatNominal(v) }
                    },
                    y2: { 
                        position: 'right', 
                        beginAtZero: true, 
                        grid: { drawOnChartArea: false },
                        ticks: { callback: v => v.toLocaleString('id-ID') }
                    }
                }
            }
        });
    }

    function gantiPeriode(e, periode) {
        e.preventDefault();
        const d = periode === 'minggu' ? dataMingguan : periode === 'bulan' ? dataBulanan : dataTahunan;
        
        if (chartInstance) {
            chartInstance.data.labels = d.labels;
            chartInstance.data.datasets[0].data = d.pendapatan;
            chartInstance.data.datasets[1].data = d.pesanan;
            chartInstance.update('active');
        }
        
        document.querySelectorAll('#periodeBtns button').forEach(b => b.classList.remove('active'));
        e.target.closest('button').classList.add('active');
        
        tampilkanTerlaris(periode);
    }

    function tampilkanTerlaris(periode) {
        const d = periode === 'minggu' ? produk_minggu : periode === 'bulan' ? produk_bulan : produk_tahun;
        
        if (!Array.isArray(d) || d.length === 0) {
            document.getElementById('terlarisList').innerHTML = '<p class="text-center text-muted">Tidak ada data</p>';
            return;
        }

        document.getElementById('terlarisList').innerHTML = d.slice(0, 5).map((p, i) => `
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary me-3">#${i+1}</span>
                    <div>
                        <div class="fw-semibold">${p.nama || 'N/A'}</div>
                        <small class="text-muted"><i class="bi bi-bag"></i> ${p.terjual || 0} terjual</small>
                    </div>
                </div>
                <span class="fw-semibold text-success">${formatNominal(p.pendapatan || 0)}</span>
            </div>
        `).join('');
    }

    function tampilkanTabelProduk(periode) {
        const d = periode === 'minggu' ? produk_minggu : periode === 'bulan' ? produk_bulan : produk_tahun;
        
        if (!Array.isArray(d) || d.length === 0) {
            document.getElementById('produkTable').innerHTML = '<tr><td colspan="3" class="text-center text-muted py-3">Tidak ada data</td></tr>';
            return;
        }

        document.getElementById('produkTable').innerHTML = d.map((p, i) => `
            <tr>
                <td class="ps-4">${i+1}. ${p.nama || 'N/A'}</td>
                <td><span class="badge bg-info">${p.terjual || 0}</span></td>
                <td><strong>${formatNominal(p.pendapatan || 0)}</strong></td>
            </tr>
        `).join('');
    }

    function gantiTabelPeriode(e, periode) {
        e.preventDefault();
        tampilkanTabelProduk(periode);
        tampilkanTerlaris(periode);
        
        document.querySelectorAll('#tablePeriodeBtns button').forEach(b => b.classList.remove('active'));
        e.target.closest('button').classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        initChart();
        tampilkanTerlaris('minggu');
        tampilkanTabelProduk('minggu');
    });
</script>

<?= view('layout/footer') ?>