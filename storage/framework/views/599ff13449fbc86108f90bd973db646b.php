<?php $__env->startSection('title', 'Application Details'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.career-applications.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Applicant Details</h6>
            <table class="dm-table" style="margin:0;">
                <tr>
                    <td style="font-weight:600;width:140px;">Name</td>
                    <td><?php echo e($application->name); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Email</td>
                    <td><a href="mailto:<?php echo e($application->email); ?>"><?php echo e($application->email); ?></a></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Phone</td>
                    <td><?php echo e($application->phone ?: '—'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Position</td>
                    <td><?php echo e($application->career?->title ?? 'Deleted'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Applied On</td>
                    <td><?php echo e($application->created_at->format('M d, Y \a\t h:i A')); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Resume</td>
                    <td>
                        <a href="<?php echo e(asset('storage/' . $application->resume)); ?>" target="_blank" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-download"></i> Download Resume
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Update Status</h6>
            <form method="POST" action="<?php echo e(route('admin.career-applications.update-status', $application)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="dm-form-group">
                    <select name="status" class="dm-form-select">
                        <?php $__currentLoopData = ['new', 'reviewed', 'shortlisted', 'rejected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php echo e($application->status === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Status
                </button>
            </form>

            <hr style="border-color:var(--dm-border);margin:20px 0;">

            <form method="POST" action="<?php echo e(route('admin.career-applications.destroy', $application)); ?>" onsubmit="return confirm('Delete this application permanently?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="dm-btn dm-btn-danger w-100">
                    <i class="fa-solid fa-trash"></i> Delete Application
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\career-applications\show.blade.php ENDPATH**/ ?>