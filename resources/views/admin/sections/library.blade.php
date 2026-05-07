@extends('layouts.admin')

@section('title', 'Section Library')

@push('styles')
<style>
/* ─── Wireframe utilities ──────────────────────── */
.wf   { display:flex; flex-direction:column; gap:3px; }
.wf-r { display:flex; gap:4px; align-items:flex-start; }
.wf-bar  { height:6px; border-radius:2px; background:#dde5f0; flex-shrink:0; }
.wf-h    { height:9px; border-radius:2px; background:#8fa6c8; flex-shrink:0; }
.wf-card { border:1px solid #dde5f0; border-radius:5px; padding:5px; display:flex; flex-direction:column; gap:3px; }
.wf-icon { width:14px; height:14px; border-radius:50%; background:#c7d5ed; flex-shrink:0; }
.wf-btn  { display:inline-block; height:13px; width:48px; border-radius:3px; background:#4a73c4; opacity:.45; }

/* ─── Library page grid ─────────────────────────── */
.lib-page-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}
@media (max-width: 1200px) { .lib-page-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 680px)  { .lib-page-grid { grid-template-columns: 1fr; } }

.lib-page-card {
    border: 1.5px solid rgba(0,0,0,0.08);
    border-radius: 12px; overflow: hidden;
    background: #fff; transition: all .18s;
    display: flex; flex-direction: column;
}
.lib-page-card:hover {
    border-color: #4a73c4;
    box-shadow: 0 6px 28px rgba(74,115,196,0.14);
    transform: translateY(-2px);
}

/* Wireframe preview area */
.lib-page-preview {
    background: #f8fafc;
    padding: 16px;
    height: 135px;
    overflow: hidden;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    pointer-events: none;
}
.lib-page-preview > * { width: 100%; }

/* Card body */
.lib-page-body { padding: 14px 16px; flex: 1; display: flex; flex-direction: column; gap: 6px; }

/* Top row: icon chip + type key */
.lib-page-meta {
    display: flex; align-items: center; gap: 7px; margin-bottom: 2px;
}
.lib-page-icon-chip {
    width: 28px; height: 28px; border-radius: 7px;
    background: #f0f4ff; display: flex; align-items: center; justify-content: center;
    color: #4a73c4; font-size: 13px; flex-shrink: 0;
}
.lib-page-type-key {
    font-family: monospace; font-size: 10.5px;
    background: #f0f4ff; color: #4a73c4;
    border-radius: 4px; padding: 2px 7px;
    white-space: nowrap;
}

/* Full label */
.lib-page-name-short {
    font-size: 14.5px; font-weight: 800; color: #1e293b;
    line-height: 1.2;
}
.lib-page-name-sub {
    font-size: 12px; color: #64748b;
    line-height: 1.4; margin-bottom: 2px;
}

/* Field badges */
.lib-page-fields {
    display: flex; flex-wrap: wrap; gap: 4px;
    margin-top: auto; padding-top: 8px;
    border-top: 1px solid #f1f5f9;
}
.lib-page-field {
    background: #f8fafc; border: 1px solid #e2e8f0;
    border-radius: 4px; padding: 1px 6px;
    font-size: 10px; color: #64748b;
}
.lib-page-field.more { color: #94a3b8; }
</style>
@endpush

@section('content')
@php
use App\Models\ServiceSection;

$wf = [
    'hero' =>
        '<div class="wf" style="align-items:center;">
            <div class="wf-h" style="width:75%;"></div>
            <div class="wf-bar" style="width:55%;"></div>
            <div class="wf-bar" style="width:45%;margin-bottom:5px;"></div>
            <div class="wf-btn"></div>
        </div>',

    'overview' =>
        '<div class="wf-r">
            <div class="wf" style="flex:3;">
                <div class="wf-h" style="width:90%;"></div>
                <div class="wf-bar" style="width:100%;"></div>
                <div class="wf-bar" style="width:90%;"></div>
                <div class="wf-bar" style="width:75%;"></div>
            </div>
            <div style="flex:2;display:grid;grid-template-columns:1fr 1fr;gap:3px;">
                <div class="wf-card"><div class="wf-h" style="width:60%;"></div><div class="wf-bar" style="width:80%;"></div></div>
                <div class="wf-card"><div class="wf-h" style="width:60%;"></div><div class="wf-bar" style="width:80%;"></div></div>
                <div class="wf-card"><div class="wf-h" style="width:60%;"></div><div class="wf-bar" style="width:80%;"></div></div>
                <div class="wf-card"><div class="wf-h" style="width:60%;"></div><div class="wf-bar" style="width:80%;"></div></div>
            </div>
        </div>',

    'services-grid' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 5px;"></div>
            <div class="wf-r">
                <div class="wf-card" style="flex:1;"><div class="wf-icon"></div><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:70%;"></div></div>
                <div class="wf-card" style="flex:1;"><div class="wf-icon"></div><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:70%;"></div></div>
                <div class="wf-card" style="flex:1;"><div class="wf-icon"></div><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:70%;"></div></div>
            </div>
        </div>',

    'process-steps' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;"></div>
            <div class="wf-r" style="margin-top:6px;">
                <div class="wf" style="align-items:center;flex:1;"><div style="width:18px;height:18px;border-radius:50%;background:#4a73c4;opacity:.4;flex-shrink:0;"></div><div class="wf-bar" style="width:90%;"></div><div class="wf-bar" style="width:70%;"></div></div>
                <div class="wf" style="align-items:center;flex:1;"><div style="width:18px;height:18px;border-radius:50%;background:#4a73c4;opacity:.4;flex-shrink:0;"></div><div class="wf-bar" style="width:90%;"></div><div class="wf-bar" style="width:70%;"></div></div>
                <div class="wf" style="align-items:center;flex:1;"><div style="width:18px;height:18px;border-radius:50%;background:#4a73c4;opacity:.4;flex-shrink:0;"></div><div class="wf-bar" style="width:90%;"></div><div class="wf-bar" style="width:70%;"></div></div>
                <div class="wf" style="align-items:center;flex:1;"><div style="width:18px;height:18px;border-radius:50%;background:#4a73c4;opacity:.4;flex-shrink:0;"></div><div class="wf-bar" style="width:90%;"></div><div class="wf-bar" style="width:70%;"></div></div>
            </div>
        </div>',

    'why-stand-out' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 5px;"></div>
            <div class="wf-r">
                <div class="wf-card" style="flex:1;"><div class="wf-icon"></div><div class="wf-h" style="width:75%;"></div><div class="wf-bar" style="width:100%;"></div></div>
                <div class="wf-card" style="flex:1;"><div class="wf-icon"></div><div class="wf-h" style="width:75%;"></div><div class="wf-bar" style="width:100%;"></div></div>
                <div class="wf-card" style="flex:1;"><div class="wf-icon"></div><div class="wf-h" style="width:75%;"></div><div class="wf-bar" style="width:100%;"></div></div>
            </div>
        </div>',

    'faq' =>
        '<div class="wf">
            <div class="wf-h" style="width:45%;margin:0 auto 6px;"></div>
            <div class="wf-card" style="flex-direction:row;align-items:center;justify-content:space-between;gap:4px;"><div class="wf-bar" style="width:70%;"></div><div style="width:10px;height:10px;border-radius:2px;background:#dde5f0;flex-shrink:0;"></div></div>
            <div class="wf-card" style="flex-direction:row;align-items:center;justify-content:space-between;gap:4px;"><div class="wf-bar" style="width:80%;"></div><div style="width:10px;height:10px;border-radius:2px;background:#dde5f0;flex-shrink:0;"></div></div>
            <div class="wf-card" style="background:#f0f5ff;">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:4px;"><div class="wf-bar" style="width:70%;"></div><div style="width:10px;height:10px;border-radius:2px;background:#4a73c4;opacity:.4;flex-shrink:0;"></div></div>
                <div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:85%;"></div>
            </div>
        </div>',

    'other-services' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 7px;"></div>
            <div style="display:flex;flex-wrap:wrap;gap:5px;">
                <div style="height:17px;width:54px;border-radius:12px;background:#dde5f0;"></div>
                <div style="height:17px;width:66px;border-radius:12px;background:#dde5f0;"></div>
                <div style="height:17px;width:46px;border-radius:12px;background:#dde5f0;"></div>
                <div style="height:17px;width:60px;border-radius:12px;background:#dde5f0;"></div>
                <div style="height:17px;width:42px;border-radius:12px;background:#dde5f0;"></div>
                <div style="height:17px;width:70px;border-radius:12px;background:#dde5f0;"></div>
            </div>
        </div>',

    'benefits-list' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;"></div>
            <div class="wf-r" style="margin-top:6px;">
                <div class="wf" style="flex:1;gap:5px;">
                    <div style="display:flex;align-items:center;gap:4px;"><div style="width:9px;height:9px;border-radius:50%;background:#22c55e;opacity:.7;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:4px;"><div style="width:9px;height:9px;border-radius:50%;background:#22c55e;opacity:.7;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:4px;"><div style="width:9px;height:9px;border-radius:50%;background:#22c55e;opacity:.7;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                </div>
                <div class="wf" style="flex:1;gap:5px;">
                    <div style="display:flex;align-items:center;gap:4px;"><div style="width:9px;height:9px;border-radius:50%;background:#22c55e;opacity:.7;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:4px;"><div style="width:9px;height:9px;border-radius:50%;background:#22c55e;opacity:.7;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:4px;"><div style="width:9px;height:9px;border-radius:50%;background:#22c55e;opacity:.7;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                </div>
            </div>
        </div>',

    'markets-served' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 7px;"></div>
            <div style="display:flex;flex-wrap:wrap;gap:4px;">
                <div style="height:15px;width:44px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:60px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:38px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:54px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:48px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:64px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:40px;border-radius:4px;background:#dde5f0;"></div>
                <div style="height:15px;width:56px;border-radius:4px;background:#dde5f0;"></div>
            </div>
        </div>',

    'trust-signals' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 8px;"></div>
            <div class="wf-r" style="justify-content:space-around;">
                <div class="wf" style="align-items:center;gap:3px;"><div class="wf-icon"></div><div class="wf-bar" style="width:44px;"></div></div>
                <div class="wf" style="align-items:center;gap:3px;"><div class="wf-icon"></div><div class="wf-bar" style="width:44px;"></div></div>
                <div class="wf" style="align-items:center;gap:3px;"><div class="wf-icon"></div><div class="wf-bar" style="width:44px;"></div></div>
                <div class="wf" style="align-items:center;gap:3px;"><div class="wf-icon"></div><div class="wf-bar" style="width:44px;"></div></div>
            </div>
        </div>',

    'cpa-reality' =>
        '<div style="background:#1b3c6b;border-radius:7px;padding:12px;" class="wf">
            <div style="height:9px;border-radius:2px;background:rgba(255,255,255,.55);width:60%;margin-bottom:7px;"></div>
            <div style="height:6px;border-radius:2px;background:rgba(255,255,255,.25);width:90%;margin-bottom:4px;"></div>
            <div style="height:6px;border-radius:2px;background:rgba(255,255,255,.25);width:80%;margin-bottom:4px;"></div>
            <div style="height:6px;border-radius:2px;background:rgba(255,255,255,.25);width:70%;"></div>
        </div>',

    'three-layer' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 6px;"></div>
            <div class="wf" style="gap:3px;">
                <div style="background:#1b3c6b;opacity:.18;border-radius:5px;padding:5px 10px;"><div style="height:7px;border-radius:2px;background:#1b3c6b;width:55%;"></div></div>
                <div style="background:#1b3c6b;opacity:.28;border-radius:5px;padding:5px 10px;margin-left:12px;"><div style="height:7px;border-radius:2px;background:#1b3c6b;width:55%;"></div></div>
                <div style="background:#1b3c6b;opacity:.42;border-radius:5px;padding:5px 10px;margin-left:24px;"><div style="height:7px;border-radius:2px;background:#1b3c6b;width:55%;"></div></div>
            </div>
        </div>',

    'comparison-table' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 6px;"></div>
            <div class="wf-r" style="border:1px solid #dde5f0;border-radius:6px;overflow:hidden;">
                <div style="flex:1;border-right:1px solid #dde5f0;">
                    <div style="background:#e0e7f5;padding:4px 6px;margin-bottom:4px;"><div class="wf-bar" style="width:70%;background:#4a73c4;opacity:.4;"></div></div>
                    <div style="padding:3px 6px;" class="wf"><div class="wf-bar" style="width:90%;"></div><div class="wf-bar" style="width:80%;"></div><div class="wf-bar" style="width:85%;"></div></div>
                </div>
                <div style="flex:1;">
                    <div style="background:#e0e7f5;padding:4px 6px;margin-bottom:4px;"><div class="wf-bar" style="width:70%;background:#4a73c4;opacity:.4;"></div></div>
                    <div style="padding:3px 6px;" class="wf"><div class="wf-bar" style="width:90%;"></div><div class="wf-bar" style="width:80%;"></div><div class="wf-bar" style="width:85%;"></div></div>
                </div>
            </div>
        </div>',

    'engagement-models' =>
        '<div class="wf">
            <div class="wf-h" style="width:60%;margin:0 auto 5px;"></div>
            <div class="wf-r">
                <div class="wf-card" style="flex:1;"><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:85%;"></div><div class="wf-bar" style="width:90%;"></div></div>
                <div class="wf-card" style="flex:1;"><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:85%;"></div><div class="wf-bar" style="width:90%;"></div></div>
            </div>
        </div>',

    'pillars' =>
        '<div class="wf">
            <div class="wf-h" style="width:45%;margin:0 auto 5px;"></div>
            <div class="wf-r">
                <div class="wf-card" style="flex:1;border-top:3px solid #4a73c4;"><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:90%;"></div></div>
                <div class="wf-card" style="flex:1;border-top:3px solid #4a73c4;"><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:90%;"></div></div>
                <div class="wf-card" style="flex:1;border-top:3px solid #4a73c4;"><div class="wf-h" style="width:80%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:90%;"></div></div>
            </div>
        </div>',

    'governance' =>
        '<div class="wf">
            <div class="wf-h" style="width:50%;margin:0 auto 5px;"></div>
            <div class="wf-r">
                <div class="wf" style="flex:1;gap:4px;">
                    <div class="wf-h" style="width:70%;"></div>
                    <div style="display:flex;align-items:center;gap:3px;"><div style="width:8px;height:8px;background:#4a73c4;opacity:.4;border-radius:2px;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:3px;"><div style="width:8px;height:8px;background:#4a73c4;opacity:.4;border-radius:2px;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:3px;"><div style="width:8px;height:8px;background:#4a73c4;opacity:.4;border-radius:2px;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                </div>
                <div class="wf" style="flex:1;gap:4px;">
                    <div class="wf-h" style="width:70%;"></div>
                    <div style="display:flex;align-items:center;gap:3px;"><div style="width:8px;height:8px;background:#4a73c4;opacity:.4;border-radius:2px;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:3px;"><div style="width:8px;height:8px;background:#4a73c4;opacity:.4;border-radius:2px;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                    <div style="display:flex;align-items:center;gap:3px;"><div style="width:8px;height:8px;background:#4a73c4;opacity:.4;border-radius:2px;flex-shrink:0;"></div><div class="wf-bar" style="flex:1;"></div></div>
                </div>
            </div>
        </div>',
];
@endphp

<div class="dm-table-wrap" style="padding: 28px;">

    {{-- Page header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
        <div>
            <h1 style="font-size:22px;font-weight:800;color:#1e293b;margin:0 0 5px;line-height:1.2;">
                <i class="fa-solid fa-swatchbook" style="color:#4a73c4;margin-right:10px;"></i>Section Library
            </h1>
            <p style="font-size:13px;color:#94a3b8;margin:0;">
                {{ count($sectionTypes) }} reusable section layouts available for service pages.
            </p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
            <i class="fa-solid fa-briefcase"></i> Go to Services
        </a>
    </div>

    {{-- Cards grid --}}
    <div class="lib-page-grid">
        @foreach($sectionTypes as $key => $meta)
        @php
            $label     = $meta['label'];
            $parts     = explode(' — ', $label, 2);
            $shortName = $parts[0];
            $subName   = $parts[1] ?? '';
            $icon      = $meta['icon'] ?? 'fa-solid fa-layer-group';
            $fields    = array_keys($meta['schema'] ?? []);
        @endphp

        <div class="lib-page-card">
            {{-- Wireframe --}}
            <div class="lib-page-preview">
                {!! $wf[$key] ?? '<div class="wf"><div class="wf-h" style="width:60%;"></div><div class="wf-bar" style="width:100%;"></div><div class="wf-bar" style="width:80%;"></div></div>' !!}
            </div>

            {{-- Body --}}
            <div class="lib-page-body">
                <div class="lib-page-meta">
                    <div class="lib-page-icon-chip"><i class="{{ $icon }}"></i></div>
                    <code class="lib-page-type-key">{{ $key }}</code>
                </div>

                <div class="lib-page-name-short">{{ $shortName }}</div>
                @if($subName)
                    <div class="lib-page-name-sub">{{ $subName }}</div>
                @endif

                @if($fields)
                <div class="lib-page-fields">
                    @foreach(array_slice($fields, 0, 5) as $field)
                        <span class="lib-page-field">{{ $field }}</span>
                    @endforeach
                    @if(count($fields) > 5)
                        <span class="lib-page-field more">+{{ count($fields) - 5 }} more</span>
                    @endif
                </div>
                @endif
            </div>
        </div>

        @endforeach
    </div>

</div>
@endsection
