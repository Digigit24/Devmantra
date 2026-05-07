<?php $__env->startSection('title', 'Create Report'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.reports.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.reports.store')); ?>" enctype="multipart/form-data">
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
                    <label class="dm-form-label">Excerpt</label>
                    <textarea name="excerpt" class="dm-form-textarea" style="min-height:80px;"><?php echo e(old('excerpt')); ?></textarea>
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
                    <label class="dm-form-label">Edition Label</label>
                    <input type="text" name="edition_label" value="<?php echo e(old('edition_label')); ?>" class="dm-form-input" placeholder="e.g. Q1 2026">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Read Time</label>
                    <input type="text" name="read_time" value="<?php echo e(old('read_time', '5 min read')); ?>" class="dm-form-input" placeholder="e.g. 5 min read">
                    <div class="dm-form-hint">Shown as a badge on cards and detail pages. Default: 5 min read</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at')); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                    <div class="dm-form-hint">Max 2MB. Formats: JPEG, PNG, GIF, WebP</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;"><?php echo e(old('meta_description')); ?></textarea>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured') ? 'checked' : ''); ?>>
                        <label class="dm-form-label" style="margin-bottom:0;">Mark as Featured</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Create Report
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/reports/create.blade.php ENDPATH**/ ?>