@extends('layouts.admin')
@section('title', 'Edit Alert')

@section('actions')
<a href="{{ route('admin.alerts.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.alerts.update', $alert) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $alert->title) }}" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $alert->slug) }}" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: {{ url('/alert/' . $alert->slug) }}</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Excerpt</label>
                    <textarea name="excerpt" class="dm-form-textarea" style="min-height:80px;">{{ old('excerpt', $alert->excerpt) }}</textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    <textarea name="content" class="summernote" required>{{ old('content', $alert->content) }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" {{ old('status', $alert->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $alert->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Tag *</label>
                    <select name="tag" class="dm-form-select" required>
                        <option value="tax" {{ old('tag', $alert->tag) === 'tax' ? 'selected' : '' }}>Tax</option>
                        <option value="deal" {{ old('tag', $alert->tag) === 'deal' ? 'selected' : '' }}>Deal</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Read Time</label>
                    <input type="text" name="read_time" value="{{ old('read_time', $alert->read_time) }}" class="dm-form-input" placeholder="e.g. 5 min read">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $alert->published_at?->format('Y-m-d\TH:i')) }}" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    @if($alert->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $alert->featured_image) }}" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;">{{ old('meta_description', $alert->meta_description) }}</textarea>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $alert->is_featured) ? 'checked' : '' }}>
                        <label class="dm-form-label" style="margin:0;">Featured</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Alert
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
