@extends('layouts.admin')
@section('title', 'Schema / Structured Data')

@push('styles')
<style>
.schema-tab-nav {
    display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 20px;
}
.schema-tab-btn {
    padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600;
    cursor: pointer; border: 1px solid #e2e8f0; background: #fff; color: #374151;
    transition: all .15s;
}
.schema-tab-btn:hover  { border-color: #1b3c6b; color: #1b3c6b; }
.schema-tab-btn.active { background: #1b3c6b; color: #fff; border-color: #1b3c6b; }
.schema-panel  { display: none; }
.schema-panel.active { display: block; }
.schema-pre {
    background: #0f172a; color: #e2e8f0; font-family: monospace;
    font-size: 12px; line-height: 1.6; border-radius: 10px;
    padding: 18px 20px; overflow-x: auto; margin: 0;
    white-space: pre; max-height: 480px; overflow-y: auto;
}
.schema-copy-btn {
    padding: 5px 12px; font-size: 11px; font-weight: 700;
    background: #1b3c6b; color: #fff; border: none; border-radius: 6px;
    cursor: pointer; transition: opacity .15s;
}
.schema-copy-btn:hover { opacity: .85; }
.schema-badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 10px; font-weight: 700; padding: 2px 8px;
    border-radius: 12px; text-transform: uppercase; letter-spacing: .4px;
}
.schema-badge-live   { background: #d1fae5; color: #065f46; }
.schema-badge-sample { background: #fef3c7; color: #92400e; }
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

    {{-- ── LEFT: Schema preview tabs ── --}}
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding:28px;">

            @if(session('success'))
            <div class="dm-alert dm-alert-success" style="margin-bottom:20px;">{{ session('success') }}</div>
            @endif

            <p class="st-title"><i class="fa-solid fa-code"></i> Live Schema Preview</p>
            <p style="font-size:13px;color:#64748b;margin-bottom:20px;">
                These are the exact JSON-LD blocks injected into each page.
                <strong>Live</strong> = real record. <strong>Sample</strong> = illustrative only.
                Copy any block and paste into
                <a href="https://validator.schema.org/" target="_blank" rel="noopener" style="color:#1b3c6b;">validator.schema.org</a>
                or <a href="https://search.google.com/test/rich-results" target="_blank" rel="noopener" style="color:#1b3c6b;">Google Rich Results Test</a>.
            </p>

            {{-- Tab navigation --}}
            <div class="schema-tab-nav">
                @foreach([
                    'organization'  => 'Organization',
                    'localBusiness' => 'LocalBusiness',
                    'article'       => 'Article (Blog)',
                    'caseStudy'     => 'Case Study',
                    'report'        => 'Report',
                    'newsletter'    => 'Newsletter',
                    'service'       => 'Service',
                    'faq'           => 'FAQPage',
                    'breadcrumb'    => 'BreadcrumbList',
                ] as $key => $label)
                <button class="schema-tab-btn {{ $loop->first ? 'active' : '' }}"
                        onclick="SchemaAdmin.tab('{{ $key }}', this)">
                    {{ $label }}
                </button>
                @endforeach
            </div>

            {{-- Tab panels --}}
            @foreach([
                'organization'  => ['Organization', true],
                'localBusiness' => ['LocalBusiness', true],
                'article'       => ['Article – BlogPosting', !!$blog],
                'caseStudy'     => ['Article – Case Study', !!$caseStudy],
                'report'        => ['Report', !!$report],
                'newsletter'    => ['Article – Newsletter', !!$newsletter],
                'service'       => ['Service', !!$service],
                'faq'           => ['FAQPage', false],
                'breadcrumb'    => ['BreadcrumbList', false],
            ] as $key => [$label, $isLive])
            <div class="schema-panel {{ $loop->first ? 'active' : '' }}" id="schema-panel-{{ $key }}">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <span style="font-size:13px; font-weight:700; color:#374151;">
                        {{ $label }}
                        <span class="schema-badge {{ $isLive ? 'schema-badge-live' : 'schema-badge-sample' }}">
                            {{ $isLive ? 'Live' : 'Sample' }}
                        </span>
                    </span>
                    <button class="schema-copy-btn" onclick="SchemaAdmin.copy('schema-code-{{ $key }}')">
                        <i class="fa-regular fa-copy"></i> Copy JSON-LD
                    </button>
                </div>
                @if($previews[$key])
                @php
                    // Extract just the JSON body from the <script> tag for display
                    preg_match('/<script[^>]*>([\s\S]*?)<\/script>/i', $previews[$key], $m);
                    $jsonBody = trim($m[1] ?? $previews[$key]);
                @endphp
                <pre class="schema-pre" id="schema-code-{{ $key }}">{{ $jsonBody }}</pre>
                @else
                <div style="background:#f8f9fb; border:1px dashed #e2e8f0; border-radius:10px; padding:24px; text-align:center; color:#94a3b8; font-size:13px;">
                    <i class="fa-solid fa-box-open" style="font-size:24px; display:block; margin-bottom:8px; opacity:.4;"></i>
                    No published {{ $label }} content yet. Schema will appear here once you publish one.
                </div>
                @endif
            </div>
            @endforeach

        </div>

        {{-- Per-page override note --}}
        <div class="dm-table-wrap" style="padding:24px; margin-top:20px;">
            <p class="st-title"><i class="fa-solid fa-pen-to-square"></i> Per-Page Schema Override</p>
            <p style="font-size:13px; color:#64748b; line-height:1.7; margin:0;">
                Every content type (Blogs, Services, Case Studies, Reports, Newsletters) has a
                <strong>Custom &lt;head&gt; Code</strong> textarea in its SEO panel. Paste any additional
                <code>&lt;script type="application/ld+json"&gt;</code> block there to supplement or
                override the automatically generated schema for that individual page.
            </p>
        </div>
    </div>

    {{-- ── RIGHT: Schema settings form ── --}}
    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding:24px; margin-bottom:20px;">
            <p class="st-title"><i class="fa-solid fa-building"></i> Organization Settings</p>
            <p style="font-size:12px; color:#64748b; margin-bottom:18px;">
                These values power the <em>Organization</em>, <em>LocalBusiness</em>, and
                <em>publisher</em> fields across all schema types.
            </p>
            <form method="POST" action="{{ route('admin.schema.update') }}">
                @csrf @method('PUT')

                <div class="dm-form-group">
                    <label class="dm-form-label">Company / Organization Name</label>
                    <input type="text" name="schema_company_name" class="dm-form-input"
                           value="{{ $settings['schema_company_name'] ?? '' }}"
                           placeholder="DevMantra">
                    <div class="dm-form-hint">Shown as publisher and organization name in all schemas.</div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Logo URL</label>
                    <input type="url" name="schema_logo_url" class="dm-form-input"
                           value="{{ $settings['schema_logo_url'] ?? '' }}"
                           placeholder="https://example.com/logo.png">
                    <div class="dm-form-hint">Absolute URL to your logo. Google prefers 112 × 112 px or larger.</div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Canonical Website URL</label>
                    <input type="url" name="schema_website_url" class="dm-form-input"
                           value="{{ $settings['schema_website_url'] ?? '' }}"
                           placeholder="{{ config('app.url') }}">
                    <div class="dm-form-hint">Leave empty to use APP_URL: <code>{{ config('app.url') }}</code></div>
                </div>

                <div class="dm-form-group" style="margin-bottom:0;">
                    <label class="dm-form-label">Area Served (Service schema)</label>
                    <input type="text" name="schema_area_served" class="dm-form-input"
                           value="{{ $settings['schema_area_served'] ?? '' }}"
                           placeholder="Worldwide">
                    <div class="dm-form-hint">Shown in Service schema <code>areaServed</code>.</div>
                </div>

                <button type="submit" class="dm-btn dm-btn-primary w-100" style="margin-top:20px;">
                    <i class="fa-solid fa-check"></i> Save Schema Settings
                </button>
            </form>
        </div>

        {{-- Social / contact data note --}}
        <div class="dm-table-wrap" style="padding:24px; margin-bottom:20px;">
            <p class="st-title"><i class="fa-solid fa-share-nodes"></i> Social Profiles &amp; Address</p>
            <p style="font-size:13px; color:#64748b; margin-bottom:14px; line-height:1.7;">
                Social links, phone, email, and address are pulled from
                <strong>Contact Settings</strong> — they feed directly into
                <em>Organization.sameAs</em> and <em>LocalBusiness</em> schema.
            </p>
            <a href="{{ route('admin.contact-settings.edit') }}" class="dm-btn dm-btn-outline dm-btn-sm" style="width:100%; justify-content:center;">
                <i class="fa-solid fa-address-book"></i> Edit Contact Settings
            </a>
        </div>

        {{-- Quick validator links --}}
        <div class="dm-table-wrap" style="padding:24px;">
            <p class="st-title"><i class="fa-solid fa-circle-check"></i> Validator Links</p>
            <a href="https://validator.schema.org/" target="_blank" rel="noopener"
               class="d-flex align-items-center gap-2 mb-3" style="font-size:13px; color:var(--dm-text);">
                <i class="fa-solid fa-external-link" style="width:16px; color:var(--dm-text-muted);"></i>
                Schema.org Validator
            </a>
            <a href="https://search.google.com/test/rich-results" target="_blank" rel="noopener"
               class="d-flex align-items-center gap-2" style="font-size:13px; color:var(--dm-text);">
                <i class="fa-brands fa-google" style="width:16px; color:var(--dm-text-muted);"></i>
                Google Rich Results Test
            </a>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
var SchemaAdmin = {
    tab: function (key, btn) {
        document.querySelectorAll('.schema-panel').forEach(function(p){ p.classList.remove('active'); });
        document.querySelectorAll('.schema-tab-btn').forEach(function(b){ b.classList.remove('active'); });
        var panel = document.getElementById('schema-panel-' + key);
        if (panel) panel.classList.add('active');
        btn.classList.add('active');
    },
    copy: function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        navigator.clipboard.writeText(el.textContent).then(function () {
            var toasts = document.getElementById('schemaToast');
            if (toasts) { toasts.textContent = 'Copied!'; toasts.classList.add('show'); setTimeout(function(){ toasts.classList.remove('show'); }, 2000); }
        });
    }
};
</script>
<div class="gallery-toast" id="schemaToast" style="bottom:24px;right:24px;"></div>
@endpush
