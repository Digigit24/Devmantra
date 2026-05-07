@extends('layouts.admin')
@section('title', 'Site Settings')

@push('styles')
<style>
.color-pair { display: flex; gap: 12px; align-items: center; }
.color-pair input[type="color"] {
    width: 44px; height: 44px; padding: 2px; border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.12); cursor: pointer; flex-shrink: 0;
}
.gradient-preview { height: 44px; border-radius: 8px; flex: 1; transition: background 0.3s; }
.st-title {
    font-size: 13px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: #4a73c4;
    margin: 0 0 18px; padding-bottom: 10px;
    border-bottom: 1px solid rgba(0,0,0,0.07);
    display: flex; align-items: center; gap: 8px;
}
</style>
@endpush

@section('content')
<div class="row g-4">

    {{-- LEFT: settings form --}}
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf @method('PUT')

            {{-- Brand colours --}}
            <div class="dm-table-wrap" style="padding:28px;margin-bottom:20px;">
                <p class="st-title"><i class="fa-solid fa-palette"></i> Brand Colour Gradient</p>
                <p style="font-size:13px;color:#64748b;margin-bottom:20px;">
                    These two colours form the gradient used on all buttons, icons, and accents across the website.
                </p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="dm-form-label">Gradient Start Colour</label>
                        <div class="color-pair">
                            <input type="color" id="brandFromPicker" name="brand_color_from"
                                   value="{{ $settings['brand_color_from'] ?? '#1b3c6b' }}">
                            <input type="text" id="brandFromHex" class="dm-form-input"
                                   value="{{ $settings['brand_color_from'] ?? '#1b3c6b' }}"
                                   placeholder="#1b3c6b" style="flex:1;" maxlength="7">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="dm-form-label">Gradient End Colour</label>
                        <div class="color-pair">
                            <input type="color" id="brandToPicker" name="brand_color_to"
                                   value="{{ $settings['brand_color_to'] ?? '#4a73c4' }}">
                            <input type="text" id="brandToHex" class="dm-form-input"
                                   value="{{ $settings['brand_color_to'] ?? '#4a73c4' }}"
                                   placeholder="#4a73c4" style="flex:1;" maxlength="7">
                        </div>
                    </div>
                </div>
                <div style="margin-top:14px;">
                    <label class="dm-form-label">Live Preview</label>
                    <div id="gradientPreview" class="gradient-preview"
                         style="background:linear-gradient(135deg,{{ $settings['brand_color_from'] ?? '#1b3c6b' }},{{ $settings['brand_color_to'] ?? '#4a73c4' }});"></div>
                </div>
            </div>

            {{-- Primary button --}}
            <div class="dm-table-wrap" style="padding:28px;margin-bottom:20px;">
                <p class="st-title"><i class="fa-solid fa-arrow-pointer"></i> Primary Button</p>
                <p style="font-size:13px;color:#64748b;margin-bottom:20px;">
                    Shown in the header, hero, homepage CTA, commitment section, and 6A framework.
                </p>
                <div class="dm-form-group">
                    <label class="dm-form-label">Button Text</label>
                    <input type="text" name="primary_button_text" class="dm-form-input"
                           value="{{ $settings['primary_button_text'] ?? 'Book a Free Consultation' }}"
                           placeholder="Book a Free Consultation">
                </div>
                <div class="dm-form-group" style="margin-bottom:0;">
                    <label class="dm-form-label">Button URL</label>
                    <input type="text" name="primary_button_url" class="dm-form-input"
                           value="{{ $settings['primary_button_url'] ?? '/contact' }}"
                           placeholder="/contact or https://...">
                    <div class="dm-form-hint">Use a relative path (e.g. /contact) or a full URL.</div>
                </div>
            </div>

            {{-- Secondary button --}}
            <div class="dm-table-wrap" style="padding:28px;margin-bottom:24px;">
                <p class="st-title"><i class="fa-solid fa-circle-dollar-to-slot"></i> Secondary Button</p>
                <p style="font-size:13px;color:#64748b;margin-bottom:20px;">
                    Appears in the header (desktop) and beside the primary button in the hero.
                    <strong>Leave the link blank to hide it everywhere.</strong>
                </p>
                <div class="dm-form-group">
                    <label class="dm-form-label">Button Text</label>
                    <input type="text" name="secondary_button_text" class="dm-form-input"
                           value="{{ $settings['secondary_button_text'] ?? 'Get a Financial Review' }}"
                           placeholder="Get a Financial Review">
                </div>
                <div class="dm-form-group" style="margin-bottom:0;">
                    <label class="dm-form-label">Button Link</label>
                    <input type="text" name="secondary_button_link" class="dm-form-input"
                           value="{{ $settings['secondary_button_link'] ?? '' }}"
                           placeholder="/contact or https://... (leave blank to hide)">
                    <div class="dm-form-hint">Leave blank to hide the secondary button everywhere.</div>
                </div>
            </div>

            {{-- Button Behaviour --}}
            <div class="dm-table-wrap" style="padding:28px;margin-bottom:24px;">
                <p class="st-title"><i class="fa-solid fa-arrow-up-right-from-square"></i> Button Behaviour</p>
                <p style="font-size:13px;color:#64748b;margin-bottom:20px;">
                    Choose whether CTA buttons open their URL in the same tab or a new tab.
                </p>
                <label style="display:flex;align-items:center;gap:14px;cursor:pointer;user-select:none;">
                    <input type="hidden" name="button_new_tab" value="0">
                    <div style="position:relative;width:44px;height:24px;flex-shrink:0;">
                        <input type="checkbox" id="btn_new_tab_toggle" name="button_new_tab" value="1"
                               {{ ($settings['button_new_tab'] ?? '1') == '1' ? 'checked' : '' }}
                               style="opacity:0;width:0;height:0;position:absolute;">
                        <span id="btn_new_tab_track"
                              style="position:absolute;inset:0;border-radius:12px;transition:background 0.2s;cursor:pointer;
                                     background:{{ ($settings['button_new_tab'] ?? '1') == '1' ? '#1b3c6b' : '#cbd5e1' }};"></span>
                        <span id="btn_new_tab_thumb"
                              style="position:absolute;top:3px;width:18px;height:18px;border-radius:50%;background:#fff;
                                     box-shadow:0 1px 4px rgba(0,0,0,0.25);transition:left 0.2s;
                                     left:{{ ($settings['button_new_tab'] ?? '1') == '1' ? '23px' : '3px' }};"></span>
                    </div>
                    <span style="font-size:14px;color:#334155;font-weight:500;">Open buttons in a new tab</span>
                </label>
                <p style="font-size:12px;color:#94a3b8;margin-top:10px;margin-bottom:0;">
                    When enabled, all primary and secondary buttons open their URL with <code>target="_blank"</code>.
                </p>
            </div>

            <button type="submit" class="dm-btn dm-btn-primary">
                <i class="fa-solid fa-check"></i> Save All Settings
            </button>
        </form>
    </div>

    {{-- RIGHT: preview + info --}}
    <div class="col-lg-4">

        {{-- Button preview --}}
        <div class="dm-table-wrap" style="padding:24px;margin-bottom:20px;">
            <p class="st-title"><i class="fa-solid fa-eye"></i> Button Preview</p>
            <p style="font-size:12px;color:#94a3b8;margin-bottom:14px;">Reflects saved settings.</p>
            <div style="display:flex;flex-direction:column;gap:10px;align-items:flex-start;">
                <a href="#" onclick="return false;"
                   style="display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:linear-gradient(135deg,{{ $settings['brand_color_from'] ?? '#1b3c6b' }},{{ $settings['brand_color_to'] ?? '#4a73c4' }});color:#fff;font-size:13px;font-weight:600;border-radius:30px;text-decoration:none;">
                    {{ $settings['primary_button_text'] ?? 'Book a Free Consultation' }}
                </a>
                @if(!empty($settings['secondary_button_link']))
                <a href="#" onclick="return false;"
                   style="display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:linear-gradient(135deg,{{ $settings['brand_color_from'] ?? '#1b3c6b' }},{{ $settings['brand_color_to'] ?? '#4a73c4' }});color:#fff;font-size:13px;font-weight:600;border-radius:30px;text-decoration:none;">
                    {{ $settings['secondary_button_text'] ?? 'Get a Financial Review' }}
                </a>
                @else
                <span style="font-size:12px;color:#94a3b8;font-style:italic;">Secondary button hidden (no link set)</span>
                @endif
            </div>
        </div>

        {{-- System Info --}}
        <div class="dm-table-wrap" style="padding:24px;margin-bottom:20px;">
            <p class="st-title"><i class="fa-solid fa-server"></i> System Info</p>
            <table style="width:100%;font-size:13px;">
                <tr><td style="padding:5px 0;color:#64748b;">Laravel</td><td style="padding:5px 0;text-align:right;font-weight:600;">{{ app()->version() }}</td></tr>
                <tr><td style="padding:5px 0;color:#64748b;">PHP</td><td style="padding:5px 0;text-align:right;font-weight:600;">{{ phpversion() }}</td></tr>
                <tr><td style="padding:5px 0;color:#64748b;">Database</td><td style="padding:5px 0;text-align:right;font-weight:600;">{{ config('database.default') }}</td></tr>
                <tr><td style="padding:5px 0;color:#64748b;">Environment</td><td style="padding:5px 0;text-align:right;font-weight:600;">{{ app()->environment() }}</td></tr>
            </table>
        </div>

        {{-- Quick Links --}}
        <div class="dm-table-wrap" style="padding:24px;">
            <p class="st-title"><i class="fa-solid fa-link"></i> Quick Links</p>
            <a href="{{ route('admin.profile') }}" class="d-flex align-items-center gap-2 mb-3" style="font-size:14px;color:var(--dm-text);">
                <i class="fa-solid fa-user" style="width:16px;color:var(--dm-text-muted);"></i> Edit Profile
            </a>
            <a href="{{ route('admin.password') }}" class="d-flex align-items-center gap-2 mb-3" style="font-size:14px;color:var(--dm-text);">
                <i class="fa-solid fa-lock" style="width:16px;color:var(--dm-text-muted);"></i> Change Password
            </a>
            <a href="{{ route('admin.contact-settings.edit') }}" class="d-flex align-items-center gap-2 mb-3" style="font-size:14px;color:var(--dm-text);">
                <i class="fa-solid fa-address-book" style="width:16px;color:var(--dm-text-muted);"></i> Contact Settings
            </a>
            <a href="{{ url('/') }}" target="_blank" class="d-flex align-items-center gap-2" style="font-size:14px;color:var(--dm-text);">
                <i class="fa-solid fa-arrow-up-right-from-square" style="width:16px;color:var(--dm-text-muted);"></i> View Website
            </a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
(function () {
    // Brand colour pickers
    var fp = document.getElementById('brandFromPicker'), fh = document.getElementById('brandFromHex');
    var tp = document.getElementById('brandToPicker'),   th = document.getElementById('brandToHex');
    var pv = document.getElementById('gradientPreview');
    function upd() { if (pv) pv.style.background = 'linear-gradient(135deg,' + fp.value + ',' + tp.value + ')'; }
    if (fp && tp) {
        fp.addEventListener('input', function () { fh.value = fp.value; upd(); });
        tp.addEventListener('input', function () { th.value = tp.value; upd(); });
        fh.addEventListener('input', function () { if (/^#[0-9a-fA-F]{6}$/.test(fh.value)) { fp.value = fh.value; upd(); } });
        th.addEventListener('input', function () { if (/^#[0-9a-fA-F]{6}$/.test(th.value)) { tp.value = th.value; upd(); } });
    }

    // New-tab toggle
    var chk   = document.getElementById('btn_new_tab_toggle');
    var track = document.getElementById('btn_new_tab_track');
    var thumb = document.getElementById('btn_new_tab_thumb');
    if (chk && track && thumb) {
        function syncToggle() {
            track.style.background = chk.checked ? '#1b3c6b' : '#cbd5e1';
            thumb.style.left       = chk.checked ? '23px'   : '3px';
        }
        track.addEventListener('click', function () { chk.checked = !chk.checked; syncToggle(); });
    }
})();
</script>
@endpush
