<?php $__env->startSection('title', 'Sections — ' . $service->title); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.services.sections.create', $service)); ?>" class="dm-btn dm-btn-sm" style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;margin-right:8px;">
    <i class="fa-solid fa-plus"></i> Add Section
</a>
<a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Service
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">
    <div class="col-12">
        <div class="dm-table-wrap" style="padding:24px 24px 8px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
                <div>
                    <h2 style="font-size:20px;font-weight:700;margin:0;"><?php echo e($service->title); ?></h2>
                    <p style="margin:4px 0 0;font-size:13px;color:#888;">
                        <a href="<?php echo e(route('service.show', $service->slug)); ?>" target="_blank" style="color:#1b3c6b;">/services/<?php echo e($service->slug); ?> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:10px;"></i></a>
                        &nbsp;·&nbsp; <?php echo e($sections->count()); ?> section(s)
                    </p>
                </div>
                <?php if($sections->count() > 1): ?>
                <p style="font-size:12px;color:#888;margin:0;"><i class="fa-solid fa-grip-dots-vertical"></i> Drag rows to reorder</p>
                <?php endif; ?>
            </div>

            <?php if(session('success')): ?>
            <div class="dm-alert dm-alert-success" style="margin-bottom:16px;"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if($sections->isEmpty()): ?>
            <div style="text-align:center;padding:60px 20px;color:#999;">
                <i class="fa-solid fa-layer-group" style="font-size:36px;margin-bottom:16px;display:block;opacity:.3;"></i>
                <p>No sections yet. <a href="<?php echo e(route('admin.services.sections.create', $service)); ?>" style="color:#1b3c6b;">Add the first section.</a></p>
            </div>
            <?php else: ?>
            <table class="dm-table" id="sections-table">
                <thead>
                    <tr>
                        <th style="width:40px;"></th>
                        <th style="width:36px;">#</th>
                        <th>Section Type</th>
                        <th>Title / Preview</th>
                        <th style="width:80px;text-align:center;">Active</th>
                        <th style="width:130px;text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortable-sections">
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-id="<?php echo e($section->id); ?>" style="<?php echo e($section->is_active ? '' : 'opacity:.5;'); ?>">
                        <td style="cursor:grab;color:#ccc;text-align:center;">
                            <i class="fa-solid fa-grip-vertical"></i>
                        </td>
                        <td style="color:#999;font-size:13px;"><?php echo e($section->sort_order); ?></td>
                        <td>
                            <span style="display:inline-block;background:#f0f4ff;color:#1b3c6b;border-radius:6px;padding:4px 10px;font-size:12px;font-weight:600;font-family:monospace;">
                                <?php echo e($section->section_type); ?>

                            </span>
                        </td>
                        <td style="font-size:14px;color:#444;max-width:320px;">
                            <?php
                                $d = $section->section_data ?? [];
                                $preview = $d['title'] ?? $d['label'] ?? ($d['items'][0]['title'] ?? '');
                            ?>
                            <?php echo e(Str::limit($preview, 70) ?: '—'); ?>

                        </td>
                        <td style="text-align:center;">
                            <form method="POST" action="<?php echo e(route('admin.services.sections.toggle', [$service, $section])); ?>" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" style="background:none;border:none;cursor:pointer;font-size:18px;color:<?php echo e($section->is_active ? '#22c55e' : '#d1d5db'); ?>;" title="<?php echo e($section->is_active ? 'Deactivate' : 'Activate'); ?>">
                                    <i class="fa-solid fa-toggle-<?php echo e($section->is_active ? 'on' : 'off'); ?>"></i>
                                </button>
                            </form>
                        </td>
                        <td style="text-align:right;">
                            <a href="<?php echo e(route('admin.services.sections.edit', [$service, $section])); ?>" class="dm-btn dm-btn-outline dm-btn-sm" style="margin-right:4px;">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.services.sections.destroy', [$service, $section])); ?>" style="display:inline;" onsubmit="return confirm('Delete this section?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm" style="color:#ef4444;border-color:#ef4444;">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Simple drag-to-reorder using HTML5 drag API
(function(){
    var tbody = document.getElementById('sortable-sections');
    if(!tbody) return;
    var dragged;
    tbody.addEventListener('dragstart', function(e){ dragged = e.target.closest('tr'); dragged.style.opacity='.4'; });
    tbody.addEventListener('dragend', function(e){ dragged.style.opacity=''; saveOrder(); });
    tbody.addEventListener('dragover', function(e){ e.preventDefault(); var row = e.target.closest('tr'); if(row && row !== dragged){ var rect=row.getBoundingClientRect(); var mid=rect.top+rect.height/2; if(e.clientY<mid){ tbody.insertBefore(dragged, row); } else { tbody.insertBefore(dragged, row.nextSibling); } } });

    [].forEach.call(tbody.querySelectorAll('tr'), function(r){ r.setAttribute('draggable', 'true'); });

    function saveOrder(){
        var ids = [].map.call(tbody.querySelectorAll('tr[data-id]'), function(r){ return r.dataset.id; });
        fetch('<?php echo e(route("admin.services.sections.reorder", $service)); ?>', {
            method: 'POST',
            headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>'},
            body: JSON.stringify({order: ids})
        });
    }
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\service-sections\index.blade.php ENDPATH**/ ?>