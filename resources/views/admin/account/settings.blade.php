@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
<div class="row">
    <div class="col-lg-8">
        {{-- Site Settings --}}
        <div class="dm-table-wrap" style="padding: 32px; margin-bottom: 24px;">
            <h5 style="font-weight: 700; margin-bottom: 4px;">Site Settings</h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 24px;">Manage general settings for the website.</p>

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                @method('PUT')

                <div class="dm-form-group">
                    <label class="dm-form-label">Site Name</label>
                    <input type="text" name="site_name" class="dm-form-input" value="Dev Mantra" readonly>
                    <div class="dm-form-hint">Contact your developer to change the site name.</div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Contact Email</label>
                    <input type="email" name="contact_email" class="dm-form-input" value="info@devmantra.com" readonly>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Contact Phone</label>
                    <input type="text" name="contact_phone" class="dm-form-input" value="+91-XXXXXXXXXX" readonly>
                </div>

                <button type="submit" class="dm-btn dm-btn-primary">
                    <i class="fa-solid fa-check"></i> Save Settings
                </button>
            </form>
        </div>

        {{-- Danger Zone --}}
        <div class="dm-table-wrap" style="padding: 32px; border-color: rgba(239,68,68,0.2);">
            <h5 style="font-weight: 700; margin-bottom: 4px; color: var(--dm-danger);">Danger Zone</h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 24px;">Irreversible and destructive actions.</p>

            <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 1px solid var(--dm-border); border-radius: 8px;">
                <div>
                    <div style="font-weight: 600; font-size: 14px;">Clear All Cache</div>
                    <div style="color: var(--dm-text-muted); font-size: 13px;">Clears application, route, config, and view caches.</div>
                </div>
                <a href="{{ route('admin.settings') }}" class="dm-btn dm-btn-outline dm-btn-sm" onclick="alert('Cache clearing is available via terminal: php artisan optimize:clear'); return false;">
                    Clear Cache
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- System Info --}}
        <div class="dm-table-wrap" style="padding: 32px; margin-bottom: 24px;">
            <h6 style="font-weight: 700; margin-bottom: 16px;">System Information</h6>
            <table style="width: 100%; font-size: 13px;">
                <tr>
                    <td style="padding: 6px 0; color: var(--dm-text-muted);">Laravel</td>
                    <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ app()->version() }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; color: var(--dm-text-muted);">PHP</td>
                    <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ phpversion() }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; color: var(--dm-text-muted);">Database</td>
                    <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ config('database.default') }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; color: var(--dm-text-muted);">Environment</td>
                    <td style="padding: 6px 0; text-align: right; font-weight: 600;">{{ app()->environment() }}</td>
                </tr>
            </table>
        </div>

        {{-- Quick Links --}}
        <div class="dm-table-wrap" style="padding: 32px;">
            <h6 style="font-weight: 700; margin-bottom: 16px;">Quick Links</h6>
            <a href="{{ route('admin.profile') }}" class="d-flex align-items-center gap-2 mb-3" style="font-size: 14px; color: var(--dm-text);">
                <i class="fa-solid fa-user" style="width: 16px; color: var(--dm-text-muted);"></i> Edit Profile
            </a>
            <a href="{{ route('admin.password') }}" class="d-flex align-items-center gap-2 mb-3" style="font-size: 14px; color: var(--dm-text);">
                <i class="fa-solid fa-lock" style="width: 16px; color: var(--dm-text-muted);"></i> Change Password
            </a>
            <a href="{{ url('/') }}" target="_blank" class="d-flex align-items-center gap-2" style="font-size: 14px; color: var(--dm-text);">
                <i class="fa-solid fa-arrow-up-right-from-square" style="width: 16px; color: var(--dm-text-muted);"></i> View Website
            </a>
        </div>
    </div>
</div>
@endsection
