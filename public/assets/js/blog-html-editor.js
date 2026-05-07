/**
 * blog-html-editor.js
 * DevMantra Blog — Monaco HTML Editor
 *
 * Expects window.DmBlogEditor config object set before this script loads:
 * {
 *   uploadUrl:       string  — route('admin.upload-image')
 *   csrfToken:       string  — Laravel CSRF token
 *   initialContent:  string  — existing HTML content (from hidden textarea .value)
 *   previewCssUrls:  string[] — CSS files to load in preview iframe
 *   previewFontUrl:  string  — Google Fonts URL for preview iframe
 * }
 */

(function () {
    'use strict';

    var cfg = window.DmBlogEditor || {};
    var editor = null;
    var previewDebounceTimer = null;

    /* ── Wait for DOM ─────────────────────────────────────────── */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {
        initMonaco();
        bindFormSubmit();
        bindImageUpload();
    }

    /* ── Monaco init ──────────────────────────────────────────── */
    function initMonaco() {
        if (typeof require === 'undefined') {
            console.error('[DmBlogEditor] Monaco loader not found. Ensure loader.js CDN script is included before blog-html-editor.js.');
            return;
        }

        require.config({
            paths: { vs: 'https://cdn.jsdelivr.net/npm/monaco-editor@0.44.0/min/vs' }
        });

        require(['vs/editor/editor.main'], function () {
            editor = monaco.editor.create(document.getElementById('monacoEditor'), {
                value: cfg.initialContent || '',
                language: 'html',
                theme: 'vs-dark',
                wordWrap: 'on',
                automaticLayout: true,
                minimap: { enabled: false },
                fontSize: 13,
                lineHeight: 20,
                tabSize: 2,
                insertSpaces: true,
                formatOnPaste: true,
                scrollBeyondLastLine: false,
                renderLineHighlight: 'line',
                cursorBlinking: 'smooth',
                smoothScrolling: true,
                contextmenu: true,
                folding: true,
                lineNumbers: 'on',
                glyphMargin: false,
                overviewRulerBorder: false,
            });

            /* Trigger initial preview render */
            updatePreview();

            /* Live preview on change (debounced) */
            editor.onDidChangeModelContent(function () {
                clearTimeout(previewDebounceTimer);
                previewDebounceTimer = setTimeout(updatePreview, 350);
            });

            /* Expose public API immediately after editor is ready */
            window.DmBlogEditor.insertSnippet = insertSnippet;
            window.DmBlogEditor.openImageUpload = openImageUpload;
        });
    }

    /* ── Live Preview ─────────────────────────────────────────── */
    function buildPreviewHtml(content) {
        var cssLinks = '';
        if (cfg.previewCssUrls && cfg.previewCssUrls.length) {
            cssLinks = cfg.previewCssUrls.map(function (url) {
                return '<link rel="stylesheet" href="' + url + '">';
            }).join('\n    ');
        }
        var fontLink = cfg.previewFontUrl
            ? '<link rel="preconnect" href="https://fonts.googleapis.com">\n    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>\n    <link rel="stylesheet" href="' + cfg.previewFontUrl + '">'
            : '';

        return '<!DOCTYPE html>\n' +
            '<html lang="en">\n' +
            '<head>\n' +
            '  <meta charset="UTF-8">\n' +
            '  <meta name="viewport" content="width=device-width, initial-scale=1.0">\n' +
            '  ' + fontLink + '\n' +
            '  ' + cssLinks + '\n' +
            '  <style>\n' +
            '    :root {\n' +
            '      --tp-ff-onest: \'Onest\', sans-serif;\n' +
            '      --tp-common-black: #141414;\n' +
            '      --tp-border-1: #EAEBED;\n' +
            '    }\n' +
            '    html, body { margin: 0; padding: 0; background: #ffffff; }\n' +
            '    body { padding: 32px 44px; max-width: 780px; font-family: \'Onest\', sans-serif; color: #141414; }\n' +
            '    /* Mirror .dm-article-content context */\n' +
            '    p { font-size: 17px; line-height: 1.8; color: rgba(0,0,0,0.7); margin-bottom: 28px; font-family: var(--tp-ff-onest); }\n' +
            '    h3 { font-size: 28px; font-weight: 600; color: #141414; margin-top: 48px; margin-bottom: 20px; font-family: var(--tp-ff-onest); line-height: 1.35; }\n' +
            '    h4 { font-size: 22px; font-weight: 600; color: #141414; margin-top: 36px; margin-bottom: 16px; font-family: var(--tp-ff-onest); }\n' +
            '    ul { padding-left: 0; margin-bottom: 28px; list-style: none; }\n' +
            '    ul li { font-size: 17px; line-height: 1.8; color: rgba(0,0,0,0.7); padding-left: 24px; position: relative; margin-bottom: 8px; font-family: var(--tp-ff-onest); }\n' +
            '    ul li::before { content: \'\'; position: absolute; left: 0; top: 12px; width: 6px; height: 6px; background: #141414; border-radius: 50%; }\n' +
            '    blockquote { border-left: 3px solid #141414; padding: 24px 0 24px 32px; margin: 40px 0; }\n' +
            '    blockquote p { font-size: 20px; font-weight: 500; color: #141414; line-height: 1.6; margin-bottom: 8px; font-style: italic; }\n' +
            '    img { max-width: 100%; height: auto; }\n' +
            '  </style>\n' +
            '</head>\n' +
            '<body>\n' +
            (content || '') + '\n' +
            '</body>\n</html>';
    }

    function updatePreview() {
        if (!editor) return;
        var iframe = document.getElementById('previewIframe');
        if (!iframe) return;
        var content = editor.getValue();
        var html = buildPreviewHtml(content);
        try {
            var doc = iframe.contentDocument || iframe.contentWindow.document;
            doc.open();
            doc.write(html);
            doc.close();
        } catch (e) {
            console.warn('[DmBlogEditor] Preview update failed:', e);
        }
    }

    /* ── Content sync ────────────────────────────────────────── */
    function syncContent() {
        var textarea = document.getElementById('contentInput');
        if (!textarea) return true;
        if (!editor) {
            alert('The HTML editor is still loading. Please wait a moment and try again.');
            return false;
        }
        var val = editor.getValue().trim();
        if (!val) {
            alert('Content cannot be empty. Please add some HTML content before saving.');
            return false;
        }
        textarea.value = val;
        return true;
    }

    /* Keep as a safety net — fires after onclick already synced the textarea */
    function bindFormSubmit() {
        var form = document.querySelector('form');
        if (!form) return;
        form.addEventListener('submit', function (e) {
            var textarea = document.getElementById('contentInput');
            if (editor && textarea && !textarea.value.trim()) {
                /* onclick ran but something went wrong — sync now */
                textarea.value = editor.getValue();
            }
        });
    }

    /* ── Snippet insertion ────────────────────────────────────── */
    function insertSnippet(html) {
        if (!editor) {
            console.warn('[DmBlogEditor] Editor not ready yet.');
            return;
        }
        var selection = editor.getSelection();
        var range = selection || new monaco.Range(
            editor.getPosition().lineNumber,
            editor.getPosition().column,
            editor.getPosition().lineNumber,
            editor.getPosition().column
        );

        /* Add a leading newline if cursor is not at start of line */
        var model = editor.getModel();
        var lineContent = model.getLineContent(range.startLineNumber);
        var prefix = lineContent.trim().length > 0 ? '\n' : '';

        editor.executeEdits('snippet-insert', [{
            range: range,
            text: prefix + html,
            forceMoveMarkers: true
        }]);

        /* Reveal and re-focus */
        editor.revealPositionInCenter(editor.getPosition());
        editor.focus();
    }

    /* ── Image upload ─────────────────────────────────────────── */
    function openImageUpload() {
        var input = document.getElementById('imageUploadInput');
        if (input) input.click();
    }

    function bindImageUpload() {
        /* Bind after DOM — the input lives in snippet-library.blade.php */
        var input = document.getElementById('imageUploadInput');
        if (!input) return;

        input.addEventListener('change', function () {
            var file = this.files[0];
            if (!file) return;

            /* Validate size (max 2MB) */
            if (file.size > 2 * 1024 * 1024) {
                alert('Image must be under 2MB.');
                this.value = '';
                return;
            }

            var formData = new FormData();
            formData.append('image', file);
            formData.append('_token', cfg.csrfToken || '');

            /* Show uploading feedback */
            var btn = document.querySelector('.snippet-btn--upload');
            var originalText = btn ? btn.textContent : '';
            if (btn) btn.textContent = '⏳ Uploading…';

            fetch(cfg.uploadUrl, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function (res) {
                if (!res.ok) throw new Error('Upload failed (' + res.status + ')');
                return res.json();
            })
            .then(function (data) {
                if (!data.url) throw new Error('No URL in response');
                var snippet =
                    '<figure class="dm-blog-figure">\n' +
                    '  <img src="' + data.url + '" alt="IMAGE DESCRIPTION">\n' +
                    '  <figcaption>Caption text here</figcaption>\n' +
                    '</figure>\n';
                insertSnippet(snippet);
            })
            .catch(function (err) {
                alert('Image upload failed: ' + err.message);
            })
            .finally(function () {
                if (btn) btn.textContent = originalText;
                input.value = '';
            });
        });
    }

    /* ── Expose public API immediately (snippets before Monaco loads call a queue) ── */
    window.DmBlogEditor = window.DmBlogEditor || {};
    window.DmBlogEditor.insertSnippet = function (html) {
        if (editor) {
            insertSnippet(html);
        } else {
            /* Queue until Monaco is ready */
            var interval = setInterval(function () {
                if (editor) {
                    clearInterval(interval);
                    insertSnippet(html);
                }
            }, 100);
        }
    };
    window.DmBlogEditor.openImageUpload = openImageUpload;
    window.DmBlogEditor.syncContent = syncContent;

})();
