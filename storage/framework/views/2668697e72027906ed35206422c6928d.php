<?php $__env->startSection('title', 'Blogs'); ?>

<?php $__env->startSection('actions'); ?>
<?php if($trashedCount > 0): ?>
<a href="<?php echo e(route('admin.blogs.trash')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash (<?php echo e($trashedCount); ?>)
</a>
<?php endif; ?>
<a href="<?php echo e(route('admin.blogs.create')); ?>" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Blog
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search blogs..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="published" <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($blog->featured_image): ?>
                        <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" class="dm-table-thumb" alt="">
                    <?php else: ?>
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:var(--dm-purple-light);"><i class="fa-solid fa-image" style="color:var(--dm-purple);"></i></div>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($blog->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/blog/<?php echo e($blog->slug); ?></div>
                </td>
                <td><?php echo e($blog->category); ?></td>
                <td>
                    <span class="dm-badge <?php echo e($blog->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                        <?php echo e(ucfirst($blog->status)); ?>

                    </span>
                </td>
                <td>
                    <?php if($blog->is_featured): ?>
                        <i class="fa-solid fa-star" style="color:var(--dm-warning);"></i>
                    <?php endif; ?>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($blog->created_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.blogs.edit', $blog)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.blogs.destroy', $blog)); ?>" onsubmit="return confirm('Delete this blog?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="dm-btn dm-btn-danger dm-btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-pen-to-square" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No blogs yet. <a href="<?php echo e(route('admin.blogs.create')); ?>">Create your first blog</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($blogs->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($blogs->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\blogs\index.blade.php ENDPATH**/ ?>