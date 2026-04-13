<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function () {
    const storageKey = 'appThemeSettings';
    const defaults = {
        theme: 'default',
        font: 'Inter, system-ui, sans-serif',
        accent: '#4680FF',
        outline: '#e9ecef',
        widgetBg: '#ffffff',
        layoutBg: '#f4f7fa'
    };

    const themePresets = {
        dark: {
            surface: '#1f2430', bg: '#0f131d',
            text: '#c2c9d6', textStrong: '#e9ecef', textMuted: '#6c7a8d',
            border: 'rgba(255,255,255,0.08)', accent: '#5d8cff',
            accentSoft: 'rgba(93,140,255,0.15)', hoverSoft: 'rgba(93,140,255,0.1)',
            widgetBg: '#1f2430', layoutBg: '#0f131d'
        },
        light: {
            surface: '#ffffff', bg: '#f4f6fb',
            text: '#4a5568', textStrong: '#2c2f33', textMuted: '#a0aec0',
            border: '#e2e8f0', accent: '#4d7cff',
            accentSoft: '#ebf0ff', hoverSoft: '#f0f4ff',
            widgetBg: '#ffffff', layoutBg: '#f4f6fb'
        },
        default: {
            surface: '#ffffff', bg: '#f4f7fa',
            text: '#5b6b79', textStrong: '#1a202c', textMuted: '#adb5bd',
            border: '#e9ecef', accent: '#4680FF',
            accentSoft: '#eef2ff', hoverSoft: '#f0f4ff',
            widgetBg: '#ffffff', layoutBg: '#f4f7fa'
        }
    };

    function initSettings() {
        const panel      = document.getElementById('app-settings-panel');
        const openBtn    = document.getElementById('app-settings-button');
        const closeBtn   = document.getElementById('settingsCloseBtn');
        const themeBtns  = document.querySelectorAll('.settings-option[data-setting="theme"]');
        const fontSelect = document.getElementById('themeFontSelect');
        const accentInput   = document.getElementById('themeAccentColor');
        const outlineInput  = document.getElementById('themeOutlineColor');
        const widgetBgInput = document.getElementById('themeWidgetBgColor');
        const layoutBgInput = document.getElementById('themeLayoutBgColor');

        if (!panel || !openBtn || !closeBtn) return;

        function load() {
            try { return JSON.parse(localStorage.getItem(storageKey)) || defaults; }
            catch { return defaults; }
        }

        function save(s) { localStorage.setItem(storageKey, JSON.stringify(s)); }

        function applyVars(s) {
            const root = document.documentElement;
            const preset = themePresets[s.theme] || themePresets.default;

            // Apply preset dulu
            root.style.setProperty('--surface',     preset.surface);
            root.style.setProperty('--bg',          preset.bg);
            root.style.setProperty('--text',        preset.text);
            root.style.setProperty('--text-strong', preset.textStrong);
            root.style.setProperty('--text-muted',  preset.textMuted);
            root.style.setProperty('--border',      preset.border);
            root.style.setProperty('--accent',      s.theme === 'default' ? s.accent : preset.accent);
            root.style.setProperty('--accent-soft', preset.accentSoft);
            root.style.setProperty('--hover-soft',  preset.hoverSoft);

            if (s.font) root.style.setProperty('--font', s.font);

            // Tema class
            root.classList.remove('theme-default', 'theme-light', 'theme-dark');
            if (s.theme !== 'default') root.classList.add('theme-' + s.theme);

            // Update UI panel
            themeBtns.forEach(b => b.classList.toggle('active', b.dataset.value === s.theme));
            if (fontSelect)     fontSelect.value = s.font || defaults.font;
            if (accentInput)    accentInput.value = s.theme === 'default' ? (s.accent || defaults.accent) : preset.accent;
            if (outlineInput)   outlineInput.value = preset.border.startsWith('rgba') ? '#1f2430' : (preset.border || defaults.outline);
            if (widgetBgInput)  widgetBgInput.value = preset.widgetBg;
            if (layoutBgInput)  layoutBgInput.value = preset.layoutBg;
        }

        function update(key, val) {
            const cur = load();
            cur[key] = val;
            save(cur);
            applyVars(cur);
        }

        openBtn.addEventListener('click', () => panel.classList.remove('d-none'));
        closeBtn.addEventListener('click', () => panel.classList.add('d-none'));
        panel.querySelector('.settings-panel-backdrop').addEventListener('click', () => panel.classList.add('d-none'));

        themeBtns.forEach(b => b.addEventListener('click', () => update('theme', b.dataset.value)));
        if (fontSelect)     fontSelect.addEventListener('change', () => update('font', fontSelect.value));
        if (accentInput)    accentInput.addEventListener('input', () => update('accent', accentInput.value));
        if (outlineInput)   outlineInput.addEventListener('input', () => update('outline', outlineInput.value));
        if (widgetBgInput)  widgetBgInput.addEventListener('input', () => update('widgetBg', widgetBgInput.value));
        if (layoutBgInput)  layoutBgInput.addEventListener('input', () => update('layoutBg', layoutBgInput.value));

        applyVars(load());

        // Expose untuk topbar dark/light toggle
        window.applyVarsFromStorage = function() { applyVars(load()); };
    }

    // Toggle sidebar — desktop: collapsed, mobile: open
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarBtn = document.getElementById('sidebar-hide');
        const overlay    = document.getElementById('sidebar-overlay');

        function isMobile() { return window.innerWidth <= 768; }

        function closeSidebar() {
            if (isMobile()) {
                document.body.classList.remove('sidebar-open');
            } else {
                document.body.classList.add('sidebar-collapsed');
            }
        }

        function openSidebar() {
            if (isMobile()) {
                document.body.classList.add('sidebar-open');
            } else {
                document.body.classList.remove('sidebar-collapsed');
            }
        }

        if (sidebarBtn) {
            sidebarBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (isMobile()) {
                    document.body.classList.toggle('sidebar-open');
                } else {
                    document.body.classList.toggle('sidebar-collapsed');
                }
            });
        }

        // Tutup sidebar saat klik overlay
        if (overlay) {
            overlay.addEventListener('click', function() {
                document.body.classList.remove('sidebar-open');
            });
        }

        // Tutup sidebar saat klik menu di mobile
        document.querySelectorAll('.pc-navbar .pc-link').forEach(function(link) {
            link.addEventListener('click', function() {
                if (isMobile()) {
                    document.body.classList.remove('sidebar-open');
                }
            });
        });

        // Reset class saat resize
        window.addEventListener('resize', function() {
            if (!isMobile()) {
                document.body.classList.remove('sidebar-open');
            } else {
                document.body.classList.remove('sidebar-collapsed');
            }
        });

        initSettings();
    });
})();
</script>
</body>
</html>