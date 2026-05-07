<?php $__env->startSection('title', 'Create Event'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.events.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.events.store')); ?>" enctype="multipart/form-data">
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
                    <label class="dm-form-label">Description *</label>
                    <textarea name="description" class="summernote" required><?php echo e(old('description')); ?></textarea>
                </div>
            </div>

            <div class="dm-table-wrap mt-4" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Gallery Images</label>
                    <input type="file" name="gallery_images[]" class="dm-form-input" accept="image/*" multiple>
                    <div class="dm-form-hint">Select multiple images for the gallery. Max 2MB each. Formats: JPEG, PNG, GIF, WebP</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Tags</label>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;">
                        <?php $__currentLoopData = \App\Models\Event::TAGS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $checked = in_array($value, old('tags', ['events'])); ?>
                        <label style="display:inline-flex;align-items:center;gap:5px;cursor:pointer;font-size:13px;">
                            <input type="checkbox" name="tags[]" value="<?php echo e($value); ?>" <?php echo e($checked ? 'checked' : ''); ?>>
                            <?php echo e($label); ?>

                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" <?php echo e(old('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e(old('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
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
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Create Event
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\events\create.blade.php ENDPATH**/ ?>