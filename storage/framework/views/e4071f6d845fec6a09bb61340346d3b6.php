<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['data' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['data' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $title          = $data['title']           ?? 'Engagement Models';
    $standardLabel  = $data['standard_label']  ?? 'Standard Models';
    $cpaLabel       = $data['cpa_label']       ?? '';
    $standardModels = $data['standard_models'] ?? [];  // [{title, description, best_for}]
    $cpaModels      = $data['cpa_models']      ?? [];  // [{title, description, best_for}]
    $hasTabs        = !empty($cpaModels);
    $uid = 'em_' . substr(md5(json_encode($data)), 0, 8);
?>

<?php if (! $__env->hasRenderedOnce('ec7c4ce1-dc4d-409b-9a21-695a9a359af8')): $__env->markAsRenderedOnce('ec7c4ce1-dc4d-409b-9a21-695a9a359af8'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-engagement { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-engagement-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 16px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-engagement-title { font-size: 26px; } }
/* Tabs */
.ss-em-tabs {
    display: flex; justify-content: center; gap: 8px; margin-bottom: 40px;
}
.ss-em-tab {
    padding: 10px 24px;
    border-radius: 30px; border: 1.5px solid #1b3c6b;
    font-size: 14px; font-weight: 600;
    color: #1b3c6b; background: #fff; cursor: pointer;
    transition: background .2s, color .2s;
}
.ss-em-tab.active {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff; border-color: transparent;
}
.ss-em-panel { display: none; }
.ss-em-panel.active { display: block; }
/* Cards */
.ss-em-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px 26px;
    height: 100%;
    border: 1px solid rgba(0,0,0,0.06);
    transition: transform .25s, box-shadow .25s;
    position: relative;
}
.ss-em-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
.ss-em-card-title {
    font-size: 17px; font-weight: 700; color: #1b3c6b;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
}
.ss-em-card-desc { font-size: 14px; color: #555; line-height: 1.75; margin-bottom: 16px; }
.ss-em-card-best {
    font-size: 12px; font-weight: 600; color: #4a73c4;
    background: rgba(74,115,196,0.08);
    padding: 5px 12px; border-radius: 20px;
    display: inline-block;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-engagement">
    <div class="container container-1230">
        <?php if($title): ?>
        <h2 class="ss-engagement-title tp_fade_anim" data-delay=".2"><?php echo e($title); ?></h2>
        <?php endif; ?>

        <?php if($hasTabs): ?>
        <div class="ss-em-tabs tp_fade_anim" data-delay=".3" id="<?php echo e($uid); ?>-tabs">
            <button class="ss-em-tab active" data-panel="<?php echo e($uid); ?>-standard"><?php echo e($standardLabel); ?></button>
            <button class="ss-em-tab" data-panel="<?php echo e($uid); ?>-cpa"><?php echo e($cpaLabel ?: 'CPA-Specific'); ?></button>
        </div>
        <?php endif; ?>

        <div class="ss-em-panel active tp_fade_anim" data-delay=".4" id="<?php echo e($uid); ?>-standard">
            <div class="row g-4">
                <?php $__currentLoopData = $standardModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-<?php echo e(count($standardModels) <= 2 ? 6 : 3); ?> col-md-6">
                    <div class="ss-em-card">
                        <h3 class="ss-em-card-title"><?php echo e($model['title'] ?? ''); ?></h3>
                        <p class="ss-em-card-desc"><?php echo e($model['description'] ?? ''); ?></p>
                        <?php if(!empty($model['best_for'])): ?>
                        <span class="ss-em-card-best">Best for: <?php echo e($model['best_for']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <?php if($hasTabs): ?>
        <div class="ss-em-panel" id="<?php echo e($uid); ?>-cpa">
            <div class="row g-4">
                <?php $__currentLoopData = $cpaModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-<?php echo e(count($cpaModels) <= 2 ? 6 : 4); ?> col-md-6">
                    <div class="ss-em-card">
                        <h3 class="ss-em-card-title"><?php echo e($model['title'] ?? ''); ?></h3>
                        <p class="ss-em-card-desc"><?php echo e($model['description'] ?? ''); ?></p>
                        <?php if(!empty($model['best_for'])): ?>
                        <span class="ss-em-card-best">Best for: <?php echo e($model['best_for']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php if($hasTabs): ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function(){
    var tabs = document.querySelectorAll('#<?php echo e($uid); ?>-tabs .ss-em-tab');
    tabs.forEach(function(tab){
        tab.addEventListener('click', function(){
            tabs.forEach(function(t){ t.classList.remove('active'); });
            document.querySelectorAll('.ss-em-panel').forEach(function(p){ p.classList.remove('active'); });
            this.classList.add('active');
            document.getElementById(this.dataset.panel).classList.add('active');
        });
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\engagement-models.blade.php ENDPATH**/ ?>