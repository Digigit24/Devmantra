<div id="snippetBar">
    <span class="snippet-label">Insert:</span>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<p>PARAGRAPH TEXT HERE</p>\n')">
        ¶ Paragraph
    </button>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<h3>SECTION HEADING HERE</h3>\n')">
        H3 Heading
    </button>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<h4>SUB-HEADING HERE</h4>\n')">
        H4 Sub-heading
    </button>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<ul>\n  <li>FIRST ITEM</li>\n  <li>SECOND ITEM</li>\n  <li>THIRD ITEM</li>\n</ul>\n')">
        • Bullet List
    </button>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<blockquote>\n  <p>QUOTE TEXT HERE</p>\n</blockquote>\n')">
        " Blockquote
    </button>

    <span class="snippet-sep"></span>

    <button type="button" class="snippet-btn snippet-btn--callout-info" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-callout dm-blog-callout--info\'>\n  <strong class=\'dm-blog-callout__title\'>NOTE</strong>\n  <p>CALLOUT BODY TEXT HERE</p>\n</div>\n')">
        ℹ Callout Info
    </button>

    <button type="button" class="snippet-btn snippet-btn--callout-tip" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-callout dm-blog-callout--tip\'>\n  <strong class=\'dm-blog-callout__title\'>TIP</strong>\n  <p>TIP BODY TEXT HERE</p>\n</div>\n')">
        💡 Callout Tip
    </button>

    <button type="button" class="snippet-btn snippet-btn--callout-warn" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-callout dm-blog-callout--warning\'>\n  <strong class=\'dm-blog-callout__title\'>IMPORTANT</strong>\n  <p>WARNING BODY TEXT HERE</p>\n</div>\n')">
        ⚠ Callout Warning
    </button>

    <span class="snippet-sep"></span>

    <button type="button" class="snippet-btn snippet-btn--stat" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-stat\'>\n  <div class=\'dm-blog-stat__number\'>STATISTIC NUMBER</div>\n  <div class=\'dm-blog-stat__label\'>STAT LABEL</div>\n  <div class=\'dm-blog-stat__context\'>Context or source note here</div>\n</div>\n')">
        # Stat Highlight
    </button>

    <button type="button" class="snippet-btn snippet-btn--takeaways" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-takeaways\'>\n  <ul>\n    <li>FIRST KEY TAKEAWAY</li>\n    <li>SECOND KEY TAKEAWAY</li>\n    <li>THIRD KEY TAKEAWAY</li>\n  </ul>\n</div>\n')">
        ✓ Key Takeaways
    </button>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<figure class=\'dm-blog-figure\'>\n  <img src=\'/storage/content-images/IMAGE-FILENAME.jpg\' alt=\'IMAGE DESCRIPTION\'>\n  <figcaption>CAPTION TEXT HERE</figcaption>\n</figure>\n')">
        🖼 Image + Caption
    </button>

    <button type="button" class="snippet-btn" onclick="DmBlogEditor.insertSnippet('<hr class=\'dm-blog-divider\'>\n')">
        — Divider
    </button>

    <button type="button" class="snippet-btn snippet-btn--compare" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-compare\'>\n  <div class=\'dm-blog-compare__col dm-blog-compare__col--left\'>\n    <div class=\'dm-blog-compare__col-title\'>LEFT COLUMN TITLE</div>\n    <p>LEFT COLUMN CONTENT HERE</p>\n  </div>\n  <div class=\'dm-blog-compare__col dm-blog-compare__col--right\'>\n    <div class=\'dm-blog-compare__col-title\'>RIGHT COLUMN TITLE</div>\n    <p>RIGHT COLUMN CONTENT HERE</p>\n  </div>\n</div>\n')">
        ⇄ Two-Column
    </button>

    <button type="button" class="snippet-btn snippet-btn--dark" onclick="DmBlogEditor.insertSnippet('<div class=\'dm-blog-highlight-dark\'>\n  <h3>OPTIONAL HEADING</h3>\n  <p>BODY TEXT HERE. Use <strong>bold text</strong> for gold emphasis.</p>\n</div>\n')">
        ◼ Dark Highlight
    </button>

    <span class="snippet-sep"></span>

    <button type="button" class="snippet-btn snippet-btn--upload" onclick="DmBlogEditor.openImageUpload()">
        ↑ Upload Image
    </button>

    
    <input type="file" id="imageUploadInput" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" style="display:none">
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\blogs\partials\snippet-library.blade.php ENDPATH**/ ?>