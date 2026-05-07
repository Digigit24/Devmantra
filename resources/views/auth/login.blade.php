<x-guest-layout>
    @section('title', 'Sign In')

    <div class="auth-form-header">
        <h2 class="auth-form-title">Welcome back</h2>
        <p class="auth-form-desc">Sign in to your account to continue</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="auth-input {{ $errors->has('email') ? 'auth-input-error' : '' }}"
                   placeholder="you@example.com"
                   required
                   autofocus
                   autocomplete="username">
            @error('email')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="auth-field">
            <label for="password" class="auth-label">Password</label>
            <div class="auth-password-wrap">
                <input id="password"
                       type="password"
                       name="password"
                       class="auth-input {{ $errors->has('password') ? 'auth-input-error' : '' }}"
                       placeholder="Enter your password"
                       required
                       autocomplete="current-password">
                <button type="button" class="auth-password-toggle" aria-label="Toggle password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="auth-row">
            <div class="auth-remember">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link">Forgot password?</a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-submit">Sign in</button>

        @if (Route::has('register'))
            <div class="auth-footer-text">
                Don't have an account? <a href="{{ route('register') }}">Create one</a>
            </div>
        @endif
    </form>
</x-guest-layout>
