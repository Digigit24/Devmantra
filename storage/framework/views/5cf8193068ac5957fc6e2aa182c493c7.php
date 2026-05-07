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
    <?php $__env->startSection('title', 'Sign In'); ?>

    <div class="auth-form-header">
        <h2 class="auth-form-title">Welcome back</h2>
        <p class="auth-form-desc">Sign in to your account to continue</p>
    </div>

    <!-- Session Status -->
    <?php if(session('status')): ?>
        <div class="auth-status"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Email Address -->
        <div class="auth-field">
            <label for="email" class="auth-label">Email address</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="<?php echo e(old('email')); ?>"
                   class="auth-input <?php echo e($errors->has('email') ? 'auth-input-error' : ''); ?>"
                   placeholder="you@example.com"
                   required
                   autofocus
                   autocomplete="username">
            <?php $__errorArgs = ['email'];
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

        <!-- Remember + Forgot -->
        <div class="auth-row">
            <div class="auth-remember">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>
            <?php if(Route::has('password.request')): ?>
                <a href="<?php echo e(route('password.request')); ?>" class="auth-link">Forgot password?</a>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <button type="submit" class="auth-submit">Sign in</button>

        <?php if(Route::has('register')): ?>
            <div class="auth-footer-text">
                Don't have an account? <a href="<?php echo e(route('register')); ?>">Create one</a>
            </div>
        <?php endif; ?>
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
<?php /**PATH /home2/devmasjc/devmantra/resources/views/auth/login.blade.php ENDPATH**/ ?>