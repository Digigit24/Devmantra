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
    $title    = $data['title']    ?? 'Frequently Asked Questions';
    $subtitle = $data['subtitle'] ?? '';
    $items    = $data['items']    ?? [];   // [{question, answer}]
    $uid      = 'faq_' . substr(md5(json_encode($data)), 0, 8);
?>

<?php if (! $__env->hasRenderedOnce('eb287741-da47-42a3-b7fa-8adfa0d3ffe2')): $__env->markAsRenderedOnce('eb287741-da47-42a3-b7fa-8adfa0d3ffe2'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-faq { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-faq-header { text-align: center; margin-bottom: 50px; }
.ss-faq-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 14px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-faq-title { font-size: 26px; } }
.ss-faq-subtitle { font-size: 16px; color: #666; line-height: 1.7; }
.ss-faq-item {
    background: #fff;
    border-radius: 12px;
    margin-bottom: 12px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.06);
}
.ss-faq-q {
    width: 100%; text-align: left;
    padding: 22px 28px;
    font-size: 16px; font-weight: 600; color: #0d1b2a;
    background: none; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    font-family: var(--tp-ff-onest);
    transition: color .2s;
}
.ss-faq-q:hover { color: #1b3c6b; }
.ss-faq-q.open { color: #1b3c6b; }
.ss-faq-q-icon { font-size: 12px; transition: transform .25s; flex-shrink: 0; }
.ss-faq-q.open .ss-faq-q-icon { transform: rotate(180deg); }
.ss-faq-a {
    max-height: 0; overflow: hidden;
    font-size: 15px; color: #555; line-height: 1.8;
    transition: max-height .35s ease, padding .35s ease;
}
.ss-faq-a.open {
    max-height: 600px;
    padding: 0 28px 22px;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-faq">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="ss-faq-header tp_fade_anim" data-delay=".2">
                    <h2 class="ss-faq-title"><?php echo e($title); ?></h2>
                    <?php if($subtitle): ?><p class="ss-faq-subtitle"><?php echo e($subtitle); ?></p><?php endif; ?>
                </div>
                <div id="<?php echo e($uid); ?>" class="tp_fade_anim" data-delay=".3">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="ss-faq-item">
                        <button class="ss-faq-q" data-faq="<?php echo e($uid); ?>-<?php echo e($i); ?>">
                            <?php echo e($item['question'] ?? ''); ?>

                            <i class="fa-solid fa-chevron-down ss-faq-q-icon"></i>
                        </button>
                        <div class="ss-faq-a" id="<?php echo e($uid); ?>-a-<?php echo e($i); ?>"><?php echo e($item['answer'] ?? ''); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
(function(){
    document.querySelectorAll('#<?php echo e($uid); ?> .ss-faq-q').forEach(function(btn){
        btn.addEventListener('click', function(){
            var idx = this.dataset.faq;
            var ans = document.getElementById(idx.replace('-<?php echo e($uid); ?>-', '<?php echo e($uid); ?>-a-').replace(/.*-(\d+)$/, '<?php echo e($uid); ?>-a-$1'));
            // find the answer sibling
            var ansEl = this.nextElementSibling;
            var isOpen = ansEl.classList.contains('open');
            // close all in this faq block
            document.querySelectorAll('#<?php echo e($uid); ?> .ss-faq-a').forEach(function(a){ a.classList.remove('open'); });
            document.querySelectorAll('#<?php echo e($uid); ?> .ss-faq-q').forEach(function(b){ b.classList.remove('open'); });
            if(!isOpen){ ansEl.classList.add('open'); this.classList.add('open'); }
        });
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/components/service-sections/faq.blade.php ENDPATH**/ ?>