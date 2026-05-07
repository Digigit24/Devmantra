<x-guest-layout>
    @section('title', 'Create Account')

    <div class="auth-form-header">
        <h2 class="auth-form-title">Create an account</h2>
        <p class="auth-form-desc">Get started with DevMantra today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="auth-field">
            <label for="name" class="auth-label">Full name</label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="auth-input {{ $errors->has('name') ? 'auth-input-error' : '' }}"
                   placeholder="John Doe"
                   required
                   autofocus
                   autocomplete="name">
            @error('name')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

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
                       placeholder="Create a password"
                       required
                       autocomplete="new-password">
                <button type="button" class="auth-password-toggle" aria-label="Toggle password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="auth-field">
            <label for="password_confirmation" class="auth-label">Confirm password</label>
            <div class="auth-password-wrap">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       class="auth-input"
                       placeholder="Repeat your password"
                       required
                       autocomplete="new-password">
                <button type="button" class="auth-password-toggle" aria-label="Toggle password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-submit">Create account</button>

        <div class="auth-footer-text">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </form>
</x-guest-layout>
