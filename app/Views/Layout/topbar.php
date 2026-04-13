<header class="pc-header">
    <div class="header-wrapper">
        
        <!-- Kiri: Toggle Sidebar & Logo -->
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="pc-head-link" id="sidebar-hide">
                <i class="bi bi-list"></i>
            </a>
            <!-- Logo hanya di mobile -->
            <a href="/dashboard" class="d-flex align-items-center gap-2 d-md-none text-decoration-none">
                <div style="width:28px;height:28px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-graph-up-arrow" style="color:#fff;font-size:14px"></i>
                </div>
                <span class="fw-bold" style="font-size:15px;color:var(--text-strong)">NiceWeb</span>
            </a>
        </div>

        <!-- Tengah: Search Bar (desktop only) -->
        <div class="flex-grow-1 mx-3 d-none d-md-block" style="max-width:400px">
            <div class="position-relative">
                <i class="bi bi-search position-absolute"
                   style="left:12px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:14px;pointer-events:none"></i>
                <input type="text" id="globalSearch"
                       class="form-control ps-5 pe-4"
                       placeholder="Search...  Ctrl+K"
                       style="border-radius:10px;background:var(--bg);border-color:var(--border);
                              color:var(--text);font-size:13px;height:38px;">
                <kbd class="position-absolute d-none d-lg-block"
                     style="right:10px;top:50%;transform:translateY(-50%);
                            background:var(--border);color:var(--text-muted);
                            border:none;border-radius:5px;padding:2px 6px;font-size:11px">Ctrl+K</kbd>
            </div>
        </div>

        <!-- Kanan: Actions -->
        <div class="ms-auto">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-1">

                <!-- Search icon mobile -->
                <li class="pc-h-item d-md-none">
                    <a href="#" class="pc-head-link" id="mobileSearchBtn">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <!-- Toggle Dark/Light -->
                <li class="pc-h-item">
                    <a href="#" class="pc-head-link" id="themeToggleBtn" title="Toggle tema">
                        <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
                    </a>
                </li>

                <!-- Notifikasi -->
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link position-relative" data-bs-toggle="dropdown" href="#" role="button">
                        <i class="bi bi-bell-fill"></i>
                        <span style="position:absolute;top:7px;right:7px;width:8px;height:8px;
                                     background:#dc3545;border-radius:50%;
                                     border:2px solid var(--surface)"></span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="d-flex align-items-center justify-content-between px-3 py-2"
                             style="border-bottom:1px solid var(--border)">
                            <h6 class="m-0 fw-semibold">Notifikasi</h6>
                            <span class="badge bg-danger rounded-pill">3 Baru</span>
                        </div>
                        <a href="#" class="dropdown-item px-3 py-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avtar avtar-s bg-success bg-opacity-10">
                                    <i class="bi bi-check-lg text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size:13px">Pesanan baru masuk</div>
                                    <small class="text-muted">2 menit lalu</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider my-0"></div>
                        <a href="#" class="dropdown-item px-3 py-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avtar avtar-s bg-primary bg-opacity-10">
                                    <i class="bi bi-person-fill text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size:13px">User baru mendaftar</div>
                                    <small class="text-muted">15 menit lalu</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider my-0"></div>
                        <a href="#" class="dropdown-item px-3 py-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avtar avtar-s bg-warning bg-opacity-10">
                                    <i class="bi bi-truck text-warning"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size:13px">Suplai baru diterima</div>
                                    <small class="text-muted">1 jam lalu</small>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider my-0"></div>
                        <div class="p-2 text-center">
                            <a href="#" class="text-primary small fw-semibold">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </li>

                <!-- Profile -->
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link d-flex align-items-center gap-2 px-2"
                       data-bs-toggle="dropdown" href="#" role="button">
                        <div style="width:32px;height:32px;border-radius:50%;
                                    background:var(--accent);
                                    display:flex;align-items:center;justify-content:center;
                                    font-weight:700;font-size:12px;color:#fff;flex-shrink:0">
                            AD
                        </div>
                        <span class="d-none d-sm-inline-block fw-semibold"
                              style="font-size:14px;color:var(--text-strong)">Admin</span>
                        <i class="bi bi-chevron-down d-none d-sm-inline-block"
                           style="font-size:11px;opacity:.5;color:var(--text)"></i>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="p-3" style="border-bottom:1px solid var(--border)">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width:44px;height:44px;border-radius:50%;
                                            background:var(--accent);
                                            display:flex;align-items:center;justify-content:center;
                                            font-weight:700;font-size:16px;color:#fff;flex-shrink:0">
                                    AD
                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size:14px;color:var(--text-strong)">
                                        Administrator
                                    </div>
                                    <small class="text-muted">admin@niceweb.com</small>
                                    <div class="mt-1">
                                        <span class="badge bg-primary bg-opacity-10 text-primary"
                                              style="font-size:10px">Super Admin</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-1">
                            <a href="/profile" class="dropdown-item rounded-2 px-3 py-2">
                                <i class="bi bi-person-circle me-2 text-primary"></i>Profile Saya
                            </a>
                            <a href="#" class="dropdown-item rounded-2 px-3 py-2"
                               onclick="event.preventDefault();document.getElementById('app-settings-button').click()">
                                <i class="bi bi-palette me-2 text-warning"></i>Pengaturan Tampilan
                            </a>
                        </div>
                        <div class="p-1" style="border-top:1px solid var(--border)">
                            <a href="#" class="dropdown-item rounded-2 px-3 py-2 text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- Mobile Search (hidden default) -->
    <div id="mobileSearch" class="d-none px-3 pb-2">
        <div class="position-relative">
            <i class="bi bi-search position-absolute"
               style="left:12px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:14px;pointer-events:none"></i>
            <input type="text" class="form-control ps-5"
                   placeholder="Cari menu, halaman..."
                   style="border-radius:10px;background:var(--bg);border-color:var(--border);color:var(--text);font-size:13px;">
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===== DARK/LIGHT TOGGLE =====
    const themeBtn  = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');

    function updateThemeIcon() {
        const dark = document.documentElement.classList.contains('theme-dark');
        themeIcon.className = dark ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
    }

    updateThemeIcon();

    if (themeBtn) {
        themeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const isDark   = document.documentElement.classList.contains('theme-dark');
            const newTheme = isDark ? 'default' : 'dark';

            try {
                const s  = JSON.parse(localStorage.getItem('appThemeSettings')) || {};
                s.theme  = newTheme;
                localStorage.setItem('appThemeSettings', JSON.stringify(s));
            } catch(err) {}

            document.documentElement.classList.remove('theme-dark','theme-light','theme-default');
            if (newTheme !== 'default') document.documentElement.classList.add('theme-' + newTheme);

            if (typeof window.applyVarsFromStorage === 'function') window.applyVarsFromStorage();
            updateThemeIcon();
        });
    }

    // ===== MOBILE SEARCH =====
    const mobileBtn    = document.getElementById('mobileSearchBtn');
    const mobileSearch = document.getElementById('mobileSearch');

    if (mobileBtn && mobileSearch) {
        mobileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            mobileSearch.classList.toggle('d-none');
            if (!mobileSearch.classList.contains('d-none')) {
                mobileSearch.querySelector('input').focus();
            }
        });
    }

    // ===== CTRL+K SHORTCUT =====
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const s = document.getElementById('globalSearch');
            if (s) { s.focus(); s.select(); }
        }
    });
});
</script>