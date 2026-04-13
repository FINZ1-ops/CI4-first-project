<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="mb-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold text-dark mb-2"><i class="bi bi-people-fill"></i> Manajemen Pengguna</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '→';">
                        <ol class="breadcrumb breadcrumb-dots small mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Pengguna</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex flex-column align-items-end gap-2">
                    <span class="text-muted small"><i class="bi bi-calendar3-week"></i> <?= date('d M Y') ?></span>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Pengguna
                    </button>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row g-2 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-3">
                        <p class="card-text small opacity-75 mb-1">Total Pengguna</p>
                        <h6 class="fw-bold mb-0"><?= isset($pengguna) ? count($pengguna) : 0 ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <div class="card-body p-3">
                        <p class="card-text small opacity-75 mb-1">Admin</p>
                        <h6 class="fw-bold mb-0"><?php
                            $admins = count(array_filter($pengguna ?? [], fn($p) => ($p['role'] ?? '') === 'Admin'));
                            echo $admins;
                        ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="card-body p-3">
                        <p class="card-text small opacity-75 mb-1">Manager</p>
                        <h6 class="fw-bold mb-0"><?php
                            $managers = count(array_filter($pengguna ?? [], fn($p) => ($p['role'] ?? '') === 'Manager'));
                            echo $managers;
                        ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-0 bg-gradient text-white" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                    <div class="card-body p-3">
                        <p class="card-text small opacity-75 mb-1">Pengguna Aktif</p>
                        <h6 class="fw-bold mb-0">100%</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="/pengguna" class="row g-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                   placeholder="Cari nama pengguna atau email..."
                                   value="<?= $search ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                        <a href="/pengguna" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-table text-info"></i> Daftar Pengguna</h6>
                        <small class="text-muted d-block">Informasi pengguna sistem</small>
                    </div>
                    <span class="badge bg-primary">
                        <i class="bi bi-people-fill me-1"></i><?= isset($pengguna) ? count($pengguna) : 0 ?> pengguna
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="fw-semibold text-uppercase small ps-4">#</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-person"></i> Pengguna</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-envelope"></i> Email</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-shield-check"></i> Role</th>
                                <th class="fw-semibold text-uppercase small"><i class="bi bi-circle-fill"></i> Status</th>
                                <th class="fw-semibold text-uppercase small text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pengguna ?? [])): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="mb-3">
                                            <i class="bi bi-people-off display-1 text-muted opacity-50"></i>
                                        </div>
                                        <p class="text-muted mb-0">Tidak ada pengguna ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($pengguna as $p): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge bg-light text-dark"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($p['name'] ?? 'Unknown') ?>&size=36&background=667eea&color=fff"
                                                 class="rounded-circle shadow-sm" width="36" height="36" alt="Avatar">
                                            <div>
                                                <p class="fw-semibold mb-0"><?= esc($p['name'] ?? 'N/A') ?></p>
                                                <small class="text-muted">ID: <?= $p['id'] ?? '#' ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            <i class="bi bi-envelope me-1"></i><?= esc($p['email'] ?? 'N/A') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                            $role = $p['role'] ?? 'User';
                                            $badgeClass = match($role) {
                                                'Admin' => 'bg-danger',
                                                'Manager' => 'bg-warning',
                                                default => 'bg-info'
                                            };
                                        ?>
                                        <span class="badge <?= $badgeClass ?> bg-opacity-90">
                                            <i class="bi bi-shield-check me-1"></i><?= esc($role) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-success text-white">
                                            <i class="bi bi-circle-fill me-1" style="font-size:6px"></i>Aktif
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="/pengguna/<?= $p['id'] ?? '#' ?>" class="btn btn-sm btn-outline-light p-1 me-1" title="Lihat" data-bs-toggle="tooltip">
                                            <i class="bi bi-eye text-info"></i>
                                        </a>
                                        <a href="/pengguna/<?= $p['id'] ?? '#' ?>/edit" class="btn btn-sm btn-outline-light p-1 me-1" title="Edit" data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil text-warning"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-light p-1" title="Hapus" onclick="hapusUser(<?= $p['id'] ?? '#' ?>)" data-bs-toggle="tooltip">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Online Users Chart -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white border-bottom-0 py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-graph-up text-primary"></i> Grafik User Online</h6>
                        <small class="text-muted d-block">Tren pengguna online per periode</small>
                    </div>
                    <div class="btn-group btn-group-sm" id="chartPeriodeBtns" role="group">
                        <input type="radio" class="btn-check" name="chartPeriode" id="chart_minggu" value="minggu" checked onchange="gantiOnline(this)">
                        <label class="btn btn-outline-secondary" for="chart_minggu">
                            <i class="bi bi-calendar-week"></i> Minggu
                        </label>

                        <input type="radio" class="btn-check" name="chartPeriode" id="chart_bulan" value="bulan" onchange="gantiOnline(this)">
                        <label class="btn btn-outline-secondary" for="chart_bulan">
                            <i class="bi bi-calendar-month"></i> Bulan
                        </label>

                        <input type="radio" class="btn-check" name="chartPeriode" id="chart_tahun" value="tahun" onchange="gantiOnline(this)">
                        <label class="btn btn-outline-secondary" for="chart_tahun">
                            <i class="bi bi-calendar3"></i> Tahun
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4">
                <canvas id="onlineChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let onlineChartInstance = null;

    const onlineData = {
        minggu: { labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'], data: [65,52,38,61,55,70,93] },
        bulan:  { labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'], data: [420,380,510,470,550,620,580,700,650,720,680,800] },
        tahun:  { labels: ['2021','2022','2023','2024','2025','2026'], data: [3200,4100,4800,5200,6100,2500] }
    };

    function initOnlineChart() {
        const chartCanvas = document.getElementById('onlineChart');
        if (!chartCanvas) return;

        if (onlineChartInstance) onlineChartInstance.destroy();

        const isMobile = window.innerWidth < 768;
        const pointRadius = isMobile ? 2 : 4;
        const pointHoverRadius = isMobile ? 3 : 6;
        const fontSize = isMobile ? 9 : 11;

        // Set container height for responsive behavior
        chartCanvas.parentElement.style.position = 'relative';
        chartCanvas.parentElement.style.height = isMobile ? '250px' : '300px';

        onlineChartInstance = new Chart(chartCanvas, {
            type: 'line',
            data: {
                labels: onlineData.minggu.labels,
                datasets: [{
                    label: 'User Online',
                    data: onlineData.minggu.data,
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
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: isMobile ? 'bottom' : 'top',
                        labels: { usePointStyle: true, padding: isMobile ? 8 : 15, font: { size: fontSize, weight: 500 } }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: {
                            callback: v => v + ' user',
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

    function gantiOnline(radio) {
        const periode = radio.value;
        const d = onlineData[periode];

        if (onlineChartInstance) {
            onlineChartInstance.data.labels = d.labels;
            onlineChartInstance.data.datasets[0].data = d.data;
            onlineChartInstance.update('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Enable Tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(t => new bootstrap.Tooltip(t));

        initOnlineChart();
    });

    window.addEventListener('resize', function() {
        initOnlineChart();
    });

    function hapusUser(id) {
        if (confirm('Yakin ingin menghapus pengguna ini?')) {
            // Add delete logic here
        }
    }
</script>

<?= view('layout/footer') ?>