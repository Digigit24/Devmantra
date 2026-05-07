<?php $__env->startSection('title', 'Pages'); ?>

<?php $__env->startSection('content'); ?>
<?php use App\Models\Page; ?>
<div class="dm-table-wrap" style="padding:28px;">

    <div style="margin-bottom:24px;">
        <h1 style="font-size:20px;font-weight:800;color:#1e293b;margin:0 0 4px;">
            <i class="fa-solid fa-file-lines" style="color:#4a73c4;margin-right:8px;"></i>Pages
        </h1>
        <p style="font-size:13px;color:#94a3b8;margin:0;">Manage page sections for each static page.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;">
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('admin.pages.sections.index', $page)); ?>"
           style="display:block;text-decoration:none;border:1.5px solid rgba(0,0,0,0.08);border-radius:12px;padding:24px;background:#fff;transition:all .15s;color:inherit;"
           onmouseover="this.style.borderColor='#4a73c4';this.style.boxShadow='0 4px 16px rgba(74,115,196,0.12)'"
           onmouseout="this.style.borderColor='rgba(0,0,0,0.08)';this.style.boxShadow='none'">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                <div style="width:36px;height:36px;border-radius:9px;background:#f0f4ff;display:flex;align-items:center;justify-content:center;color:#4a73c4;font-size:16px;flex-shrink:0;">
                    <i class="fa-solid <?php echo e($page->name === 'home' ? 'fa-house' : 'fa-address-card'); ?>"></i>
                </div>
                <span style="font-size:16px;font-weight:700;color:#1e293b;"><?php echo e($page->title); ?></span>
            </div>
            <div style="font-size:12px;color:#94a3b8;margin-bottom:4px;">
                <i class="fa-solid fa-layer-group" style="margin-right:4px;"></i>
                <?php echo e($page->sections()->count()); ?> section(s)
                &nbsp;·&nbsp;
                <?php echo e($page->sections()->where('is_active', true)->count()); ?> active
            </div>
            <div style="margin-top:14px;font-size:12px;font-weight:600;color:#4a73c4;">
                Manage sections <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\pages\index.blade.php ENDPATH**/ ?>