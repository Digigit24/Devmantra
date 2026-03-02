@extends('layouts.admin')
@section('title', 'Edit Service')

@section('actions')
<a href="{{ route('admin.services.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@section('content')
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
@endsection
