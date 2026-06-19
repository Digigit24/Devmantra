<?php $__env->startSection('title', 'Edit Career'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.careers.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.careers.update', $career)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $career->title)); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="<?php echo e(old('slug', $career->slug)); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: <?php echo e(url('/careers/' . $career->slug)); ?></div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Description *</label>
                    <textarea name="description" class="summernote" required><?php echo e(old('description', $career->description)); ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" <?php echo e(old('status', $career->status) === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e(old('status', $career->status) === 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Job Type</label>
                    <select name="type" class="dm-form-select">
                        <?php $__currentLoopData = ['Full-time', 'Part-time', 'Remote', 'Contract']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t); ?>" <?php echo e(old('type', $career->type) === $t ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Location</label>
                    <input type="text" name="location" value="<?php echo e(old('location', $career->location)); ?>" class="dm-form-input" placeholder="e.g. Bengaluru, India">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at', $career->published_at?->format('Y-m-d\TH:i'))); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <?php if($career->featured_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $career->featured_image)); ?>" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;"><?php echo e(old('meta_description', $career->meta_description)); ?></textarea>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Career
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\careers\edit.blade.php ENDPATH**/ ?>