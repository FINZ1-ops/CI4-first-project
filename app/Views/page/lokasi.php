<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<?= view('layout/topbar') ?>

<?php
/**
 * Format nominal value to Rupiah currency with abbreviation
 * Converts large numbers to T (trillion), M (million), JT (juta), K (thousand)
 *
 * @param int $n The numeric value to format
 * @return string Formatted currency string (e.g., "Rp 1.2M")
 */
function formatNominal($n) {
    if ($n >= 1000000000000) {
        return 'Rp ' . number_format($n / 1000000000000, 1, ',', '.') . 'T';
    } elseif ($n >= 1000000000) {
        return 'Rp ' . number_format($n / 1000000000, 1, ',', '.') . 'M';
    } elseif ($n >= 1000000) {
        return 'Rp ' . number_format($n / 1000000, 1, ',', '.') . 'JT';
    } elseif ($n >= 1000) {
        return 'Rp ' . number_format($n / 1000, 1, ',', '.') . 'K';
    }
    return 'Rp ' . number_format($n, 0, ',', '.');
}
?>

<style>
/* ============================================================================
   MAP MODAL STYLES
   ============================================================================ */

/** Map modal overlay - fixed positioning covering entire viewport */
.map-modal {
    position: fixed;
    inset: 0;
    z-index: 2000;
    display: none;
    place-items: center;
    padding: 12px;
}

.map-modal.active { display: grid; }

/** Semi-transparent backdrop with blur effect */
.map-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
}

/** Map modal card container */
.map-card {
    position: relative;
    z-index: 1;
    width: min(900px, calc(100vw - 24px));
    height: min(88vh, 760px);
    background: var(--surface);
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 24px 64px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.map-card-header {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    flex-wrap: wrap;
    flex-shrink: 0;
}

.map-card-body {
    flex: 1;
    min-height: 0;
    position: relative;
    overflow: hidden;
}

/* ============================================================================
   SCROLLABLE MAP CONTAINER
   ============================================================================ */

/** Map container with smooth scrolling and grab cursor */
#map-container {
    width: 100%;
    height: 100%;
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    cursor: grab;
    touch-action: pan-x pan-y;
}

#map-container:active { cursor: grabbing; }

/** SVG wrapper for zoom transforms and positioning */
#map-inner {
    width: max-content;
    min-width: 100%;
    min-height: 100%;
    padding: 12px;
    transform-origin: top left;
    transition: transform 0.1s;
}

/** Indonesian SVG map with responsive sizing */
#svg-indonesia {
    display: block;
    width: 1100px;
    max-width: none;
    height: auto;
}

/** Styling for individual province paths */
#svg-indonesia path {
    fill: var(--bg);
    stroke: var(--border);
    stroke-width: 0.5;
    cursor: pointer;
    transition: fill 0.2s, opacity 0.2s;
}

#svg-indonesia path:hover { opacity: 0.8; }

/** Export and import province styling */
#svg-indonesia path.ekspor { fill: #4680FF; }
#svg-indonesia path.impor { fill: #f5576c; }
#svg-indonesia path.ekspor:hover { fill: #2d5fc4; }
#svg-indonesia path.impor:hover { fill: #c72d44; }

/* ============================================================================
   TOOLTIP STYLES
   ============================================================================ */

/** Hover tooltip showing province details */
.map-tooltip {
    position: fixed;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 12px;
    color: var(--text-strong);
    pointer-events: none;
    z-index: 3000;
    display: none;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    max-width: 180px;
}

/* ============================================================================
   MOBILE RESPONSIVE STYLES (max-width: 576px)
   ============================================================================ */

@media (max-width: 576px) {
    .map-modal { padding: 8px; }

    /** Mobile map modal - full screen responsiveness */
    .map-card {
        width: calc(100vw - 16px);
        height: calc(100vh - 16px);
        max-height: none;
        border-radius: 12px;
    }

    .map-card-header { padding: 10px 12px; }
    .map-card-body { height: calc(100% - 64px); }

    /** Responsive SVG sizing for mobile */
    #map-inner { padding: 8px; }
    #svg-indonesia {
        width: 950px;
        min-width: 950px;
    }

    /** Compact controls for mobile */
    .map-zoom-controls {
        bottom: 8px;
        right: 8px;
        gap: 2px;
    }

    .map-zoom-btn {
        width: 30px;
        height: 30px;
        font-size: 14px;
    }

    /** Tooltip adjustments for small screens */
    .map-tooltip {
        font-size: 11px;
        max-width: 150px;
        padding: 6px 10px;
    }
}

/* ============================================================================
   TABLE & BADGE STYLES
   ============================================================================ */

/** Badge styling for export/import categorization */
.badge-ekspor {
    background: rgba(70, 128, 255, 0.12);
    color: #4680FF;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 600;
}

.badge-impor {
    background: rgba(245, 87, 108, 0.12);
    color: #f5576c;
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 600;
}

/** Table responsive fix - only horizontal scroll, vertical flows with page */
.table-responsive {
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
}

@media (max-width: 768px) {
    .table-responsive {
        max-height: none;
        overflow-y: visible;
    }
}

/* ============================================================================
   DESCRIPTION MODAL STYLES
   ============================================================================ */

/** Description modal overlay */
.deskripsi-modal {
    position: fixed;
    inset: 0;
    z-index: 2000;
    display: none;
    place-items: center;
    background: rgba(0, 0, 0, 0.5);
}

.deskripsi-modal.active { display: grid; }

/** Description modal card */
.deskripsi-card {
    position: relative;
    z-index: 1;
    width: min(500px, calc(100vw - 24px));
    background: var(--surface);
    border-radius: 12px;
    border: 1px solid var(--border);
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.deskripsi-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.deskripsi-body { padding: 20px; }

/** Textarea for description input */
.deskripsi-textarea {
    width:100%;
    min-height:150px;
    padding:12px;
    border:1px solid var(--border);
    border-radius:8px;
    font-family:inherit;
    font-size:14px;
    color:var(--text);
    background:var(--bg);
    resize:vertical;
}
.deskripsi-textarea:focus {
    outline:none;
    border-color:var(--accent);
    box-shadow:0 0 0 3px rgba(70,128,255,0.1);
}
.deskripsi-actions {
    display:flex;gap:8px;justify-content:flex-end;margin-top:16px;
}

/* TABLE RESPONSIVE FIX */
.table-responsive {
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    max-height: 480px;
    overflow-y: auto;
}

@media (max-width: 768px) {
    .table-responsive {
        max-height: none;
        overflow-y: visible;
    }
}
</style>

<div class="pc-container">
    <div class="pc-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h5 class="mb-1 fw-bold" style="color:var(--text-strong)">Data Lokasi</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard" style="color:var(--accent)">Home</a></li>
                            <li class="breadcrumb-item active" style="color:var(--text-muted)">Data Lokasi</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-primary btn-sm" title="Lihat Deskripsi" onclick="deskripsi()">
                        <i class="bi bi-exclamation-circle me-1"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" onclick="bukaMap()">
                        <i class="bi bi-globe me-1"></i>Lihat Peta
                    </button>
                    <span class="text-muted small"><?= date('d M Y') ?></span>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 overflow-hidden"
                     style="background:linear-gradient(135deg,#4680FF,#2d5fc4)">
                    <div class="card-body text-white" style="z-index:2;position:relative">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Total Ekspor</div>
                            <i class="bi bi-box-arrow-up-right" style="font-size:18px;opacity:.6"></i>
                        </div>
                        <div class="fw-bold" style="font-size:20px"><?= formatNominal($totalEkspor) ?></div>
                        <div style="font-size:11px;opacity:.7;margin-top:4px">
                            <?= count(array_filter($lokasi, fn($l)=>$l['tipe']==='ekspor')) ?> pengiriman
                        </div>
                    </div>
                    <div class="position-absolute text-white" style="font-size:64px;opacity:.07;bottom:-10px;right:-8px">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 overflow-hidden"
                     style="background:linear-gradient(135deg,#f5576c,#c72d44)">
                    <div class="card-body text-white" style="z-index:2;position:relative">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Total Impor</div>
                            <i class="bi bi-box-arrow-in-down-left" style="font-size:18px;opacity:.6"></i>
                        </div>
                        <div class="fw-bold" style="font-size:20px"><?= formatNominal($totalImpor) ?></div>
                        <div style="font-size:11px;opacity:.7;margin-top:4px">
                            <?= count(array_filter($lokasi, fn($l)=>$l['tipe']==='impor')) ?> penerimaan
                        </div>
                    </div>
                    <div class="position-absolute text-white" style="font-size:64px;opacity:.07;bottom:-10px;right:-8px">
                        <i class="bi bi-box-arrow-in-down-left"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 overflow-hidden"
                     style="background:linear-gradient(135deg,#2dca72,#1a9e57)">
                    <div class="card-body text-white" style="z-index:2;position:relative">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Total Nilai</div>
                            <i class="bi bi-cash-coin" style="font-size:18px;opacity:.6"></i>
                        </div>
                        <div class="fw-bold" style="font-size:20px"><?= formatNominal($totalEkspor + $totalImpor) ?></div>
                        <div style="font-size:11px;opacity:.7;margin-top:4px">Ekspor + Impor</div>
                    </div>
                    <div class="position-absolute text-white" style="font-size:64px;opacity:.07;bottom:-10px;right:-8px">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="card stat-card border-0 overflow-hidden"
                     style="background:linear-gradient(135deg,#FFAB2D,#d4891a)">
                    <div class="card-body text-white" style="z-index:2;position:relative">
                        <div class="d-flex align-items-start justify-content-between mb-2">
                            <div style="font-size:12px;opacity:.85">Kota Aktif</div>
                            <i class="bi bi-geo-alt-fill" style="font-size:18px;opacity:.6"></i>
                        </div>
                        <div class="fw-bold" style="font-size:28px"><?= $totalLokasi ?></div>
                        <div style="font-size:11px;opacity:.7;margin-top:4px">Lokasi tercatat</div>
                    </div>
                    <div class="position-absolute text-white" style="font-size:64px;opacity:.07;bottom:-10px;right:-8px">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="/lokasi" class="row g-3 align-items-end">
                    <div class="col-sm-6 col-lg-5">
                        <label class="form-label small fw-semibold">Cari Kota / Produk / Provinsi</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Contoh: Jakarta, iPhone..."
                               value="<?= $search ?? '' ?>">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <label class="form-label small fw-semibold">Jenis</label>
                        <select name="tipe" class="form-select">
                            <option value="semua" <?= ($filter_tipe==='semua')?'selected':'' ?>>Semua</option>
                            <option value="ekspor" <?= ($filter_tipe==='ekspor')?'selected':'' ?>>Ekspor</option>
                            <option value="impor"  <?= ($filter_tipe==='impor') ?'selected':'' ?>>Impor</option>
                        </select>
                    </div>
                    <div class="col-6 col-lg-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i>Filter
                        </button>
                    </div>
                    <div class="col-6 col-lg-2">
                        <a href="/lokasi" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 fw-semibold" style="color:var(--text-strong)">
                    <i class="bi bi-pin-map-fill me-2" style="color:var(--accent)"></i>Daftar Lokasi
                </h6>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge-ekspor"><i class="bi bi-arrow-up-right me-1"></i>Ekspor</span>
                    <span class="badge-impor"><i class="bi bi-arrow-down-left me-1"></i>Impor</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="min-width:600px">
                        <thead style="background:var(--bg)">
                            <tr>
                                <th class="ps-4" style="color:var(--text-muted);font-size:11px">#</th>
                                <th style="color:var(--text-muted);font-size:11px">KOTA / PROVINSI</th>
                                <th style="color:var(--text-muted);font-size:11px">PRODUK</th>
                                <th style="color:var(--text-muted);font-size:11px">TIPE</th>
                                <th style="color:var(--text-muted);font-size:11px">NEGARA</th>
                                <th style="color:var(--text-muted);font-size:11px">JUMLAH</th>
                                <th style="color:var(--text-muted);font-size:11px">NILAI</th>
                                <th style="color:var(--text-muted);font-size:11px">TANGGAL</th>
                                <th style="color:var(--text-muted);font-size:11px">MAP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($lokasi)): ?>
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="bi bi-geo-alt" style="font-size:48px;opacity:.2;color:var(--text)"></i>
                                    <p class="mt-2" style="color:var(--text-muted)">Tidak ada data lokasi ditemukan</p>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php $no=1; foreach($lokasi as $l): ?>
                                <tr>
                                    <td class="ps-4" style="color:var(--text-muted)"><?= $no++ ?></td>
                                    <td>
                                        <div class="fw-semibold" style="color:var(--text-strong);font-size:13px">
                                            <i class="bi bi-geo-alt" style="color:#2dca72;margin-right:6px"></i><?= esc($l['kota']) ?>
                                        </div>
                                        <small style="color:var(--text-muted)"><i class="bi bi-map" style="color:#FFAB2D;margin-right:4px"></i><?= esc($l['provinsi']) ?></small>
                                    </td>
                                    <td style="color:var(--text);font-size:13px"><i class="bi bi-box2" style="color:#4680FF;margin-right:6px"></i><?= esc($l['produk']) ?></td>
                                    <td>
                                        <?php if($l['tipe']==='ekspor'): ?>
                                            <span class="badge-ekspor">
                                                <i class="bi bi-arrow-up-right me-1"></i>Ekspor
                                            </span>
                                        <?php else: ?>
                                            <span class="badge-impor">
                                                <i class="bi bi-arrow-down-left me-1"></i>Impor
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="d-flex align-items-center gap-1" style="font-size:13px;color:var(--text)">
                                            <i class="bi bi-flag" style="color:#f5576c"></i>
                                            <?= esc($l['negara']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-semibold" style="color:var(--text-strong);font-size:13px">
                                            <i class="bi bi-box-seam" style="color:#9b59b6;margin-right:4px"></i><?= number_format($l['jumlah']) ?>
                                        </span>
                                        <small style="color:var(--text-muted)"> unit</small>
                                    </td>
                                    <td class="fw-semibold" style="color:var(--accent);font-size:13px">
                                        <i class="bi bi-cash-coin" style="color:#2dca72;margin-right:4px"></i><?= formatNominal($l['nilai']) ?>
                                    </td>
                                    <td style="color:var(--text-muted);font-size:12px">
                                        <i class="bi bi-calendar-event" style="color:#3498db;margin-right:4px"></i><?= date('d M Y', strtotime($l['tanggal'])) ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm"
                                                style="background:var(--accent-soft);color:var(--accent);border:none;border-radius:6px;padding:4px 8px"
                                                onclick="bukaMapProvinsi('<?= $l['svg_id'] ?>','<?= $l['kota'] ?>','<?= $l['tipe'] ?>')"
                                                title="Lihat di peta">
                                            <i class="bi bi-globe" style="color:#3498db"></i>
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

    </div>
</div>

<!-- MAP MODAL -->
<div class="map-modal" id="mapModal">
    <div class="map-backdrop" onclick="tutupMap()"></div>
    <div class="map-card">
        <div class="map-card-header">
            <div style="flex:1;">
                <h6 class="mb-1 fw-bold" style="color:var(--text-strong);font-size:16px;">
                    <i class="bi bi-map-fill me-2" style="color:var(--accent)"></i>Peta Lokasi Indonesia
                </h6>
                <small style="color:var(--text-muted);display:flex;gap:12px;flex-wrap:wrap;">
                    <span style="display:inline-flex;align-items:center;gap:4px;">
                        <span style="width:10px;height:10px;background:#4680FF;border-radius:50%;"></span>Ekspor
                    </span>
                    <span style="display:inline-flex;align-items:center;gap:4px;">
                        <span style="width:10px;height:10px;background:#f5576c;border-radius:50%;"></span>Impor
                    </span>
                </small>
            </div>
            <button class="btn-close" style="filter:invert(0);flex-shrink:0;" onclick="tutupMap()"></button>
        </div>
        <div class="map-card-body">
            <div id="map-container">
                <?= file_get_contents(APPPATH . 'Views/Map/indonesia.svg') ?>
            </div>
        </div>
    </div>
</div>

<!-- TOOLTIP -->
<div class="map-tooltip" id="mapTooltip"></div>

<!-- DESKRIPSI MODAL -->
<div class="deskripsi-modal" id="deskripsiModal">
    <div class="deskripsi-card">
        <div class="deskripsi-header">
            <div>
                <h6 class="mb-0 fw-bold" style="color:var(--text-strong)">
                    <i class="bi bi-exclamation-circle me-2" style="color:var(--accent)"></i>Deskripsi Data Lokasi
                </h6>
                <small style="color:var(--text-muted)">Tambahkan atau edit deskripsi untuk halaman ini</small>
            </div>
            <button style="background:none;border:none;font-size:20px;color:var(--text-muted);cursor:pointer" onclick="tutupDeskripsi()">×</button>
        </div>
        <div class="deskripsi-body">
            <textarea id="deskripsiText" class="deskripsi-textarea" placeholder="Ketik deskripsi Anda di sini... (contoh: Halaman ini menampilkan data lokasi ekspor dan impor di seluruh Indonesia dengan informasi kota, provinsi, produk, dan nilai transaksi.)"></textarea>
            <div class="deskripsi-actions">
                <button class="btn btn-outline-secondary btn-sm" onclick="tutupDeskripsi()">Batal</button>
                <button class="btn btn-primary btn-sm" onclick="simpanDeskripsi()">
                    <i class="bi bi-check-lg me-1"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * ============================================================================
 * MAP MODULE - Handles map interactions and visualizations
 * ============================================================================
 */

/** Map data from PHP backend - contains province info (type, city, count) */
const petaData = <?= json_encode($peta) ?>;

/** Initialize map and tooltip on DOM ready */
document.addEventListener('DOMContentLoaded', function() {
    colorizeMap();
    setupTooltip();
});

/**
 * Colorize SVG provinces based on export/import type
 * Assigns CSS classes to province paths for styling
 */
function colorizeMap() {
    const svg = document.querySelector('#map-container svg');
    if (!svg) return;
    svg.setAttribute('id', 'svg-indonesia');

    Object.entries(petaData).forEach(([id, data]) => {
        const el = svg.querySelector(`[id="${id}"]`);
        if (el) {
            el.classList.add(data.tipe);
        }
    });
}

/**
 * Setup interactive tooltips for SVG province paths
 * Shows province details on hover with smooth positioning
 */
function setupTooltip() {
    const svg = document.querySelector('#svg-indonesia');
    const tip = document.getElementById('mapTooltip');
    if (!svg || !tip) return;

    svg.querySelectorAll('path').forEach(path => {
        path.addEventListener('mousemove', function(e) {
            const id = this.id;
            const data = petaData[id];
            if (data) {
                tip.innerHTML = `
                    <div class="fw-bold mb-1">${data.kota}</div>
                    <div style="color:${data.tipe==='ekspor'?'#4680FF':'#f5576c'}">
                        <i class="bi bi-${data.tipe==='ekspor'?'arrow-up-right':'arrow-down-left'}"></i>
                        ${data.tipe.toUpperCase()}
                    </div>
                    <div class="mt-1">${data.count} unit</div>
                `;
                tip.style.display = 'block';
            }
            tip.style.left = (e.clientX + 12) + 'px';
            tip.style.top  = (e.clientY + 12) + 'px';
        });

        path.addEventListener('mouseleave', function() {
            tip.style.display = 'none';
        });
    });
}

/**
 * Open map modal with full-screen visualization
 * Recolorizes map on open with slight delay for rendering
 */
function bukaMap() {
    document.getElementById('mapModal').classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(colorizeMap, 50);
}

/** Close map modal and restore body scroll */
function tutupMap() {
    document.getElementById('mapModal').classList.remove('active');
    document.body.style.overflow = '';
}

/**
 * Open map modal with specific province highlighted
 * Dims other provinces and adds emphasis to selected one
 *
 * @param {string} svgId - Province SVG element ID
 * @param {string} kota - City name (for display)
 * @param {string} tipe - Transaction type (ekspor/impor)
 */
function bukaMapProvinsi(svgId, kota, tipe) {
    bukaMap();
    setTimeout(function() {
        const svg = document.querySelector('#svg-indonesia');
        if (!svg) return;

        // Highlight selected province
        svg.querySelectorAll('path').forEach(p => p.style.opacity = '0.3');
        const target = svg.querySelector(`[id="${svgId}"]`);
        if (target) {
            target.style.opacity = '1';
            target.style.strokeWidth = '2';
            target.style.stroke = '#fff';
        }

        // Auto-reset highlighting after 3 seconds
        setTimeout(() => {
            svg.querySelectorAll('path').forEach(p => {
                p.style.opacity = '';
                p.style.strokeWidth = '';
                p.style.stroke = '';
            });
        }, 3000);
    }, 100);
}

/** Close map modal with Escape key */
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') tutupMap();
});

/**
 * ============================================================================
 * DESCRIPTION MODULE - Handles page-level documentation editing
 * ============================================================================
 */

/**
 * Open description modal and load saved content from localStorage
 */
function deskripsi() {
    const modal = document.getElementById('deskripsiModal');
    const textarea = document.getElementById('deskripsiText');

    const saved = localStorage.getItem('lokasi_deskripsi');
    textarea.value = saved || '';

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    textarea.focus();
}

/** Close description modal and restore body scroll */
function tutupDeskripsi() {
    const modal = document.getElementById('deskripsiModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

/**
 * Save description to localStorage and display notification
 * Clears localStorage if textarea is empty
 */
function simpanDeskripsi() {
    const textarea = document.getElementById('deskripsiText');
    const deskripsi = textarea.value.trim();

    // Simpan ke localStorage
    if (deskripsi) {
        localStorage.setItem('lokasi_deskripsi', deskripsi);
        showNotification('Deskripsi berhasil disimpan!', 'success');
    } else {
        localStorage.removeItem('lokasi_deskripsi');
        showNotification('Deskripsi dihapus!', 'info');
    }

    tutupDeskripsi();
}

/**
 * Display temporary notification toast at top-right corner
 * Auto-dismisses after 2.5 seconds with slide animation
 *
 * @param {string} message - Notification message text
 * @param {string} type - Notification type: 'success', 'error', or 'info'
 */
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 12px 16px;
        background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8'};
        color: white;
        border-radius: 6px;
        z-index: 9999;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease-out;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 2500);
}

/** Inject CSS animations for notification toast */
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(400px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(400px); opacity: 0; }
    }
`;
document.head.appendChild(style);

/** Close description modal with Escape key */
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        const modal = document.getElementById('deskripsiModal');
        if (modal.classList.contains('active')) tutupDeskripsi();
    }
});
</script>

<?= view('layout/footer') ?>