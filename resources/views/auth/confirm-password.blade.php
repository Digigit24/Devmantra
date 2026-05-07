<x-guest-layout>
    @section('title', 'Confirm Password')

    <div class="auth-form-header">
        <h2 class="auth-form-title">Confirm your password</h2>
        <p class="auth-form-desc">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

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

        <!-- Submit -->
        <button type="submit" class="auth-submit">Confirm</button>
    </form>
</x-guest-layout>
