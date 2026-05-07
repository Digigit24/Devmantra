<?php $__env->startSection('title', 'Trashed Careers'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.careers.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Careers
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search trashed careers..." class="dm-form-input" style="max-width:260px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($career->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/careers/<?php echo e($career->slug); ?></div>
                </td>
                <td style="color:var(--dm-text-muted);"><?php echo e($career->type); ?></td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($career->deleted_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="<?php echo e(route('admin.careers.restore', $career->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dm-btn dm-btn-primary dm-btn-sm">
                                <i class="fa-solid fa-rotate-left"></i> Restore
                            </button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.careers.force-delete', $career->id)); ?>" onsubmit="return confirm('Permanently delete this career? This cannot be undone.')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="dm-btn dm-btn-danger dm-btn-sm">
                                <i class="fa-solid fa-trash"></i> Delete Forever
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-trash-can" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    Trash is empty.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($careers->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($careers->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\careers\trash.blade.php ENDPATH**/ ?>