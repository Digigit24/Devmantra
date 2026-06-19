<?php $__env->startSection('title', 'Edit Report'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.reports.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.reports.update', $report)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Title *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $report->title)); ?>" class="dm-form-input" required>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Slug</label>
                    <input type="text" name="slug" value="<?php echo e(old('slug', $report->slug)); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Permalink: <?php echo e(url('/reports/' . $report->slug)); ?></div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Excerpt</label>
                    <textarea name="excerpt" class="dm-form-textarea" style="min-height:80px;"><?php echo e(old('excerpt', $report->excerpt)); ?></textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Content *</label>
                    <textarea name="content" class="summernote" required><?php echo e(old('content', $report->content)); ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Status</label>
                    <select name="status" class="dm-form-select">
                        <option value="draft" <?php echo e(old('status', $report->status) === 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e(old('status', $report->status) === 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Edition Label</label>
                    <input type="text" name="edition_label" value="<?php echo e(old('edition_label', $report->edition_label)); ?>" class="dm-form-input" placeholder="e.g. Q1 2026">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Read Time</label>
                    <input type="text" name="read_time" value="<?php echo e(old('read_time', $report->read_time ?: '5 min read')); ?>" class="dm-form-input" placeholder="e.g. 5 min read">
                    <div class="dm-form-hint">Shown as a badge on cards and detail pages. Default: 5 min read</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at', $report->published_at?->format('Y-m-d\TH:i'))); ?>" class="dm-form-input">
                    <div class="dm-form-hint">Leave empty to publish immediately when status is Published</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Featured Image</label>
                    <?php if($report->featured_image): ?>
                        <div class="mb-2">
                            <img src="<?php echo e(asset('storage/' . $report->featured_image)); ?>" style="width:100%;border-radius:8px;max-height:160px;object-fit:cover;" alt="">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="featured_image" class="dm-form-input" accept="image/*">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Button URL</label>
                    <input type="url" name="button_url" value="<?php echo e(old('button_url', $report->button_url)); ?>" class="dm-form-input" placeholder="https://example.com/report.pdf">
                    <div class="dm-form-hint">External link shown as a button on the report page. Leave empty to hide.</div>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Button Label</label>
                    <input type="text" name="button_text" value="<?php echo e(old('button_text', $report->button_text ?: 'Read More')); ?>" class="dm-form-input" placeholder="Read More">
                    <div class="dm-form-hint">Default: Read More</div>
                </div>
                <div class="dm-form-group">
                    <div class="dm-form-check">
                        <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $report->is_featured) ? 'checked' : ''); ?>>
                        <label class="dm-form-label" style="margin-bottom:0;">Mark as Featured</label>
                    </div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Report
                </button>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <?php echo $__env->make('admin.partials._seo-panel', ['model' => $report], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\reports\edit.blade.php ENDPATH**/ ?>