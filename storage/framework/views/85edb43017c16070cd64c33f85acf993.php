<?php $__env->startSection('title', 'Events'); ?>

<?php $__env->startSection('actions'); ?>
<?php if($trashedCount > 0): ?>
<a href="<?php echo e(route('admin.events.trash')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash (<?php echo e($trashedCount); ?>)
</a>
<?php endif; ?>
<a href="<?php echo e(route('admin.events.create')); ?>" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Event
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.ev-qi { display:flex; align-items:center; gap:6px; }
.ev-qi input[type="number"] { width:64px; padding:5px 8px; border:1px solid rgba(0,0,0,0.15); border-radius:6px; font-size:13px; text-align:center; }
.ev-qi input[type="text"] { flex:1; min-width:0; padding:5px 8px; border:1px solid rgba(0,0,0,0.15); border-radius:6px; font-size:12px; }
.ev-qi input:focus { outline:none; border-color:#4a73c4; }
.ev-save-btn {
    flex-shrink:0; width:28px; height:28px; border:none; border-radius:6px;
    background:rgba(22,163,74,0.1); color:#1d6aa9; cursor:pointer; font-size:13px;
    display:flex; align-items:center; justify-content:center; transition:background .15s;
}
.ev-save-btn:hover { background:rgba(22,163,74,0.2); }
.ev-save-btn.saving { opacity:.5; pointer-events:none; }
.ev-save-btn.saved { background:rgba(22,163,74,0.25); }
.ev-save-btn.error { background:rgba(239,68,68,0.15); color:#ef4444; }
.ev-tag-pills { display:flex; flex-wrap:wrap; gap:5px; }
.ev-tag-pill {
    display:inline-flex; align-items:center; gap:4px;
    padding:3px 9px; border-radius:12px; font-size:11px; font-weight:600;
    cursor:pointer; border:1.5px solid transparent; transition:all .15s;
    user-select:none;
}
.ev-tag-pill.off  { background:rgba(0,0,0,0.05); color:rgba(0,0,0,0.35); border-color:rgba(0,0,0,0.1); }
.ev-tag-pill.on.t-events          { background:rgba(27,60,107,0.1);  color:#1b3c6b; border-color:#1b3c6b; }
.ev-tag-pill.on.t-media-and-news  { background:rgba(29,106,169,0.1); color:#1d6aa9; border-color:#1d6aa9; }
.ev-tag-pill.on.t-team-activities { background:rgba(217,119,6,0.1);  color:#d97706; border-color:#d97706; }
.ev-tag-pill.on.t-achievements    { background:rgba(124,58,237,0.1); color:#7c3aed; border-color:#7c3aed; }
.ev-tag-saving { opacity:.5; pointer-events:none; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search events..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="published" <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>>Published</option>
                <option value="draft" <?php echo e(request('status') === 'draft' ? 'selected' : ''); ?>>Draft</option>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th style="min-width:200px;">Hero Image URL</th>
                <th style="width:110px;">Order</th>
                <th style="min-width:220px;">Tags</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);"><?php echo e(Str::limit($event->title, 50)); ?></div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/events/<?php echo e($event->slug); ?></div>
                </td>

                
                <td>
                    <div class="ev-qi">
                        <input type="text"
                               id="hero-<?php echo e($event->id); ?>"
                               value="<?php echo e($event->hero_image_url); ?>"
                               placeholder="https://..."
                               title="Hero image URL">
                        <button class="ev-save-btn"
                                onclick="evSave(<?php echo e($event->id); ?>, this)"
                                title="Save">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    </div>
                </td>

                
                <td>
                    <div class="ev-qi">
                        <input type="number"
                               id="order-<?php echo e($event->id); ?>"
                               value="<?php echo e($event->sort_order); ?>"
                               min="0"
                               title="Display order (lower = first)">
                        <button class="ev-save-btn"
                                onclick="evSave(<?php echo e($event->id); ?>, this)"
                                title="Save">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    </div>
                </td>

                
                <td>
                    <div class="ev-tag-pills" id="tags-<?php echo e($event->id); ?>">
                        <?php $__currentLoopData = \App\Models\Event::TAGS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tval => $tlabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $active = in_array($tval, $event->tags ?? []); ?>
                        <span class="ev-tag-pill t-<?php echo e($tval); ?> <?php echo e($active ? 'on' : 'off'); ?>"
                              onclick="evTagToggle(<?php echo e($event->id); ?>, '<?php echo e($tval); ?>', this)">
                            <?php echo e($tlabel); ?>

                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </td>

                <td>
                    <span class="dm-badge <?php echo e($event->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft'); ?>">
                        <?php echo e(ucfirst($event->status)); ?>

                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);"><?php echo e($event->created_at->format('M d, Y')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.events.destroy', $event)); ?>" onsubmit="return confirm('Delete this event?')">
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
                <td colspan="7" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-calendar-days" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No events yet. <a href="<?php echo e(route('admin.events.create')); ?>">Create your first event</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($events->hasPages()): ?>
    <div class="dm-pagination">
        <?php echo e($events->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const evQuickUrls = <?php echo json_encode($events->pluck('id')->mapWithKeys(fn($id) => [$id => route('admin.events.quick-update', $id)]), 512) ?>;
const evCsrf = '<?php echo e(csrf_token()); ?>';

async function evSave(id, btn) {
    const heroInput = document.getElementById('hero-' + id);
    const orderInput = document.getElementById('order-' + id);

    btn.classList.add('saving');
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

    try {
        const res = await fetch(evQuickUrls[id], {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': evCsrf },
            body: JSON.stringify({
                hero_image_url: heroInput ? heroInput.value : undefined,
                sort_order: orderInput ? parseInt(orderInput.value) || 0 : undefined,
            }),
        });
        if (!res.ok) throw new Error();
        btn.classList.remove('saving');
        btn.classList.add('saved');
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        setTimeout(() => {
            btn.classList.remove('saved');
            btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
        }, 1800);
    } catch (e) {
        btn.classList.remove('saving');
        btn.classList.add('error');
        btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        setTimeout(() => {
            btn.classList.remove('error');
            btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
        }, 2000);
    }
}

async function evTagToggle(id, tag, pill) {
    const container = document.getElementById('tags-' + id);
    container.classList.add('ev-tag-saving');

    // Collect current active tags, toggle the clicked one
    const pills = container.querySelectorAll('.ev-tag-pill');
    let tags = [];
    pills.forEach(p => {
        const t = p.className.match(/t-([\w-]+)/)?.[1];
        if (!t) return;
        let on = p.classList.contains('on');
        if (p === pill) on = !on;
        if (on) tags.push(t);
    });
    if (tags.length === 0) tags = [tag]; // always keep at least one

    try {
        const res = await fetch(evQuickUrls[id], {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': evCsrf },
            body: JSON.stringify({ tags }),
        });
        if (!res.ok) throw new Error();
        // Update pill states
        pills.forEach(p => {
            const t = p.className.match(/t-([\w-]+)/)?.[1];
            if (!t) return;
            p.classList.toggle('on', tags.includes(t));
            p.classList.toggle('off', !tags.includes(t));
        });
    } catch (e) {
        // revert visual — do nothing, just remove saving state
    } finally {
        container.classList.remove('ev-tag-saving');
    }
}

// Also save on Enter key in inputs
document.querySelectorAll('.ev-qi input').forEach(input => {
    input.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            const btn = input.closest('.ev-qi').querySelector('.ev-save-btn');
            btn && btn.click();
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/admin/events/index.blade.php ENDPATH**/ ?>