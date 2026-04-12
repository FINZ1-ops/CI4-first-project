<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-2">
                <li class="pc-h-item">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="ms-auto">
            <ul class="list-unstyled mb-0 d-flex align-items-center gap-3">

                <!-- Notifikasi -->
                <li class="dropdown pc-h-item me-1">
                    <a class="pc-head-link" data-bs-toggle="dropdown" href="#" role="button"
                       style="position:relative;display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;">
                        <i class="bi bi-bell-fill" style="font-size:20px;color:var(--text)"></i>
                        <span style="position:absolute;top:6px;right:6px;width:8px;height:8px;
                                     background:#dc3545;border-radius:50%;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between px-3 py-2">
                            <h6 class="m-0 fw-semibold">Notifikasi</h6>
                            <span class="badge bg-warning rounded-pill">3 Baru</span>
                        </div>
                        <div class="dropdown-divider my-0"></div>

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
                            <a href="#" class="text-primary small">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </li>

                <!-- Profile -->
                <li class="dropdown pc-h-item me-1">
                    <a class="pc-head-link d-flex align-items-center gap-2 px-2" data-bs-toggle="dropdown" href="#" role="button">
                        <!-- <img src="https://ui-avatars.com/api/?name=Admin&background=4680FF&color=fff"
                             alt="Admin" class="user-avtar"> -->
                        <span class="d-none d-sm-inline-block fw-semibold" style="font-size:14px">Admin</span>
                        <i class="bi bi-chevron-down d-none d-sm-inline-block" style="font-size:14px;opacity:.6"></i>
                    </a>

                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="p-3 border-bottom" style="border-color:var(--border)!important">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=4680FF&color=fff&size=48"
                                     alt="Admin" class="rounded-circle" width="48" height="48">
                                <div>
                                    <div class="fw-semibold" style="font-size:14px">Administrator</div>
                                    <small class="text-muted">admin@myapp.com</small>
                                    <div class="mt-1">
                                        <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:10px">Super Admin</span>
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
                                <i class="bi bi-gear me-2 text-warning"></i>Pengaturan Tampilan
                            </a>
                        </div>

                        <div class="p-1 border-top" style="border-color:var(--border)!important">
                            <a href="#" class="dropdown-item rounded-2 px-3 py-2 text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</header>