<x-guest-layout>
    @section('title', 'Verify Email')

    <div class="auth-form-header">
        <h2 class="auth-form-title">Verify your email</h2>
        <p class="auth-form-desc">Thanks for signing up! Please verify your email address by clicking the link we just sent you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="auth-status">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="auth-submit">Resend verification email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="auth-link" style="background:none;border:none;cursor:pointer;font-family:'Onest',sans-serif;">
                Log out
            </button>
        </form>
    </div>
</x-guest-layout>
