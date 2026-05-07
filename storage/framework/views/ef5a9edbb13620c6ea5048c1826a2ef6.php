<?php $__env->startSection('title', 'Media Gallery'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ── Layout ── */
.gallery-wrap { display: flex; gap: 0; min-height: calc(100vh - 120px); }

/* ── Left sidebar ── */
.gallery-sidebar {
    width: 220px; flex-shrink: 0;
    background: #f8f9fb;
    border-right: 1px solid #e5e7eb;
    padding: 20px 0;
}
.gallery-root-btn {
    display: flex; align-items: center; gap: 10px;
    width: 100%; padding: 10px 20px;
    background: none; border: none; text-align: left;
    font-size: 13px; font-weight: 600; color: #374151;
    cursor: pointer; transition: background 0.15s, color 0.15s;
    border-left: 3px solid transparent;
}
.gallery-root-btn:hover  { background: #eef2ff; color: #1b3c6b; }
.gallery-root-btn.active { background: #eef2ff; color: #1b3c6b; border-left-color: #1b3c6b; }
.gallery-root-btn i { width: 16px; text-align: center; opacity: 0.7; }
.gallery-sidebar-label {
    font-size: 10px; font-weight: 700; color: #9ca3af;
    text-transform: uppercase; letter-spacing: 1px;
    padding: 16px 20px 6px;
}

/* ── Main panel ── */
.gallery-main { flex: 1; padding: 24px 28px; min-width: 0; }

/* Breadcrumb */
.gallery-breadcrumb {
    display: flex; align-items: center; flex-wrap: wrap; gap: 4px;
    font-size: 13px; color: #6b7280; margin-bottom: 20px;
}
.gallery-breadcrumb a { color: #1b3c6b; text-decoration: none; font-weight: 500; }
.gallery-breadcrumb a:hover { text-decoration: underline; }
.gallery-breadcrumb .sep { color: #d1d5db; }
.gallery-breadcrumb .current { color: #111; font-weight: 600; }

/* Toolbar */
.gallery-toolbar {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 22px; flex-wrap: wrap;
}
.gallery-search {
    flex: 1; min-width: 180px; max-width: 280px;
    padding: 8px 12px; border: 1px solid #e5e7eb;
    border-radius: 8px; font-size: 13px; color: #111;
    outline: none; transition: border-color 0.2s;
}
.gallery-search:focus { border-color: #1b3c6b; }
.gallery-count { font-size: 13px; color: #6b7280; margin-left: auto; }

/* Folders */
.gallery-folders { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 28px; }
.gallery-folder-card {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 16px; background: #fff;
    border: 1px solid #e5e7eb; border-radius: 10px;
    cursor: pointer; transition: border-color 0.2s, box-shadow 0.2s;
    font-size: 13px; font-weight: 600; color: #374151;
    min-width: 140px;
}
.gallery-folder-card:hover { border-color: #1b3c6b; box-shadow: 0 2px 10px rgba(27,60,107,0.08); color: #1b3c6b; }
.gallery-folder-card i { color: #f59e0b; font-size: 18px; }
.gallery-folder-card .folder-count { font-size: 11px; color: #9ca3af; font-weight: 400; margin-left: 2px; }

/* Divider */
.gallery-section-label {
    font-size: 12px; font-weight: 700; color: #9ca3af;
    text-transform: uppercase; letter-spacing: 0.8px;
    margin-bottom: 14px;
}

/* Image grid */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 14px;
}
.gallery-img-card {
    background: #fff; border: 1px solid #e5e7eb;
    border-radius: 10px; overflow: hidden;
    transition: border-color 0.2s, box-shadow 0.2s;
    cursor: pointer;
    position: relative;
}
.gallery-img-card:hover { border-color: #1b3c6b; box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
.gallery-img-card:hover .gallery-img-actions { opacity: 1; }

.gallery-img-thumb {
    width: 100%; aspect-ratio: 4/3;
    object-fit: contain; display: block;
    background: #f3f4f6; padding: 6px;
}
.gallery-img-info {
    padding: 8px 10px; border-top: 1px solid #f3f4f6;
}
.gallery-img-name {
    font-size: 11px; font-weight: 600; color: #374151;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    margin-bottom: 2px;
}
.gallery-img-meta { font-size: 10px; color: #9ca3af; }

/* Hover action overlay */
.gallery-img-actions {
    position: absolute; top: 6px; right: 6px;
    display: flex; gap: 5px; opacity: 0;
    transition: opacity 0.2s;
}
.gallery-img-action-btn {
    width: 28px; height: 28px; border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; cursor: pointer; border: none;
    transition: background 0.15s;
}
.btn-copy  { background: rgba(255,255,255,0.95); color: #1b3c6b; }
.btn-copy:hover  { background: #1b3c6b; color: #fff; }
.btn-view  { background: rgba(255,255,255,0.95); color: #374151; }
.btn-view:hover  { background: #374151; color: #fff; }

/* Empty / loading states */
.gallery-empty {
    text-align: center; padding: 60px 20px;
    color: #9ca3af; font-size: 14px;
}
.gallery-empty i { font-size: 40px; display: block; margin-bottom: 12px; opacity: 0.35; }
.gallery-loading { text-align: center; padding: 60px; color: #9ca3af; }
.gallery-loading i { font-size: 28px; animation: spin 1s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

/* Toast */
.gallery-toast {
    position: fixed; bottom: 24px; right: 24px; z-index: 9999;
    background: #1b3c6b; color: #fff;
    padding: 12px 20px; border-radius: 8px;
    font-size: 13px; font-weight: 500;
    display: flex; align-items: center; gap: 8px;
    opacity: 0; transform: translateY(10px);
    transition: opacity 0.3s, transform 0.3s;
    pointer-events: none;
}
.gallery-toast.show { opacity: 1; transform: translateY(0); }
.gallery-toast.error { background: #dc2626; }

/* ── Modal ── */
.gallery-modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.6); z-index: 9000;
    align-items: center; justify-content: center;
}
.gallery-modal-overlay.open { display: flex; }
.gallery-modal {
    background: #fff; border-radius: 14px;
    width: 90%; max-width: 680px; max-height: 90vh;
    overflow-y: auto; padding: 28px;
    position: relative;
}
.gallery-modal-close {
    position: absolute; top: 16px; right: 18px;
    background: none; border: none; font-size: 20px;
    color: #9ca3af; cursor: pointer;
}
.gallery-modal-close:hover { color: #111; }
.gallery-modal-preview {
    width: 100%; max-height: 320px;
    object-fit: contain; border-radius: 8px;
    background: #f3f4f6; margin-bottom: 18px;
}
.gallery-modal-title {
    font-size: 16px; font-weight: 700; color: #111;
    margin-bottom: 4px; word-break: break-all;
}
.gallery-modal-meta { font-size: 13px; color: #6b7280; margin-bottom: 16px; }
.gallery-modal-path {
    display: flex; align-items: center; gap: 8px;
    background: #f8f9fb; border: 1px solid #e5e7eb;
    border-radius: 8px; padding: 10px 14px;
    font-size: 12px; font-family: monospace; color: #374151;
    margin-bottom: 16px; word-break: break-all;
}
.gallery-modal-path button {
    flex-shrink: 0; padding: 4px 10px;
    background: #1b3c6b; color: #fff;
    border: none; border-radius: 5px;
    font-size: 11px; font-weight: 600; cursor: pointer;
}
.gallery-modal-divider { border: none; border-top: 1px solid #f3f4f6; margin: 18px 0; }
.gallery-replace-label { font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px; }
.gallery-replace-note  { font-size: 11px; color: #9ca3af; margin-bottom: 12px; }
.gallery-replace-area {
    border: 2px dashed #e5e7eb; border-radius: 10px;
    padding: 20px; text-align: center; cursor: pointer;
    transition: border-color 0.2s;
}
.gallery-replace-area:hover { border-color: #1b3c6b; }
.gallery-replace-area input { display: none; }
.gallery-replace-area i { font-size: 24px; color: #d1d5db; margin-bottom: 8px; display: block; }
.gallery-replace-area p { font-size: 13px; color: #6b7280; margin: 0; }
.gallery-replace-preview {
    max-width: 100%; max-height: 140px;
    object-fit: contain; border-radius: 6px;
    margin-top: 10px; display: none;
}
.gallery-modal-actions { display: flex; gap: 10px; margin-top: 18px; flex-wrap: wrap; }

/* Responsive */
@media (max-width: 767px) {
    .gallery-wrap { flex-direction: column; }
    .gallery-sidebar { width: 100%; border-right: none; border-bottom: 1px solid #e5e7eb; padding: 10px 0; display: flex; flex-wrap: wrap; gap: 0; }
    .gallery-root-btn { padding: 8px 14px; flex: 1; min-width: 100px; border-left: none; border-bottom: 3px solid transparent; justify-content: center; }
    .gallery-root-btn.active { border-bottom-color: #1b3c6b; border-left: none; }
    .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); }
}

/* ── Alt text section ── */
.alt-section { margin-bottom: 4px; }
.alt-label {
    font-size: 12px; font-weight: 600; color: #374151;
    margin: 0 0 5px; display: block;
}
.alt-input {
    width: 100%; padding: 8px 12px;
    border: 1px solid #e5e7eb; border-radius: 8px;
    font-size: 13px; color: #111; outline: none;
    transition: border-color 0.2s; box-sizing: border-box;
}
.alt-input:focus { border-color: #1b3c6b; }
.alt-input.has-value { border-color: #10b981; background: #f0fdf4; }
.alt-suggestion-row { display: flex; gap: 6px; align-items: stretch; }
.alt-suggestion-row .alt-input { flex: 1; background: #f8f9fb; color: #6b7280; font-style: italic; }
.alt-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 2px 8px; border-radius: 12px; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: .4px;
}
.alt-badge-set   { background: #d1fae5; color: #065f46; }
.alt-badge-empty { background: #fef3c7; color: #92400e; }
.alt-btn-sm {
    flex-shrink: 0; padding: 6px 12px;
    border-radius: 7px; font-size: 12px; font-weight: 600;
    cursor: pointer; border: 1px solid #e5e7eb;
    background: #fff; color: #374151;
    transition: background 0.15s, border-color 0.15s;
    white-space: nowrap;
}
.alt-btn-sm:hover { background: #f1f5f9; border-color: #1b3c6b; color: #1b3c6b; }
.alt-btn-suggest { background: #eef2ff; border-color: #c7d2fe; color: #4338ca; }
.alt-btn-suggest:hover { background: #e0e7ff; border-color: #818cf8; }
.alt-btn-use { background: #f0fdf4; border-color: #bbf7d0; color: #15803d; }
.alt-btn-use:hover { background: #dcfce7; border-color: #86efac; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="gallery-wrap">

    
    <aside class="gallery-sidebar">
        <div class="gallery-sidebar-label">Source</div>
        <button class="gallery-root-btn active" data-root="assets" onclick="Gallery.switchRoot('assets', this)">
            <i class="fa-solid fa-image"></i> Assets / img
        </button>
        <button class="gallery-root-btn" data-root="storage" onclick="Gallery.switchRoot('storage', this)">
            <i class="fa-solid fa-hard-drive"></i> Storage
        </button>
        <button class="gallery-root-btn" data-root="wp" onclick="Gallery.switchRoot('wp', this)">
            <i class="fa-brands fa-wordpress"></i> WP Uploads
        </button>
    </aside>

    
    <div class="gallery-main">

        
        <div class="gallery-breadcrumb" id="galleryBreadcrumb"></div>

        
        <div class="gallery-toolbar">
            <input type="text" class="gallery-search" id="gallerySearch"
                   placeholder="Filter images by name…"
                   oninput="Gallery.filterImages(this.value)">
            <button class="alt-btn-sm alt-btn-suggest" id="suggestAltsBtn"
                    onclick="Gallery.suggestAlts()" title="Auto-fill missing suggestions for catalogued images">
                <i class="fa-solid fa-wand-magic-sparkles"></i> Suggest All Missing
            </button>
            <span class="gallery-count" id="galleryCount"></span>
        </div>

        
        <div id="galleryContent">
            <div class="gallery-loading"><i class="fa-solid fa-spinner"></i></div>
        </div>

    </div>
</div>


<div class="gallery-modal-overlay" id="galleryModal" onclick="Gallery.closeModal(event)">
    <div class="gallery-modal">
        <button class="gallery-modal-close" onclick="Gallery.closeModal()"><i class="fa-solid fa-xmark"></i></button>

        <img id="modalPreview" class="gallery-modal-preview" src="" alt="">
        <div class="gallery-modal-title" id="modalName"></div>
        <div class="gallery-modal-meta" id="modalMeta"></div>

        <div class="gallery-modal-path">
            <span id="modalPath" style="flex:1;"></span>
            <button onclick="Gallery.copyPath()" title="Copy path">
                <i class="fa-solid fa-copy"></i> Copy
            </button>
        </div>

        <hr class="gallery-modal-divider">

        
        <div class="alt-section">
            <div style="display:flex; align-items:center; gap:8px; margin-bottom:12px;">
                <span style="font-size:13px; font-weight:700; color:#374151;">
                    <i class="fa-solid fa-tag" style="color:#6366f1; margin-right:4px;"></i>Alt Text
                </span>
                <span class="alt-badge" id="altBadge"></span>
            </div>

            <label class="alt-label" for="altTextInput">Alt Text
                <span style="font-weight:400; color:#9ca3af;">(used in HTML <code>alt=</code> and screen readers)</span>
            </label>
            <input type="text" id="altTextInput" class="alt-input"
                   maxlength="500" placeholder="Describe this image for accessibility and SEO…"
                   oninput="Gallery.onAltInput(this)">

            <label class="alt-label" for="altSuggestion"
                   style="margin-top:12px;">Suggested Alt
                <span style="font-weight:400; color:#9ca3af;">(generated from filename)</span>
            </label>
            <div class="alt-suggestion-row">
                <input type="text" id="altSuggestion" class="alt-input"
                       readonly placeholder="Click ✨ Suggest to auto-generate…">
                <button class="alt-btn-sm alt-btn-suggest" id="suggestOneBtn"
                        onclick="Gallery.suggestOne()" title="Generate suggestion from filename">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Suggest
                </button>
                <button class="alt-btn-sm alt-btn-use" id="useBtn"
                        onclick="Gallery.useSuggestion()" title="Copy suggestion into alt text field"
                        style="display:none;">
                    ← Use
                </button>
            </div>
        </div>

        <div style="margin-top:14px; margin-bottom:2px;">
            <button class="dm-btn dm-btn-primary dm-btn-sm" id="saveAltBtn" onclick="Gallery.saveAlt()">
                <i class="fa-solid fa-floppy-disk"></i> Save Alt Text
            </button>
        </div>

        <hr class="gallery-modal-divider">

        <div class="gallery-replace-label">Replace Image</div>
        <div class="gallery-replace-note">Upload a new file to replace this image at the same path. Filename stays the same.</div>
        <div class="gallery-replace-area" onclick="document.getElementById('replaceInput').click()">
            <input type="file" id="replaceInput" accept="image/*" onchange="Gallery.previewReplace(this)">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <p id="replacePrompt">Click to choose a replacement image</p>
            <img id="replacePreview" class="gallery-replace-preview" src="" alt="">
        </div>

        <div class="gallery-modal-actions">
            <button class="dm-btn dm-btn-primary" id="replaceBtn" onclick="Gallery.doReplace()" style="display:none;">
                <i class="fa-solid fa-arrows-rotate"></i> Replace Image
            </button>
            <button class="dm-btn dm-btn-outline" onclick="Gallery.closeModal()">Cancel</button>
            <button class="dm-btn" style="background:#fee2e2;color:#dc2626;border:1px solid #fca5a5;"
                    onclick="Gallery.doDelete()">
                <i class="fa-solid fa-trash"></i> Delete
            </button>
        </div>
    </div>
</div>


<div class="gallery-toast" id="galleryToast"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {

    var state = {
        root:    'assets',
        dir:     '',
        images:  [],
        current: null,   // image object open in modal
    };

    var BROWSE_URL       = '<?php echo e(route("admin.gallery.browse")); ?>';
    var REPLACE_URL      = '<?php echo e(route("admin.gallery.replace")); ?>';
    var DELETE_URL       = '<?php echo e(route("admin.gallery.delete")); ?>';
    var SAVE_ALT_URL     = '<?php echo e(route("admin.media.saveAlt")); ?>';
    var SUGGEST_ALTS_URL = '<?php echo e(route("admin.media.suggestAlts")); ?>';
    var SUGGEST_ALT_BASE = '<?php echo e(url("admin/media")); ?>';  // append /{id}/suggest-alt
    var CSRF             = '<?php echo e(csrf_token()); ?>';

    /* ── Load folder contents ── */
    function load(root, dir) {
        state.root = root;
        state.dir  = dir;
        document.getElementById('galleryContent').innerHTML =
            '<div class="gallery-loading"><i class="fa-solid fa-spinner"></i></div>';
        document.getElementById('gallerySearch').value = '';

        fetch(BROWSE_URL + '?root=' + encodeURIComponent(root) + '&dir=' + encodeURIComponent(dir))
            .then(function(r){ return r.json(); })
            .then(function(data) {
                state.images = data.images || [];
                renderBreadcrumb(data.breadcrumbs || []);
                renderContent(data.folders || [], data.images || []);
            })
            .catch(function() {
                document.getElementById('galleryContent').innerHTML =
                    '<div class="gallery-empty"><i class="fa-solid fa-triangle-exclamation"></i>Failed to load. Directory may not exist.</div>';
            });
    }

    /* ── Render breadcrumb ── */
    function renderBreadcrumb(crumbs) {
        var el = document.getElementById('galleryBreadcrumb');
        el.innerHTML = crumbs.map(function(c, i) {
            if (i === crumbs.length - 1) {
                return '<span class="current">' + esc(c.label) + '</span>';
            }
            return '<a href="#" onclick="Gallery.browse(\'' + c.root + '\',\'' + c.dir + '\');return false;">'
                + esc(c.label) + '</a><span class="sep"> / </span>';
        }).join('');
    }

    /* ── Render folders + image grid ── */
    function renderContent(folders, images) {
        var html = '';

        if (folders.length) {
            html += '<div class="gallery-folders">';
            folders.forEach(function(f) {
                html += '<div class="gallery-folder-card" onclick="Gallery.browse(\'' + state.root + '\',\'' + f.dir + '\')">'
                    + '<i class="fa-solid fa-folder"></i>'
                    + '<span>' + esc(f.name) + '</span>'
                    + (f.img_count ? '<span class="folder-count">(' + f.img_count + ')</span>' : '')
                    + '</div>';
            });
            html += '</div>';
        }

        if (images.length) {
            html += '<div class="gallery-section-label">' + images.length + ' image' + (images.length !== 1 ? 's' : '') + '</div>';
            html += '<div class="gallery-grid" id="galleryGrid">';
            images.forEach(function(img, idx) {
                html += renderCard(img, idx);
            });
            html += '</div>';
        } else if (!folders.length) {
            html += '<div class="gallery-empty"><i class="fa-solid fa-photo-film"></i>No images in this folder.</div>';
        } else if (!images.length) {
            html += '<div class="gallery-empty" style="padding:20px 0 0;"><i class="fa-solid fa-photo-film"></i>No images here — check subfolders.</div>';
        }

        document.getElementById('galleryCount').textContent = images.length + ' image' + (images.length !== 1 ? 's' : '');
        document.getElementById('galleryContent').innerHTML = html;
    }

    function renderCard(img, idx) {
        return '<div class="gallery-img-card" data-name="' + esc(img.name) + '" onclick="Gallery.openModal(' + idx + ')">'
            + '<img class="gallery-img-thumb" src="' + esc(img.url) + '" alt="' + esc(img.name) + '" loading="lazy" onerror="this.src=\'data:image/svg+xml,<svg xmlns=\\\'http://www.w3.org/2000/svg\\\' width=\\\'80\\\' height=\\\'60\\\'><rect fill=\\\'%23f3f4f6\\\' width=\\\'80\\\' height=\\\'60\\\'/><text x=\\\'50%25\\\' y=\\\'55%25\\\' font-size=\\\'10\\\' fill=\\\'%23bbb\\\' text-anchor=\\\'middle\\\'>No preview</text></svg>\'">'
            + '<div class="gallery-img-actions">'
            +   '<button class="gallery-img-action-btn btn-copy" onclick="event.stopPropagation();Gallery.quickCopy(\'' + esc(img.rel_path) + '\')" title="Copy path"><i class="fa-solid fa-copy"></i></button>'
            +   '<button class="gallery-img-action-btn btn-view" onclick="event.stopPropagation();Gallery.openModal(' + idx + ')" title="View details"><i class="fa-solid fa-expand"></i></button>'
            + '</div>'
            + '<div class="gallery-img-info">'
            +   '<div class="gallery-img-name">' + esc(img.name) + '</div>'
            +   '<div class="gallery-img-meta">' + esc(img.size) + ' &middot; ' + esc(img.ext.toUpperCase()) + '</div>'
            + '</div>'
            + '</div>';
    }

    /* ── Modal ── */
    function openModal(idx) {
        var img = state.images[idx];
        if (!img) return;
        state.current = img;

        document.getElementById('modalPreview').src  = img.url;
        document.getElementById('modalName').textContent = img.name;
        document.getElementById('modalMeta').textContent = img.size + '  ·  Modified ' + img.modified;
        document.getElementById('modalPath').textContent = '/' + img.rel_path;

        // Populate alt text fields
        var altInput  = document.getElementById('altTextInput');
        var altSugEl  = document.getElementById('altSuggestion');
        altInput.value  = img.alt_text || '';
        altSugEl.value  = img.alt_text_suggestion || '';
        syncAltBadge(img.alt_text);
        syncAltInput(altInput);
        document.getElementById('useBtn').style.display = altSugEl.value ? 'inline-flex' : 'none';

        // Reset replace UI
        document.getElementById('replaceInput').value  = '';
        document.getElementById('replacePreview').style.display = 'none';
        document.getElementById('replaceBtn').style.display     = 'none';
        document.getElementById('replacePrompt').textContent    = 'Click to choose a replacement image';

        document.getElementById('galleryModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    /* ── Alt badge helper ── */
    function syncAltBadge(altValue) {
        var badge = document.getElementById('altBadge');
        if (altValue && altValue.trim()) {
            badge.textContent = 'Set';
            badge.className   = 'alt-badge alt-badge-set';
        } else {
            badge.textContent = 'Missing';
            badge.className   = 'alt-badge alt-badge-empty';
        }
    }

    function syncAltInput(el) {
        el.classList.toggle('has-value', !!(el.value && el.value.trim()));
    }

    function onAltInput(el) {
        syncAltInput(el);
        syncAltBadge(el.value);
    }

    /* ── Copy suggestion → alt text field ── */
    function useSuggestion() {
        var sug = document.getElementById('altSuggestion').value;
        if (!sug) return;
        var altInput = document.getElementById('altTextInput');
        altInput.value = sug;
        syncAltInput(altInput);
        syncAltBadge(sug);
        if (state.current) state.current.alt_text = sug;
    }

    /* ── Save alt text ── */
    function saveAlt() {
        if (!state.current) return;
        var altText   = document.getElementById('altTextInput').value;
        var altSug    = document.getElementById('altSuggestion').value;
        var btn       = document.getElementById('saveAltBtn');
        var origLabel = btn.innerHTML;

        btn.disabled  = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner" style="animation:spin 1s linear infinite"></i> Saving…';

        var fd = new FormData();
        fd.append('rel_path',            state.current.rel_path);
        fd.append('alt_text',            altText);
        fd.append('alt_text_suggestion', altSug);
        fd.append('_token', CSRF);

        fetch(SAVE_ALT_URL, { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                btn.disabled  = false;
                btn.innerHTML = origLabel;
                if (data.success) {
                    // Update state so suggest-alt can use the new id
                    state.current.meta_id             = data.id;
                    state.current.alt_text            = data.alt_text;
                    state.current.alt_text_suggestion = data.alt_text_suggestion;
                    syncAltBadge(data.alt_text);
                    // Sync back into images array
                    var idx = state.images.findIndex(function(i){ return i.rel_path === state.current.rel_path; });
                    if (idx > -1) {
                        state.images[idx].meta_id             = data.id;
                        state.images[idx].alt_text            = data.alt_text;
                        state.images[idx].alt_text_suggestion = data.alt_text_suggestion;
                    }
                    toast('Alt text saved!');
                } else {
                    toast(data.message || 'Save failed.', true);
                }
            })
            .catch(function() {
                btn.disabled  = false;
                btn.innerHTML = origLabel;
                toast('Network error.', true);
            });
    }

    /* ── Suggest alt text for one image ── */
    function suggestOne() {
        if (!state.current) return;
        var btn       = document.getElementById('suggestOneBtn');
        var origLabel = btn.innerHTML;

        // If the image already has a meta record, use POST /media/{id}/suggest-alt
        // If not, save first (creates the record) and then suggest
        if (state.current.meta_id) {
            btn.disabled  = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner" style="animation:spin 1s linear infinite"></i>';
            runSuggestById(state.current.meta_id, btn, origLabel);
        } else {
            // Upsert via saveAlt (empty values) to get an ID, then suggest
            btn.disabled  = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner" style="animation:spin 1s linear infinite"></i>';
            var fd = new FormData();
            fd.append('rel_path', state.current.rel_path);
            fd.append('alt_text', state.current.alt_text || '');
            fd.append('alt_text_suggestion', '');
            fd.append('_token', CSRF);
            fetch(SAVE_ALT_URL, { method: 'POST', body: fd })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success && data.id) {
                        state.current.meta_id = data.id;
                        var idx = state.images.findIndex(function(i){ return i.rel_path === state.current.rel_path; });
                        if (idx > -1) state.images[idx].meta_id = data.id;
                        runSuggestById(data.id, btn, origLabel);
                    } else {
                        btn.disabled = false; btn.innerHTML = origLabel;
                        toast('Could not register image.', true);
                    }
                })
                .catch(function() {
                    btn.disabled = false; btn.innerHTML = origLabel;
                    toast('Network error.', true);
                });
        }
    }

    function runSuggestById(id, btn, origLabel) {
        fetch(SUGGEST_ALT_BASE + '/' + id + '/suggest-alt', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled  = false;
            btn.innerHTML = origLabel;
            if (data.success) {
                var sug = data.alt_text_suggestion;
                document.getElementById('altSuggestion').value = sug;
                document.getElementById('useBtn').style.display = sug ? 'inline-flex' : 'none';
                state.current.alt_text_suggestion = sug;
                var idx = state.images.findIndex(function(i){ return i.rel_path === state.current.rel_path; });
                if (idx > -1) state.images[idx].alt_text_suggestion = sug;
                toast('Suggestion generated!');
            } else {
                toast(data.message || 'Suggestion failed.', true);
            }
        })
        .catch(function() {
            btn.disabled  = false;
            btn.innerHTML = origLabel;
            toast('Network error.', true);
        });
    }

    /* ── Bulk suggest for all catalogued images without a suggestion ── */
    function suggestAlts() {
        var btn       = document.getElementById('suggestAltsBtn');
        var origLabel = btn.innerHTML;
        btn.disabled  = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner" style="animation:spin 1s linear infinite"></i> Working…';

        fetch(SUGGEST_ALTS_URL, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            btn.disabled  = false;
            btn.innerHTML = origLabel;
            if (data.success) {
                toast('Filled suggestions for ' + data.updated + ' image' + (data.updated !== 1 ? 's' : '') + '.');
                // Reload current folder so new suggestions show up
                load(state.root, state.dir);
            } else {
                toast('Bulk suggest failed.', true);
            }
        })
        .catch(function() {
            btn.disabled  = false;
            btn.innerHTML = origLabel;
            toast('Network error.', true);
        });
    }

    function closeModal(e) {
        if (e && e.target !== document.getElementById('galleryModal')) return;
        document.getElementById('galleryModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    function closeModalDirect() {
        document.getElementById('galleryModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    /* ── Copy path ── */
    function copyPath() {
        var path = '/' + (state.current ? state.current.rel_path : '');
        navigator.clipboard.writeText(path).then(function() { toast('Path copied!'); });
    }
    function quickCopy(relPath) {
        navigator.clipboard.writeText('/' + relPath).then(function() { toast('Path copied!'); });
    }

    /* ── Replace ── */
    function previewReplace(input) {
        var file = input.files[0];
        if (!file) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var prev = document.getElementById('replacePreview');
            prev.src = e.target.result;
            prev.style.display = 'block';
        };
        reader.readAsDataURL(file);
        document.getElementById('replacePrompt').textContent = file.name;
        document.getElementById('replaceBtn').style.display  = 'inline-flex';
    }

    function doReplace() {
        var file = document.getElementById('replaceInput').files[0];
        if (!file || !state.current) return;

        var fd = new FormData();
        fd.append('file', file);
        fd.append('rel_path', state.current.rel_path);
        fd.append('_token', CSRF);

        var btn = document.getElementById('replaceBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner" style="animation:spin 1s linear infinite"></i> Replacing…';

        fetch(REPLACE_URL, { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-arrows-rotate"></i> Replace Image';
                if (data.success) {
                    toast('Image replaced successfully!');
                    // Bust thumbnail cache
                    var ts = '?t=' + Date.now();
                    document.getElementById('modalPreview').src = state.current.url + ts;
                    // Update grid thumbnail
                    var thumbs = document.querySelectorAll('.gallery-img-thumb');
                    thumbs.forEach(function(t) {
                        if (t.alt === state.current.name) t.src = state.current.url + ts;
                    });
                    closeModalDirect();
                } else {
                    toast(data.error || 'Replace failed.', true);
                }
            })
            .catch(function() {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-arrows-rotate"></i> Replace Image';
                toast('Network error.', true);
            });
    }

    /* ── Delete ── */
    function doDelete() {
        if (!state.current) return;
        if (!confirm('Delete "' + state.current.name + '"? This cannot be undone.')) return;

        var fd = new FormData();
        fd.append('rel_path', state.current.rel_path);
        fd.append('_token', CSRF);

        fetch(DELETE_URL, { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    toast('Image deleted.');
                    closeModalDirect();
                    load(state.root, state.dir); // refresh
                } else {
                    toast(data.error || 'Delete failed.', true);
                }
            });
    }

    /* ── Filter ── */
    function filterImages(q) {
        q = q.toLowerCase();
        var cards = document.querySelectorAll('#galleryGrid .gallery-img-card');
        var visible = 0;
        cards.forEach(function(c) {
            var match = c.dataset.name.toLowerCase().includes(q);
            c.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        document.getElementById('galleryCount').textContent = visible + ' image' + (visible !== 1 ? 's' : '');
    }

    /* ── Switch root ── */
    function switchRoot(root, btn) {
        document.querySelectorAll('.gallery-root-btn').forEach(function(b) { b.classList.remove('active'); });
        btn.classList.add('active');
        load(root, '');
    }

    /* ── Toast ── */
    function toast(msg, isError) {
        var el = document.getElementById('galleryToast');
        el.innerHTML = (isError ? '<i class="fa-solid fa-triangle-exclamation"></i> ' : '<i class="fa-solid fa-check"></i> ') + msg;
        el.className = 'gallery-toast show' + (isError ? ' error' : '');
        setTimeout(function() { el.classList.remove('show'); }, 3000);
    }

    function esc(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    /* ── Keyboard shortcut ── */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModalDirect();
    });

    /* ── Public API ── */
    window.Gallery = {
        browse:         function(root, dir) { load(root, dir); },
        switchRoot:     switchRoot,
        openModal:      openModal,
        closeModal:     closeModal,
        copyPath:       copyPath,
        quickCopy:      quickCopy,
        previewReplace: previewReplace,
        doReplace:      doReplace,
        doDelete:       doDelete,
        filterImages:   filterImages,
        onAltInput:     onAltInput,
        useSuggestion:  useSuggestion,
        saveAlt:        saveAlt,
        suggestOne:     suggestOne,
        suggestAlts:    suggestAlts,
    };

    // Init: load default root
    load('assets', '');

})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\gallery\index.blade.php ENDPATH**/ ?>