<?php $__env->startSection('title', 'Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding: 32px;">
            <h5 style="font-weight: 700; margin-bottom: 4px;">Profile Information</h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 24px;">Update your name and email address.</p>

            <form method="POST" action="<?php echo e(route('admin.profile.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="dm-form-group">
                    <label class="dm-form-label">Name</label>
                    <input type="text" name="name" class="dm-form-input" value="<?php echo e(old('name', $user->name)); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="dm-form-hint" style="color: var(--dm-danger);"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Email</label>
                    <input type="email" name="email" class="dm-form-input" value="<?php echo e(old('email', $user->email)); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="dm-form-hint" style="color: var(--dm-danger);"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="dm-btn dm-btn-primary">
                    <i class="fa-solid fa-check"></i> Save Changes
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding: 32px; text-align: center;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--dm-purple); display: inline-flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; color: #fff; margin-bottom: 16px;">
                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <h5 style="font-weight: 700; margin-bottom: 4px;"><?php echo e($user->name); ?></h5>
            <p style="color: var(--dm-text-muted); font-size: 14px; margin-bottom: 8px;"><?php echo e($user->email); ?></p>
            <span class="dm-badge dm-badge-published">Admin</span>
            <hr style="border-color: var(--dm-border); margin: 20px 0;">
            <p style="color: var(--dm-text-muted); font-size: 13px; margin: 0;">
                Member since <?php echo e($user->created_at?->format('M d, Y') ?? 'N/A'); ?>

            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\account\profile.blade.php ENDPATH**/ ?>