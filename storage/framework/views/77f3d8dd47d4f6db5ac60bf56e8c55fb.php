<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:var(--dm-purple-light);color:var(--dm-purple);">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="dm-stat-value"><?php echo e($stats['blogs']); ?></div>
            <div class="dm-stat-label">Total Blogs <span style="color:var(--dm-success);">(<?php echo e($stats['blogs_published']); ?> published)</span></div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(34,197,94,0.15);color:var(--dm-success);">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="dm-stat-value"><?php echo e($stats['services']); ?></div>
            <div class="dm-stat-label">Total Services <span style="color:var(--dm-success);">(<?php echo e($stats['services_homepage']); ?> on homepage)</span></div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(245,158,11,0.15);color:var(--dm-warning);">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div class="dm-stat-value"><?php echo e($stats['newsletters']); ?></div>
            <div class="dm-stat-label">Total Newsletters <span style="color:var(--dm-success);">(<?php echo e($stats['newsletters_published']); ?> published)</span></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="dm-table-wrap">
            <div class="dm-table-header">
                <div class="dm-table-title">Recent Blogs</div>
                <a href="<?php echo e(route('admin.blogs.create')); ?>" class="dm-btn dm-btn-primary dm-btn-sm">
                    <i class="fa-solid fa-plus"></i> New Blog
                </a>
            </div>
            <table class="dm-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('admin.blogs.edit', $blog)); ?>" style="color:var(--dm-text);font-weight:500;">
                                <?php echo e(Str::limit($blog->title, 40)); ?>

                            </a>
                        </td>
                        <td>
                            <span class="dm-badge <?php echo e($blog->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                                <?php echo e(ucfirst($blog->status)); ?>

                            </span>
                        </td>
                        <td style="color:var(--dm-text-muted);font-size:13px;"><?php echo e($blog->created_at->format('M d, Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" style="text-align:center;color:var(--dm-text-muted);">No blogs yet</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="dm-table-wrap">
            <div class="dm-table-header">
                <div class="dm-table-title">Recent Services</div>
                <a href="<?php echo e(route('admin.services.create')); ?>" class="dm-btn dm-btn-primary dm-btn-sm">
                    <i class="fa-solid fa-plus"></i> New Service
                </a>
            </div>
            <table class="dm-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Homepage</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('admin.services.edit', $service)); ?>" style="color:var(--dm-text);font-weight:500;">
                                <?php echo e(Str::limit($service->title, 40)); ?>

                            </a>
                        </td>
                        <td>
                            <?php if($service->show_on_homepage): ?>
                                <i class="fa-solid fa-check-circle" style="color:var(--dm-success);"></i>
                            <?php else: ?>
                                <i class="fa-solid fa-minus-circle" style="color:var(--dm-text-muted);"></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="dm-badge <?php echo e($service->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                                <?php echo e(ucfirst($service->status)); ?>

                            </span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" style="text-align:center;color:var(--dm-text-muted);">No services yet</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>