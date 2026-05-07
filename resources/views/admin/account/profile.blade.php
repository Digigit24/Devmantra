@extends('layouts.admin')
@section('title', 'Profile')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding: 32px;">
            <h5 style="font-weight: 700; margin-bottom: 4px;">Profile Information</h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 24px;">Update your name and email address.</p>

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="dm-form-group">
                    <label class="dm-form-label">Name</label>
                    <input type="text" name="name" class="dm-form-input" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="dm-form-hint" style="color: var(--dm-danger);">{{ $message }}</div>
                    @enderror
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Email</label>
                    <input type="email" name="email" class="dm-form-input" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="dm-form-hint" style="color: var(--dm-danger);">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="dm-btn dm-btn-primary">
                    <i class="fa-solid fa-check"></i> Save Changes
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding: 32px; text-align: center;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--dm-purple); display: inline-flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; color: #fff; margin-bottom: 16px;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h5 style="font-weight: 700; margin-bottom: 4px;">{{ $user->name }}</h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 8px;">{{ $user->email }}</p>
            <span class="dm-badge dm-badge-published">Admin</span>
            <hr style="border-color: var(--dm-border); margin: 20px 0;">
            <p style="color: var(--dm-text-muted); font-size: 13px; margin: 0;">
                Member since {{ $user->created_at?->format('M d, Y') ?? 'N/A' }}
            </p>
        </div>
    </div>
</div>
@endsection
