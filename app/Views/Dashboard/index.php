<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<!-- ===== MAIN CONTENT ===== -->
<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-1 fw-bold">Dashboard</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-end">
                    <span class="badge bg-light text-dark fs-6"><?= date('l, d F Y') ?></span>
                </div>
            </div>
        </div>

        <!-- Stat Cards dengan Gradient -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-sm-6">
                <div class="card stat-card border-0 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 140px;">
                    <div class="card-body text-white position-relative z-2">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-label opacity-75 mb-2">Total Pengguna</div>
                                <div class="stat-value fw-bold" style="font-size: 28px;"><?= number_format($total_user) ?></div>
                            </div>
                            <div class="stat-icon opacity-25" style="font-size: 40px;">
                                <i class="ti ti-users"></i>
                            </div>
                        </div>
                        <small class="mt-2 d-block opacity-75"><i class="ti ti-trending-up"></i> +12% dari minggu lalu</small>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10" style="font-size: 80px; margin: -20px -20px 0 0;">
                        <i class="ti ti-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card stat-card border-0 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 140px;">
                    <div class="card-body text-white position-relative z-2">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-label opacity-75 mb-2">Total Pesanan</div>
                                <div class="stat-value fw-bold" style="font-size: 28px;"><?= number_format($total_order) ?></div>
                            </div>
                            <div class="stat-icon opacity-25" style="font-size: 40px;">
                                <i class="ti ti-shopping-cart"></i>
                            </div>
                        </div>
                        <small class="mt-2 d-block opacity-75"><i class="ti ti-trending-up"></i> +8% dari minggu lalu</small>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10" style="font-size: 80px; margin: -20px -20px 0 0;">
                        <i class="ti ti-shopping-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card stat-card border-0 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); min-height: 140px;">
                    <div class="card-body text-white position-relative z-2">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-label opacity-75 mb-2">Total Pendapatan</div>
                                <div class="stat-value fw-bold" style="font-size: 24px;"><?= $total_income ?></div>
                            </div>
                            <div class="stat-icon opacity-25" style="font-size: 40px;">
                                <i class="ti ti-cash"></i>
                            </div>
                        </div>
                        <small class="mt-2 d-block opacity-75"><i class="ti ti-trending-up"></i> +24% dari minggu lalu</small>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10" style="font-size: 80px; margin: -20px -20px 0 0;">
                        <i class="ti ti-cash"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card stat-card border-0 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); min-height: 140px;">
                    <div class="card-body text-white position-relative z-2">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <div class="stat-label opacity-75 mb-2">Total Produk</div>
                                <div class="stat-value fw-bold" style="font-size: 28px;"><?= number_format($total_produk) ?></div>
                            </div>
                            <div class="stat-icon opacity-25" style="font-size: 40px;">
                                <i class="ti ti-box"></i>
                            </div>
                        </div>
                        <small class="mt-2 d-block opacity-75"><i class="ti ti-trending-down"></i> -3% dari minggu lalu</small>
                    </div>
                    <div class="position-absolute bottom-0 end-0 opacity-10" style="font-size: 80px; margin: -20px -20px 0 0;">
                        <i class="ti ti-box"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-3 mb-4">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 fw-semibold">📊 Grafik Penjualan</h6>
                        <div class="btn-group btn-group-sm" id="periodeBtns">
                            <button class="btn btn-outline-primary active" onclick="gantiPeriode('minggu', this)">Minggu</button>
                            <button class="btn btn-outline-primary" onclick="gantiPeriode('bulan', this)">Bulan</button>
                            <button class="btn btn-outline-primary" onclick="gantiPeriode('tahun', this)">Tahun</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 fw-semibold">📦 Status Pesanan</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <canvas id="donutChart" height="200"></canvas>
                        <div class="mt-4 w-100">
                            <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded" style="background: #f0f4ff;">
                                <span class="d-flex align-items-center">
                                    <span class="badge rounded-circle me-2" style="width:12px;height:12px; background:#4680FF;"></span>
                                    <small class="fw-medium">Selesai</small>
                                </span>
                                <span class="fw-bold small">68%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded" style="background: #fff9f0;">
                                <span class="d-flex align-items-center">
                                    <span class="badge rounded-circle me-2" style="width:12px;height:12px; background:#FFAB2D;"></span>
                                    <small class="fw-medium">Proses</small>
                                </span>
                                <span class="fw-bold small">22%</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2 rounded" style="background: #ffe6e6;">
                                <span class="d-flex align-items-center">
                                    <span class="badge rounded-circle me-2" style="width:12px;height:12px; background:#FF5252;"></span>
                                    <small class="fw-medium">Batal</small>
                                </span>
                                <span class="fw-bold small">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="row g-3">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                        <h6 class="mb-0 fw-semibold">🛒 Pesanan Terbaru</h6>
                        <a href="/pesanan" class="btn btn-sm btn-primary"><i class="ti ti-eye me-1"></i> Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">No. Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Produk</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom">
                                        <td class="ps-3"><span class="badge bg-light text-dark">#ORD-0021</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Andi+S&size=32&background=4680FF&color=fff" class="rounded-circle me-2" width="32">
                                                <small class="fw-medium">Andi Setiawan</small>
                                            </div>
                                        </td>
                                        <td><small>Iphone 15</small></td>
                                        <td><small class="fw-bold text-primary">Rp 8.5M</small></td>
                                        <td><span class="badge bg-success bg-opacity-75">✓ Selesai</span></td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="ps-3"><span class="badge bg-light text-dark">#ORD-0020</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Budi+R&size=32&background=FFAB2D&color=fff" class="rounded-circle me-2" width="32">
                                                <small class="fw-medium">Budi Raharjo</small>
                                            </div>
                                        </td>
                                        <td><small>Mouse Logitech G305</small></td>
                                        <td><small class="fw-bold text-primary">Rp 450K</small></td>
                                        <td><span class="badge bg-warning bg-opacity-75">⟳ Proses</span></td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="ps-3"><span class="badge bg-light text-dark">#ORD-0019</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Citra+D&size=32&background=2dca72&color=fff" class="rounded-circle me-2" width="32">
                                                <small class="fw-medium">Citra Dewi</small>
                                            </div>
                                        </td>
                                        <td><small>Monitor Samsung 24"</small></td>
                                        <td><small class="fw-bold text-primary">Rp 2.8M</small></td>
                                        <td><span class="badge bg-success bg-opacity-75">✓ Selesai</span></td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="ps-3"><span class="badge bg-light text-dark">#ORD-0018</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Deni+P&size=32&background=dc3545&color=fff" class="rounded-circle me-2" width="32">
                                                <small class="fw-medium">Deni Pratama</small>
                                            </div>
                                        </td>
                                        <td><small>Keyboard Mechanical</small></td>
                                        <td><small class="fw-bold text-primary">Rp 750K</small></td>
                                        <td><span class="badge bg-danger bg-opacity-75">✕ Batal</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-3"><span class="badge bg-light text-dark">#ORD-0017</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://ui-avatars.com/api/?name=Eka+W&size=32&background=6610f2&color=fff" class="rounded-circle me-2" width="32">
                                                <small class="fw-medium">Eka Wulandari</small>
                                            </div>
                                        </td>
                                        <td><small>Sony WH-1000XM5</small></td>
                                        <td><small class="fw-bold text-primary">Rp 1.2M</small></td>
                                        <td><span class="badge bg-info bg-opacity-75">📦 Dikirim</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="mb-0 fw-semibold">⭐ Produk Terlaris</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="fw-semibold">Apple iPhone 15</small>
                                <small class="badge bg-primary text-white">324 terjual</small>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; overflow: hidden;">
                                <div class="progress-bar bg-primary" style="width: 82%;"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="fw-semibold">Samsung Galaxy S24</small>
                                <small class="badge bg-warning text-white">210 terjual</small>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; overflow: hidden;">
                                <div class="progress-bar bg-warning" style="width: 60%;"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="fw-semibold">MacBook Pro</small>
                                <small class="badge bg-success text-white">186 terjual</small>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; overflow: hidden;">
                                <div class="progress-bar bg-success" style="width: 48%;"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="fw-semibold">Xiaomi 14 Ultra</small>
                                <small class="badge bg-info text-white">142 terjual</small>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; overflow: hidden;">
                                <div class="progress-bar bg-info" style="width: 38%;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <small class="fw-semibold">Sony WH-1000XM5</small>
                                <small class="badge bg-danger text-white">98 terjual</small>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; overflow: hidden;">
                                <div class="progress-bar bg-danger" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Toggle Sidebar
    document.getElementById('sidebar-hide').addEventListener('click', function(e) {
        e.preventDefault();
        document.body.classList.toggle('sidebar-collapsed');
    });

    // Fungsi format nominal
    function formatNominal(nominal) {
        const abs = Math.abs(nominal);
        if (abs >= 1000000000000) {
            return 'Rp ' + (nominal / 1000000000000).toFixed(1) + 'T';
        } else if (abs >= 1000000000) {
            return 'Rp ' + (nominal / 1000000000).toFixed(1) + 'B';
        } else if (abs >= 1000000) {
            return 'Rp ' + (nominal / 1000000).toFixed(1) + 'M';
        } else if (abs >= 1000) {
            return 'Rp ' + (nominal / 1000).toFixed(1) + 'K';
        }
        return 'Rp ' + nominal;
    }

    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const dataMingguan = {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        pendapatan: [3200000, 4100000, 3800000, 5200000, 4800000, 6100000, 5500000],
        pesanan: [120, 180, 160, 210, 195, 240, 220]
    };

    const dataBulanan = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        pendapatan: [42000000, 38000000, 51000000, 47000000, 55000000, 62000000, 58000000, 70000000, 65000000, 72000000, 68000000, 80000000],
        pesanan: [1200, 1100, 1400, 1350, 1600, 1800, 1700, 2000, 1900, 2100, 2000, 2400]
    };

    const dataTahunan = {
        labels: ['2021', '2022', '2023', '2024', '2025', '2026'],
        pendapatan: [320000000, 410000000, 480000000, 520000000, 610000000, 250000000],
        pesanan: [9800, 12400, 14200, 15800, 18600, 7200]
    };

    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: dataMingguan.labels,
            datasets: [{
                label: 'Pendapatan',
                data: dataMingguan.pendapatan, 
                borderColor: '#4680FF',
                backgroundColor: 'rgba(70,128,255,0.1)',
                tension: 0.4, fill: true,
                pointBackgroundColor: '#4680FF',
                pointRadius: 5, pointHoverRadius: 7,
                borderWidth: 3
            }, {
                label: 'Pesanan',
                data: dataMingguan.pesanan,  
                borderColor: '#2dca72',
                backgroundColor: 'rgba(45,202,114,0.1)',
                tension: 0.4, fill: true,
                pointBackgroundColor: '#2dca72',
                pointRadius: 5, pointHoverRadius: 7,
                yAxisID: 'y2',
                borderWidth: 3
            }],
        },
        
        options: {
            responsive: true,
            interaction: { mode: 'index', intersect: false },
            plugins: { 
                legend: { position: 'top', labels: { usePointStyle: true, padding: 15 } },
                filler: { propagate: true }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: '#e9ecef' },
                    ticks: { callback: v => formatNominal(v) }
                },
                y2: { 
                    position: 'right', 
                    beginAtZero: true,
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });

    function gantiPeriode(periode, tombol) {
        let data;
        if (periode === 'minggu') data = dataMingguan;
        else if (periode === 'bulan') data = dataBulanan;
        else data = dataTahunan;

        salesChart.data.labels = data.labels;
        salesChart.data.datasets[0].data = data.pendapatan;
        salesChart.data.datasets[1].data = data.pesanan;
        salesChart.update();

        document.querySelectorAll('#periodeBtns button').forEach(btn => {
            btn.classList.remove('active');
        });
        tombol.classList.add('active');
    }

    // Donut Chart
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Proses', 'Batal'],
            datasets: [{
                data: [68, 22, 10],
                backgroundColor: ['#4680FF', '#FFAB2D', '#FF5252'],
                borderWidth: 0, hoverOffset: 10
            }]
        },
        options: {
            cutout: '72%',
            plugins: { legend: { display: false } }
        }
    });
</script>

<?= view('layout/footer') ?>
</body>