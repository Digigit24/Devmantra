@extends('layouts.admin')
@section('title', 'Typography Settings')

@push('styles')
{{-- Load ALL available Google Fonts for live preview --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="{{ \App\Http\Controllers\Admin\TypographyController::allGoogleFontsUrl() }}">
<style>
.ty-section-title {
    font-size: 13px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: #4a73c4;
    margin: 0 0 18px; padding-bottom: 10px;
    border-bottom: 1px solid rgba(0,0,0,0.07);
    display: flex; align-items: center; gap: 8px;
}
.ty-row {
    display: grid; grid-template-columns: 120px 1fr 1fr; gap: 16px;
    align-items: center; padding: 14px 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.ty-row:last-child { border-bottom: none; }
.ty-tag {
    font-size: 11px; font-weight: 700; letter-spacing: 0.8px;
    text-transform: uppercase; color: #64748b;
    background: #f1f5f9; padding: 4px 10px; border-radius: 6px;
    display: inline-block;
}
.ty-select { width: 100%; }
.ty-preview {
    padding: 8px 14px; border-radius: 8px;
    background: #f8fafc; border: 1px solid #e2e8f0;
    color: #1e293b; min-height: 42px;
    display: flex; align-items: center;
    overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
    transition: font-family 0.2s;
}
.ty-preview-body { font-size: 14px; }
.ty-preview-h1   { font-size: 28px; font-weight: 600; }
.ty-preview-h2   { font-size: 24px; font-weight: 600; }
.ty-preview-h3   { font-size: 20px; font-weight: 600; }
.ty-preview-h4   { font-size: 17px; font-weight: 600; }
.ty-preview-h5   { font-size: 15px; font-weight: 600; }
.ty-preview-h6   { font-size: 13px; font-weight: 600; }
.ty-preview-p    { font-size: 15px; }
.ty-badge-google {
    display: inline-block; font-size: 9px; font-weight: 700; letter-spacing: 0.5px;
    text-transform: uppercase; background: #dbeafe; color: #1d4ed8;
    border-radius: 4px; padding: 1px 5px; margin-left: 4px; vertical-align: middle;
}
.ty-badge-local {
    display: inline-block; font-size: 9px; font-weight: 700; letter-spacing: 0.5px;
    text-transform: uppercase; background: #fef3c7; color: #92400e;
    border-radius: 4px; padding: 1px 5px; margin-left: 4px; vertical-align: middle;
}
.ty-info-box {
    background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 10px;
    padding: 14px 18px; margin-bottom: 20px; font-size: 13px; color: #0369a1;
}
@media (max-width: 768px) {
    .ty-row { grid-template-columns: 1fr; gap: 8px; }
    .ty-preview { display: none; }
}
</style>
@endpush

@section('content')
<div class="row g-4">

    {{-- LEFT: form --}}
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.typography.update') }}">
            @csrf @method('PUT')

            {{-- Body & Paragraph --}}
            <div class="dm-table-wrap" style="padding:28px;margin-bottom:20px;">
                <p class="ty-section-title"><i class="fa-solid fa-align-left"></i> Body &amp; Paragraph</p>
                <div class="ty-info-box">
                    <i class="fa-solid fa-circle-info" style="margin-right:6px;"></i>
                    Choose <strong>Default</strong> to keep the theme font. Fonts marked
                    <span class="ty-badge-google">Google</span> are loaded from Google Fonts.
                    <span class="ty-badge-local">Local</span> fonts are bundled with the site.
                </div>

                {{-- Body --}}
                <div class="ty-row">
                    <div><span class="ty-tag">body</span></div>
                    <div>
                        <select name="font_body" class="dm-form-input ty-select" data-preview="preview_body">
                            <option value="">-- Default (Inter) --</option>
                            @foreach($fonts as $font)
                            <option value="{{ $font['key'] }}"
                                data-fallback="{{ $font['fallback'] }}"
                                {{ ($settings['font_body'] ?? '') === $font['key'] ? 'selected' : '' }}>
                                {{ $font['label'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div id="preview_body" class="ty-preview ty-preview-body"
                             style="font-family: '{{ $settings['font_body'] ?? 'Inter' }}', sans-serif;">
                            The quick brown fox jumps over the lazy dog.
                        </div>
                    </div>
                </div>

                {{-- Paragraph --}}
                <div class="ty-row">
                    <div><span class="ty-tag">&lt;p&gt;</span></div>
                    <div>
                        <select name="font_p" class="dm-form-input ty-select" data-preview="preview_p">
                            <option value="">-- Default (Inter) --</option>
                            @foreach($fonts as $font)
                            <option value="{{ $font['key'] }}"
                                data-fallback="{{ $font['fallback'] }}"
                                {{ ($settings['font_p'] ?? '') === $font['key'] ? 'selected' : '' }}>
                                {{ $font['label'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div id="preview_p" class="ty-preview ty-preview-p"
                             style="font-family: '{{ $settings['font_p'] ?? 'Inter' }}', sans-serif;">
                            Paragraph text — clear, readable prose.
                        </div>
                    </div>
                </div>
            </div>

            {{-- Headings --}}
            <div class="dm-table-wrap" style="padding:28px;margin-bottom:24px;">
                <p class="ty-section-title"><i class="fa-solid fa-heading"></i> Headings (H1 – H6)</p>
                <p style="font-size:13px;color:#64748b;margin-bottom:20px;">
                    Each heading level can use a different font. Leave <strong>Default</strong> to inherit the theme heading font.
                </p>

                @foreach([
                    ['h1', 'H1', '40px'],
                    ['h2', 'H2', '34px'],
                    ['h3', 'H3', '26px'],
                    ['h4', 'H4', '20px'],
                    ['h5', 'H5', '17px'],
                    ['h6', 'H6', '14px'],
                ] as [$el, $tag, $size])
                <div class="ty-row">
                    <div><span class="ty-tag">{{ $tag }}</span></div>
                    <div>
                        <select name="font_{{ $el }}" class="dm-form-input ty-select" data-preview="preview_{{ $el }}">
                            <option value="">-- Default (Inter) --</option>
                            @foreach($fonts as $font)
                            <option value="{{ $font['key'] }}"
                                data-fallback="{{ $font['fallback'] }}"
                                {{ ($settings['font_'.$el] ?? '') === $font['key'] ? 'selected' : '' }}>
                                {{ $font['label'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div id="preview_{{ $el }}" class="ty-preview ty-preview-{{ $el }}"
                             style="font-family: '{{ $settings['font_'.$el] ?? 'Inter' }}', sans-serif; font-size: {{ $size }};">
                            {{ $tag }} — Page Heading
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="submit" class="dm-btn dm-btn-primary">
                <i class="fa-solid fa-check"></i> Save Typography
            </button>
        </form>
    </div>

    {{-- RIGHT: info panel --}}
    <div class="col-lg-4">

        {{-- Live full page preview --}}
        <div class="dm-table-wrap" style="padding:24px;margin-bottom:20px;">
            <p class="ty-section-title"><i class="fa-solid fa-eye"></i> Live Preview</p>
            <div id="fullPreview" style="line-height:1.6;color:#1e293b;">
                <div id="fp_h1" style="font-size:26px;font-weight:700;margin-bottom:6px;">
                    Main Page Title
                </div>
                <div id="fp_h2" style="font-size:20px;font-weight:600;color:#334155;margin-bottom:6px;">
                    Section Heading
                </div>
                <div id="fp_h3" style="font-size:16px;font-weight:600;color:#475569;margin-bottom:8px;">
                    Sub-section Heading
                </div>
                <div id="fp_p" style="font-size:14px;color:#64748b;line-height:1.7;margin-bottom:10px;">
                    This is a sample paragraph demonstrating how your chosen body font will look
                    on the website. Clear, readable text is essential for a great user experience.
                </div>
                <div id="fp_body" style="font-size:13px;color:#94a3b8;">
                    Caption / UI text — menus, labels, buttons
                </div>
            </div>
        </div>

        {{-- Quick info --}}
        <div class="dm-table-wrap" style="padding:24px;margin-bottom:20px;">
            <p class="ty-section-title"><i class="fa-solid fa-info-circle"></i> How It Works</p>
            <ul style="font-size:13px;color:#64748b;line-height:1.9;padding-left:18px;margin:0;">
                <li>Settings are saved to the database and applied site-wide instantly.</li>
                <li>Google Fonts are loaded only for the fonts you select — no unused font files.</li>
                <li>Local fonts (Mango, Clash, etc.) are already bundled with the site CSS.</li>
                <li>Leaving an element on <em>Default</em> uses the theme's built-in font (Inter).</li>
            </ul>
        </div>

        {{-- Font catalogue --}}
        <div class="dm-table-wrap" style="padding:24px;">
            <p class="ty-section-title"><i class="fa-solid fa-font"></i> Available Fonts</p>
            @foreach($fonts as $font)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:5px 0;border-bottom:1px solid rgba(0,0,0,0.04);">
                <span style="font-size:13px;font-family:'{{ $font['key'] }}',{{ $font['fallback'] }};">
                    {{ $font['label'] }}
                </span>
                <span class="ty-badge-{{ $font['type'] }}">{{ $font['type'] }}</span>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var loadedFonts = {};

    function loadGoogleFont(fontKey) {
        if (loadedFonts[fontKey]) return;
        loadedFonts[fontKey] = true;
        // Font is already loaded via the bulk preload link above — no extra request needed.
    }

    function applyFont(selectEl) {
        var fontKey  = selectEl.value;
        var previewId = selectEl.getAttribute('data-preview');
        if (!previewId) return;

        var preview = document.getElementById(previewId);
        if (!preview) return;

        var opt      = selectEl.options[selectEl.selectedIndex];
        var fallback = opt ? (opt.getAttribute('data-fallback') || 'sans-serif') : 'sans-serif';
        var family   = fontKey ? "'" + fontKey + "', " + fallback : 'inherit';

        preview.style.fontFamily = family;

        // Also update the full-page preview panel
        var fpMap = {
            preview_body: 'fp_body',
            preview_h1:   'fp_h1',
            preview_h2:   'fp_h2',
            preview_h3:   'fp_h3',
            preview_h4:   'fp_h4',
            preview_h5:   'fp_h5',
            preview_h6:   'fp_h6',
            preview_p:    'fp_p',
        };
        var fpId = fpMap[previewId];
        if (fpId) {
            var fpEl = document.getElementById(fpId);
            if (fpEl) fpEl.style.fontFamily = family;
        }
    }

    document.querySelectorAll('.ty-select').forEach(function (sel) {
        // Apply on page load (reflects saved state)
        applyFont(sel);

        sel.addEventListener('change', function () {
            applyFont(sel);
        });
    });
})();
</script>
@endpush
