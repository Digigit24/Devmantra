<?php $__env->startSection('title', 'Edit Event'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.events.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.events.update', $event)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $event->title)); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="<?php echo e(old('slug', $event->slug)); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: <?php echo e(url('/events/' . $event->slug)); ?></div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Description *</label>
                    <textarea name="description" class="summernote" required><?php echo e(old('description', $event->description)); ?></textarea>
                </div>
            </div>

            <div class="dm-table-wrap mt-4" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Gallery Images</label>
                    <?php if($event->galleryImages->count()): ?>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:12px;margin-bottom:16px;">
                        <?php $__currentLoopData = $event->galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="position:relative;border-radius:8px;overflow:hidden;border:1px solid rgba(0,0,0,0.08);">
                            <img src="<?php echo e($img->image_path); ?>" style="width:100%;height:100px;object-fit:cover;" alt="">
                            <label style="position:absolute;top:4px;right:4px;background:rgba(220,38,38,0.9);color:#fff;border-radius:50%;width:22px;height:22px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:11px;">
                                <input type="checkbox" name="remove_gallery[]" value="<?php echo e($img->id); ?>" style="display:none;">
                                <i class="fa-solid fa-xmark"></i>
                            </label>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="dm-form-hint mb-2">Click the X to mark images for removal on save</div>
                    <?php endif; ?>
                    <input type="file" name="gallery_images[]" class="dm-form-input" accept="image/*" multiple>
                    <div class="dm-form-hint">Add more gallery images. Max 2MB each. Formats: JPEG, PNG, GIF, WebP</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Tags</label>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;">
                        <?php $__currentLoopData = \App\Models\Event::TAGS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $checked = in_array($value, old('tags', $event->tags ?? ['events'])); ?>
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
                        <option value="draft" <?php echo e(old('status', $event->status) === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e(old('status', $event->status) === 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at', $event->published_at?->format('Y-m-d\TH:i'))); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <?php if($event->featured_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e($event->featured_image); ?>" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;"><?php echo e(old('meta_description', $event->meta_description)); ?></textarea>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Event
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\events\edit.blade.php ENDPATH**/ ?>