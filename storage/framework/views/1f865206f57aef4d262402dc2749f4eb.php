<?php $__env->startSection('title', 'Bookmarks — Link in Bio'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('bookmarks')); ?>" target="_blank" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-up-right-from-square"></i> View Page
</a>
<a href="<?php echo e(route('admin.bookmarks.create')); ?>" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> Add Link
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div class="dm-alert dm-alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="dm-table-wrap">
    <div class="dm-table-header" style="padding:16px 24px;">
        <p style="margin:0;font-size:13px;color:var(--dm-text-muted);">
            Drag rows to reorder. Links appear on your <a href="<?php echo e(route('bookmarks')); ?>" target="_blank">/bookmarks</a> page in this order.
        </p>
    </div>
    <table class="dm-table" id="bookmarks-table">
        <thead>
            <tr>
                <th style="width:32px;"></th>
                <th>Title &amp; URL</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sortable-body">
            <?php $__empty_1 = true; $__currentLoopData = $bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr data-id="<?php echo e($bookmark->id); ?>" style="cursor:grab;">
                <td style="color:var(--dm-text-muted);text-align:center;">
                    <i class="fa-solid fa-grip-vertical"></i>
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e($bookmark->title); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);word-break:break-all;"><?php echo e(Str::limit($bookmark->url, 60)); ?></div>
                </td>
                <td style="color:var(--dm-text-muted);font-size:13px;"><?php echo e($bookmark->description ?: '—'); ?></td>
                <td>
                    <?php if($bookmark->icon): ?>
                    <i class="<?php echo e($bookmark->icon); ?>" style="font-size:18px;color:var(--dm-purple);"></i>
                    <?php else: ?>
                    <span style="color:var(--dm-text-muted);">—</span>
                    <?php endif; ?>
                </td>
                <td>
                    <span class="dm-badge <?php echo e($bookmark->is_active ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                        <?php echo e($bookmark->is_active ? 'Active' : 'Hidden'); ?>

                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.bookmarks.edit', $bookmark)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.bookmarks.destroy', $bookmark)); ?>" onsubmit="return confirm('Delete this link?')">
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
                <td colspan="6" style="text-align:center;padding:48px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-link" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No links yet. <a href="<?php echo e(route('admin.bookmarks.create')); ?>">Add your first link</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
(function () {
    var el = document.getElementById('sortable-body');
    if (!el) return;

    Sortable.create(el, {
        animation: 150,
        handle: 'tr',
        ghostClass: 'dm-sortable-ghost',
        onEnd: function () {
            var order = [];
            el.querySelectorAll('tr[data-id]').forEach(function (row) {
                order.push(parseInt(row.dataset.id));
            });
            fetch('<?php echo e(route('admin.bookmarks.reorder')); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ order: order })
            });
        }
    });
})();
</script>
<style>
.dm-sortable-ghost { opacity: 0.4; background: var(--dm-purple-light); }
tr[data-id]:hover td:first-child i { color: var(--dm-purple); }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/bookmarks/index.blade.php ENDPATH**/ ?>