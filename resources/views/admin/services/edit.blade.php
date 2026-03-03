@extends('layouts.admin')
@section('title', 'Edit Service')

@section('actions')
<button type="button" onclick="openSectionsSidebar()" class="dm-btn dm-btn-sm" style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;margin-right:8px;">
    <i class="fa-solid fa-layer-group"></i> Sections
    @php $sectionCount = $service->sections()->count(); @endphp
    @if($sectionCount)<span id="sections-badge" style="background:rgba(255,255,255,0.25);border-radius:10px;padding:1px 7px;font-size:12px;margin-left:4px;">{{ $sectionCount }}</span>@endif
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

{{-- ══════════════ SECTIONS SIDEBAR DRAWER ══════════════ --}}
<div id="sections-overlay" onclick="closeSectionsSidebar()"></div>

<div id="sections-drawer">
    {{-- Drawer Header --}}
    <div class="drawer-hdr">
        <button id="drawer-back-btn" onclick="showSidebarList()"
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

        {{-- ─── LIST VIEW ─── --}}
        <div id="sidebar-list-view">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                <p style="font-size:12px;color:#94a3b8;margin:0;" id="sidebar-list-subtitle"></p>
                <button onclick="showSidebarAdd()" class="dm-btn dm-btn-primary dm-btn-sm">
                    <i class="fa-solid fa-plus"></i> Add Section
                </button>
            </div>
            <div id="sidebar-sections-list">
                <p style="text-align:center;color:#94a3b8;padding:30px 0;">
                    <i class="fa-solid fa-spinner fa-spin"></i> Loading…
                </p>
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
   Sections Sidebar
   ═══════════════════════════════════════════════ */
const previewUrl  = '{{ route("admin.section-preview") }}';
const csrf        = '{{ csrf_token() }}';
const sectionsBase = '{{ rtrim(route("admin.services.sections.index", $service), "/") }}';

let sidebarMode       = 'list'; // 'list' | 'add' | 'edit'
let editingSectionId  = null;
let drawerCurrentType = null;
let sectionsList      = @json($service->sections()->orderBy('sort_order')->get());

const drawerBuilder = new SectionBuilder(document.getElementById('sidebar-builder-container'));

/* ── Open / Close ────────────────────────────── */
function openSectionsSidebar() {
    renderSectionsList();
    showSidebarList();
    document.getElementById('sections-overlay').style.display = 'block';
    document.getElementById('sections-drawer').classList.add('open');
}

function closeSectionsSidebar() {
    document.getElementById('sections-overlay').style.display = 'none';
    document.getElementById('sections-drawer').classList.remove('open');
}

/* ── State: List ─────────────────────────────── */
function showSidebarList() {
    sidebarMode = 'list';
    document.getElementById('sidebar-list-view').style.display = '';
    document.getElementById('sidebar-form-view').style.display = 'none';
    document.getElementById('drawer-back-btn').style.display = 'none';
    document.getElementById('drawer-title').innerHTML = '<i class="fa-solid fa-layer-group"></i> Page Sections';
}

/* ── State: Add ──────────────────────────────── */
function showSidebarAdd() {
    sidebarMode = 'add';
    editingSectionId  = null;
    drawerCurrentType = null;
    document.getElementById('sidebar-list-view').style.display = 'none';
    document.getElementById('sidebar-form-view').style.display = '';
    document.getElementById('drawer-back-btn').style.display  = '';
    document.getElementById('drawer-title').textContent = 'Add New Section';
    document.getElementById('sidebar-type-picker').style.display  = '';
    document.getElementById('sidebar-builder-wrap').style.display = 'none';
    document.getElementById('sidebar-type-badge').style.display   = 'none';
    document.getElementById('sidebar-sort-input').value = '';
    document.getElementById('sidebar-active-check').checked = true;
    document.querySelectorAll('.sdr-type-card').forEach(c => c.classList.remove('selected'));
}

/* ── State: Edit ─────────────────────────────── */
function showSidebarEdit(sectionId) {
    const section = sectionsList.find(s => s.id == sectionId);
    if (!section) return;
    sidebarMode       = 'edit';
    editingSectionId  = sectionId;
    drawerCurrentType = section.section_type;

    document.getElementById('sidebar-list-view').style.display  = 'none';
    document.getElementById('sidebar-form-view').style.display  = '';
    document.getElementById('drawer-back-btn').style.display    = '';
    document.getElementById('drawer-title').textContent = 'Edit Section';
    document.getElementById('sidebar-type-picker').style.display  = 'none';
    document.getElementById('sidebar-builder-wrap').style.display = '';

    // Show type badge
    document.getElementById('sidebar-type-badge').style.display = '';
    document.getElementById('sidebar-type-badge-val').textContent = section.section_type;

    document.getElementById('sidebar-save-btn').innerHTML = '<i class="fa-solid fa-floppy-disk"></i> Save Changes';
    document.getElementById('sidebar-sort-input').value = section.sort_order;
    document.getElementById('sidebar-active-check').checked = !!section.is_active;

    drawerBuilder.render(section.section_type, section.section_data || {});
    sidebarUpdatePreview();
}

/* ── Select type (Add flow) ──────────────────── */
function sidebarSelectType(type) {
    if (!FIELD_SCHEMAS[type]) return;
    drawerCurrentType = type;
    document.querySelectorAll('.sdr-type-card').forEach(c => c.classList.remove('selected'));
    document.querySelector(`.sdr-type-card[data-type="${type}"]`)?.classList.add('selected');
    document.getElementById('sidebar-builder-wrap').style.display = '';
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

/* ── Render sections list ────────────────────── */
function renderSectionsList() {
    const container = document.getElementById('sidebar-sections-list');
    const subtitle  = document.getElementById('sidebar-list-subtitle');

    if (!sectionsList.length) {
        subtitle.textContent = '';
        container.innerHTML = `
            <div style="text-align:center;padding:40px 0;color:#94a3b8;">
                <i class="fa-solid fa-layer-group" style="font-size:28px;display:block;margin-bottom:10px;opacity:.3;"></i>
                <p>No sections yet. Add the first one!</p>
            </div>`;
        return;
    }

    subtitle.textContent = sectionsList.length + ' section(s) — drag to reorder';
    container.innerHTML = sectionsList.map(s => {
        const d = s.section_data || {};
        const preview = d.title || d.label || (Array.isArray(d.items) && d.items[0] && d.items[0].title) || '';
        const trunc   = preview ? preview.substring(0, 50) : '—';
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
                <button class="ssi-btn" onclick="showSidebarEdit(${s.id})" title="Edit" draggable="false">
                    <i class="fa-solid fa-pen"></i>
                </button>
                <button class="ssi-btn danger" onclick="sidebarDelete(${s.id})" title="Delete" draggable="false">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>`;
    }).join('');

    initSidebarDragDrop();
}

/* ── Drag and Drop reorder ───────────────────── */
let _dndReady = false;
let _dragSrcId = null;

function initSidebarDragDrop() {
    const list = document.getElementById('sidebar-sections-list');
    if (!list || _dndReady) return;
    _dndReady = true;

    list.addEventListener('dragstart', e => {
        const item = e.target.closest('.ssi-item');
        if (!item) return;
        _dragSrcId = parseInt(item.dataset.id);
        item.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', String(_dragSrcId)); // required for Firefox
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
        if (!list.contains(e.relatedTarget)) {
            list.querySelectorAll('.ssi-item').forEach(i => i.classList.remove('drag-over'));
        }
    });

    list.addEventListener('drop', e => {
        e.preventDefault();
        const targetItem = e.target.closest('.ssi-item');
        if (!targetItem) return;
        const targetId = parseInt(targetItem.dataset.id);
        if (targetId === _dragSrcId || !_dragSrcId) return;

        const srcIdx = sectionsList.findIndex(s => s.id === _dragSrcId);
        const tgtIdx = sectionsList.findIndex(s => s.id === targetId);
        if (srcIdx === -1 || tgtIdx === -1) return;

        const [moved] = sectionsList.splice(srcIdx, 1);
        sectionsList.splice(tgtIdx, 0, moved);

        _dndReady = false; // allow re-init after re-render
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
    } catch (e) { /* fail silently — order is correct locally */ }
}

/* ── Save (add / edit) ───────────────────────── */
async function sidebarSave() {
    if (!drawerCurrentType) { alert('Please select a section type.'); return; }
    const btn     = document.getElementById('sidebar-save-btn');
    const origHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Saving…';

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
            showSidebarList();
        } else {
            alert(json.error || 'Save failed. Please try again.');
        }
    } catch (e) {
        alert('Network error. Please try again.');
    } finally {
        btn.disabled = false;
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

        // Update header badge
        const badge = document.getElementById('sections-badge');
        if (badge) {
            badge.textContent = sectionsList.length;
            badge.style.display = sectionsList.length ? '' : 'none';
        }
    } catch (e) { /* silently fail — list stays stale */ }
}

/* ── Set icons on type cards ─────────────────── */
document.querySelectorAll('.sdr-type-card').forEach(card => {
    const s = FIELD_SCHEMAS[card.dataset.type];
    if (s) card.querySelector('.sdr-type-card-icon i').className = s.icon || 'fa-solid fa-layer-group';
});
</script>
@endpush
