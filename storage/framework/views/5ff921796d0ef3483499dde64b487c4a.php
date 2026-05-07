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
    use App\Models\Blog;
    $sectionTitle    = $data['title']             ?? 'Explore our latest insights & updates';
    $sectionSubtitle = $data['subtitle']          ?? 'Insights';
    $exploreText     = $data['explore_link_text'] ?? 'Explore more insights from Dev Mantra';
    $exploreUrl      = $data['explore_link_url']  ?? '/blog';
    $count           = (int) ($data['count']      ?? 3);

    $blogs = Blog::published()->latest('published_at')->take($count)->get();
?>

<?php if (! $__env->hasRenderedOnce('16cc9b8e-4988-4b39-a043-de4f149fae84')): $__env->markAsRenderedOnce('16cc9b8e-4988-4b39-a043-de4f149fae84'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.cr-blog-area-dark { background: #001d30; }
.cr-blog-area-dark .tp-section-subtitle-gradient.ct { color: #fff; }
.cr-blog-area-dark .tp-section-title-onest { color: #fff !important; }
.cr-blog-area-dark .cr-blog-item-category { color: #fff; }
.cr-blog-area-dark .cr-blog-item-title { color: #fff; }
.cr-blog-area-dark .cr-blog-item-title a { color: #fff; }
.cr-blog-area-dark .cr-blog-item-meta { color: rgba(255,255,255,0.5); }
.cr-blog-area-dark .cr-blog-bottom-text { color: #fff; }
.cr-blog-area-dark .cr-blog-bottom-border { border-bottom-color: rgba(255,255,255,0.07); }
.cr-blog-area-dark .cr-multi-border { border-color: rgba(255,255,255,0.07); }
.cr-blog-area-dark .cr-multi-border::after,
.cr-blog-area-dark .cr-multi-border::before { background-color: rgba(255,255,255,0.07); }
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<!-- blog area start -->
<div class="cr-blog-area cr-blog-area-dark">
    <div class="container container-1230">
        <div class="cr-multi-border pt-120">
            <div class="cr-blog-bottom-border">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-blog-heading text-center pb-60">
                            <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3"><?php echo e($sectionSubtitle); ?></div>
                            <h4 class="tp-section-title-onest fs-72 tp-text-revel-anim"><?php echo nl2br(e($sectionTitle)); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="cr-blog-item mb-30">
                            <div class="cr-blog-item-thumb">
                                <a href="<?php echo e(route('blog.show', $blog->slug)); ?>">
                                    <?php if($blog->featured_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>" loading="lazy">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/img/home-13/blog/blog-thumb-'.(($loop->index % 3)+1).'.jpg')); ?>" alt="<?php echo e($blog->title); ?>" loading="lazy">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="cr-blog-item-content">
                                <span class="cr-blog-item-category"><?php echo e($blog->category ?? 'Blog'); ?></span>
                                <h4 class="cr-blog-item-title">
                                    <a class="tp-line-white" href="<?php echo e(route('blog.show', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                </h4>
                                <p class="cr-blog-item-meta"><?php echo e($blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y')); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cr-blog-bottom text-center tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                            <a href="<?php echo e($exploreUrl); ?>" class="cr-blog-bottom-text"><?php echo e($exploreText); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog area end -->
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/components/service-sections/page-blogs.blade.php ENDPATH**/ ?>