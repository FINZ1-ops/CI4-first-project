<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="mb-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold text-dark mb-2"><i class="bi bi-person-circle"></i> Profile Saya</h4>
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '→';">
                        <ol class="breadcrumb breadcrumb-dots small mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </nav>
                </div>
                <span class="text-muted small"><i class="bi bi-calendar3-week"></i> <?= date('d M Y') ?></span>
            </div>
        </div>

        <div class="row g-4">

            <!-- Kartu Profile Kiri -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-4">
                        <div class="position-relative d-inline-block mb-3">
                            <img src="https://ui-avatars.com/api/?name=Administrator&size=96&background=667eea&color=fff&bold=true"
                                 class="rounded-circle" width="96" height="96">
                            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2"
                                  style="width:16px;height:16px;border-color:var(--surface)!important"></span>
                        </div>
                        <h5 class="fw-bold mb-1">Administrator</h5>
                        <p class="text-muted small mb-3">admin@myapp.com</p>
                        <span class="badge rounded-pill bg-primary px-3 py-2 mb-4">Super Admin</span>

                        <div class="border rounded-3 p-3 text-start" style="border-color:var(--border)!important">
                            <div class="d-flex justify-content-between py-2 border-bottom" style="border-color:var(--border)!important">
                                <span class="text-muted small">Bergabung</span>
                                <span class="small fw-semibold">Jan 2024</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom" style="border-color:var(--border)!important">
                                <span class="text-muted small">Login terakhir</span>
                                <span class="small fw-semibold">Hari ini</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom" style="border-color:var(--border)!important">
                                <span class="text-muted small">Status</span>
                                <span class="small fw-semibold text-success">
                                    <i class="bi bi-circle-fill me-1" style="font-size:8px"></i>Aktif
                                </span>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span class="text-muted small">Role</span>
                                <span class="small fw-semibold">Super Admin</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Akses Menu -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h6 class="mb-1 fw-semibold text-dark"><i class="bi bi-key text-primary"></i> Akses Menu</h6>
                        <small class="text-muted d-block">Menu yang dapat diakses</small>
                    </div>
                    <div class="card-body p-0">
                        <?php
                            $menus = [
                                ['icon' => 'bi-speedometer2', 'label' => 'Dashboard',         'color' => 'primary'],
                                ['icon' => 'bi-people-fill', 'label' => 'Data Pengguna',      'color' => 'info'],
                                ['icon' => 'bi-box2-fill',    'label' => 'Data Produk',        'color' => 'success'],
                                ['icon' => 'bi-basket2-fill', 'label' => 'Data Pesanan',       'color' => 'warning'],
                                ['icon' => 'bi-truck',        'label' => 'Data Suplai',        'color' => 'danger'],
                                ['icon' => 'bi-graph-up-arrow', 'label' => 'Laporan Penjualan', 'color' => 'primary'],
                            ];
                        ?>
                        <?php foreach ($menus as $m): ?>
                        <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom"
                             style="border-color:var(--border)!important">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi <?= $m['icon'] ?> text-<?= $m['color'] ?>"></i>
                                <span class="small"><?= $m['label'] ?></span>
                            </div>
                            <i class="bi bi-check-lg text-success"></i>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Form Edit Kanan -->
            <div class="col-xl-8">

                <!-- Info Pribadi -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-0 fw-semibold text-dark"><i class="bi bi-person-badge text-primary"></i> Informasi Pribadi</h6>
                            <small class="text-muted d-block">Data personal Anda</small>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" id="btnEdit" onclick="toggleEdit()">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control profile-input" value="Administrator" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Username</label>
                                <input type="text" class="form-control profile-input" value="admin" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Email</label>
                                <input type="email" class="form-control profile-input" value="admin@myapp.com" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">No. Telepon</label>
                                <input type="text" class="form-control profile-input" value="+62 812 3456 7890" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Role</label>
                                <input type="text" class="form-control profile-input" value="Super Admin" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Departemen</label>
                                <input type="text" class="form-control profile-input" value="IT & Sistem" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Alamat</label>
                                <textarea class="form-control profile-input" rows="2" readonly>Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta</textarea>
                            </div>
                        </div>
                        <div id="editActions" class="d-none mt-3 d-flex gap-2">
                            <button class="btn btn-primary btn-sm" onclick="saveProfile()">
                                <i class="bi bi-check-lg me-1"></i>Simpan
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="cancelEdit()">
                                <i class="bi bi-x-lg me-1"></i>Batal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Ganti Password -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h6 class="mb-1 fw-semibold text-dark"><i class="bi bi-shield-lock text-warning"></i> Ganti Password</h6>
                        <small class="text-muted d-block">Ubah password untuk keamanan akun</small>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label class="form-label small fw-semibold">Password Lama</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="oldPass" placeholder="Masukkan password lama">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('oldPass')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="newPass" placeholder="Password baru">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('newPass')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label small fw-semibold">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confPass" placeholder="Ulangi password baru">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePass('confPass')">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-warning btn-sm" onclick="changePassword()">
                                <i class="bi bi-lock me-1"></i>Ganti Password
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h6 class="mb-1 fw-semibold text-dark"><i class="bi bi-clock-history text-info"></i> Aktivitas Terakhir</h6>
                        <small class="text-muted d-block">Riwayat aktivitas akun Anda</small>
                    </div>
                    <div class="card-body p-0">
                        <?php
                            $aktivitas = [
                                ['icon' => 'bi-box-arrow-in-right', 'color' => 'success', 'aksi' => 'Login ke sistem', 'waktu' => 'Hari ini, 08:32'],
                                ['icon' => 'bi-pencil-square', 'color' => 'primary', 'aksi' => 'Update data produk', 'waktu' => 'Hari ini, 09:15'],
                                ['icon' => 'bi-plus-lg', 'color' => 'info', 'aksi' => 'Tambah pesanan baru', 'waktu' => 'Kemarin, 14:22'],
                                ['icon' => 'bi-graph-up-arrow', 'color' => 'warning', 'aksi' => 'Lihat laporan penjualan', 'waktu' => 'Kemarin, 16:05'],
                                ['icon' => 'bi-gear', 'color' => 'secondary', 'aksi' => 'Ubah pengaturan tampilan', 'waktu' => '2 hari lalu'],
                            ];
                        ?>
                        <?php foreach ($aktivitas as $a): ?>
                        <div class="d-flex align-items-center gap-3 px-3 py-3 border-bottom"
                             style="border-color:var(--border)!important">
                            <div class="badge rounded-circle" style="background-color: var(--bs-<?= $a['color'] ?>); width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi <?= $a['icon'] ?> text-white" style="font-size: 14px;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold small"><?= $a['aksi'] ?></div>
                            </div>
                            <small class="text-muted text-nowrap"><?= $a['waktu'] ?></small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .profile-input[readonly] {
        background: var(--bg);
        cursor: default;
        border-color: transparent;
    }
    .profile-input:not([readonly]) {
        background: var(--surface);
        border-color: var(--border);
    }
</style>

<script>
    function toggleEdit() {
        const inputs = document.querySelectorAll('.profile-input');
        const actions = document.getElementById('editActions');
        const btn = document.getElementById('btnEdit');
        inputs.forEach(i => i.removeAttribute('readonly'));
        actions.classList.remove('d-none');
        actions.classList.add('d-flex');
        btn.classList.add('d-none');
    }

    function cancelEdit() {
        const inputs = document.querySelectorAll('.profile-input');
        const actions = document.getElementById('editActions');
        const btn = document.getElementById('btnEdit');
        inputs.forEach(i => i.setAttribute('readonly', true));
        actions.classList.add('d-none');
        actions.classList.remove('d-flex');
        btn.classList.remove('d-none');
    }

    function saveProfile() {
        // Gimmick — nanti konek ke database
        cancelEdit();
        alert('Profile berhasil disimpan! (Gimmick — belum konek database)');
    }

    function togglePass(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function changePassword() {
        const o = document.getElementById('oldPass').value;
        const n = document.getElementById('newPass').value;
        const c = document.getElementById('confPass').value;
        if (!o || !n || !c) { alert('Semua field harus diisi!'); return; }
        if (n !== c) { alert('Password baru tidak cocok!'); return; }
        alert('Password berhasil diganti! (Gimmick — belum konek database)');
        ['oldPass','newPass','confPass'].forEach(id => document.getElementById(id).value = '');
    }
</script>

<?= view('layout/footer') ?>