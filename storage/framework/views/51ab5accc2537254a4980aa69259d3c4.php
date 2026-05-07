<?php $__env->startSection('title', 'Contact Submission Details'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.contact-submissions.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Sender Details</h6>
            <table class="dm-table" style="margin:0;">
                <tr>
                    <td style="font-weight:600;width:140px;">Name</td>
                    <td><?php echo e($submission->name); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Email</td>
                    <td><a href="mailto:<?php echo e($submission->email); ?>"><?php echo e($submission->email); ?></a></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Phone</td>
                    <td><?php echo e($submission->phone ?: '—'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Subject</td>
                    <td><?php echo e($submission->subject); ?></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Received On</td>
                    <td><?php echo e($submission->created_at->format('M d, Y \a\t h:i A')); ?></td>
                </tr>
            </table>
        </div>

        <div class="dm-table-wrap" style="padding:24px;margin-top:20px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Message</h6>
            <div style="background:var(--dm-bg);border:1px solid var(--dm-border);border-radius:8px;padding:20px;line-height:1.7;color:var(--dm-text);white-space:pre-wrap;"><?php echo e($submission->message); ?></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Update Status</h6>
            <form method="POST" action="<?php echo e(route('admin.contact-submissions.update-status', $submission)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="dm-form-group">
                    <select name="status" class="dm-form-select">
                        <?php $__currentLoopData = ['new', 'read', 'replied', 'archived']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php echo e($submission->status === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Status
                </button>
            </form>

            <hr style="border-color:var(--dm-border);margin:20px 0;">

            <a href="mailto:<?php echo e($submission->email); ?>?subject=Re: <?php echo e(urlencode($submission->subject)); ?>" class="dm-btn dm-btn-outline w-100" style="margin-bottom:12px;">
                <i class="fa-solid fa-reply"></i> Reply via Email
            </a>

            <form method="POST" action="<?php echo e(route('admin.contact-submissions.destroy', $submission)); ?>" onsubmit="return confirm('Delete this submission permanently?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="dm-btn dm-btn-danger w-100">
                    <i class="fa-solid fa-trash"></i> Delete Submission
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\contact-submissions\show.blade.php ENDPATH**/ ?>