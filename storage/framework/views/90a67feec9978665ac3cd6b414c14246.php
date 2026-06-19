<?php $__env->startSection('title', 'Create Service'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.services.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.services.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="<?php echo e(old('slug')); ?>" class="dm-form-input" placeholder="Auto-generated from title">
                    <div class="dm-form-hint">Leave empty to auto-generate from title</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Short Description</label>
                    <textarea name="short_description" class="dm-form-textarea" style="min-height:80px;"><?php echo e(old('short_description')); ?></textarea>
                    <div class="dm-form-hint">Shown on homepage slider card</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    <textarea name="content" class="summernote" required><?php echo e(old('content')); ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" <?php echo e(old('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e(old('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Icon (Font Awesome class)</label>
                    <input type="text" name="icon" value="<?php echo e(old('icon')); ?>" class="dm-form-input" placeholder="e.g. fa-solid fa-chart-line">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Card Image</label>
                    <input type="file" name="image" class="dm-form-input" accept="image/*">
                    <div class="dm-form-hint">Shown on homepage slider</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Hero Image</label>
                    <input type="file" name="hero_image" class="dm-form-input" accept="image/*">
                    <div class="dm-form-hint">Shown on service detail page hero</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                    <div class="dm-form-hint">Full-width image shown below hero on detail page</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', 0)); ?>" class="dm-form-input">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;"><?php echo e(old('meta_description')); ?></textarea>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="show_on_homepage" value="1" <?php echo e(old('show_on_homepage') ? 'checked' : ''); ?>>
                        <label class="dm-form-label" style="margin:0;">Show on Homepage Slider</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Create Service
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\services\create.blade.php ENDPATH**/ ?>