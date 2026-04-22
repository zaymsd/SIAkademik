<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login — SIAkademik Sistem Informasi Akademik">
    <title>Login — SIAkademik</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- Custom CSS (terpusat) --}}
    @vite('resources/css/app.css')
</head>
<body class="login-page">

    <div class="login-wrapper">

        {{-- Brand --}}
        <div class="brand-header">
            <div class="brand-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h1>SIAkademik</h1>
            <p>Sistem Informasi Akademik</p>
        </div>

        {{-- Login Card --}}
        <div class="login-card">
            <h2>Selamat Datang 👋</h2>
            <p class="subtitle">Masuk untuk mengakses sistem</p>

            {{-- Flash success (setelah logout) --}}
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="bi bi-exclamation-circle-fill flex-shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" id="form-login">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold" style="font-size:.85rem;">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope-fill" style="font-size:.9rem;"></i>
                        </span>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="admin@siakademik.ac.id"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               autofocus
                               required>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold" style="font-size:.85rem;">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill" style="font-size:.9rem;"></i>
                        </span>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control"
                               placeholder="••••••••"
                               autocomplete="current-password"
                               required>
                        <button type="button"
                                class="btn-toggle-pass"
                                id="btn-toggle-pass"
                                title="Tampilkan/sembunyikan password">
                            <i class="bi bi-eye-fill" id="toggle-icon"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               id="remember" name="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>

            {{-- Hint Akun Default --}}
            <div class="hint-box">
                <i class="bi bi-info-circle-fill"></i>
                <strong>Akun default:</strong>
                admin@siakademik.ac.id &nbsp;/&nbsp; <code>admin123</code>
            </div>
        </div>

        <div class="login-footer">
            &copy; {{ date('Y') }} SIAkademik &mdash; Hak akses terbatas
        </div>

    </div>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        const toggleBtn  = document.getElementById('btn-toggle-pass');
        const passInput  = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');

        toggleBtn.addEventListener('click', function () {
            const isPassword = passInput.type === 'password';
            passInput.type   = isPassword ? 'text' : 'password';
            toggleIcon.className = isPassword ? 'bi bi-eye-slash-fill' : 'bi bi-eye-fill';
        });

        // Loading state on submit
        document.getElementById('form-login').addEventListener('submit', function () {
            const btn = document.getElementById('btn-login');
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Memverifikasi...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
