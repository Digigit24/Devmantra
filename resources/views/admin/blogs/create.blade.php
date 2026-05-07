@extends('layouts.admin')
@section('title', 'Create Blog')

@push('styles')
<style>
    /* ── Blog HTML Editor layout ── */
    #blogEditorWrap {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        background: #1e1e1e;
    }
    #snippetBar {
        padding: 10px 14px;
        background: #f8f9fb;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
    }
    .snippet-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        margin-right: 4px;
        letter-spacing: .5px;
        white-space: nowrap;
    }
    .snippet-sep {
        display: inline-block;
        width: 1px;
        height: 20px;
        background: #e2e8f0;
        margin: 0 2px;
        vertical-align: middle;
    }
    .snippet-btn {
        padding: 5px 11px;
        font-size: 12px;
        font-weight: 600;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        cursor: pointer;
        color: #334155;
        transition: all .15s;
        white-space: nowrap;
        line-height: 1.4;
    }
    .snippet-btn:hover { border-color: #7463FF; color: #7463FF; background: rgba(116,99,255,0.05); }
    .snippet-btn--callout-info:hover  { border-color: #001d30; color: #001d30; background: rgba(0,29,48,0.05); }
    .snippet-btn--callout-tip:hover   { border-color: #c8a96e; color: #9a7a3e; background: rgba(200,169,110,0.07); }
    .snippet-btn--callout-warn:hover  { border-color: #d97706; color: #b45309; background: rgba(217,119,6,0.06); }
    .snippet-btn--stat:hover          { border-color: #001d30; color: #001d30; }
    .snippet-btn--takeaways:hover     { border-color: #c8a96e; color: #9a7a3e; }
    .snippet-btn--compare:hover       { border-color: #334155; color: #334155; }
    .snippet-btn--dark:hover          { border-color: #001d30; color: #001d30; background: rgba(0,29,48,0.05); }
    .snippet-btn--upload {
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 700;
        background: #001d30;
        color: #c8a96e !important;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        white-space: nowrap;
        transition: opacity .2s;
    }
    .snippet-btn--upload:hover { opacity: .85; }

    #editorSplitPane {
        display: grid;
        grid-template-columns: 1fr 1fr;
        height: 620px;
    }
    #monacoPane, #previewPane {
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    #monacoPane { border-right: 1px solid #333; }
    .pane-label {
        padding: 7px 14px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #94a3b8;
        background: #252526;
        border-bottom: 1px solid #333;
        flex-shrink: 0;
    }
    #monacoEditor { flex: 1; min-height: 0; }
    #previewIframe {
        flex: 1;
        border: none;
        width: 100%;
        background: #fff;
    }

    @media (max-width: 991px) {
        #editorSplitPane { grid-template-columns: 1fr; height: auto; }
        #monacoPane { height: 400px; border-right: none; border-bottom: 1px solid #333; }
        #previewPane { height: 400px; }
    }
</style>
@endpush

@section('actions')
<a href="{{ route('admin.blogs.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="dm-form-input" placeholder="Auto-generated from title">
                    <div class="dm-form-hint">Leave empty to auto-generate from title</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Excerpt</label>
                    <textarea name="excerpt" class="dm-form-textarea" style="min-height:80px;">{{ old('excerpt') }}</textarea>
                </div>

                {{-- ── Monaco HTML Editor ── --}}
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    {{-- Hidden textarea — synced before form submit by blog-html-editor.js --}}
                    <textarea name="content" id="contentInput" style="display:none">{{ old('content') }}</textarea>
                    <div id="blogEditorWrap">
                        @include('admin.blogs.partials.snippet-library')
                        <div id="editorSplitPane">
                            <div id="monacoPane">
                                <div class="pane-label">HTML Editor</div>
                                <div id="monacoEditor"></div>
                            </div>
                            <div id="previewPane">
                                <div class="pane-label">Live Preview</div>
                                <iframe id="previewIframe" sandbox="allow-same-origin allow-scripts"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Category</label>
                    <input type="text" name="category" value="{{ old('category', 'Blog') }}" class="dm-form-input">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Read Time</label>
                    <input type="text" name="read_time" value="{{ old('read_time', '5 min read') }}" class="dm-form-input" placeholder="e.g. 5 min read">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                    <div class="dm-form-hint">Max 2MB. Formats: JPEG, PNG, GIF, WebP</div>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="dm-form-label" style="margin:0;">Featured Post</label>
                    </div>
                </div>
                <button type="submit" onclick="return DmBlogEditor.syncContent()" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Create Blog
                </button>
            </div>
        </div>
    </div>
    <div class="mt-4">
        @include('admin.partials._seo-panel', ['model' => null])
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/monaco-editor@0.44.0/min/vs/loader.js"></script>
<script>
window.DmBlogEditor = {
    uploadUrl:      '{{ route("admin.upload-image") }}',
    csrfToken:      '{{ csrf_token() }}',
    initialContent: document.getElementById('contentInput').value,
    previewCssUrls: [
        '/assets/css/main.css',
        '/assets/css/spacing.css',
        '/assets/css/dm-blog-components.css'
    ],
    previewFontUrl: 'https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700;800&display=swap'
};
</script>
<script src="{{ asset('assets/js/blog-html-editor.js') }}"></script>
@endpush
