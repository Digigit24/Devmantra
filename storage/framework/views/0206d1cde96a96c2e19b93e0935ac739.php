<?php $__env->startSection('title', 'Services'); ?>

<?php $__env->startSection('actions'); ?>
<?php if($trashedCount > 0): ?>
<a href="<?php echo e(route('admin.services.trash')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash (<?php echo e($trashedCount); ?>)
</a>
<?php endif; ?>
<a href="<?php echo e(route('admin.services.create')); ?>" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Service
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search services..." class="dm-form-input" style="max-width:260px;">
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
                <th>Homepage</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($service->image): ?>
                        <img src="<?php echo e(asset('storage/' . $service->image)); ?>" class="dm-table-thumb" alt="">
                    <?php else: ?>
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:rgba(34,197,94,0.15);"><i class="fa-solid fa-briefcase" style="color:var(--dm-success);"></i></div>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($service->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/services/<?php echo e($service->slug); ?></div>
                </td>
                <td>
                    <?php if($service->show_on_homepage): ?>
                        <span class="dm-badge dm-badge-published"><i class="fa-solid fa-check"></i> Slider</span>
                    <?php else: ?>
                        <span style="color:var(--dm-text-muted);">-</span>
                    <?php endif; ?>
                </td>
                <td style="color:var(--dm-text-muted);"><?php echo e($service->sort_order); ?></td>
                <td>
                    <span class="dm-badge <?php echo e($service->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                        <?php echo e(ucfirst($service->status)); ?>

                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.services.destroy', $service)); ?>" onsubmit="return confirm('Delete this service?')">
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
                <td colspan="6" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-briefcase" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No services yet. <a href="<?php echo e(route('admin.services.create')); ?>">Create your first service</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($services->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($services->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/services/index.blade.php ENDPATH**/ ?>