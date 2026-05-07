<?php $__env->startSection('title', 'Contact Submissions'); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search name, email or subject..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <?php $__currentLoopData = ['new', 'read', 'replied', 'archived']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e(request('status') === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Sender</th>
                <th>Subject</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Received</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e($sub->name); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);"><?php echo e($sub->email); ?></div>
                </td>
                <td style="color:var(--dm-text-muted);max-width:220px;"><?php echo e(Str::limit($sub->subject, 40)); ?></td>
                <td style="color:var(--dm-text-muted);"><?php echo e($sub->phone ?: '—'); ?></td>
                <td>
                    <?php
                        $statusColors = [
                            'new' => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                            'read' => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'replied' => 'background:rgba(34,197,94,0.15);color:#1d6aa9;',
                            'archived' => 'background:rgba(148,163,184,0.15);color:#64748b;',
                        ];
                    ?>
                    <span class="dm-badge" style="<?php echo e($statusColors[$sub->status] ?? ''); ?>">
                        <?php echo e(ucfirst($sub->status)); ?>

                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($sub->created_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.contact-submissions.show', $sub)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.contact-submissions.destroy', $sub)); ?>" onsubmit="return confirm('Delete this submission?')">
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
                    No contact submissions yet.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($submissions->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($submissions->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/contact-submissions/index.blade.php ENDPATH**/ ?>