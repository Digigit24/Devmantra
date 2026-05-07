@extends('layouts.admin')
@section('title', 'Change Password')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding: 32px;">
            <h5 style="font-weight: 700; margin-bottom: 4px;">Change Password</h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 24px;">Ensure your account is using a strong password for security.</p>

            <form method="POST" action="{{ route('admin.password.update') }}">
                @csrf
                @method('PUT')

                <div class="dm-form-group">
                    <label class="dm-form-label">Current Password</label>
                    <input type="password" name="current_password" class="dm-form-input" required>
                    @error('current_password')
                        <div class="dm-form-hint" style="color: var(--dm-danger);">{{ $message }}</div>
                    @enderror
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">New Password</label>
                    <input type="password" name="password" class="dm-form-input" required>
                    @error('password')
                        <div class="dm-form-hint" style="color: var(--dm-danger);">{{ $message }}</div>
                    @enderror
                    <div class="dm-form-hint">Minimum 8 characters.</div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="dm-form-input" required>
                </div>

                <button type="submit" class="dm-btn dm-btn-primary">
                    <i class="fa-solid fa-lock"></i> Update Password
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding: 32px;">
            <div style="margin-bottom: 16px;">
                <i class="fa-solid fa-shield-halved" style="font-size: 28px; color: var(--dm-purple);"></i>
            </div>
            <h6 style="font-weight: 700; margin-bottom: 8px;">Password Tips</h6>
            <ul style="color: var(--dm-text-muted); font-size: 13px; padding-left: 18px; margin: 0; line-height: 2;">
                <li>Use at least 8 characters</li>
                <li>Include uppercase and lowercase letters</li>
                <li>Add numbers and special characters</li>
                <li>Avoid common words or patterns</li>
            </ul>
        </div>
    </div>
</div>
@endsection
