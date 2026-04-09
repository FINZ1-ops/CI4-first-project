<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-2 fw-bold">
                        <i class="ti ti-users me-2"></i>Manajemen Pengguna
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active">Data Pengguna</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-end">
                    <small class="text-muted d-block"><?= date('l, d F Y') ?></small>
                    <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="ti ti-plus me-1"></i>Tambah Pengguna
                    </button>
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
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" 
                                   placeholder="Cari nama pengguna atau email..."
                                   value="<?= $search ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="ti ti-search me-1"></i>Cari
                        </button>
                        <a href="/pengguna" class="btn btn-outline-secondary">
                            <i class="ti ti-refresh me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold">
                        <i class="ti ti-list me-2"></i>Daftar Pengguna
                    </h6>
                    <span class="badge bg-primary">
                        <i class="ti ti-users me-1"></i><?= isset($pengguna) ? count($pengguna) : 0 ?> pengguna
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Pengguna</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pengguna ?? [])): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="mb-3">
                                            <i class="ti ti-users-off display-1 text-muted opacity-50"></i>
                                        </div>
                                        <p class="text-muted mb-0">Tidak ada pengguna ditemukan</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($pengguna as $p): ?>
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <span class="badge bg-light text-dark"><?= $no++ ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($p['name'] ?? 'Unknown') ?>&size=40&background=4680FF&color=fff"
                                                 class="rounded-circle shadow-sm" width="40" height="40" alt="Avatar">
                                            <div>
                                                <p class="fw-semibold mb-0"><?= esc($p['name'] ?? 'N/A') ?></p>
                                                <small class="text-muted">ID: <?= $p['id'] ?? '#' ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            <i class="ti ti-mail me-1"></i><?= esc($p['email'] ?? 'N/A') ?>
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
                                        <span class="badge <?= $badgeClass ?>">
                                            <i class="ti ti-shield-check me-1"></i><?= esc($role) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="ti ti-circle-filled me-1"></i>Aktif
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="/pengguna/<?= $p['id'] ?? '#' ?>" class="btn btn-sm btn-light" title="Lihat" data-bs-toggle="tooltip">
                                            <i class="ti ti-eye text-info"></i>
                                        </a>
                                        <a href="/pengguna/<?= $p['id'] ?? '#' ?>/edit" class="btn btn-sm btn-light ms-1" title="Edit" data-bs-toggle="tooltip">
                                            <i class="ti ti-pencil text-warning"></i>
                                        </a>
                                        <button class="btn btn-sm btn-light ms-1" title="Hapus" onclick="hapusUser(<?= $p['id'] ?? '#' ?>)" data-bs-toggle="tooltip">
                                            <i class="ti ti-trash text-danger"></i>
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
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold">
                        <i class="ti ti-activity me-2"></i>Grafik User Online
                    </h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <button class="btn btn-outline-primary active" onclick="gantiOnline('minggu', this)">
                            <i class="ti ti-calendar-week me-1"></i>Minggu
                        </button>
                        <button class="btn btn-outline-primary" onclick="gantiOnline('bulan', this)">
                            <i class="ti ti-calendar-month me-1"></i>Bulan
                        </button>
                        <button class="btn btn-outline-primary" onclick="gantiOnline('tahun', this)">
                            <i class="ti ti-calendar-year me-1"></i>Tahun
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="onlineChart" height="80"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable Tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(t => new bootstrap.Tooltip(t));

        // Chart Data
        const onlineData = {
            minggu: { labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'], data: [65,52,38,61,55,70,93] },
            bulan:  { labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'], data: [420,380,510,470,550,620,580,700,650,720,680,800] },
            tahun:  { labels: ['2021','2022','2023','2024','2025','2026'], data: [3200,4100,4800,5200,6100,2500] }
        };

        const chartCanvas = document.getElementById('onlineChart');
        if (chartCanvas) {
            const onlineChart = new Chart(chartCanvas, {
                type: 'line',
                data: {
                    labels: onlineData.minggu.labels,
                    datasets: [{
                        label: 'User Online',
                        data: onlineData.minggu.data,
                        borderColor: '#4680FF', 
                        backgroundColor: 'rgba(70,128,255,0.08)',
                        tension: 0.4, 
                        fill: true, 
                        pointBackgroundColor: '#4680FF',
                        pointRadius: 5, 
                        pointHoverRadius: 7,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    interaction: { mode: 'index', intersect: false },
                    plugins: { 
                        legend: { position: 'top', labels: { usePointStyle: true } }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(128,128,128,0.1)' }, 
                            ticks: { callback: v => v + ' user' }
                        },
                        x: { grid: { display: false }}
                    }
                }
            });

            window.gantiOnline = function(periode, tombol) {
                const d = onlineData[periode];
                onlineChart.data.labels = d.labels;
                onlineChart.data.datasets[0].data = d.data;
                onlineChart.update();
                document.querySelectorAll('.btn-group button').forEach(b => b.classList.remove('active'));
                tombol.classList.add('active');
            };
        }
    });

    function hapusUser(id) {
        if (confirm('Yakin ingin menghapus pengguna ini?')) {
            // Add delete logic here
        }
    }
</script>

<?= view('layout/footer') ?>