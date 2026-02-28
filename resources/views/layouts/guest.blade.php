<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sign In') - {{ config('app.name', 'DevMantra') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Onest', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #000;
            color: #fff;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Left panel (branding) ── */
        .auth-brand {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 60px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, #0a0a0a 0%, #111 50%, #0d0d0d 100%);
        }
        .auth-brand::before {
            content: '';
            position: absolute;
            top: -200px;
            left: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(116,99,255,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .auth-brand::after {
            content: '';
            position: absolute;
            bottom: -300px;
            right: -200px;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(116,99,255,0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-brand-logo img {
            height: 48px;
            width: auto;
            border-radius: 50px;
        }

        .auth-brand-content {
            position: relative;
            z-index: 1;
        }
        .auth-brand-headline {
            font-size: 44px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }
        .auth-brand-headline span {
            background: linear-gradient(135deg, #7463FF, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .auth-brand-sub {
            font-size: 17px;
            color: rgba(255,255,255,0.5);
            line-height: 1.7;
            max-width: 420px;
        }

        .auth-brand-footer {
            position: relative;
            z-index: 1;
            font-size: 13px;
            color: rgba(255,255,255,0.25);
        }

        /* Floating dots decoration */
        .auth-dots {
            position: absolute;
            z-index: 0;
        }
        .auth-dots-1 {
            top: 30%;
            right: 60px;
            width: 120px;
            height: 120px;
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: 50%;
        }
        .auth-dots-2 {
            bottom: 25%;
            right: 100px;
            width: 200px;
            height: 200px;
            border: 1px solid rgba(255,255,255,0.03);
            border-radius: 50%;
        }
        .auth-dots-3 {
            top: 20%;
            right: 120px;
            width: 8px;
            height: 8px;
            background: rgba(116,99,255,0.3);
            border-radius: 50%;
        }

        /* ── Right panel (form) ── */
        .auth-form-panel {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            background: #fff;
        }

        .auth-form-container {
            width: 100%;
            max-width: 420px;
        }

        .auth-form-header {
            margin-bottom: 40px;
        }
        .auth-form-title {
            font-size: 28px;
            font-weight: 700;
            color: #0a0a0a;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .auth-form-desc {
            font-size: 15px;
            color: rgba(0,0,0,0.45);
            line-height: 1.6;
        }

        /* Form fields */
        .auth-field {
            margin-bottom: 24px;
        }
        .auth-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }
        .auth-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 15px;
            font-family: 'Onest', sans-serif;
            color: #1a1a1a;
            background: #f8f8f8;
            border: 1.5px solid #eee;
            border-radius: 10px;
            outline: none;
            transition: all 0.25s ease;
        }
        .auth-input:focus {
            border-color: #7463FF;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(116,99,255,0.08);
        }
        .auth-input::placeholder { color: rgba(0,0,0,0.25); }

        .auth-input-error {
            border-color: #ef4444 !important;
        }
        .auth-error-text {
            font-size: 13px;
            color: #ef4444;
            margin-top: 6px;
        }

        /* Password wrapper */
        .auth-password-wrap {
            position: relative;
        }
        .auth-password-wrap .auth-input { padding-right: 48px; }
        .auth-password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(0,0,0,0.3);
            cursor: pointer;
            font-size: 16px;
            padding: 4px;
            transition: color 0.2s;
        }
        .auth-password-toggle:hover { color: rgba(0,0,0,0.6); }

        /* Checkbox */
        .auth-remember {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .auth-remember input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #7463FF;
            border-radius: 4px;
            cursor: pointer;
        }
        .auth-remember label {
            font-size: 14px;
            color: rgba(0,0,0,0.55);
            cursor: pointer;
            user-select: none;
        }

        /* Submit button */
        .auth-submit {
            width: 100%;
            padding: 15px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Onest', sans-serif;
            color: #fff;
            background: #0a0a0a;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }
        .auth-submit:hover {
            background: #1a1a1a;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .auth-submit:active {
            transform: translateY(0);
        }

        /* Links */
        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .auth-link {
            font-size: 14px;
            color: #7463FF;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        .auth-link:hover { opacity: 0.7; }

        .auth-footer-text {
            text-align: center;
            margin-top: 32px;
            font-size: 14px;
            color: rgba(0,0,0,0.4);
        }
        .auth-footer-text a {
            color: #7463FF;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .auth-footer-text a:hover { opacity: 0.7; }

        /* Status message */
        .auth-status {
            padding: 12px 16px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            font-size: 14px;
            color: #166534;
            margin-bottom: 24px;
        }

        /* Mobile responsive */
        @media (max-width: 991px) {
            .auth-brand { display: none; }
            .auth-form-panel {
                width: 100%;
                min-height: 100vh;
                padding: 32px 24px;
            }
            .auth-form-container { max-width: 440px; }
            .auth-form-header { margin-bottom: 32px; }

            .auth-mobile-logo {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 40px;
            }
            .auth-mobile-logo img {
                height: 40px;
                width: auto;
                border-radius: 50px;
            }
            .auth-mobile-logo span {
                font-size: 18px;
                font-weight: 700;
                color: #0a0a0a;
            }
        }
        @media (min-width: 992px) {
            .auth-mobile-logo { display: none; }
        }

        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .auth-form-container {
            animation: fadeInUp 0.5s ease forwards;
        }
        .auth-brand-content {
            animation: fadeInUp 0.6s ease 0.1s both;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Left Panel: Branding -->
    <div class="auth-brand">
        <div class="auth-brand-logo">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="DevMantra"></a>
        </div>
        <div class="auth-brand-content">
            <h1 class="auth-brand-headline">
                Your strategic partner <span>in digital progress.</span>
            </h1>
            <p class="auth-brand-sub">
                We help businesses navigate the digital economy with smart technology, strategic insight, and purpose-driven execution.
            </p>
        </div>
        <div class="auth-brand-footer">
            &copy; {{ date('Y') }} DevMantra. All rights reserved.
        </div>

        <!-- Decorative elements -->
        <div class="auth-dots auth-dots-1"></div>
        <div class="auth-dots auth-dots-2"></div>
        <div class="auth-dots auth-dots-3"></div>
    </div>

    <!-- Right Panel: Form -->
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <div class="auth-mobile-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="DevMantra"></a>
                <span>DevMantra</span>
            </div>
            {{ $slot }}
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.querySelectorAll('.auth-password-toggle').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.previousElementSibling;
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                btn.innerHTML = isPassword
                    ? '<i class="fa-regular fa-eye-slash"></i>'
                    : '<i class="fa-regular fa-eye"></i>';
            });
        });
    </script>
</body>
</html>
