<?php $__env->startSection('title', 'Newsletter Subscribers'); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search name or email..." class="dm-form-input" style="max-width:280px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
            <?php if(request('search')): ?>
            <a href="<?php echo e(route('admin.subscribers.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">Clear</a>
            <?php endif; ?>
        </form>
        <div style="font-size:13px;color:var(--dm-text-muted);margin-left:auto;">
            Total: <strong><?php echo e($subscribers->total()); ?></strong> subscribers
        </div>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subscribed On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="color:var(--dm-text-muted);font-size:13px;"><?php echo e($subscribers->firstItem() + $loop->index); ?></td>
                <td style="font-weight:600;color:var(--dm-text);"><?php echo e($subscriber->name); ?></td>
                <td style="color:var(--dm-text-muted);"><?php echo e($subscriber->email); ?></td>
                <td style="color:var(--dm-text-muted);font-size:13px;"><?php echo e($subscriber->created_at->format('M d, Y')); ?></td>
                <td>
                    <form method="POST" action="<?php echo e(route('admin.subscribers.destroy', $subscriber)); ?>" onsubmit="return confirm('Remove this subscriber?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="dm-btn dm-btn-sm" style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" style="text-align:center;padding:60px 0;color:var(--dm-text-muted);">No subscribers yet.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($subscribers->hasPages()): ?>
    <div style="padding:20px 24px;border-top:1px solid var(--dm-border);">
        <?php echo e($subscribers->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\subscribers\index.blade.php ENDPATH**/ ?>