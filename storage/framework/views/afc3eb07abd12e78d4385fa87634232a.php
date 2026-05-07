<?php $__env->startSection('title', 'Edit Blog'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.blogs.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.blogs.update', $blog)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $blog->title)); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="<?php echo e(old('slug', $blog->slug)); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: <?php echo e(url('/blog/' . $blog->slug)); ?></div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Excerpt</label>
                    <textarea name="excerpt" class="dm-form-textarea" style="min-height:80px;"><?php echo e(old('excerpt', $blog->excerpt)); ?></textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    <textarea name="content" class="summernote" required><?php echo e(old('content', $blog->content)); ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" <?php echo e(old('status', $blog->status) === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e(old('status', $blog->status) === 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Category</label>
                    <input type="text" name="category" value="<?php echo e(old('category', $blog->category)); ?>" class="dm-form-input">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Read Time</label>
                    <input type="text" name="read_time" value="<?php echo e(old('read_time', $blog->read_time)); ?>" class="dm-form-input" placeholder="e.g. 6 min read">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at', $blog->published_at?->format('Y-m-d\TH:i'))); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <?php if($blog->featured_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Meta Description</label>
                    <textarea name="meta_description" class="dm-form-textarea" style="min-height:60px;"><?php echo e(old('meta_description', $blog->meta_description)); ?></textarea>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $blog->is_featured) ? 'checked' : ''); ?>>
                        <label class="dm-form-label" style="margin:0;">Featured Post</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Blog
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/blogs/edit.blade.php ENDPATH**/ ?>