@extends('layouts.admin')
@section('title', 'Add Link')

@section('actions')
<a href="{{ route('admin.bookmarks.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@section('content')

@if($errors->any())
<div class="dm-alert dm-alert-error">
    <i class="fa-solid fa-circle-exclamation"></i>
    <div>{{ $errors->first() }}</div>
</div>
@endif

<form method="POST" action="{{ route('admin.bookmarks.store') }}">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="dm-form-input" placeholder="e.g. Follow us on LinkedIn" required>
                    <div class="dm-form-hint">Displayed as the button label on the page.</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">URL *</label>
                    <input type="url" name="url" value="{{ old('url') }}" class="dm-form-input" placeholder="https://..." required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="dm-form-input" placeholder="Short tagline shown below the button">
                    <div class="dm-form-hint">Optional. Max 255 characters.</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Icon (FontAwesome class)</label>
                    <input type="text" name="icon" value="{{ old('icon') }}" class="dm-form-input" placeholder="e.g. fa-brands fa-linkedin">
                    <div class="dm-form-hint">
                        Leave empty for no icon. Examples:
                        <code>fa-brands fa-linkedin</code> &nbsp;
                        <code>fa-brands fa-instagram</code> &nbsp;
                        <code>fa-brands fa-youtube</code> &nbsp;
                        <code>fa-solid fa-globe</code>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <div class="dm-form-check" style="margin-top:8px;">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                        <label for="is_active" style="font-size:14px;cursor:pointer;">Active (visible on page)</label>
                    </div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="dm-form-input" min="0">
                    <div class="dm-form-hint">Lower numbers appear first. You can also drag to reorder from the list.</div>
                </div>
                <div style="margin-top:8px;">
                    <button type="submit" class="dm-btn dm-btn-primary w-100">
                        <i class="fa-solid fa-check"></i> Add Link
                    </button>
                </div>
            </div>

            {{-- Live Preview --}}
            <div class="dm-table-wrap" style="padding:20px;margin-top:16px;">
                <div style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:12px;">Preview</div>
                <div id="preview-btn" style="background:#fff;border:2px solid #e2e8f0;border-radius:14px;padding:14px 18px;display:flex;align-items:center;gap:12px;transition:border-color .2s;">
                    <span id="preview-icon" style="font-size:20px;color:#1b3c6b;width:24px;text-align:center;"></span>
                    <div>
                        <div id="preview-title" style="font-weight:700;color:#1b3c6b;font-size:15px;">Link Title</div>
                        <div id="preview-desc" style="font-size:12px;color:#64748b;margin-top:2px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
(function () {
    function update() {
        var title = document.querySelector('[name="title"]').value || 'Link Title';
        var desc  = document.querySelector('[name="description"]').value;
        var icon  = document.querySelector('[name="icon"]').value.trim();

        document.getElementById('preview-title').textContent = title;
        document.getElementById('preview-desc').textContent  = desc;

        var iconEl = document.getElementById('preview-icon');
        iconEl.innerHTML = icon ? '<i class="' + icon + '"></i>' : '';
    }

    ['[name="title"]','[name="description"]','[name="icon"]'].forEach(function (sel) {
        var el = document.querySelector(sel);
        if (el) el.addEventListener('input', update);
    });
    update();
})();
</script>
@endpush
