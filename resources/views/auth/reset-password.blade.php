<x-guest-layout>
    @section('title', 'Reset Password')

    <div class="auth-form-header">
        <h2 class="auth-form-title">Reset your password</h2>
        <p class="auth-form-desc">Choose a new secure password for your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   class="auth-input {{ $errors->has('email') ? 'auth-input-error' : '' }}"
                   required
                   autofocus
                   autocomplete="username">
            @error('email')
                <div class="auth-error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="auth-field">
            <label for="password" class="auth-label">New password</label>
            <div class="auth-password-wrap">
                <input id="password"
                       type="password"
                       name="password"
                       class="auth-input {{ $errors->has('password') ? 'auth-input-error' : '' }}"
                       placeholder="Enter new password"
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
            <label for="password_confirmation" class="auth-label">Confirm new password</label>
            <div class="auth-password-wrap">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       class="auth-input"
                       placeholder="Repeat new password"
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
        <button type="submit" class="auth-submit">Reset password</button>
    </form>
</x-guest-layout>
