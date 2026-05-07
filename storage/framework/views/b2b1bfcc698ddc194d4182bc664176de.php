<?php $__env->startSection('title', 'India vs Europe Calculator Leads'); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                   placeholder="Search name, email or company..."
                   class="dm-form-input" style="max-width:280px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <?php $__currentLoopData = ['new', 'read', 'archived']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e(request('status') === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
        <div style="font-size:13px;color:var(--dm-text-muted);">
            <?php echo e($leads->total()); ?> lead<?php echo e($leads->total() !== 1 ? 's' : ''); ?>

        </div>
    </div>

    <?php if(session('success')): ?>
    <div class="dm-alert dm-alert-success" style="margin:16px 24px 0;">
        <i class="fa-solid fa-circle-check"></i> <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <table class="dm-table">
        <thead>
            <tr>
                <th>Lead</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Submitted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e($lead->name); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);"><?php echo e($lead->email); ?></div>
                </td>
                <td style="color:var(--dm-text-muted);"><?php echo e($lead->company); ?></td>
                <td style="color:var(--dm-text-muted);"><?php echo e($lead->phone); ?></td>
                <td>
                    <?php
                        $colors = [
                            'new'      => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                            'read'     => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'archived' => 'background:rgba(148,163,184,0.15);color:#64748b;',
                        ];
                    ?>
                    <form method="POST" action="<?php echo e(route('admin.calculator-leads.update-status', $lead)); ?>" style="display:inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <select name="status" onchange="this.form.submit()"
                                class="dm-badge" style="<?php echo e($colors[$lead->status] ?? ''); ?> border:none;cursor:pointer;font-size:12px;font-weight:600;padding:4px 10px;border-radius:6px;">
                            <?php $__currentLoopData = ['new','read','archived']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s); ?>" <?php echo e($lead->status === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($lead->created_at->format('M d, Y')); ?></td>
                <td>
                    <form method="POST" action="<?php echo e(route('admin.calculator-leads.destroy', $lead)); ?>"
                          onsubmit="return confirm('Delete this lead?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="dm-btn dm-btn-danger dm-btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-calculator" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No calculator leads yet.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($leads->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($leads->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\calculator-leads\index.blade.php ENDPATH**/ ?>