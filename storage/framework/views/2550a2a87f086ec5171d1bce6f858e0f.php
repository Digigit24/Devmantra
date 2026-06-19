<?php $__env->startSection('title', 'Trashed Events'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.events.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Events
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search trashed events..." class="dm-form-input" style="max-width:260px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($event->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/events/<?php echo e($event->slug); ?></div>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($event->deleted_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="<?php echo e(route('admin.events.restore', $event->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dm-btn dm-btn-primary dm-btn-sm">
                                <i class="fa-solid fa-rotate-left"></i> Restore
                            </button>
                        </form>
                        <form method="POST" action="<?php echo e(route('admin.events.force-delete', $event->id)); ?>" onsubmit="return confirm('Permanently delete this event? This cannot be undone.')">
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
                <td colspan="3" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-trash-can" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    Trash is empty.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($events->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($events->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\events\trash.blade.php ENDPATH**/ ?>