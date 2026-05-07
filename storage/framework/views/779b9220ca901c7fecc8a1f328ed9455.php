<?php $__env->startSection('title', 'Edit Link'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.bookmarks.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
<div class="dm-alert dm-alert-error">
    <i class="fa-solid fa-circle-exclamation"></i>
    <div><?php echo e($errors->first()); ?></div>
</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.bookmarks.update', $bookmark)); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $bookmark->title)); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">URL *</label>
                    <input type="url" name="url" value="<?php echo e(old('url', $bookmark->url)); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Description</label>
                    <input type="text" name="description" value="<?php echo e(old('description', $bookmark->description)); ?>" class="dm-form-input" placeholder="Short tagline shown below the button">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Icon (FontAwesome class)</label>
                    <input type="text" name="icon" value="<?php echo e(old('icon', $bookmark->icon)); ?>" class="dm-form-input" placeholder="e.g. fa-brands fa-linkedin">
                    <div class="dm-form-hint">
                        Examples:
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
                        <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', $bookmark->is_active) ? 'checked' : ''); ?>>
                        <label for="is_active" style="font-size:14px;cursor:pointer;">Active (visible on page)</label>
                    </div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $bookmark->sort_order)); ?>" class="dm-form-input" min="0">
                </div>
                <div style="margin-top:8px;">
                    <button type="submit" class="dm-btn dm-btn-primary w-100">
                        <i class="fa-solid fa-check"></i> Save Changes
                    </button>
                </div>
            </div>

            
            <div class="dm-table-wrap" style="padding:20px;margin-top:16px;">
                <div style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:12px;">Preview</div>
                <div id="preview-btn" style="background:#fff;border:2px solid #e2e8f0;border-radius:14px;padding:14px 18px;display:flex;align-items:center;gap:12px;">
                    <span id="preview-icon" style="font-size:20px;color:#1b3c6b;width:24px;text-align:center;"></span>
                    <div>
                        <div id="preview-title" style="font-weight:700;color:#1b3c6b;font-size:15px;"><?php echo e($bookmark->title); ?></div>
                        <div id="preview-desc" style="font-size:12px;color:#64748b;margin-top:2px;"><?php echo e($bookmark->description); ?></div>
                    </div>
                </div>
            </div>

            
            <div class="dm-table-wrap" style="padding:20px;margin-top:16px;border:1px solid rgba(220,38,38,0.2);">
                <div style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:var(--dm-danger);margin-bottom:12px;">Danger Zone</div>
                <form method="POST" action="<?php echo e(route('admin.bookmarks.destroy', $bookmark)); ?>" onsubmit="return confirm('Permanently delete this link?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="dm-btn dm-btn-danger w-100">
                        <i class="fa-solid fa-trash"></i> Delete Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\bookmarks\edit.blade.php ENDPATH**/ ?>