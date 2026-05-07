<?php $__env->startSection('title', 'Alerts'); ?>

<?php $__env->startSection('actions'); ?>
<?php if($trashedCount > 0): ?>
<a href="<?php echo e(route('admin.alerts.trash')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash (<?php echo e($trashedCount); ?>)
</a>
<?php endif; ?>
<a href="<?php echo e(route('admin.alerts.create')); ?>" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Alert
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search alerts..." class="dm-form-input" style="max-width:260px;">
            <select name="tag" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Tags</option>
                <option value="tax" <?php echo e(request('tag') === 'tax' ? 'selected' : ''); ?>>Tax</option>
                <option value="deal" <?php echo e(request('tag') === 'deal' ? 'selected' : ''); ?>>Deal</option>
            </select>
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
                <th>Tag</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($item->featured_image): ?>
                        <img src="<?php echo e(asset('storage/' . $item->featured_image)); ?>" class="dm-table-thumb" alt="">
                    <?php else: ?>
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:var(--dm-purple-light);"><i class="fa-solid fa-image" style="color:var(--dm-purple);"></i></div>
                    <?php endif; ?>
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($item->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/alert/<?php echo e($item->slug); ?></div>
                </td>
                <td>
                    <?php
                        $tagColors = [
                            'tax' => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'deal' => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                        ];
                    ?>
                    <span class="dm-badge" style="<?php echo e($tagColors[$item->tag] ?? ''); ?>">
                        <?php echo e(ucfirst($item->tag)); ?>

                    </span>
                </td>
                <td>
                    <span class="dm-badge <?php echo e($item->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                        <?php echo e(ucfirst($item->status)); ?>

                    </span>
                </td>
                <td>
                    <?php if($item->is_featured): ?>
                        <i class="fa-solid fa-star" style="color:var(--dm-warning);"></i>
                    <?php endif; ?>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($item->created_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.alerts.edit', $item)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.alerts.destroy', $item)); ?>" onsubmit="return confirm('Delete this alert?')">
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
                    <i class="fa-solid fa-bell" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No alerts yet. <a href="<?php echo e(route('admin.alerts.create')); ?>">Create your first alert</a>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\alerts\index.blade.php ENDPATH**/ ?>