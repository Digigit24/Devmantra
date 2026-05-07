@extends('layouts.admin')
@section('title', 'Edit Section — ' . $service->title)

@section('actions')
<a href="{{ route('admin.services.sections.index', $service) }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Sections
</a>
@endsection

@push('styles')
<style>
.ss-editor-grid { display: grid; grid-template-columns: 1fr 420px; gap: 20px; align-items: start; }
@media(max-width:1100px){ .ss-editor-grid { grid-template-columns: 1fr; } }
.ss-preview-wrap { position: sticky; top: 90px; }
.ss-preview-iframe { width:100%; height:520px; border:1px solid rgba(0,0,0,0.1); border-radius:12px; background:#f8fafc; overflow:hidden; }
.ss-panel { background:#fff; border:1px solid rgba(0,0,0,0.08); border-radius:12px; padding:20px; margin-bottom:16px; }
.ss-panel-title { font-size:13px; font-weight:700; color:#1e293b; margin-bottom:16px; }
.ss-type-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:8px; max-height:260px; overflow-y:auto; }
.ss-type-card { display:flex; flex-direction:column; align-items:flex-start; gap:4px; padding:10px 12px; border:1.5px solid rgba(0,0,0,0.09); border-radius:9px; cursor:pointer; transition:all .15s; background:#fff; }
.ss-type-card:hover { border-color:#4a73c4; background:#f0f5ff; }
.ss-type-card.selected { border-color:#1b3c6b; background:#f0f5ff; }
.ss-type-card-icon { font-size:14px; color:#4a73c4; }
.ss-type-card-name { font-size:11px; font-weight:600; color:#1e293b; line-height:1.3; }
.ss-setting-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; }
.ss-setting-label { font-size:13px; font-weight:600; color:#1e293b; }
</style>
@endpush

@section('content')
@include('admin.service-sections.partials._builder')

<form method="POST" action="{{ route('admin.services.sections.update', [$service, $section]) }}" id="section-form">
    @csrf @method('PUT')
    <input type="hidden" name="section_type" id="hidden-type" value="{{ $section->section_type }}">
    <input type="hidden" name="section_data" id="hidden-data" value="{}">
    <input type="hidden" name="sort_order" id="hidden-order" value="{{ $section->sort_order }}">
    <input type="hidden" name="is_active" id="hidden-active" value="{{ $section->is_active ? '1' : '0' }}">

    <div class="ss-editor-grid">
        {{-- LEFT: Field Builder --}}
        <div>
            <div class="dm-table-wrap" style="padding:24px; min-height:500px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
                    <h3 style="font-size:16px;font-weight:700;margin:0;">Section Content</h3>
                    <span id="type-badge" style="font-size:11px;color:#4a73c4;font-weight:600;"></span>
                </div>
                <div id="builder-container" class="sb-container"></div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="ss-preview-wrap">
            {{-- Type Picker --}}
            <div class="ss-panel">
                <div class="ss-panel-title"><i class="fa-solid fa-shapes"></i> Section Type</div>
                <div class="ss-type-grid" id="type-grid">
                    @foreach(ServiceSection::sectionTypes() as $key => $meta)
                    <div class="ss-type-card {{ $section->section_type === $key ? 'selected' : '' }}"
                         data-type="{{ $key }}" onclick="selectType('{{ $key }}', false)">
                        <span class="ss-type-card-icon"><i class="fa-solid fa-layer-group"></i></span>
                        <span class="ss-type-card-name">{{ explode(' — ', $meta['label'])[0] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Settings --}}
            <div class="ss-panel">
                <div class="ss-panel-title"><i class="fa-solid fa-sliders"></i> Settings</div>
                <div class="ss-setting-row">
                    <label class="ss-setting-label">Sort Order</label>
                    <input type="number" id="sort-order-input" value="{{ $section->sort_order }}" class="dm-form-input" style="width:90px;text-align:center;">
                </div>
                <div class="ss-setting-row" style="margin-bottom:0;">
                    <label class="ss-setting-label">Active</label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;">
                        <input type="checkbox" id="active-checkbox" {{ $section->is_active ? 'checked' : '' }} style="accent-color:#1b3c6b;width:16px;height:16px;">
                        <span style="font-size:12px;color:#64748b;">Show on page</span>
                    </label>
                </div>
            </div>

            {{-- Save + Preview --}}
            <div class="ss-panel">
                <button type="submit" class="dm-btn dm-btn-primary w-100 mb-2" style="justify-content:center;">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>
                <button type="button" onclick="updatePreview()" class="dm-btn dm-btn-outline w-100" style="justify-content:center;">
                    <i class="fa-solid fa-eye"></i> Update Preview
                </button>
            </div>

            {{-- Live Preview iframe --}}
            <div>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
                    <h3 style="font-size:14px;font-weight:700;margin:0;"><i class="fa-solid fa-desktop"></i> Live Preview</h3>
                    <span style="font-size:11px;color:#94a3b8;">Auto-loads on page open</span>
                </div>
                <iframe name="preview-frame" id="preview-frame" class="ss-preview-iframe"></iframe>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
const builder = new SectionBuilder(document.getElementById('builder-container'));
const previewUrl = '{{ route("admin.section-preview") }}';
const csrf = '{{ csrf_token() }}';
let currentType = '{{ $section->section_type }}';
const existingData = @json($section->section_data ?? []);

function selectType(type, loadEmpty) {
    if (!FIELD_SCHEMAS[type]) return;
    currentType = type;
    document.getElementById('hidden-type').value = type;

    document.querySelectorAll('.ss-type-card').forEach(c => c.classList.remove('selected'));
    document.querySelector(`.ss-type-card[data-type="${type}"]`)?.classList.add('selected');

    const schema = FIELD_SCHEMAS[type];
    document.getElementById('type-badge').textContent = schema ? schema.label : '';

    const data = (loadEmpty === false && type === '{{ $section->section_type }}') ? existingData : {};
    builder.render(type, data);
    updatePreview();
}

function updatePreview() {
    if (!currentType) return;
    const data = builder.getData();
    const form = document.createElement('form');
    form.method = 'POST'; form.action = previewUrl; form.target = 'preview-frame'; form.style.display = 'none';
    const add = (n, v) => { const i = document.createElement('input'); i.name=n; i.value=v; form.appendChild(i); };
    add('_token', csrf); add('type', currentType); add('data', JSON.stringify(data));
    document.body.appendChild(form); form.submit(); document.body.removeChild(form);
}

document.getElementById('section-form').addEventListener('submit', function() {
    document.getElementById('hidden-data').value = JSON.stringify(builder.getData());
    document.getElementById('hidden-order').value = document.getElementById('sort-order-input').value;
    document.getElementById('hidden-active').value = document.getElementById('active-checkbox').checked ? '1' : '0';
});

// Set icons per type
document.querySelectorAll('.ss-type-card').forEach(card => {
    const s = FIELD_SCHEMAS[card.dataset.type];
    if (s) card.querySelector('.ss-type-card-icon i').className = s.icon || 'fa-solid fa-layer-group';
});

// Auto-load existing section
selectType(currentType, false);
</script>
@endpush
