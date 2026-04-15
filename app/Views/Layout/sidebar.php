<nav class="pc-sidebar">
    <style>
        /* Sidebar overlay gradient */
        .pc-sidebar::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 200px;
            background: linear-gradient(180deg, rgba(70,128,255,0.08) 0%, transparent 100%);
            pointer-events: none;
            z-index: 0;
        }

        .pc-sidebar .navbar-wrapper { position: relative; z-index: 1; }

        .pc-sidebar .pc-link {
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }

        .pc-sidebar .pc-item + .pc-item {
            margin-top: 2px;
        }

        /* User card di bawah sidebar */
        .sidebar-user-card {
            margin: 12px;
            padding: 12px;
            border-radius: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-user-card .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: #fff;
            flex-shrink: 0;
        }

        .sidebar-user-card .user-name {
            font-size: 13px; font-weight: 600;
            color: rgba(255,255,255,0.9);
            line-height: 1.2;
        }

        .sidebar-user-card .user-role {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
        }
    </style>

    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/dashboard" class="b-brand d-flex align-items-center gap-2 text-decoration-none">
                <div style="width:36px;height:36px;background:var(--accent);border-radius:10px;
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;
                            box-shadow:0 4px 12px rgba(70,128,255,0.4)">
                    <i class="bi bi-graph-up-arrow" style="color:#fff;font-size:17px"></i>
                </div>
                <div>
                    <span class="fw-bold" style="font-size:17px;color:#fff;letter-spacing:-.3px">NiceWeb</span>
                    <div style="font-size:10px;color:rgba(255,255,255,0.35);letter-spacing:.05em;margin-top:-2px">ADMIN PANEL</div>
                </div>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>

                <li class="pc-item <?= (uri_string() == '' || uri_string() == 'dashboard') ? 'active' : '' ?>">
                    <a href="/dashboard" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-speedometer2"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Master Data</label>
                </li>

                <li class="pc-item <?= uri_string() == 'pengguna' ? 'active' : '' ?>">
                    <a href="/pengguna" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-people-fill"></i></span>
                        <span class="pc-mtext">Data Pengguna</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'produk' ? 'active' : '' ?>">
                    <a href="/produk" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-box2-fill"></i></span>
                        <span class="pc-mtext">Data Produk</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'pesanan' ? 'active' : '' ?>">
                    <a href="/pesanan" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-basket2-fill"></i></span>
                        <span class="pc-mtext">Data Pesanan</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Laporan</label>
                </li>

                <li class="pc-item <?= uri_string() == 'penjualan' ? 'active' : '' ?>">
                    <a href="/penjualan" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-graph-up-arrow"></i></span>
                        <span class="pc-mtext">Laporan Penjualan</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'suplai' ? 'active' : '' ?>">
                    <a href="/suplai" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-truck"></i></span>
                        <span class="pc-mtext">Data Suplai</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'lokasi' ? 'active' : '' ?>">
                    <a href="/lokasi" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-geo-alt-fill"></i></span>
                        <span class="pc-mtext">Data Lokasi</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Akun</label>
                </li>

                <li class="pc-item">
                    <button class="pc-link" id="app-settings-button" type="button">
                        <span class="pc-micon"><i class="bi bi-gear"></i></span>
                        <span class="pc-mtext">Pengaturan</span>
                    </button>
                </li>

                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="bi bi-box-arrow-right"></i></span>
                        <span class="pc-mtext">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Card -->
        <div class="sidebar-user-card">
            <div class="user-avatar">AD</div>
            <div>
                <div class="user-name">Administrator</div>
                <div class="user-role">Super Admin</div>
            </div>
            <a href="/profile" class="ms-auto text-decoration-none"
               style="color:rgba(255,255,255,0.4);font-size:16px">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>
        </div>

    </div>

    <div id="app-settings-panel" class="settings-panel d-none">
        <div class="settings-panel-backdrop"></div>
        <div class="settings-panel-card">
            <div class="settings-panel-header">
                <div>
                    <h6 class="mb-1">Pengaturan Tampilan</h6>
                    <small class="text-muted">Ubah tema, font, dan warna tanpa reload</small>
                </div>
                <button id="settingsCloseBtn" type="button" class="btn-close"></button>
            </div>

            <div class="settings-panel-body">
                <div class="mb-3">
                    <label class="form-label">Tema</label>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-secondary btn-sm settings-option active" data-setting="theme" data-value="default">Default</button>
                        <button class="btn btn-outline-secondary btn-sm settings-option" data-setting="theme" data-value="light">Light</button>
                        <button class="btn btn-outline-secondary btn-sm settings-option" data-setting="theme" data-value="dark">Dark</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Font</label>
                    <select id="themeFontSelect" class="form-select form-select-sm">
                        <option value="Inter, system-ui, sans-serif">Inter</option>
                        <option value="Roboto, system-ui, sans-serif">Roboto</option>
                        <option value="Montserrat, system-ui, sans-serif">Montserrat</option>
                        <option value="Poppins, system-ui, sans-serif">Poppins</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Warna Accent / Huruf</label>
                    <input id="themeAccentColor" type="color" class="form-control form-control-color" value="#4680FF">
                </div>

                <div class="mb-3">
                    <label class="form-label">Warna Outline</label>
                    <input id="themeOutlineColor" type="color" class="form-control form-control-color" value="#e9ecef">
                </div>

                <div class="mb-3">
                    <label class="form-label">Background Widget</label>
                    <input id="themeWidgetBgColor" type="color" class="form-control form-control-color" value="#ffffff">
                </div>

                <div class="mb-3">
                    <label class="form-label">Background Layout</label>
                    <input id="themeLayoutBgColor" type="color" class="form-control form-control-color" value="#f8f9fa">
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="sidebar-overlay" id="sidebar-overlay"></div>