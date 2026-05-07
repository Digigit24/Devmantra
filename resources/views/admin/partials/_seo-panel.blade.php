@php
    $seo = $model ?? null;
@endphp

<div class="dm-table-wrap" style="padding:0; overflow:visible;" id="seoPanelWrap">

    {{-- Header / toggle --}}
    <button type="button" id="seoPanelToggle"
        style="display:flex; align-items:center; justify-content:space-between; width:100%;
               padding:16px 24px; background:transparent; border:none; cursor:pointer;
               border-bottom:1px solid var(--dm-border,#e2e8f0);"
        aria-expanded="false" aria-controls="seoPanelBody">
        <span style="display:flex; align-items:center; gap:10px;">
            <span style="display:inline-flex; align-items:center; justify-content:center;
                         width:32px; height:32px; border-radius:8px;
                         background:rgba(116,99,255,.12); color:var(--dm-purple,#7463FF);">
                <i class="fa-solid fa-magnifying-glass" style="font-size:14px;"></i>
            </span>
            <span style="font-size:14px; font-weight:700; color:var(--dm-text,#0f172a); letter-spacing:.01em;">
                SEO &amp; Open Graph
            </span>
        </span>
        <i class="fa-solid fa-chevron-down" id="seoPanelChevron"
           style="font-size:12px; color:var(--dm-text-muted,#64748b);
                  transition:transform .25s ease;"></i>
    </button>

    {{-- Collapsible body --}}
    <div id="seoPanelBody" style="display:none; padding:24px;">

        {{-- Meta Title --}}
        <div class="dm-form-group">
            <label class="dm-form-label" for="seo_meta_title">
                Meta Title
                <span style="font-weight:400; color:var(--dm-text-muted,#64748b);">(search result headline)</span>
            </label>
            <input type="text"
                   id="seo_meta_title"
                   name="meta_title"
                   class="dm-form-input seo-counter-input"
                   maxlength="60"
                   data-counter="seo_meta_title_count"
                   data-max="60"
                   value="{{ old('meta_title', $seo?->meta_title ?? '') }}"
                   placeholder="e.g. Professional Financial Services in India | DevMantra">
            <div class="dm-form-hint" style="display:flex; justify-content:space-between;">
                <span>Ideal: 50–60 characters</span>
                <span>
                    <span id="seo_meta_title_count"
                          style="font-weight:700;">{{ mb_strlen(old('meta_title', $seo?->meta_title ?? '')) }}</span>
                    / 60
                </span>
            </div>
        </div>

        {{-- Meta Description --}}
        <div class="dm-form-group">
            <label class="dm-form-label" for="seo_meta_description">
                Meta Description
                <span style="font-weight:400; color:var(--dm-text-muted,#64748b);">(search result snippet)</span>
            </label>
            <textarea id="seo_meta_description"
                      name="meta_description"
                      class="dm-form-textarea seo-counter-input"
                      maxlength="160"
                      data-counter="seo_meta_desc_count"
                      data-max="160"
                      style="min-height:80px;"
                      placeholder="A concise summary of this page for search engines…">{{ old('meta_description', $seo?->meta_description ?? '') }}</textarea>
            <div class="dm-form-hint" style="display:flex; justify-content:space-between;">
                <span>Ideal: 120–160 characters</span>
                <span>
                    <span id="seo_meta_desc_count"
                          style="font-weight:700;">{{ mb_strlen(old('meta_description', $seo?->meta_description ?? '')) }}</span>
                    / 160
                </span>
            </div>
        </div>

        {{-- OG Image --}}
        <div class="dm-form-group">
            <label class="dm-form-label">
                OG Image
                <span style="font-weight:400; color:var(--dm-text-muted,#64748b);">(social share preview)</span>
            </label>

            {{-- Current image preview --}}
            @php $currentOg = old('og_image', $seo?->og_image ?? ''); @endphp
            @if($currentOg)
            <div style="margin-bottom:12px;">
                <img src="{{ $currentOg }}" alt="Current OG image"
                     style="max-width:100%; max-height:160px; object-fit:cover; border-radius:8px;
                            border:1px solid var(--dm-border,#e2e8f0);">
                <div class="dm-form-hint" style="margin-top:4px; color:var(--dm-success,#10b981);">
                    <i class="fa-solid fa-circle-check"></i> Current OG image
                </div>
            </div>
            @endif

            {{-- Upload --}}
            <label class="dm-form-label"
                   style="font-size:12px; font-weight:600; color:var(--dm-text-muted,#64748b); margin-bottom:4px; display:block;">
                Upload image
            </label>
            <input type="file"
                   id="seo_og_image_file"
                   name="og_image_file"
                   class="dm-form-input"
                   accept="image/jpeg,image/png,image/gif,image/webp"
                   onchange="DmSeoPanel.previewOg(this)">
            <img id="seo_og_upload_preview" src="" alt="Upload preview"
                 style="display:none; max-width:100%; max-height:160px; object-fit:cover;
                        border-radius:8px; border:1px solid var(--dm-border,#e2e8f0); margin-top:8px;">
            <div class="dm-form-hint">
                Saved to <code>storage/seo/og-images/</code>. Max 2 MB. JPEG, PNG, GIF, WebP.
                <strong>Overrides the URL below when set.</strong>
            </div>

            {{-- URL fallback --}}
            <label class="dm-form-label"
                   style="font-size:12px; font-weight:600; color:var(--dm-text-muted,#64748b); margin:12px 0 4px; display:block;">
                Or enter external URL
            </label>
            <input type="url"
                   id="seo_og_image"
                   name="og_image"
                   class="dm-form-input"
                   value="{{ $currentOg }}"
                   placeholder="https://example.com/images/og-cover.jpg">
            <div class="dm-form-hint">Recommended: 1200 × 630 px. Leave empty to use the featured image.</div>
        </div>

        {{-- Canonical URL --}}
        <div class="dm-form-group">
            <label class="dm-form-label" for="seo_canonical_url">
                Canonical URL
                <span style="font-weight:400; color:var(--dm-text-muted,#64748b);">(optional override)</span>
            </label>
            <input type="url"
                   id="seo_canonical_url"
                   name="canonical_url"
                   class="dm-form-input"
                   value="{{ old('canonical_url', $seo?->canonical_url ?? '') }}"
                   placeholder="https://example.com/canonical-path">
            <div class="dm-form-hint">Leave empty to use the default page URL.</div>
        </div>

        {{-- Noindex --}}
        <div class="dm-form-group">
            <div class="dm-form-check" style="display:flex; align-items:center; gap:10px;">
                <input type="hidden" name="noindex" value="0">
                <input type="checkbox"
                       id="seo_noindex"
                       name="noindex"
                       value="1"
                       {{ old('noindex', $seo?->noindex ?? false) ? 'checked' : '' }}
                       style="width:16px; height:16px; accent-color:var(--dm-danger,#ef4444); cursor:pointer;">
                <label for="seo_noindex" class="dm-form-label" style="margin:0; cursor:pointer;">
                    Hide from search engines
                    <span style="font-weight:400; color:var(--dm-text-muted,#64748b);">(adds noindex, nofollow)</span>
                </label>
            </div>
            <div class="dm-form-hint" style="padding-left:26px;">
                Enable only for drafts, duplicates, or pages you don't want indexed.
            </div>
        </div>

        {{-- Custom Head --}}
        <div class="dm-form-group" style="margin-bottom:0;">
            <label class="dm-form-label" for="seo_custom_head">
                Custom &lt;head&gt; Code
                <span style="font-weight:400; color:var(--dm-text-muted,#64748b);">(injected before &lt;/head&gt;)</span>
            </label>
            <textarea id="seo_custom_head"
                      name="custom_head"
                      class="dm-form-textarea"
                      style="min-height:90px; font-family:monospace; font-size:13px;"
                      placeholder="<!-- e.g. extra meta tags, JSON-LD schema, etc. -->">{{ old('custom_head', $seo?->custom_head ?? '') }}</textarea>
            <div class="dm-form-hint">Raw HTML only. Script tags are allowed but use with caution.</div>
        </div>

    </div>{{-- /seoPanelBody --}}
</div>{{-- /seoPanelWrap --}}

@once
@push('scripts')
<script>
(function () {
    // ── Toggle collapse ──────────────────────────────────────────
    var toggle   = document.getElementById('seoPanelToggle');
    var body     = document.getElementById('seoPanelBody');
    var chevron  = document.getElementById('seoPanelChevron');

    if (toggle && body && chevron) {
        toggle.addEventListener('click', function () {
            var open = body.style.display !== 'none';
            body.style.display  = open ? 'none' : 'block';
            chevron.style.transform = open ? '' : 'rotate(180deg)';
            toggle.setAttribute('aria-expanded', String(!open));
        });

        // Auto-open when validation errors exist in this panel
        var hasError = ['meta_title','meta_description','og_image','canonical_url','custom_head']
            .some(function(n){ return document.querySelector('[name="'+n+'"].is-invalid'); });
        if (hasError) {
            body.style.display = 'block';
            chevron.style.transform = 'rotate(180deg)';
            toggle.setAttribute('aria-expanded', 'true');
        }
    }

    // ── Live character counters ──────────────────────────────────
    function updateCounter(input) {
        var max     = parseInt(input.dataset.max, 10);
        var countId = input.dataset.counter;
        var span    = document.getElementById(countId);
        if (!span) return;

        var len = input.value.length;
        span.textContent = len;

        var ratio = len / max;
        if (ratio >= 1) {
            span.style.color = 'var(--dm-danger,#ef4444)';
        } else if (ratio >= 0.85) {
            span.style.color = 'var(--dm-warning,#f59e0b)';
        } else {
            span.style.color = 'var(--dm-success,#10b981)';
        }
    }

    document.querySelectorAll('.seo-counter-input').forEach(function (el) {
        updateCounter(el);           // init on load
        el.addEventListener('input', function () { updateCounter(el); });
    });
}());

// ── OG image upload preview ─────────────────────────────────────
window.DmSeoPanel = {
    previewOg: function (input) {
        var file = input.files[0];
        var prev = document.getElementById('seo_og_upload_preview');
        if (!file || !prev) return;
        var reader = new FileReader();
        reader.onload = function (e) {
            prev.src = e.target.result;
            prev.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
};
</script>
@endpush
@endonce
