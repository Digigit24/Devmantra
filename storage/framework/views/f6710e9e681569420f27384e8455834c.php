<?php $__env->startSection('title', 'Trashed Reports'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.reports.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Reports
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search trashed reports..." class="dm-form-input" style="max-width:260px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Edition</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($report->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/reports/<?php echo e($report->slug); ?></div>
                </td>
                <td style="color:var(--dm-text-muted);"><?php echo e($report->edition_label ?? '-'); ?></td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($report->deleted_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="<?php echo e(route('admin.reports.restore', $report->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dm-btn dm-btn-primary dm-btn-sm">
                                <i class="fa-solid fa-rotate-left"></i> Restore
                            </button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.reports.force-delete', $report->id)); ?>" onsubmit="return confirm('Permanently delete this report? This cannot be undone.')">
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
    <?php if($reports->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($reports->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\reports\trash.blade.php ENDPATH**/ ?>