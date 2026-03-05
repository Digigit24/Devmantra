@extends('layouts.admin')
@section('title', 'Popup Banner')

@push('styles')
<style>
/* ── Popup Admin Editor ── */
.dm-popup-toggle-row {
    display: flex; align-items: center; justify-content: space-between;
    gap: 20px; flex-wrap: wrap;
}
.dm-toggle-group {
    display: flex; align-items: center; gap: 12px;
    background: var(--dm-dark); border-radius: 10px;
    padding: 12px 16px; flex: 1; min-width: 200px;
}
.dm-toggle-label {
    font-size: 14px; font-weight: 600; color: var(--dm-text);
    flex: 1;
}
.dm-toggle-sub {
    font-size: 12px; color: var(--dm-text-muted); font-weight: 400;
    margin-top: 2px; display: block;
}
/* iOS-style toggle switch */
.dm-switch { position: relative; display: inline-block; width: 46px; height: 26px; flex-shrink: 0; }
.dm-switch input { opacity: 0; width: 0; height: 0; }
.dm-switch-slider {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0.15);
    border-radius: 26px; cursor: pointer;
    transition: background 0.3s;
}
.dm-switch-slider::before {
    content: '';
    position: absolute;
    left: 3px; top: 3px;
    width: 20px; height: 20px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
    transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
}
.dm-switch input:checked + .dm-switch-slider { background: var(--dm-purple); }
.dm-switch input:checked + .dm-switch-slider::before { transform: translateX(20px); }

/* Scroll percentage input with suffix */
.dm-input-suffix-wrap { position: relative; display: flex; align-items: center; }
.dm-input-suffix-wrap .dm-form-input { padding-right: 44px; }
.dm-input-suffix {
    position: absolute; right: 12px;
    font-size: 14px; font-weight: 600; color: var(--dm-text-muted);
    pointer-events: none;
}
/* Points textarea */
.dm-popup-points-hint {
    font-size: 12px; color: var(--dm-text-muted);
    margin-top: 6px; line-height: 1.6;
}
/* Preview card */
.dm-popup-preview-card {
    background: #001d30;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.08);
    position: relative;
}
.dm-popup-preview-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4, #7da3e0);
}
.dm-popup-preview-inner { padding: 28px; position: relative; z-index: 1; }
.dm-popup-preview-blob {
    position: absolute;
    top: -30px; right: -30px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(74,115,196,0.18) 0%, transparent 70%);
    pointer-events: none;
}
.dm-popup-preview-eyebrow {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #7eb8ff;
    background: rgba(74,115,196,0.15);
    border: 1px solid rgba(74,115,196,0.2);
    padding: 5px 14px; border-radius: 20px;
    margin-bottom: 16px;
}
.dm-popup-preview-headline {
    font-size: 22px; font-weight: 800; color: #fff;
    line-height: 1.2; margin-bottom: 12px;
    font-family: 'Onest', sans-serif;
}
.dm-popup-preview-sub {
    font-size: 13px; color: rgba(255,255,255,0.55); line-height: 1.6; margin-bottom: 16px;
}
.dm-popup-preview-point {
    display: flex; align-items: flex-start; gap: 10px;
    margin-bottom: 10px;
}
.dm-popup-preview-point-num {
    flex-shrink: 0; width: 26px; height: 26px;
    border-radius: 7px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff; font-size: 10px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    margin-top: 1px;
}
.dm-popup-preview-point-text {
    font-size: 13px; color: rgba(255,255,255,0.78); line-height: 1.5;
}
.dm-popup-preview-btns { display: flex; flex-direction: column; gap: 8px; margin-top: 20px; }
.dm-popup-preview-btn-primary {
    padding: 12px 20px; border-radius: 30px; text-align: center;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff; font-size: 13px; font-weight: 700;
}
.dm-popup-preview-btn-secondary {
    padding: 11px 20px; border-radius: 30px; text-align: center;
    background: transparent; color: rgba(255,255,255,0.7);
    font-size: 13px; font-weight: 600;
    border: 1px solid rgba(255,255,255,0.2);
}
.dm-popup-preview-support {
    font-size: 11px; color: rgba(255,255,255,0.35);
    text-align: center; margin-top: 14px; line-height: 1.5;
}

/* Section card */
.dm-section-card {
    background: var(--dm-card);
    border-radius: 14px;
    border: 1px solid var(--dm-border);
    padding: 28px;
    margin-bottom: 20px;
}
.dm-section-card-title {
    font-size: 14px; font-weight: 700; color: var(--dm-text);
    margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
    padding-bottom: 14px;
    border-bottom: 1px solid var(--dm-border);
}
.dm-section-card-title i { color: var(--dm-purple); font-size: 13px; }
</style>
@endpush

@section('content')

@if(session('success'))
<div class="dm-alert dm-alert-success mb-4">
    <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.popup.update') }}">
@csrf @method('PUT')

<div class="row g-4 align-items-start">

    {{-- ── LEFT: Main editor ── --}}
    <div class="col-lg-7">

        {{-- Status & Triggers --}}
        <div class="dm-section-card">
            <div class="dm-section-card-title">
                <i class="fa-solid fa-toggle-on"></i> Status & Triggers
            </div>
            <div style="display:flex; flex-direction:column; gap:12px;">

                <div class="dm-toggle-group">
                    <div style="flex:1;">
                        <div class="dm-toggle-label">Enable Popup</div>
                        <span class="dm-toggle-sub">Show popup to visitors on all pages</span>
                    </div>
                    <label class="dm-switch">
                        <input type="checkbox" name="popup_enabled" value="1" {{ \App\Models\SiteSetting::get('popup_enabled','0') === '1' ? 'checked' : '' }}>
                        <span class="dm-switch-slider"></span>
                    </label>
                </div>

                <div class="dm-toggle-group">
                    <div style="flex:1;">
                        <div class="dm-toggle-label">Exit Intent Trigger</div>
                        <span class="dm-toggle-sub">Show when user moves mouse toward browser bar</span>
                    </div>
                    <label class="dm-switch">
                        <input type="checkbox" name="popup_show_exit_intent" value="1" {{ \App\Models\SiteSetting::get('popup_show_exit_intent','1') === '1' ? 'checked' : '' }}>
                        <span class="dm-switch-slider"></span>
                    </label>
                </div>

                <div class="dm-toggle-group">
                    <div style="flex:1;">
                        <div class="dm-toggle-label">Scroll Depth Trigger</div>
                        <span class="dm-toggle-sub">Show after user scrolls a set % of the page</span>
                    </div>
                    <label class="dm-switch">
                        <input type="checkbox" name="popup_show_scroll" value="1" {{ \App\Models\SiteSetting::get('popup_show_scroll','1') === '1' ? 'checked' : '' }}>
                        <span class="dm-switch-slider"></span>
                    </label>
                </div>

                <div class="dm-toggle-group">
                    <div style="flex:1;">
                        <div class="dm-toggle-label">Timer Trigger</div>
                        <span class="dm-toggle-sub">Show popup automatically after page loads</span>
                    </div>
                    <label class="dm-switch">
                        <input type="checkbox" name="popup_timer_enabled" value="1" {{ \App\Models\SiteSetting::get('popup_timer_enabled','0') === '1' ? 'checked' : '' }}>
                        <span class="dm-switch-slider"></span>
                    </label>
                </div>

                <div class="row g-3" style="margin-top:4px;">
                    <div class="col-6">
                        <div class="dm-form-group mb-0">
                            <label class="dm-form-label">Scroll Trigger Depth</label>
                            <div class="dm-input-suffix-wrap">
                                <input type="number" name="popup_trigger_scroll" min="10" max="95"
                                    value="{{ \App\Models\SiteSetting::get('popup_trigger_scroll','55') }}"
                                    class="dm-form-input">
                                <span class="dm-input-suffix">%</span>
                            </div>
                            <div class="dm-form-hint">Trigger at this scroll depth</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dm-form-group mb-0">
                            <label class="dm-form-label">Timer Delay</label>
                            <div class="dm-input-suffix-wrap">
                                <input type="number" name="popup_timer_delay" min="1" max="120"
                                    value="{{ \App\Models\SiteSetting::get('popup_timer_delay','8') }}"
                                    class="dm-form-input">
                                <span class="dm-input-suffix">s</span>
                            </div>
                            <div class="dm-form-hint">Seconds after page load</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="dm-section-card">
            <div class="dm-section-card-title">
                <i class="fa-solid fa-pen-nib"></i> Popup Content
            </div>

            <div class="dm-form-group">
                <label class="dm-form-label">Headline <span style="color:var(--dm-danger)">*</span></label>
                <input type="text" name="popup_headline" class="dm-form-input"
                    placeholder="Expanding to or in India? Avoid costly compliance mistakes."
                    value="{{ \App\Models\SiteSetting::get('popup_headline') }}">
            </div>

            <div class="dm-form-group">
                <label class="dm-form-label">Subtext / Intro</label>
                <textarea name="popup_subtext" class="dm-form-textarea" style="min-height:80px;"
                    placeholder="Talk to Dev Mantra's cross-border advisory team about:">{{ \App\Models\SiteSetting::get('popup_subtext') }}</textarea>
            </div>

            <div class="dm-form-group">
                <label class="dm-form-label">Numbered Points</label>
                <textarea name="popup_points" class="dm-form-textarea" style="min-height:110px;"
                    placeholder="One point per line…">{{ \App\Models\SiteSetting::get('popup_points') }}</textarea>
                <p class="dm-popup-points-hint">
                    <i class="fa-solid fa-circle-info" style="color:var(--dm-purple);"></i>
                    Enter one bullet point per line. These appear as numbered items (01, 02…) in the popup.
                </p>
            </div>

            <div class="dm-form-group mb-0">
                <label class="dm-form-label">Supporting Text</label>
                <input type="text" name="popup_supporting_text" class="dm-form-input"
                    placeholder="Trusted partner for global companies building operations in India."
                    value="{{ \App\Models\SiteSetting::get('popup_supporting_text') }}">
                <div class="dm-form-hint">Small muted text shown below the buttons</div>
            </div>
        </div>

        {{-- CTA Buttons --}}
        <div class="dm-section-card">
            <div class="dm-section-card-title">
                <i class="fa-solid fa-hand-pointer"></i> CTA Buttons
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="dm-form-group">
                        <label class="dm-form-label">Primary Button Text</label>
                        <input type="text" name="popup_primary_cta_text" class="dm-form-input"
                            placeholder="Book a Free 20-Minute Strategy Call"
                            value="{{ \App\Models\SiteSetting::get('popup_primary_cta_text') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-form-group">
                        <label class="dm-form-label">Primary Button URL</label>
                        <input type="text" name="popup_primary_cta_url" class="dm-form-input"
                            placeholder="/contact"
                            value="{{ \App\Models\SiteSetting::get('popup_primary_cta_url') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-form-group mb-0">
                        <label class="dm-form-label">Secondary Button Text</label>
                        <input type="text" name="popup_secondary_cta_text" class="dm-form-input"
                            placeholder="Learn More About Our Services"
                            value="{{ \App\Models\SiteSetting::get('popup_secondary_cta_text') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-form-group mb-0">
                        <label class="dm-form-label">Secondary Button URL</label>
                        <input type="text" name="popup_secondary_cta_url" class="dm-form-input"
                            placeholder="/services"
                            value="{{ \App\Models\SiteSetting::get('popup_secondary_cta_url') }}">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="dm-btn dm-btn-primary w-100">
            <i class="fa-solid fa-floppy-disk"></i> Save Popup Settings
        </button>

    </div>

    {{-- ── RIGHT: Live preview ── --}}
    <div class="col-lg-5" style="position:sticky;top:90px;">
        <div class="dm-section-card" style="padding:0;overflow:hidden;">
            <div style="padding:16px 20px;border-bottom:1px solid var(--dm-border);display:flex;align-items:center;gap:8px;">
                <i class="fa-solid fa-eye" style="color:var(--dm-purple);"></i>
                <span style="font-size:13px;font-weight:700;">Popup Preview</span>
                <span style="margin-left:auto;font-size:11px;color:var(--dm-text-muted);">Approximate — save to refresh</span>
            </div>
            <div style="padding:16px;">
                <div class="dm-popup-preview-card">
                    <div class="dm-popup-preview-blob"></div>
                    <div class="dm-popup-preview-inner">
                        <div class="dm-popup-preview-eyebrow">
                            <i class="fa-solid fa-globe" style="font-size:10px;"></i>
                            India Expansion Advisory
                        </div>
                        <div class="dm-popup-preview-headline">
                            {{ \App\Models\SiteSetting::get('popup_headline', 'Expanding to or in India? Avoid costly compliance mistakes.') }}
                        </div>
                        <div class="dm-popup-preview-sub">
                            {{ \App\Models\SiteSetting::get('popup_subtext', 'Talk to Dev Mantra\'s cross-border advisory team about:') }}
                        </div>
                        @php
                            $pts = array_filter(array_map('trim', explode("\n", \App\Models\SiteSetting::get('popup_points', ''))));
                        @endphp
                        @foreach(array_values($pts) as $i => $pt)
                        <div class="dm-popup-preview-point">
                            <span class="dm-popup-preview-point-num">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                            <span class="dm-popup-preview-point-text">{{ $pt }}</span>
                        </div>
                        @endforeach
                        <div class="dm-popup-preview-btns">
                            <div class="dm-popup-preview-btn-primary">
                                {{ \App\Models\SiteSetting::get('popup_primary_cta_text', 'Book a Free 20-Minute Strategy Call') }}
                            </div>
                            @if(\App\Models\SiteSetting::get('popup_secondary_cta_text'))
                            <div class="dm-popup-preview-btn-secondary">
                                {{ \App\Models\SiteSetting::get('popup_secondary_cta_text') }}
                            </div>
                            @endif
                        </div>
                        @if(\App\Models\SiteSetting::get('popup_supporting_text'))
                        <div class="dm-popup-preview-support">
                            {{ \App\Models\SiteSetting::get('popup_supporting_text') }}
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Status badge --}}
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:14px;padding:10px 14px;background:var(--dm-dark);border-radius:10px;">
                    <span style="font-size:12px;color:var(--dm-text-muted);">Current Status</span>
                    @if(\App\Models\SiteSetting::get('popup_enabled','0') === '1')
                    <span style="font-size:12px;font-weight:700;color:var(--dm-success);"><i class="fa-solid fa-circle" style="font-size:8px;margin-right:4px;"></i> Active</span>
                    @else
                    <span style="font-size:12px;font-weight:700;color:var(--dm-text-muted);"><i class="fa-solid fa-circle" style="font-size:8px;margin-right:4px;"></i> Disabled</span>
                    @endif
                </div>
                <div style="display:flex;gap:6px;margin-top:8px;">
                    @if(\App\Models\SiteSetting::get('popup_show_exit_intent','1') === '1')
                    <span style="font-size:11px;font-weight:600;color:var(--dm-purple);background:var(--dm-purple-light);padding:4px 10px;border-radius:20px;">Exit Intent ✓</span>
                    @endif
                    @if(\App\Models\SiteSetting::get('popup_show_scroll','1') === '1')
                    <span style="font-size:11px;font-weight:600;color:var(--dm-purple);background:var(--dm-purple-light);padding:4px 10px;border-radius:20px;">Scroll {{ \App\Models\SiteSetting::get('popup_trigger_scroll','55') }}% ✓</span>
                    @endif
                    @if(\App\Models\SiteSetting::get('popup_timer_enabled','0') === '1')
                    <span style="font-size:11px;font-weight:600;color:var(--dm-purple);background:var(--dm-purple-light);padding:4px 10px;border-radius:20px;">Timer {{ \App\Models\SiteSetting::get('popup_timer_delay','8') }}s ✓</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
</form>
@endsection
