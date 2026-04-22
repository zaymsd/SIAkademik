<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SIAkademik - Sistem Informasi Akademik">
    <title>@yield('title', 'Dashboard') — SIAkademik</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Custom CSS (terpusat) --}}
    @vite('resources/css/app.css')

    @stack('styles')
</head>
<body>

    {{-- ======================== SIDEBAR OVERLAY (mobile) ======================== --}}
    <div id="sidebar-overlay" onclick="closeSidebar()"></div>

    {{-- ======================== SIDEBAR ======================== --}}
    <div id="sidebar">
        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="brand-icon-sb">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="brand-text">
                <h6>SIAkademik</h6>
                <small>Sistem Informasi Akademik</small>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="sidebar-section-label">Menu Utama</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('jurusan.index') }}"
                   class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span>Jurusan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.index') }}"
                   class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('matakuliah.index') }}"
                   class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill"></i>
                    <span>Mata Kuliah</span>
                </a>
            </li>
        </ul>

        {{-- Sidebar Footer --}}
        <div class="sidebar-footer">
            <div class="sidebar-section-label">Akun</div>
            <ul class="sidebar-nav">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    {{-- ======================== MAIN CONTENT ======================== --}}
    <div id="main-content">

        {{-- Topbar --}}
        <div id="topbar">
            <div class="topbar-left">
                {{-- Hamburger (mobile) --}}
                <button class="btn-hamburger" id="btn-hamburger" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-title">
                    <i class="bi bi-grid-1x2-fill" style="color: var(--accent);"></i>
                    @yield('page-title', 'Dashboard')
                </div>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <small>{{ auth()->user()->name ?? 'Admin' }}</small>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="content-wrapper">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4 shadow-sm"
                     role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4 shadow-sm"
                     role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        {{-- Footer --}}
        <div id="main-footer">
            &copy; {{ date('Y') }} <strong>SIAkademik</strong> &mdash; Sistem Informasi Akademik
        </div>

    </div>

    {{-- ======================== GLOBAL CONFIRM MODAL ======================== --}}
    {{-- Digunakan untuk konfirmasi Simpan, Update, dan Hapus --}}
    <div class="modal fade" id="globalConfirmModal" tabindex="-1" aria-labelledby="globalConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-body text-center py-4 px-4">
                    <div class="confirm-modal-icon save" id="confirmModalIcon">
                        <i class="bi bi-patch-question-fill" id="confirmModalIconEl"></i>
                    </div>
                    <h5 class="fw-bold mb-1" id="confirmModalTitle">Konfirmasi</h5>
                    <p class="text-muted mb-0" id="confirmModalMessage" style="font-size: 0.88rem;"></p>
                    <p class="fw-semibold mt-1 mb-0" id="confirmModalSubject" style="color:#1a237e; font-size: 0.9rem;"></p>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2 pb-4 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Batal
                    </button>
                    <button type="button" class="btn px-4" id="confirmModalBtn" onclick="executeConfirm()">
                        <i class="bi bi-check-lg me-1"></i>Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal (digunakan per-halaman index) --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-body text-center py-4 px-4">
                    <div class="confirm-modal-icon danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Konfirmasi Hapus</h5>
                    <p class="text-muted mb-1" style="font-size:0.88rem;">Hapus data:</p>
                    <p class="fw-semibold mb-1" id="deleteItemName" style="color:#c62828; font-size:0.9rem;"></p>
                    <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2 pb-4 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="bi bi-trash-fill me-1"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap 5 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ── Sidebar Toggle (mobile) ──────────────────────────
        function toggleSidebar() {
            const sidebar  = document.getElementById('sidebar');
            const overlay  = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('sidebar-overlay').classList.remove('show');
        }

        // Tutup sidebar saat resize ke desktop
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });

        // ── Global Confirm Modal ─────────────────────────────
        let _confirmTargetForm = null;
        let _confirmModal      = null;

        /**
         * Tampilkan modal konfirmasi sebelum submit form.
         * @param {string} formId   - ID elemen <form>
         * @param {string} title    - Judul konfirmasi
         * @param {string} message  - Pesan deskripsi
         * @param {string} subject  - Nama data (opsional, dibaca otomatis jika ada data-subject-field)
         * @param {string} type     - 'save' | 'danger'
         */
        function confirmAction(formId, title, message, subject, type) {
            type    = type    || 'save';
            subject = subject || '';

            _confirmTargetForm = document.getElementById(formId);
            if (!_confirmTargetForm) return;

            document.getElementById('confirmModalTitle').textContent   = title;
            document.getElementById('confirmModalMessage').textContent = message;
            document.getElementById('confirmModalSubject').textContent = subject;

            const iconWrap = document.getElementById('confirmModalIcon');
            const iconEl   = document.getElementById('confirmModalIconEl');
            const btn      = document.getElementById('confirmModalBtn');

            iconWrap.className = 'confirm-modal-icon ' + type;
            if (type === 'save') {
                iconEl.className = 'bi bi-patch-check-fill';
                btn.className    = 'btn btn-primary px-4';
            } else {
                iconEl.className = 'bi bi-exclamation-triangle-fill';
                btn.className    = 'btn btn-danger px-4';
            }

            _confirmModal = new bootstrap.Modal(document.getElementById('globalConfirmModal'));
            _confirmModal.show();
        }

        function executeConfirm() {
            if (_confirmModal) _confirmModal.hide();
            if (_confirmTargetForm) _confirmTargetForm.submit();
        }

        // ── Event delegation untuk tombol data-confirm-form ──
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-confirm-form]');
            if (!btn) return;

            const formId    = btn.getAttribute('data-confirm-form');
            const title     = btn.getAttribute('data-confirm-title')   || 'Konfirmasi';
            const message   = btn.getAttribute('data-confirm-message') || 'Lanjutkan aksi ini?';
            const fieldId   = btn.getAttribute('data-subject-field');
            const subject   = fieldId
                ? (document.getElementById(fieldId) || {}).value || ''
                : (btn.getAttribute('data-confirm-subject') || '');
            const type      = btn.getAttribute('data-confirm-type')    || 'save';

            confirmAction(formId, title, message, subject, type);
        });

        // ── Delete Confirm (index pages) ─────────────────────
        function confirmDelete(url, name) {
            document.getElementById('deleteItemName').textContent = name;
            document.getElementById('deleteForm').action = url;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>

    @stack('scripts')
</body>
</html>
