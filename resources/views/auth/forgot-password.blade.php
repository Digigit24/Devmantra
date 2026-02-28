<x-guest-layout>
    @section('title', 'Forgot Password')

    <div class="auth-form-header">
        <h2 class="auth-form-title">Forgot password?</h2>
        <p class="auth-form-desc">No worries. Enter your email and we'll send you a reset link.</p>
    </div>

    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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
                   autofocus>
            @error('email')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-submit">Send reset link</button>

        <div class="auth-footer-text">
            <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left" style="font-size:12px;margin-right:6px;"></i>Back to sign in</a>
        </div>
    </form>
</x-guest-layout>
