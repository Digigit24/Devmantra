@extends('layouts.admin')
@section('title', 'Edit Service')

@section('actions')
<button type="button" onclick="openSectionAdd()" class="dm-btn dm-btn-sm" style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;margin-right:8px;">
    <i class="fa-solid fa-plus"></i> Add Section
</button>
<a href="{{ route('admin.services.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@push('styles')
<style>
/* ─── Sections Drawer ──────────────────────────────────── */
#sections-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.45); z-index: 1040;
}
#sections-drawer {
    position: fixed; top: 0; right: -600px; width: 600px;
    height: 100vh; background: #f8fafc; z-index: 1050;
    transition: right .3s cubic-bezier(.4,0,.2,1);
    display: flex; flex-direction: column;
    box-shadow: -4px 0 40px rgba(0,0,0,0.18);
}
#sections-drawer.open { right: 0; }
.drawer-hdr {
    display: flex; align-items: center; gap: 10px;
    padding: 15px 20px; background: #fff;
    border-bottom: 1px solid rgba(0,0,0,0.08); flex-shrink: 0;
}
.drawer-hdr-title { flex: 1; font-size: 15px; font-weight: 700; color: #1e293b; }
.drawer-body { flex: 1; overflow-y: auto; padding: 16px 20px; }

/* Section list items */
.ssi-item {
    display: flex; align-items: center; gap: 8px;
    padding: 10px 12px; background: #fff;
    border: 1px solid rgba(0,0,0,0.08); border-radius: 9px; margin-bottom: 8px;
}
.ssi-type {
    display: inline-block; background: #f0f4ff; color: #1b3c6b;
    border-radius: 5px; padding: 3px 8px; font-size: 11px; font-weight: 700;
    font-family: monospace; flex-shrink: 0; white-space: nowrap;
}
.ssi-preview { flex: 1; font-size: 13px; color: #64748b; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.ssi-actions { display: flex; align-items: center; gap: 4px; flex-shrink: 0; }
.ssi-btn {
    width: 30px; height: 30px; border: 1px solid rgba(0,0,0,0.1);
    border-radius: 7px; background: #fff; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; transition: background .12s;
}
.ssi-btn:hover { background: #f0f4ff; }
.ssi-btn.danger { color: #ef4444; }
.ssi-btn.danger:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.25); }

/* ─── Inline Sections Panel ───────────────────── */
#page-sections-panel .ssi-item {
    transition: box-shadow .15s, border-color .15s;
}
#page-sections-panel .ssi-item:hover {
    border-color: rgba(74,115,196,0.3);
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

/* Drag handle + states */
.ssi-drag-handle {
    color: #cbd5e1; cursor: grab; font-size: 13px;
    padding: 0 3px; flex-shrink: 0; user-select: none;
    display: flex; align-items: center;
}
.ssi-drag-handle:active { cursor: grabbing; }
.ssi-item[draggable="true"] { cursor: default; }
.ssi-item.dragging { opacity: .35; background: #f0f5ff; }
.ssi-item.drag-over {
    border-color: #4a73c4;
    box-shadow: 0 0 0 2px rgba(74,115,196,0.25);
    background: #eef3ff;
}

/* Type grid inside sidebar */
.sdr-type-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 8px; margin-bottom: 16px;
    max-height: 280px; overflow-y: auto;
}
.sdr-type-card {
    display: flex; flex-direction: column; align-items: flex-start; gap: 4px;
    padding: 10px; border: 1.5px solid rgba(0,0,0,0.09); border-radius: 9px;
    cursor: pointer; background: #fff; transition: all .15s;
}
.sdr-type-card:hover { border-color: #4a73c4; background: #f0f5ff; }
.sdr-type-card.selected { border-color: #1b3c6b; background: #f0f5ff; }
.sdr-type-card-icon { font-size: 14px; color: #4a73c4; }
.sdr-type-card-name { font-size: 11px; font-weight: 600; color: #1e293b; line-height: 1.3; }

/* Sidebar settings */
.sdr-setting { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
.sdr-setting-label { font-size: 13px; font-weight: 600; color: #1e293b; }

/* ─── Wireframe utilities ──────────────────────── */
.wf  { display:flex; flex-direction:column; gap:3px; }
.wf-r { display:flex; gap:4px; align-items:flex-start; }
.wf-bar { height:6px; border-radius:2px; background:#dde5f0; flex-shrink:0; }
.wf-h   { height:9px; border-radius:2px; background:#8fa6c8; flex-shrink:0; }
.wf-card { border:1px solid #dde5f0; border-radius:5px; padding:5px; display:flex; flex-direction:column; gap:3px; }
.wf-icon { width:14px; height:14px; border-radius:50%; background:#c7d5ed; flex-shrink:0; }
.wf-dot  { width:8px;  height:8px;  border-radius:50%; flex-shrink:0; }
.wf-btn  { display:inline-block; height:13px; width:44px; border-radius:3px; background:#4a73c4; opacity:.45; }

/* ─── Library grid + cards ─────────────────────── */
.lib-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
.lib-card {
    border:1.5px solid rgba(0,0,0,0.08); border-radius:10px; overflow:hidden;
    background:#fff; cursor:pointer; transition:all .15s;
    display:flex; flex-direction:column;
}
.lib-card:hover {
    border-color:#4a73c4; transform:translateY(-1px);
    box-shadow:0 6px 18px rgba(74,115,196,0.15);
}
.lib-card-preview {
    background:#f8fafc; padding:10px;
    height:108px; overflow:hidden;
    border-bottom:1px solid rgba(0,0,0,0.06);
    display:flex; align-items:center; pointer-events:none;
}
.lib-card-preview > * { width:100%; }
.lib-card-info {
    padding:8px 10px; display:flex; align-items:center; gap:7px;
}
.lib-card-icon {
    width:26px; height:26px; border-radius:7px;
    background:#f0f4ff; display:flex; align-items:center; justify-content:center;
    color:#4a73c4; font-size:12px; flex-shrink:0;
}
.lib-card-name { font-size:11.5px; font-weight:700; color:#1e293b; line-height:1.3; flex:1; }
.lib-card-add {
    width:24px; height:24px; border:1px solid rgba(74,115,196,0.25);
    border-radius:6px; background:#fff; cursor:pointer;
    display:flex; align-items:center; justify-content:center;
    color:#4a73c4; font-size:12px; flex-shrink:0; transition:all .12s;
}
.lib-card-add:hover { background:#4a73c4; color:#fff; border-color:#4a73c4; }
</style>
@endpush

@section('content')
@php use App\Models\ServiceSection; @endphp
{{-- Builder partial: FIELD_SCHEMAS + SectionBuilder class --}}
@include('admin.service-sections.partials._builder')

<form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: {{ url('/services/' . $service->slug) }}</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Short Description</label>
                    <textarea name="short_description" class="dm-form-textarea" style="min-height:80px;">{{ old('short_description', $service->short_description) }}</textarea>
                    <div class="dm-form-hint">Shown on homepage slider card</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    <textarea name="content" class="summernote" required>{{ old('content', $service->content) }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" {{ old('status', $service->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Icon (Font Awesome class)</label>
                    <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="dm-form-input" placeholder="e.g. fa-solid fa-chart-line">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Card Image</label>
                    @if($service->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $service->image) }}" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    @endif
                    <input type="file" name="image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Hero Image</label>
                    @if($service->hero_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $service->hero_image) }}" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    @endif
                    <input type="file" name="hero_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    @if($service->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $service->featured_image) }}" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                    <div class="dm-form-hint">Full-width image shown below hero on detail page</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="dm-form-input">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;">{{ old('meta_description', $service->meta_description) }}</textarea>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="show_on_homepage" value="1" {{ old('show_on_homepage', $service->show_on_homepage) ? 'checked' : '' }}>
                        <label class="dm-form-label" style="margin:0;">Show on Homepage Slider</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Service
                </button>
            </div>
        </div>
    </div>
</form>

{{-- ══════════════ INLINE SECTIONS LIST ══════════════ --}}
<div id="page-sections-panel" class="dm-table-wrap" style="padding:20px 24px;margin-top:24px;">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <div>
            <h6 style="font-size:15px;font-weight:700;color:#1e293b;margin:0;">
                <i class="fa-solid fa-layer-group" style="color:#4a73c4;margin-right:6px;"></i>Page Sections
            </h6>
            <p style="font-size:12px;color:#94a3b8;margin:4px 0 0;" id="page-sections-subtitle"></p>
        </div>
        <div style="display:flex;align-items:center;gap:8px;">
            <a href="{{ route('admin.services.sections.index', $service) }}" target="_blank"
               class="dm-btn dm-btn-outline dm-btn-sm" title="Full sections manager">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>
            <button onclick="openSectionAdd()" class="dm-btn dm-btn-primary dm-btn-sm">
                <i class="fa-solid fa-plus"></i> Add Section
            </button>
        </div>
    </div>
    <div id="page-sections-list">
        <p style="text-align:center;color:#94a3b8;padding:30px 0;">
            <i class="fa-solid fa-spinner fa-spin"></i> Loading…
        </p>
    </div>
</div>

{{-- ══════════════ SECTIONS SIDEBAR DRAWER ══════════════ --}}
<div id="sections-overlay" onclick="closeSectionsSidebar()"></div>

<div id="sections-drawer">
    {{-- Drawer Header --}}
    <div class="drawer-hdr">
        <button id="drawer-back-btn" onclick="drawerBack()"
            style="display:none;background:none;border:none;cursor:pointer;padding:4px 8px;border-radius:6px;color:#4a73c4;font-size:13px;font-weight:600;">
            <i class="fa-solid fa-arrow-left"></i> Back
        </button>
        <span class="drawer-hdr-title" id="drawer-title">
            <i class="fa-solid fa-layer-group"></i> Page Sections
        </span>
        <a href="{{ route('admin.services.sections.index', $service) }}" target="_blank"
            style="font-size:11px;color:#4a73c4;text-decoration:none;margin-right:4px;" title="Open full Sections page">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
        <button onclick="closeSectionsSidebar()"
            style="background:none;border:none;cursor:pointer;width:32px;height:32px;border-radius:8px;color:#64748b;font-size:20px;display:flex;align-items:center;justify-content:center;line-height:1;">×</button>
    </div>

    {{-- Drawer Body --}}
    <div class="drawer-body">

        {{-- ─── LIBRARY VIEW ─── --}}
        <div id="sidebar-library-view" style="display:none;">
            <p style="font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:12px;text-transform:uppercase;letter-spacing:.8px;">
                Choose a section layout to add
            </p>
            <div id="lib-grid" class="lib-grid">
                {{-- generated by renderLibrary() --}}
            </div>
        </div>

        {{-- ─── FORM VIEW (Add / Edit) ─── --}}
        <div id="sidebar-form-view" style="display:none;">

            {{-- Type Picker — shown only in Add mode --}}
            <div id="sidebar-type-picker" style="display:none;">
                <p style="font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:10px;text-transform:uppercase;letter-spacing:.8px;">Choose Section Type</p>
                <div class="sdr-type-grid">
                    @foreach(ServiceSection::sectionTypes() as $key => $meta)
                    <div class="sdr-type-card" data-type="{{ $key }}" onclick="sidebarSelectType('{{ $key }}')">
                        <span class="sdr-type-card-icon"><i class="fa-solid fa-layer-group"></i></span>
                        <span class="sdr-type-card-name">{{ explode(' — ', $meta['label'])[0] }}</span>
                    </div>
                    @endforeach
                </div>
                <hr style="border:none;border-top:1px solid rgba(0,0,0,0.07);margin:4px 0 16px;">
            </div>

            {{-- Builder + Settings + Actions --}}
            <div id="sidebar-builder-wrap" style="display:none;">
                {{-- Section type badge (shown in edit mode) --}}
                <div id="sidebar-type-badge" style="margin-bottom:14px;display:none;">
                    <span style="font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.8px;">Section Type: </span>
                    <span id="sidebar-type-badge-val" style="font-family:monospace;color:#1b3c6b;font-weight:700;font-size:13px;"></span>
                </div>

                {{-- Field builder --}}
                <div id="sidebar-builder-container" class="sb-container" style="margin-bottom:16px;"></div>

                {{-- Settings panel --}}
                <div style="background:#fff;border:1px solid rgba(0,0,0,0.08);border-radius:10px;padding:14px 16px;margin-bottom:14px;">
                    <div class="sdr-setting">
                        <label class="sdr-setting-label">Sort Order</label>
                        <input type="number" id="sidebar-sort-input" class="dm-form-input" style="width:80px;text-align:center;" placeholder="Auto">
                    </div>
                    <div class="sdr-setting" style="margin-bottom:0;">
                        <label class="sdr-setting-label">Active</label>
                        <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                            <input type="checkbox" id="sidebar-active-check" checked style="accent-color:#1b3c6b;width:15px;height:15px;">
                            <span style="font-size:12px;color:#64748b;">Show on page</span>
                        </label>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div style="display:flex;gap:8px;margin-bottom:14px;">
                    <button type="button" id="sidebar-save-btn" onclick="sidebarSave()" class="dm-btn dm-btn-primary" style="flex:1;justify-content:center;">
                        <i class="fa-solid fa-floppy-disk"></i> Save
                    </button>
                    <button type="button" onclick="sidebarUpdatePreview()" class="dm-btn dm-btn-outline" style="justify-content:center;">
                        <i class="fa-solid fa-eye"></i> Preview
                    </button>
                </div>

                {{-- Live preview --}}
                <p style="font-size:13px;font-weight:700;color:#1e293b;margin-bottom:8px;">
                    <i class="fa-solid fa-desktop"></i> Live Preview
                </p>
                <iframe name="sidebar-preview-frame" id="sidebar-preview-frame"
                    style="width:100%;height:320px;border:1px solid rgba(0,0,0,0.1);border-radius:10px;background:#f8fafc;"></iframe>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
/* ═══════════════════════════════════════════════
   Sections — inline list + sidebar drawer
   (library → add / direct edit)
   ═══════════════════════════════════════════════ */
const previewUrl   = '{{ route("admin.section-preview") }}';
const csrf         = '{{ csrf_token() }}';
const sectionsBase = '{{ rtrim(route("admin.services.sections.index", $service), "/") }}';

let sidebarMode       = 'library'; // 'library' | 'add' | 'edit'
let editingSectionId  = null;
let drawerCurrentType = null;
let sectionsList      = @json($service->sections()->orderBy('sort_order')->get());

const drawerBuilder = new SectionBuilder(document.getElementById('sidebar-builder-container'));

/* ═══════════════════════════════════════════════
   Section Library — wireframe previews
   ═══════════════════════════════════════════════ */

/* Helper shortcuts for cleaner wireframe HTML */
const B  = (w) => `<div class="wf-bar" style="width:${w}%;"></div>`;
const H  = (w) => `<div class="wf-h"  style="width:${w}%;"></div>`;
const Hc = (w) => `<div class="wf-h"  style="width:${w}%;margin:0 auto;"></div>`;
const IC = `<div class="wf-icon"></div>`;
const DOT= `<div class="wf-dot" style="background:#22c55e;opacity:.65;"></div>`;
const SQ = `<div class="wf-dot" style="background:#4a73c4;opacity:.4;border-radius:3px;"></div>`;
const NUM= (n) => `<div style="width:16px;height:16px;border-radius:50%;background:#4a73c4;opacity:.4;font-size:8px;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">${n}</div>`;
const BTN= `<div class="wf-btn"></div>`;
const PILL=(w)=>`<div style="height:14px;width:${w}px;border-radius:10px;background:#dde5f0;"></div>`;
const BADGE=(w)=>`<div style="height:13px;width:${w}px;border-radius:4px;background:#dde5f0;"></div>`;

const SECTION_WF = {

  'hero': `
    <div class="wf" style="align-items:center;">
      ${Hc(75)} ${B(55)} ${B(45)}
      <div style="margin-top:3px;">${BTN}</div>
    </div>`,

  'overview': `
    <div class="wf-r">
      <div class="wf" style="flex:3;">${H(90)}${B(100)}${B(90)}${B(75)}</div>
      <div style="flex:2;display:grid;grid-template-columns:1fr 1fr;gap:3px;">
        <div class="wf-card">${H(60)}${B(80)}</div>
        <div class="wf-card">${H(60)}${B(80)}</div>
        <div class="wf-card">${H(60)}${B(80)}</div>
        <div class="wf-card">${H(60)}${B(80)}</div>
      </div>
    </div>`,

  'services-grid': `
    <div class="wf">
      ${Hc(55)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf-card" style="flex:1;">${IC}${H(80)}${B(100)}${B(70)}</div>
        <div class="wf-card" style="flex:1;">${IC}${H(80)}${B(100)}${B(70)}</div>
        <div class="wf-card" style="flex:1;">${IC}${H(80)}${B(100)}${B(70)}</div>
      </div>
    </div>`,

  'process-steps': `
    <div class="wf">
      ${H(50)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf" style="align-items:center;flex:1;">${NUM(1)}${B(90)}${B(70)}</div>
        <div class="wf" style="align-items:center;flex:1;">${NUM(2)}${B(90)}${B(70)}</div>
        <div class="wf" style="align-items:center;flex:1;">${NUM(3)}${B(90)}${B(70)}</div>
        <div class="wf" style="align-items:center;flex:1;">${NUM(4)}${B(90)}${B(70)}</div>
      </div>
    </div>`,

  'why-stand-out': `
    <div class="wf">
      ${Hc(50)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf-card" style="flex:1;">${IC}${H(75)}${B(100)}${B(80)}</div>
        <div class="wf-card" style="flex:1;">${IC}${H(75)}${B(100)}${B(80)}</div>
        <div class="wf-card" style="flex:1;">${IC}${H(75)}${B(100)}${B(80)}</div>
      </div>
    </div>`,

  'faq': `
    <div class="wf">
      ${Hc(45)}
      <div class="wf-card" style="flex-direction:row;align-items:center;justify-content:space-between;gap:4px;">
        ${B(70)}<div style="width:10px;height:10px;border-radius:2px;background:#dde5f0;flex-shrink:0;"></div>
      </div>
      <div class="wf-card" style="flex-direction:row;align-items:center;justify-content:space-between;gap:4px;">
        ${B(80)}<div style="width:10px;height:10px;border-radius:2px;background:#dde5f0;flex-shrink:0;"></div>
      </div>
      <div class="wf-card" style="background:#f0f5ff;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:4px;">${B(70)}<div style="width:10px;height:10px;border-radius:2px;background:#4a73c4;opacity:.4;flex-shrink:0;"></div></div>
        ${B(100)}${B(85)}
      </div>
    </div>`,

  'other-services': `
    <div class="wf">
      ${Hc(50)}
      <div style="display:flex;flex-wrap:wrap;gap:4px;margin-top:5px;">
        ${PILL(52)}${PILL(62)}${PILL(44)}${PILL(56)}${PILL(40)}${PILL(68)}
      </div>
    </div>`,

  'benefits-list': `
    <div class="wf">
      ${H(50)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf" style="flex:1;gap:4px;">
          <div class="wf-r">${DOT}${B(90)}</div>
          <div class="wf-r">${DOT}${B(80)}</div>
          <div class="wf-r">${DOT}${B(90)}</div>
        </div>
        <div class="wf" style="flex:1;gap:4px;">
          <div class="wf-r">${DOT}${B(90)}</div>
          <div class="wf-r">${DOT}${B(80)}</div>
          <div class="wf-r">${DOT}${B(90)}</div>
        </div>
      </div>
    </div>`,

  'markets-served': `
    <div class="wf">
      ${Hc(50)}
      <div style="display:flex;flex-wrap:wrap;gap:3px;margin-top:5px;">
        ${BADGE(42)}${BADGE(56)}${BADGE(36)}${BADGE(50)}${BADGE(44)}${BADGE(60)}${BADGE(38)}${BADGE(52)}
      </div>
    </div>`,

  'trust-signals': `
    <div class="wf">
      ${Hc(50)}
      <div class="wf-r" style="justify-content:space-around;margin-top:6px;">
        <div class="wf" style="align-items:center;gap:3px;">${IC}${B(40)}</div>
        <div class="wf" style="align-items:center;gap:3px;">${IC}${B(40)}</div>
        <div class="wf" style="align-items:center;gap:3px;">${IC}${B(40)}</div>
        <div class="wf" style="align-items:center;gap:3px;">${IC}${B(40)}</div>
      </div>
    </div>`,

  'cpa-reality': `
    <div style="background:#1b3c6b;border-radius:6px;padding:8px;" class="wf">
      <div style="height:9px;border-radius:2px;background:rgba(255,255,255,.55);width:60%;margin-bottom:5px;"></div>
      <div style="height:6px;border-radius:2px;background:rgba(255,255,255,.25);width:90%;margin-bottom:3px;"></div>
      <div style="height:6px;border-radius:2px;background:rgba(255,255,255,.25);width:80%;margin-bottom:3px;"></div>
      <div style="height:6px;border-radius:2px;background:rgba(255,255,255,.25);width:70%;"></div>
    </div>`,

  'three-layer': `
    <div class="wf">
      ${Hc(50)}
      <div class="wf" style="gap:2px;margin-top:4px;">
        <div style="background:#1b3c6b;opacity:.18;border-radius:4px;padding:4px 6px;">${H(55)}</div>
        <div style="background:#1b3c6b;opacity:.28;border-radius:4px;padding:4px 6px;margin-left:8px;">${H(55)}</div>
        <div style="background:#1b3c6b;opacity:.4;border-radius:4px;padding:4px 6px;margin-left:16px;">${H(55)}</div>
      </div>
    </div>`,

  'comparison-table': `
    <div class="wf">
      ${Hc(50)}
      <div class="wf-r" style="border:1px solid #dde5f0;border-radius:5px;overflow:hidden;margin-top:4px;">
        <div style="flex:1;border-right:1px solid #dde5f0;">
          <div style="background:#e0e7f5;padding:3px 5px;margin-bottom:3px;"><div class="wf-bar" style="width:70%;background:#4a73c4;opacity:.4;"></div></div>
          <div style="padding:2px 5px;">${B(90)}${B(80)}</div>
        </div>
        <div style="flex:1;">
          <div style="background:#e0e7f5;padding:3px 5px;margin-bottom:3px;"><div class="wf-bar" style="width:70%;background:#4a73c4;opacity:.4;"></div></div>
          <div style="padding:2px 5px;">${B(90)}${B(80)}</div>
        </div>
      </div>
    </div>`,

  'engagement-models': `
    <div class="wf">
      ${Hc(60)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf-card" style="flex:1;">${H(80)}${B(100)}${B(85)}${B(90)}</div>
        <div class="wf-card" style="flex:1;">${H(80)}${B(100)}${B(85)}${B(90)}</div>
      </div>
    </div>`,

  'pillars': `
    <div class="wf">
      ${Hc(45)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf-card" style="flex:1;border-top:3px solid #4a73c4;">${H(80)}${B(100)}${B(90)}</div>
        <div class="wf-card" style="flex:1;border-top:3px solid #4a73c4;">${H(80)}${B(100)}${B(90)}</div>
        <div class="wf-card" style="flex:1;border-top:3px solid #4a73c4;">${H(80)}${B(100)}${B(90)}</div>
      </div>
    </div>`,

  'governance': `
    <div class="wf">
      ${Hc(50)}
      <div class="wf-r" style="margin-top:4px;">
        <div class="wf" style="flex:1;gap:4px;">
          ${H(70)}
          <div class="wf-r">${SQ}${B(100)}</div>
          <div class="wf-r">${SQ}${B(100)}</div>
          <div class="wf-r">${SQ}${B(85)}</div>
        </div>
        <div class="wf" style="flex:1;gap:4px;">
          ${H(70)}
          <div class="wf-r">${SQ}${B(100)}</div>
          <div class="wf-r">${SQ}${B(100)}</div>
          <div class="wf-r">${SQ}${B(85)}</div>
        </div>
      </div>
    </div>`,
};

/* ── Render the library grid ─────────────────── */
let _libraryRendered = false;

function renderLibrary() {
    if (_libraryRendered) return;
    _libraryRendered = true;

    const grid = document.getElementById('lib-grid');
    grid.innerHTML = Object.entries(FIELD_SCHEMAS).map(([type, schema]) => {
        const wf   = SECTION_WF[type] || `<div class="wf">${H(60)}${B(100)}${B(80)}</div>`;
        const name = schema.label.split(' — ')[0];
        return `
        <div class="lib-card" onclick="openAddFromLibrary('${type}')">
            <div class="lib-card-preview">${wf}</div>
            <div class="lib-card-info">
                <div class="lib-card-icon"><i class="${schema.icon || 'fa-solid fa-layer-group'}"></i></div>
                <span class="lib-card-name">${name}</span>
                <button class="lib-card-add" title="Add this section" onclick="event.stopPropagation();openAddFromLibrary('${type}')">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </div>`;
    }).join('');
}

/* ── Drawer navigation ───────────────────────── */
function drawerBack() {
    if (sidebarMode === 'add') showSidebarLibrary();
    else closeSectionsSidebar();
}

/* ── Open / Close drawer ─────────────────────── */
function openSectionAdd() {
    showSidebarLibrary();
    document.getElementById('sections-overlay').style.display = 'block';
    document.getElementById('sections-drawer').classList.add('open');
}

function openSectionEdit(sectionId) {
    showSidebarEdit(sectionId);
    document.getElementById('sections-overlay').style.display = 'block';
    document.getElementById('sections-drawer').classList.add('open');
}

function openAddFromLibrary(type) {
    showSidebarAdd();
    sidebarSelectType(type);
}

function closeSectionsSidebar() {
    document.getElementById('sections-overlay').style.display = 'none';
    document.getElementById('sections-drawer').classList.remove('open');
}

/* ── Drawer: Library view ────────────────────── */
function showSidebarLibrary() {
    sidebarMode = 'library';
    renderLibrary();
    document.getElementById('sidebar-library-view').style.display = '';
    document.getElementById('sidebar-form-view').style.display    = 'none';
    document.getElementById('drawer-back-btn').style.display      = 'none';
    document.getElementById('drawer-title').innerHTML = '<i class="fa-solid fa-swatchbook" style="color:#4a73c4;margin-right:6px;"></i>Section Library';
}

/* ── Drawer: Add mode ────────────────────────── */
function showSidebarAdd() {
    sidebarMode       = 'add';
    editingSectionId  = null;
    drawerCurrentType = null;
    document.getElementById('sidebar-library-view').style.display  = 'none';
    document.getElementById('sidebar-form-view').style.display     = '';
    document.getElementById('drawer-back-btn').style.display       = '';
    document.getElementById('drawer-title').textContent = 'Add New Section';
    document.getElementById('sidebar-type-picker').style.display   = 'none'; // type chosen from library
    document.getElementById('sidebar-builder-wrap').style.display  = 'none';
    document.getElementById('sidebar-type-badge').style.display    = 'none';
    document.getElementById('sidebar-sort-input').value = '';
    document.getElementById('sidebar-active-check').checked = true;
    document.querySelectorAll('.sdr-type-card').forEach(c => c.classList.remove('selected'));
}

/* ── Drawer: Edit mode ───────────────────────── */
function showSidebarEdit(sectionId) {
    const section = sectionsList.find(s => s.id == sectionId);
    if (!section) return;
    sidebarMode       = 'edit';
    editingSectionId  = sectionId;
    drawerCurrentType = section.section_type;

    document.getElementById('sidebar-library-view').style.display  = 'none';
    document.getElementById('sidebar-form-view').style.display     = '';
    document.getElementById('drawer-back-btn').style.display       = '';
    document.getElementById('drawer-title').textContent = 'Edit Section';
    document.getElementById('sidebar-type-picker').style.display   = 'none';
    document.getElementById('sidebar-builder-wrap').style.display  = '';
    document.getElementById('sidebar-type-badge').style.display    = '';
    document.getElementById('sidebar-type-badge-val').textContent  = section.section_type;

    document.getElementById('sidebar-save-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Save Changes';
    document.getElementById('sidebar-sort-input').value  = section.sort_order;
    document.getElementById('sidebar-active-check').checked = !!section.is_active;

    drawerBuilder.render(section.section_type, section.section_data || {});
    sidebarUpdatePreview();
}

/* ── Select type (from library card) ────────── */
function sidebarSelectType(type) {
    if (!FIELD_SCHEMAS[type]) return;
    drawerCurrentType = type;
    document.getElementById('sidebar-builder-wrap').style.display = '';
    document.getElementById('sidebar-type-badge').style.display   = '';
    document.getElementById('sidebar-type-badge-val').textContent = type;
    document.getElementById('sidebar-save-btn').innerHTML = '<i class="fa-solid fa-plus"></i> Add Section';
    drawerBuilder.render(type, {});
    sidebarUpdatePreview();
}

/* ── Preview ─────────────────────────────────── */
function sidebarUpdatePreview() {
    if (!drawerCurrentType) return;
    const data = drawerBuilder.getData();
    const form = document.createElement('form');
    form.method = 'POST'; form.action = previewUrl;
    form.target = 'sidebar-preview-frame'; form.style.display = 'none';
    const add = (n, v) => { const i = document.createElement('input'); i.name = n; i.value = v; form.appendChild(i); };
    add('_token', csrf); add('type', drawerCurrentType); add('data', JSON.stringify(data));
    document.body.appendChild(form); form.submit(); document.body.removeChild(form);
}

/* ── Render inline sections list ─────────────── */
function renderSectionsList() {
    const container = document.getElementById('page-sections-list');
    const subtitle  = document.getElementById('page-sections-subtitle');

    if (!sectionsList.length) {
        subtitle.textContent = '';
        container.innerHTML = `
            <div style="text-align:center;padding:40px 0;color:#94a3b8;">
                <i class="fa-solid fa-layer-group" style="font-size:32px;display:block;margin-bottom:12px;opacity:.25;"></i>
                <p style="margin:0;">No sections yet — click <strong>Add Section</strong> to create one.</p>
            </div>`;
        return;
    }

    subtitle.textContent = sectionsList.length + ' section(s) — drag to reorder';
    container.innerHTML = sectionsList.map(s => {
        const d = s.section_data || {};
        const preview = d.title || d.label || (Array.isArray(d.items) && d.items[0] && d.items[0].title) || '';
        const trunc   = preview ? preview.substring(0, 60) : '—';
        const onIcon  = s.is_active ? 'fa-toggle-on' : 'fa-toggle-off';
        const onColor = s.is_active ? '#22c55e' : '#d1d5db';
        return `
        <div class="ssi-item" data-id="${s.id}" draggable="true" style="${s.is_active ? '' : 'opacity:.55;'}">
            <span class="ssi-drag-handle" title="Drag to reorder"><i class="fa-solid fa-grip-vertical"></i></span>
            <span class="ssi-type">${s.section_type}</span>
            <span class="ssi-preview" title="${preview}">${trunc}</span>
            <div class="ssi-actions">
                <button class="ssi-btn" onclick="sidebarToggle(${s.id})" title="${s.is_active ? 'Deactivate' : 'Activate'}" style="color:${onColor};" draggable="false">
                    <i class="fa-solid ${onIcon}"></i>
                </button>
                <button class="ssi-btn" onclick="openSectionEdit(${s.id})" title="Edit" draggable="false">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="ssi-btn danger" onclick="sidebarDelete(${s.id})" title="Delete" draggable="false">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>`;
    }).join('');

    initSectionsDragDrop();
}

/* ── Drag and Drop reorder ───────────────────── */
let _dndReady  = false;
let _dragSrcId = null;

function initSectionsDragDrop() {
    const list = document.getElementById('page-sections-list');
    if (!list || _dndReady) return;
    _dndReady = true;

    list.addEventListener('dragstart', e => {
        const item = e.target.closest('.ssi-item');
        if (!item) return;
        _dragSrcId = parseInt(item.dataset.id);
        item.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', String(_dragSrcId));
    });

    list.addEventListener('dragend', () => {
        list.querySelectorAll('.ssi-item').forEach(i => i.classList.remove('dragging', 'drag-over'));
        _dragSrcId = null;
    });

    list.addEventListener('dragover', e => {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        const item = e.target.closest('.ssi-item');
        if (!item) return;
        list.querySelectorAll('.ssi-item').forEach(i => i.classList.remove('drag-over'));
        if (parseInt(item.dataset.id) !== _dragSrcId) item.classList.add('drag-over');
    });

    list.addEventListener('dragleave', e => {
        if (!list.contains(e.relatedTarget))
            list.querySelectorAll('.ssi-item').forEach(i => i.classList.remove('drag-over'));
    });

    list.addEventListener('drop', e => {
        e.preventDefault();
        const targetItem = e.target.closest('.ssi-item');
        if (!targetItem || !_dragSrcId) return;
        const targetId = parseInt(targetItem.dataset.id);
        if (targetId === _dragSrcId) return;
        const srcIdx = sectionsList.findIndex(s => s.id === _dragSrcId);
        const tgtIdx = sectionsList.findIndex(s => s.id === targetId);
        if (srcIdx === -1 || tgtIdx === -1) return;
        const [moved] = sectionsList.splice(srcIdx, 1);
        sectionsList.splice(tgtIdx, 0, moved);
        _dndReady = false;
        renderSectionsList();
        sidebarReorder();
    });
}

async function sidebarReorder() {
    const payload = new FormData();
    payload.append('_token', csrf);
    sectionsList.forEach(s => payload.append('order[]', s.id));
    try {
        await fetch(sectionsBase + '/reorder', {
            method: 'POST', body: payload,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }
        });
        sectionsList.forEach((s, i) => { s.sort_order = i; });
    } catch (e) { /* fail silently */ }
}

/* ── Save (add / edit) ───────────────────────── */
async function sidebarSave() {
    if (!drawerCurrentType) { alert('Please select a section type.'); return; }
    const btn      = document.getElementById('sidebar-save-btn');
    const origHtml = btn.innerHTML;
    btn.disabled   = true;
    btn.innerHTML  = '<i class="fa-solid fa-spinner fa-spin"></i> Saving…';

    const payload = new FormData();
    payload.append('section_type', drawerCurrentType);
    payload.append('section_data', JSON.stringify(drawerBuilder.getData()));
    payload.append('sort_order', document.getElementById('sidebar-sort-input').value);
    payload.append('is_active', document.getElementById('sidebar-active-check').checked ? '1' : '0');

    let url = sectionsBase;
    if (sidebarMode === 'edit') {
        payload.append('_method', 'PUT');
        url = sectionsBase + '/' + editingSectionId;
    }

    try {
        const res  = await fetch(url, {
            method: 'POST', body: payload,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }
        });
        const json = await res.json();
        if (json.success) {
            await reloadSections();
            closeSectionsSidebar();
        } else {
            alert(json.error || 'Save failed. Please try again.');
        }
    } catch (e) {
        alert('Network error. Please try again.');
    } finally {
        btn.disabled  = false;
        btn.innerHTML = origHtml;
    }
}

/* ── Delete ──────────────────────────────────── */
async function sidebarDelete(sectionId) {
    if (!confirm('Delete this section? This cannot be undone.')) return;
    const payload = new FormData();
    payload.append('_method', 'DELETE');
    payload.append('_token', csrf);
    try {
        await fetch(sectionsBase + '/' + sectionId, {
            method: 'POST', body: payload,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }
        });
        await reloadSections();
    } catch (e) { alert('Error deleting section.'); }
}

/* ── Toggle active ───────────────────────────── */
async function sidebarToggle(sectionId) {
    const payload = new FormData();
    payload.append('_token', csrf);
    try {
        await fetch(sectionsBase + '/' + sectionId + '/toggle', {
            method: 'POST', body: payload,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }
        });
        await reloadSections();
    } catch (e) { alert('Error toggling section.'); }
}

/* ── Reload sections from server ─────────────── */
async function reloadSections() {
    try {
        const res = await fetch(sectionsBase, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf }
        });
        sectionsList = await res.json();
        renderSectionsList();
    } catch (e) { /* silently fail */ }
}

/* ── Boot ────────────────────────────────────── */
renderSectionsList(); // show list immediately on page load
</script>
@endpush
