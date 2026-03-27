@extends('layouts.admin')
@section('title', 'Edit Newsletter')

@section('actions')
<a href="{{ route('admin.newsletters.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.newsletters.update', $newsletter) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $newsletter->title) }}" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $newsletter->slug) }}" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: {{ url('/newsletter/' . $newsletter->slug) }}</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Excerpt</label>
                    <textarea name="excerpt" class="dm-form-textarea" style="min-height:80px;">{{ old('excerpt', $newsletter->excerpt) }}</textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    <textarea name="content" class="summernote" required>{{ old('content', $newsletter->content) }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" {{ old('status', $newsletter->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $newsletter->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Edition Label</label>
                    <input type="text" name="edition_label" value="{{ old('edition_label', $newsletter->edition_label) }}" class="dm-form-input" placeholder="e.g. February 2025">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $newsletter->published_at?->format('Y-m-d\TH:i')) }}" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    @if($newsletter->featured_image)
                        <div class="mb-2">
                            <img src="{{  $newsletter->featured_image }}" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    @endif
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;">{{ old('meta_description', $newsletter->meta_description) }}</textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Read Time</label>
                    <input type="text" name="read_time" value="{{ old('read_time', $newsletter->read_time ?: '5 min read') }}" class="dm-form-input" placeholder="e.g. 5 min read">
                    <div class="dm-form-hint">Shown as a badge on cards and detail pages. Default: 5 min read</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Button URL</label>
                    <input type="url" name="button_url" value="{{ old('button_url', $newsletter->button_url) }}" class="dm-form-input" placeholder="https://example.com/newsletter.pdf">
                    <div class="dm-form-hint">External link that opens in a new tab. Leave empty to hide the button.</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Button Label</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $newsletter->button_text ?: 'Read More') }}" class="dm-form-input" placeholder="Read More">
                    <div class="dm-form-hint">Default: Read More</div>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $newsletter->is_featured) ? 'checked' : '' }}>
                        <label class="dm-form-label" style="margin-bottom:0;">Mark as Featured</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Newsletter
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
