<nav class="pc-sidebar">
    <style>
        .pc-sidebar .pc-link {
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }

        .pc-sidebar .pc-link:hover,
        .pc-sidebar .pc-link:focus {
            background: rgba(70, 128, 255, .1);
            color: var(--primary);
            transform: translateX(2px);
        }

        .pc-sidebar .pc-link:hover .pc-micon,
        .pc-sidebar .pc-link:focus .pc-micon {
            background: rgba(70, 128, 255, .15);
        }

        .pc-sidebar .pc-link:hover .pc-micon i,
        .pc-sidebar .pc-link:focus .pc-micon i {
            color: var(--primary);
        }

        .pc-sidebar .pc-navbar .pc-item button.pc-link {
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .pc-sidebar .pc-item + .pc-item {
            margin-top: 4px;
        }
    </style>

    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/dashboard" class="b-brand text-primary">
                <span class="badge bg-primary rounded-pill ms-2 fw-bold fs-6">NiceWeb</span>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>

                <li class="pc-item <?= (uri_string() == '' || uri_string() == 'dashboard') ? 'active' : '' ?>">
                    <a href="/dashboard" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Master Data</label>
                </li>

                <li class="pc-item <?= uri_string() == 'pengguna' ? 'active' : '' ?>">
                    <a href="/pengguna" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Data Pengguna</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'produk' ? 'active' : '' ?>">
                    <a href="/produk" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-box"></i></span>
                        <span class="pc-mtext">Data Produk</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'pesanan' ? 'active' : '' ?>">
                    <a href="/pesanan" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-shopping-cart"></i></span>
                        <span class="pc-mtext">Data Pesanan</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Laporan</label>
                </li>

                <li class="pc-item <?= uri_string() == 'penjualan' ? 'active' : '' ?>">
                    <a href="/penjualan" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-chart-bar"></i></span>
                        <span class="pc-mtext">Laporan Penjualan</span>
                    </a>
                </li>

                <li class="pc-item <?= uri_string() == 'suplai' ? 'active' : '' ?>">
                    <a href="/suplai" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-truck"></i></span>
                        <span class="pc-mtext">Data Suplai</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>Akun</label>
                </li>

                <li class="pc-item">
                    <button class="pc-link" id="app-settings-button" type="button">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">Pengaturan</span>
                    </button>
                </li>

                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-logout"></i></span>
                        <span class="pc-mtext">Logout</span>
                    </a>
                </li>
            </ul>
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