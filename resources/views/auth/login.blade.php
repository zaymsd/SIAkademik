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

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a237e 0%, #283593 40%, #3949ab 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles background */
        body::before {
            content: '';
            position: fixed;
            top: -120px;
            right: -120px;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.04);
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -150px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
            pointer-events: none;
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 1;
        }

        /* Brand Header */
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.15);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .brand-header h1 {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.25rem;
            letter-spacing: -0.5px;
        }

        .brand-header p {
            color: rgba(255,255,255,0.65);
            font-size: 0.875rem;
            margin: 0;
        }

        /* Card */
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 2.25rem 2.25rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }

        .login-card h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a237e;
            margin-bottom: 0.25rem;
        }

        .login-card .subtitle {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 1.75rem;
        }

        /* Form */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 0.4rem;
        }

        .input-group-text {
            background: #f8f9fa;
            border-right: none;
            color: #6c757d;
        }

        .form-control {
            border-left: none;
            font-size: 0.9rem;
            padding: 0.65rem 0.9rem;
        }

        .form-control:focus {
            border-color: #5c6bc0;
            box-shadow: 0 0 0 0.2rem rgba(92,107,192,0.2);
        }

        .input-group:focus-within .input-group-text {
            border-color: #5c6bc0;
        }

        /* Password toggle */
        .btn-toggle-pass {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-left: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0 0.9rem;
            font-size: 0.95rem;
            transition: color 0.2s;
        }

        .btn-toggle-pass:hover {
            color: #1a237e;
        }

        /* Submit Button */
        .btn-login {
            background: linear-gradient(135deg, #1a237e, #3949ab);
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.75rem;
            border-radius: 10px;
            width: 100%;
            transition: all 0.25s ease;
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #283593, #5c6bc0);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26,35,126,0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Alert */
        .alert-danger {
            background: #fff5f5;
            border: 1px solid #fed7d7;
            color: #c53030;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        .alert-success {
            background: #f0fff4;
            border: 1px solid #c6f6d5;
            color: #276749;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255,255,255,0.5);
            font-size: 0.78rem;
        }

        /* Hint box */
        .hint-box {
            background: #f0f4ff;
            border: 1px solid #c5cae9;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            color: #3949ab;
            margin-top: 1.25rem;
        }

        .hint-box i {
            margin-right: 0.4rem;
        }

        /* Remember checkbox */
        .form-check-input:checked {
            background-color: #1a237e;
            border-color: #1a237e;
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #495057;
        }
    </style>
</head>
<body>

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

            {{-- Flash success (misal setelah logout) --}}
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error umum --}}
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
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope-fill" style="font-size:0.9rem;"></i>
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
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill" style="font-size:0.9rem;"></i>
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
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
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
