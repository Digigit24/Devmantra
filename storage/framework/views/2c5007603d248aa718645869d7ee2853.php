<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title', 'Confirm Password'); ?>

    <div class="auth-form-header">
        <h2 class="auth-form-title">Confirm your password</h2>
        <p class="auth-form-desc">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="<?php echo e(route('password.confirm')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Password -->
        <div class="auth-field">
            <label for="password" class="auth-label">Password</label>
            <div class="auth-password-wrap">
                <input id="password"
                       type="password"
                       name="password"
                       class="auth-input <?php echo e($errors->has('password') ? 'auth-input-error' : ''); ?>"
                       placeholder="Enter your password"
                       required
                       autocomplete="current-password">
                <button type="button" class="auth-password-toggle" aria-label="Toggle password">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="auth-error-text"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-submit">Confirm</button>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\auth\confirm-password.blade.php ENDPATH**/ ?>