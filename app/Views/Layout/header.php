<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> | NiceWeb</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&family=Montserrat:wght@300;400;500;700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&family=Montserrat:wght@300;400;500;700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

    <script>
    (function() {
        try {
            var s = JSON.parse(localStorage.getItem('appThemeSettings'));
            if (s && s.theme && s.theme !== 'default') {
                document.documentElement.classList.add('theme-' + s.theme);
            }
        } catch(e) {}
    })();
    </script>

    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
            --radius: 12px;
            --surface:      #ffffff;
            --bg:           #f4f7fa;
            --text:         #5b6b79;
            --text-strong:  #1a202c;
            --text-muted:   #adb5bd;
            --border:       #e9ecef;
            --accent:       #4680FF;
            --accent-soft:  #eef2ff;
            --hover-soft:   #f0f4ff;
            --icon-color:   #8996a4;
            --font:         'Inter', system-ui, sans-serif;
        }

        html.theme-dark {
            --surface:      #1f2430;
            --bg:           #0f131d;
            --text:         #c2c9d6;
            --text-strong:  #e9ecef;
            --text-muted:   #6c7a8d;
            --border:       rgba(255,255,255,0.08);
            --accent:       #5d8cff;
            --accent-soft:  rgba(93,140,255,0.15);
            --hover-soft:   rgba(93,140,255,0.1);
            --icon-color:   #6c7a8d;
        }

        html.theme-light {
            --surface:      #ffffff;
            --bg:           #f4f6fb;
            --text:         #4a5568;
            --text-strong:  #2c2f33;
            --text-muted:   #a0aec0;
            --border:       #e2e8f0;
            --accent:       #4d7cff;
            --accent-soft:  #ebf0ff;
            --hover-soft:   #f0f4ff;
            --icon-color:   #a0aec0;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body {
            margin: 0; min-height: 100%;
            font-family: var(--font);
            background: var(--bg);
            color: var(--text);
            transition: background 0.3s, color 0.3s;
        }

        a { color: inherit; text-decoration: none; }

        .pc-header ul.list-unstyled { 
            flex-wrap: nowrap; 
            overflow: visible;
        }
        
        .pc-header .pc-h-item {
            position: relative;
            flex-shrink: 0;
        }
        
        .user-avtar {
            display: block;
            flex-shrink: 0;
        }  

        .pc-sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: #0f172a;
            border-right: none;
            z-index: 1030; overflow-y: auto;
            transition: left 0.3s ease;
            box-shadow: 4px 0 24px rgba(0,0,0,0.12);
        }

        html.theme-light .pc-sidebar { background: #1e293b; }

        .pc-sidebar::-webkit-scrollbar { width: 4px; }
        .pc-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
        .pc-sidebar .navbar-wrapper { display: flex; flex-direction: column; min-height: 100%; }
        .pc-sidebar .m-header {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            min-height: var(--header-height); display: flex; align-items: center;
        }
        .pc-sidebar .navbar-content { flex: 1; padding: 16px 0; }

        .pc-navbar { list-style: none; margin: 0; padding: 0; }
        .pc-navbar .pc-item { position: relative; }
        .pc-navbar .pc-caption { padding: 8px 20px 4px; margin-top: 8px; }
        .pc-navbar .pc-caption label {
            display: inline-block; margin: 0;
            font-size: 10px; font-weight: 700;
            letter-spacing: .12em; text-transform: uppercase;
            color: rgba(255,255,255,0.3);
        }

        .pc-navbar .pc-link {
            display: flex; align-items: center;
            padding: 10px 16px; margin: 2px 10px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            font-size: 14px; font-weight: 500;
            transition: background 0.2s, color 0.2s, transform 0.2s;
            background: transparent; border: none;
            width: calc(100% - 20px); cursor: pointer; text-align: left;
        }

        .pc-navbar .pc-link:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
            transform: translateX(2px);
        }
        .pc-navbar .pc-link:hover .pc-micon i { color: #fff; }

        .pc-navbar .pc-item.active .pc-link {
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(70,128,255,0.4);
        }
        .pc-navbar .pc-item.active .pc-micon i { color: #fff; }

        .pc-micon { width: 24px; margin-right: 12px; display: flex; align-items: center; justify-content: center; }
        .pc-micon i { font-size: 18px; color: rgba(255,255,255,0.45); transition: color 0.2s; }
        .pc-mtext { transition: color 0.2s; }

        .pc-header {
            position: fixed; top: 0;
            left: var(--sidebar-width); right: 0;
            height: var(--header-height);
            display: flex; flex-direction: column; justify-content: center;
            padding: 0 20px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            z-index: 1020;
            transition: left 0.3s ease;
        }

        html.theme-dark .pc-header {
            background: rgba(15,19,29,0.92);
        }

        .pc-header .header-wrapper {
            display: flex; align-items: center; width: 100%; gap: 8px;
        }
        /* Search bar theming */
        #globalSearch:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(70,128,255,0.15);
            border-color: var(--accent) !important;
            background: var(--surface) !important;
        }
        #globalSearch::placeholder { color: var(--text-muted); }

    .pc-head-link{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      border:none;
      border-radius:8px;
      background:transparent;
      color:var(--text);
      transition:.2s;
    }

    .pc-head-link.icon-link{
      width:38px;
      height:38px;
      font-size:20px;
      padding:0;
    }

    .pc-head-link.profile-link{
      width:auto;
      height:38px;
      padding:0 .5rem;
      font-size:14px;
      white-space:nowrap;
    }

    .pc-header .ms-auto > ul{
      display:flex;
      align-items:center;
      gap:.25rem;
      flex-wrap:nowrap;
    }

    /* parent yang membungkus bell + profile */
    .pc-header .pc-head-right {
      display: flex !important;
      align-items: center;
      gap: 10px;
    }

    /* tiap item tetap di flow normal */
    .pc-header .pc-head-right .pc-h-item {
      position: relative;
      flex: 0 0 auto;
      margin: 0 !important;
    }

    /* area klik jangan melebar aneh */
    .pc-header .pc-head-right .pc-head-link {
      display: inline-flex;
      align-items: center;
      position: relative;
      width: auto;
      min-width: 0;
    }

    /* khusus tombol lonceng */
    .pc-header .pc-head-right .pc-h-item > button.pc-head-link {
      width: 36px;
      height: 36px;
      justify-content: center;
      padding: 0;
    }

        .pc-head-link:hover { background: var(--hover-soft); color: var(--accent); }
        .pc-h-badge { position: absolute; top: 0; right: 0; font-size: 9px; padding: 2px 5px; }
        .pc-h-item { position: relative; }
        .dropdown-notification { width: 320px; }
        .dropdown-user-profile { width: 220px; }
        .dropdown-menu { background: var(--surface); border-color: var(--border); }
        .dropdown-item { color: var(--text); }
        .dropdown-item:hover { background: var(--hover-soft); color: var(--accent); }
        .dropdown-divider { border-color: var(--border); }
        .avtar { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; }
        .avtar.avtar-s { width: 32px; height: 32px; }
        .user-avtar { width: 36px; height: 36px; border-radius: 50%; }
        .wid-40 { width: 40px; height: 40px; border-radius: 50%; }

        .pc-container {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            transition: margin-left 0.3s ease;
        }

        .pc-content { padding: 24px; }

        .page-header { margin-bottom: 24px; }
        .page-header h5 { font-size: 20px; font-weight: 600; color: var(--text-strong); }
        .breadcrumb-item a { color: var(--accent); }
        .breadcrumb-item.active { color: var(--text-muted); }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: none;
            transition: background 0.3s, border-color 0.3s;
        }

        .card-header { background: transparent !important; border-color: var(--border); color: var(--text-strong); }
        .card-body { color: var(--text); }

        .stat-card { border-radius: var(--radius); overflow: hidden; }
        .stat-card .card-body { padding: 20px; }
        .stat-icon { width: 52px; height: 52px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; font-size: 24px; }
        .stat-value { font-size: 24px; font-weight: 700; color: var(--text-strong); }
        .stat-label { font-size: 13px; color: var(--text-muted); margin-bottom: 4px; }
        .stat-badge { font-size: 12px; font-weight: 600; }

        .table { color: var(--text); border-color: var(--border); }
        .table th { font-size: 12px; text-transform: uppercase; letter-spacing: .05em; color: var(--text-muted); font-weight: 600; border-top: none; background: transparent; border-color: var(--border); }
        .table td { font-size: 14px; vertical-align: middle; color: var(--text); border-color: var(--border); }
        .table-light { background: var(--accent-soft) !important; }
        .table-light th { color: var(--text) !important; background: var(--accent-soft) !important; }
        .table-hover tbody tr:hover td { background: var(--hover-soft); }
        .table-bordered { border-color: var(--border); }
        .badge-status { font-size: 11px; padding: 4px 10px; border-radius: 20px; font-weight: 500; }

        .form-control, .form-select {
            background: var(--surface); color: var(--text); border-color: var(--border);
        }
        .form-control:focus, .form-select:focus {
            background: var(--surface); color: var(--text-strong);
            border-color: var(--accent); box-shadow: 0 0 0 0.2rem rgba(70,128,255,0.15);
        }
        .form-control::placeholder { color: var(--text-muted); }

        .btn-outline-secondary { color: var(--text); border-color: var(--border); }
        .btn-outline-secondary:hover, .btn-outline-secondary.active {
            background: var(--accent); border-color: var(--accent); color: #fff;
        }

        /* ===== DESKTOP COLLAPSED ===== */
        body.sidebar-collapsed .pc-sidebar { left: calc(-1 * var(--sidebar-width)); }
        body.sidebar-collapsed .pc-header { left: 0; }
        body.sidebar-collapsed .pc-container { margin-left: 0; }

        /* ===== MOBILE OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(15,23,42,.45);
            z-index: 1025;
            backdrop-filter: blur(2px);
        }

        @media (max-width: 768px) {
            /* Sidebar tersembunyi default di mobile */
            .pc-sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }
            .pc-header { left: 0 !important; }
            .pc-container { margin-left: 0 !important; }

            /* Sidebar muncul saat sidebar-open */
            body.sidebar-open .pc-sidebar {
                left: 0;
                box-shadow: 8px 0 24px rgba(0,0,0,0.15);
            }
            body.sidebar-open .sidebar-overlay { display: block; }

            /* Perkecil padding konten di mobile */
            .pc-content { padding: 12px; }

            /* Tabel scroll horizontal */
            .table-responsive { -webkit-overflow-scrolling: touch; }

            /* Card full width di mobile */
            .stat-icon { width: 40px; height: 40px; font-size: 20px; }
            .stat-value { font-size: 20px; }

            /* Dropdown notification full width */
            .dropdown-notification { width: calc(100vw - 32px); }

            /* Page header responsive */
            .page-header { margin-bottom: 16px; }
            .page-header h5 { font-size: 18px; }

            /* Stat cards better spacing */
            .row.g-3 { --bs-gutter-y: 12px; }

            /* Form responsive */
            .input-group { flex-wrap: wrap; }
            .input-group-text, .form-control, .btn { flex: 1 1 auto; min-width: 100px; }

            /* D-flex with wrap for header controls */
            .d-flex.align-items-center.justify-content-between { flex-wrap: wrap; }
        }

        /* ===== POLISH ===== */

        /* Cards lebih premium */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06);
            transition: background 0.3s, border-color 0.3s, box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        html.theme-dark .card {
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        /* Stat cards hover lift */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
        }

        /* Page bg lebih hidup — subtle dot pattern */
        body {
            background-image: radial-gradient(circle, rgba(70,128,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        html.theme-dark body {
            background-image: radial-gradient(circle, rgba(93,140,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Badge & button lebih rounded */
        .badge { border-radius: 6px; }
        .btn { border-radius: 8px; font-weight: 500; }
        .btn-sm { border-radius: 6px; }

        /* Card header border aksen kiri */
        .card-header {
            position: relative;
        }

        /* Table row hover smooth */
        .table-hover tbody tr {
            transition: background 0.15s;
        }

        /* Form input focus glow */
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(70,128,255,0.12) !important;
        }

        /* Progress bar animasi */
        .progress-bar {
            border-radius: 10px;
            background-image: linear-gradient(90deg, rgba(255,255,255,0.15) 0%, transparent 100%);
        }

        /* ===== PAGINATION RESPONSIVE ===== */
        .pagination { flex-wrap: wrap; gap: 2px; }
        .pagination-sm .page-link { padding: 0.375rem 0.75rem; font-size: 12px; }
        .pagination-sm .page-item { margin: 0; }

        @media (max-width: 576px) {
            .pagination-sm .page-link { padding: 0.25rem 0.5rem; font-size: 11px; }
            .pagination-sm { font-size: 12px; }
        }

        @media (max-width: 480px) {
            .pagination-sm .page-link { padding: 0.2rem 0.4rem; font-size: 10px; }
            .pagination { gap: 1px; }
        }

        /* Breadcrumb separator */
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--text-muted);
        }

        /* Dropdown shadow */
        .dropdown-menu {
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        html.theme-dark .dropdown-menu {
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }

        /* ===== EXTRA SMALL DEVICES (< 480px) ===== */
        @media (max-width: 480px) {
            :root { --header-height: 60px; --sidebar-width: 240px; }
            .pc-content { padding: 10px !important; }
            .mb-4 { margin-bottom: 12px !important; }
            .page-header h5 { font-size: 16px; font-weight: 700; }
            .card-body { padding: 12px !important; }
            .card-header { padding: 10px 12px !important; }
            .card-footer { padding: 8px 12px !important; }
            .table { font-size: 12px; }
            .table th { font-size: 10px; }
            .stat-card .card-body { padding: 12px !important; }
            .stat-value { font-size: 18px !important; }
            .badge { font-size: 10px; padding: 3px 8px; }
            .btn-sm { padding: 4px 8px; font-size: 12px; }
            .input-group { flex-direction: column; }
            .input-group > * { width: 100% !important; margin-bottom: 6px; }
            .input-group > *:last-child { margin-bottom: 0; }
            .d-flex.align-items-center.justify-content-between { gap: 8px; }
            .row.g-3 { --bs-gutter-x: 8px; --bs-gutter-y: 8px; }
            .col-sm-6 { flex: 0 0 100%; max-width: 100%; }
            .hide-mobile { display: none !important; }
            /* Page header stacking */
            .page-header .d-flex.align-items-center.justify-content-between { flex-direction: column; align-items: flex-start; }
            .page-header .d-flex.align-items-center.justify-content-between > span { align-self: flex-start; margin-top: 8px; }
        }

        /* ===== RESPONSIVE UTILITIES ===== */
        /* Ensure flex containers wrap properly on mobile */
        .responsive-flex { display: flex; flex-wrap: wrap; gap: 8px; }
        .responsive-flex > * { flex: 1 1 auto; min-width: 150px; }

        @media (max-width: 576px) {
            .responsive-flex { gap: 6px; }
            .responsive-flex > * { min-width: 100%; }
        }

        .settings-panel { position: fixed; inset: 0; z-index: 1100; display: grid; place-items: center; }
        .settings-panel-backdrop { position: absolute; inset: 0; background: rgba(15,23,42,.55); }
        .settings-panel-card {
            position: relative; width: min(420px, calc(100% - 32px));
            background: var(--surface); border: 1px solid var(--border);
            border-radius: .75rem; box-shadow: 0 20px 50px rgba(15,23,42,.18);
            padding: 1.25rem; z-index: 1; transition: background 0.3s, border-color 0.3s;
        }
        .settings-panel-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1rem; }
        .settings-panel-header h6 { margin: 0; font-size: 1rem; color: var(--text-strong); }
        .settings-panel-header small { color: var(--text-muted); }
        .settings-panel-body .form-label { font-size: .85rem; font-weight: 600; margin-bottom: .4rem; color: var(--text); }
        .settings-panel-body .settings-option.active { background: var(--accent); color: #fff; border-color: var(--accent); }
        .btn-close { filter: invert(0); }
        html.theme-dark .btn-close { filter: invert(1); }
    </style>
</head>
<body>