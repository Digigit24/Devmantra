<?php $__env->startSection('title', 'Careers'); ?>

<?php $__env->startSection('actions'); ?>
<?php if($trashedCount > 0): ?>
<a href="<?php echo e(route('admin.careers.trash')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash (<?php echo e($trashedCount); ?>)
</a>
<?php endif; ?>
<a href="<?php echo e(route('admin.careers.create')); ?>" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Career
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search careers..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="published" <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
            </select>
            <select name="type" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Types</option>
                <?php $__currentLoopData = ['Full-time', 'Part-time', 'Remote', 'Contract']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($t); ?>" <?php echo e(request('type') === $t ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Type</th>
                <th>Status</th>
                <th>Applications</th>
                <th>Date</th>
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
                <td style="color:var(--dm-text-muted);"><?php echo e($career->location ?: '—'); ?></td>
                <td><span class="dm-badge dm-badge-published"><?php echo e($career->type); ?></span></td>
                <td>
                    <span class="dm-badge <?php echo e($career->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                        <?php echo e(ucfirst($career->status)); ?>

                    </span>
                </td>
                <td style="text-align:center;">
                    <a href="<?php echo e(route('admin.career-applications.index', ['career_id' => $career->id])); ?>" style="font-weight:600;">
                        <?php echo e($career->applications_count ?? $career->applications()->count()); ?>

                    </a>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($career->created_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.careers.edit', $career)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.careers.destroy', $career)); ?>" onsubmit="return confirm('Delete this career?')">
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
                    <i class="fa-solid fa-briefcase" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No careers yet. <a href="<?php echo e(route('admin.careers.create')); ?>">Create your first career listing</a>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\careers\index.blade.php ENDPATH**/ ?>