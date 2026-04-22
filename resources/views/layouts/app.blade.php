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

    <style>
        :root {
            --sidebar-width: 255px;
            --sidebar-bg: #1a237e;
            --sidebar-bg-end: #283593;
            --accent: #5c6bc0;
            --accent-light: #e8eaf6;
            --topbar-h: 60px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        /* =====================
           SIDEBAR
        ===================== */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-end) 100%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.25rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            flex-shrink: 0;
        }

        .brand-text h6 {
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            margin: 0;
            line-height: 1.2;
        }

        .brand-text small {
            color: rgba(255,255,255,0.5);
            font-size: 0.7rem;
            font-weight: 400;
        }

        .sidebar-section-label {
            padding: 1.25rem 1.25rem 0.4rem;
            color: rgba(255,255,255,0.35);
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .sidebar-nav .nav-item { list-style: none; }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.65);
            padding: 0.7rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            cursor: pointer;
            background: none;
            border-top: none;
            border-right: none;
            border-bottom: none;
            width: 100%;
            text-align: left;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-nav .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
            border-left-color: rgba(144,202,249,0.5);
        }

        .sidebar-nav .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.15);
            border-left-color: #90caf9;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 0.75rem 0;
        }

        /* =====================
           MAIN CONTENT
        ===================== */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =====================
           TOPBAR
        ===================== */
        #topbar {
            height: var(--topbar-h);
            background: #fff;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        }

        .topbar-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a237e;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .topbar-user .avatar {
            width: 34px;
            height: 34px;
            background: var(--accent-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--sidebar-bg);
            font-size: 1rem;
        }

        .topbar-user small {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* =====================
           CONTENT WRAPPER
        ===================== */
        .content-wrapper {
            padding: 1.5rem;
            flex: 1;
        }

        /* =====================
           CARDS
        ===================== */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #eef0f3;
            border-radius: 12px 12px 0 0 !important;
            padding: 1rem 1.25rem;
        }

        .card-header .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #212529;
            margin: 0;
        }

        /* =====================
           TABLE
        ===================== */
        .table-responsive { border-radius: 0 0 12px 12px; }

        .table th {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            background: #f8f9fa;
            border-top: none;
            padding: 0.75rem 1rem;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            color: #343a40;
        }

        .table tbody tr:hover { background-color: #f8f9ff; }

        /* =====================
           BADGES AKREDITASI
        ===================== */
        .badge-A { background-color: #1b5e20; color: #fff; }
        .badge-B { background-color: #e65100; color: #fff; }
        .badge-C { background-color: #b71c1c; color: #fff; }

        /* =====================
           BUTTONS
        ===================== */
        .btn-primary {
            background: #1a237e;
            border-color: #1a237e;
        }
        .btn-primary:hover {
            background: #283593;
            border-color: #283593;
        }

        /* =====================
           FORM
        ===================== */
        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #495057;
        }

        .form-control:focus, .form-select:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 0 0.2rem rgba(92,107,192,0.2);
        }

        .page-header {
            margin-bottom: 1.25rem;
        }

        .page-header h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #212529;
            margin: 0;
        }

        .page-header .breadcrumb {
            font-size: 0.8rem;
            margin: 0;
            background: transparent;
            padding: 0;
        }

        /* =====================
           FOOTER
        ===================== */
        #main-footer {
            background: #fff;
            padding: 0.875rem 1.5rem;
            border-top: 1px solid #eef0f3;
            color: #adb5bd;
            font-size: 0.78rem;
            text-align: center;
        }

        /* =====================
           RESPONSIVE
        ===================== */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.show {
                transform: translateX(0);
            }
            #main-content {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- ======================== SIDEBAR ======================== --}}
    <div id="sidebar">
        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="brand-text">
                <h6>SIAkademik</h6>
                <small>Sistem Informasi Akademik</small>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="sidebar-section-label">Menu Utama</div>
        <ul class="sidebar-nav ps-0 mb-0">
            <li class="nav-item">
                <a href="{{ route('jurusan.index') }}"
                   class="nav-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span>Jurusan</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('mahasiswa.index') }}"
                   class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
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
            <ul class="sidebar-nav ps-0 mb-0">
                <li class="nav-item">
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
            <div class="topbar-title">
                <i class="bi bi-grid-1x2-fill" style="color: var(--accent);"></i>
                @yield('page-title', 'Dashboard')
            </div>
            <div class="topbar-user">
                <div class="avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <small>{{ auth()->user()->name ?? 'Admin' }}</small>
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

    {{-- Bootstrap 5 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
