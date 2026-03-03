@extends('layouts.admin')
@section('title', 'Edit Section — ' . $service->title)

@section('actions')
<a href="{{ route('admin.services.sections.index', $service) }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Sections
</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.services.sections.update', [$service, $section]) }}" id="section-form">
    @csrf @method('PUT')
    <div class="row g-4">
        {{-- Left: JSON editor --}}
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Section Data (JSON) *</label>
                    <textarea name="section_data" id="section-data" class="dm-form-textarea @error('section_data') is-invalid @enderror"
                        style="font-family:monospace;font-size:13px;min-height:420px;white-space:pre;" required>{{ old('section_data', json_encode($section->section_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
                    @error('section_data')<div style="color:#ef4444;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
                    <div class="dm-form-hint" style="margin-top:8px;">
                        <i class="fa-solid fa-circle-info"></i>
                        Edit the JSON content. The schema hint on the right shows expected keys.
                    </div>
                </div>
                <div id="json-status" style="font-size:13px;margin-top:8px;display:flex;align-items:center;gap:6px;">
                    <i class="fa-solid fa-circle-check" style="color:#22c55e;"></i> Valid JSON
                </div>
            </div>
        </div>

        {{-- Right: settings + schema --}}
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;margin-bottom:16px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Section Type *</label>
                    <select name="section_type" id="section-type" class="dm-form-select" required>
                        @foreach($sectionTypes as $key => $meta)
                        <option value="{{ $key }}" {{ (old('section_type', $section->section_type) === $key) ? 'selected' : '' }}>
                            {{ $meta['label'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" class="dm-form-input">
                </div>
                <div class="dm-form-group" style="display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }} style="width:16px;height:16px;">
                    <label for="is_active" class="dm-form-label" style="margin:0;">Active (visible on page)</label>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary" style="width:100%;margin-top:8px;">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>
            </div>

            <div class="dm-table-wrap" style="padding:24px;" id="schema-panel">
                <p style="font-size:13px;font-weight:700;color:#1b3c6b;margin-bottom:14px;">
                    <i class="fa-solid fa-code"></i> JSON Schema
                </p>
                <div id="schema-content" style="font-size:12px;color:#555;font-family:monospace;background:#f8f9fa;padding:12px;border-radius:8px;line-height:1.8;">
                    Loading…
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
var schemas = @json($sectionTypes);

var typeSelect = document.getElementById('section-type');
var dataTextarea = document.getElementById('section-data');
var schemaContent = document.getElementById('schema-content');
var jsonStatus = document.getElementById('json-status');

function showSchema(){
    var type = typeSelect.value;
    if(!type || !schemas[type]) { schemaContent.textContent='No schema'; return; }
    var schema = schemas[type].schema;
    var lines = Object.entries(schema).map(function(e){ return '"' + e[0] + '": ' + (typeof e[1]==='string' ? '"' + e[1] + '"' : JSON.stringify(e[1])); });
    schemaContent.textContent = '{\n  ' + lines.join(',\n  ') + '\n}';
}

function validateJson(){
    try { JSON.parse(dataTextarea.value); jsonStatus.innerHTML = '<i class="fa-solid fa-circle-check" style="color:#22c55e;"></i> Valid JSON'; }
    catch(e){ jsonStatus.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:#ef4444;"></i> Invalid JSON: ' + e.message; }
}

typeSelect.addEventListener('change', showSchema);
dataTextarea.addEventListener('input', validateJson);
showSchema();
validateJson();
</script>
@endpush
