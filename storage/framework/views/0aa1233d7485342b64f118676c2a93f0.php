<?php $__env->startSection('title', 'Career Applications'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.careers.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Careers
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search name or email..." class="dm-form-input" style="max-width:220px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <?php $__currentLoopData = ['new', 'reviewed', 'shortlisted', 'rejected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e(request('status') === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="career_id" class="dm-form-select" style="max-width:200px;" onchange="this.form.submit()">
                <option value="">All Positions</option>
                <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($career->id); ?>" <?php echo e(request('career_id') == $career->id ? 'selected' : ''); ?>><?php echo e(Str::limit($career->title, 30)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Position</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Applied</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e($app->name); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);"><?php echo e($app->email); ?></div>
                </td>
                <td style="color:var(--dm-text-muted);"><?php echo e($app->career?->title ?? 'Deleted'); ?></td>
                <td style="color:var(--dm-text-muted);"><?php echo e($app->phone ?: '—'); ?></td>
                <td>
                    <?php
                        $statusColors = [
                            'new' => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                            'reviewed' => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'shortlisted' => 'background:rgba(34,197,94,0.15);color:#1d6aa9;',
                            'rejected' => 'background:rgba(239,68,68,0.15);color:#dc2626;',
                        ];
                    ?>
                    <span class="dm-badge" style="<?php echo e($statusColors[$app->status] ?? ''); ?>">
                        <?php echo e(ucfirst($app->status)); ?>

                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($app->created_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.career-applications.show', $app)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.career-applications.destroy', $app)); ?>" onsubmit="return confirm('Delete this application?')">
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
                    <i class="fa-solid fa-inbox" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No applications yet.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($applications->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($applications->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\career-applications\index.blade.php ENDPATH**/ ?>