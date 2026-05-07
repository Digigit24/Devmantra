<?php $__env->startSection('title', 'Trashed Alerts'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.alerts.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Alerts
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search trashed alerts..." class="dm-form-input" style="max-width:260px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Tag</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($item->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/alert/<?php echo e($item->slug); ?></div>
                </td>
                <td>
                    <span class="dm-badge" style="<?php echo e($item->tag === 'tax' ? 'background:rgba(245,158,11,0.15);color:#d97706;' : 'background:rgba(59,130,246,0.15);color:#2563eb;'); ?>">
                        <?php echo e(ucfirst($item->tag)); ?>

                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($item->deleted_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="<?php echo e(route('admin.alerts.restore', $item->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dm-btn dm-btn-primary dm-btn-sm">
                                <i class="fa-solid fa-rotate-left"></i> Restore
                            </button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.alerts.force-delete', $item->id)); ?>" onsubmit="return confirm('Permanently delete this alert? This cannot be undone.')">
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
    <?php if($alerts->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($alerts->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\alerts\trash.blade.php ENDPATH**/ ?>