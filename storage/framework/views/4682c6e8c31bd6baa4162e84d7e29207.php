<?php $__env->startSection('title', ($event->title ?? 'Events') . ' - DevMantra'); ?>
<?php $__env->startSection('meta_description', $event->meta_description ?? 'Dev Mantra events, news coverage, and media highlights.'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .dm-events-hero { background-color: #001d30; padding: 200px 0 120px; }
    .dm-events-hero-desc {
        font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px;
        line-height: 1.7; font-family: var(--tp-ff-onest);
    }
    @media (max-width: 767px) {
        .dm-events-hero { padding: 150px 0 70px; }
    }

    /* Top Section: Text left + Featured Image right */
    .dm-event-top { padding: 100px 0 60px; }
    .dm-event-top-title {
        font-size: 36px; font-weight: 700; line-height: 1.3;
        color: var(--tp-common-black, #111); font-family: var(--tp-ff-onest);
        margin-bottom: 24px;
    }
    .dm-event-top-title span { color: #1d6aa9; }
    .dm-event-top-desc {
        font-size: 16px; line-height: 1.8; color: rgba(0,0,0,0.6);
        font-family: var(--tp-ff-onest);
    }
    .dm-event-top-desc p { margin-bottom: 16px; }
    .dm-event-featured-img {
        width: 100%; border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        object-fit: cover; max-height: 460px;
    }
    @media (max-width: 991px) {
        .dm-event-top { padding: 60px 0 40px; }
        .dm-event-top-title { font-size: 28px; }
        .dm-event-featured-img { margin-top: 30px; height: auto; object-fit:contain; }
    }

    /* Gallery Section */
    .dm-event-gallery { padding: 0 0 100px; }
    .dm-event-gallery-title {
        font-size: 28px; font-weight: 700;
        color: var(--tp-common-black, #111); font-family: var(--tp-ff-onest);
        margin-bottom: 40px; text-align: center;
    }
    .dm-event-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }
    .dm-event-gallery-item {
        border-radius: 12px; overflow: hidden;
        border: 1px solid rgba(0,0,0,0.06);
        transition: all 0.3s ease; cursor: pointer;
    }
    .dm-event-gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    .dm-event-gallery-item img {
        width: 100%; height: 220px; object-fit: cover;
        display: block; transition: transform 0.4s ease;
    }
    .dm-event-gallery-item:hover img { transform: scale(1.05); }
    @media (max-width: 767px) {
        .dm-event-gallery { padding: 0 0 60px; }
        .dm-event-gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
        }
        .dm-event-gallery-item img { height: 170px; }
    }

    /* Empty state */
    .dm-events-empty {
        text-align: center; padding: 100px 20px;
        color: rgba(0,0,0,0.4); font-size: 18px;
        font-family: var(--tp-ff-onest);
    }
    .dm-events-empty i { font-size: 48px; display: block; margin-bottom: 16px; opacity: 0.3; }

    /* Lightbox */
    .dm-lightbox-overlay {
        display: none; position: fixed; top: 0; left: 0;
        width: 100%; height: 100%; background: rgba(0,0,0,0.9);
        z-index: 9999; align-items: center; justify-content: center;
        cursor: pointer;
    }
    .dm-lightbox-overlay.active { display: flex; }
    .dm-lightbox-overlay img {
        max-width: 90%; max-height: 90vh; border-radius: 8px;
        object-fit: contain; cursor: default;
    }
    .dm-lightbox-close {
        position: absolute; top: 20px; right: 30px;
        color: #fff; font-size: 32px; cursor: pointer;
        background: none; border: none; z-index: 10000;
    }
    .dm-lightbox-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        color: #fff; font-size: 28px; cursor: pointer;
        background: rgba(255,255,255,0.15); border: none;
        width: 50px; height: 50px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.3s;
    }
    .dm-lightbox-nav:hover { background: rgba(255,255,255,0.3); }
    .dm-lightbox-prev { left: 20px; }
    .dm-lightbox-next { right: 20px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero -->
<div class="dm-events-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Events</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Our Events &<br>Media Presence
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-events-hero-desc">Discover Dev Mantra's latest events, industry recognition, and media coverage that highlight our commitment to driving innovation.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($event): ?>
<!-- Top Section: Text + Featured Image -->
<div class="dm-event-top">
    <div class="container container-1230">
        <div class="row align-items-center">
            <div class="col-lg-6 tp_fade_anim" data-delay=".3">
                <h2 class="dm-event-top-title"><?php echo e($event->title); ?></h2>
                <div class="dm-event-top-desc">
                    <?php echo $event->description; ?>

                </div>
            </div>
            <div class="col-lg-6 tp_fade_anim" data-delay=".5">
                <?php if($event->featured_image): ?>
                <img src="<?php echo e(str_starts_with($event->featured_image, 'http') ? $event->featured_image : asset('storage/' . $event->featured_image)); ?>" alt="<?php echo e($event->title); ?>" class="dm-event-featured-img">
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Image Gallery -->
<?php if($event->galleryImages->count()): ?>
<div class="dm-event-gallery">
    <div class="container container-1230">
        <div class="dm-event-gallery-grid">
            <?php $__currentLoopData = $event->galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="dm-event-gallery-item tp_fade_anim" data-delay=".<?php echo e(3 + ($index % 4)); ?>" onclick="openLightbox(<?php echo e($index); ?>)">
                <img src="<?php echo e(str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path)); ?>" alt="<?php echo e($event->title); ?> - Gallery Image <?php echo e($index + 1); ?>">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<!-- Lightbox -->
<div class="dm-lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox(event)">
    <button class="dm-lightbox-close" onclick="closeLightbox(event)"><i class="fa-solid fa-xmark"></i></button>
    <button class="dm-lightbox-nav dm-lightbox-prev" onclick="navigateLightbox(event, -1)"><i class="fa-solid fa-chevron-left"></i></button>
    <img id="lightboxImage" src="" alt="">
    <button class="dm-lightbox-nav dm-lightbox-next" onclick="navigateLightbox(event, 1)"><i class="fa-solid fa-chevron-right"></i></button>
</div>
<?php endif; ?>

<?php else: ?>
<div class="dm-events-empty">
    <i class="fa-solid fa-calendar-days"></i>
    No events published yet. Check back soon!
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function() {
    var images = <?php echo json_encode($event && $event->galleryImages->count() ? $event->galleryImages->map(fn($img) => str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path)) : [], 512) ?>;
    var currentIndex = 0;

    window.openLightbox = function(index) {
        currentIndex = index;
        var overlay = document.getElementById('lightboxOverlay');
        var img = document.getElementById('lightboxImage');
        img.src = images[currentIndex];
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function(e) {
        if (e.target === document.getElementById('lightboxOverlay') || e.currentTarget.classList.contains('dm-lightbox-close')) {
            document.getElementById('lightboxOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    window.navigateLightbox = function(e, direction) {
        e.stopPropagation();
        currentIndex = (currentIndex + direction + images.length) % images.length;
        document.getElementById('lightboxImage').src = images[currentIndex];
    };

    document.addEventListener('keydown', function(e) {
        var overlay = document.getElementById('lightboxOverlay');
        if (!overlay || !overlay.classList.contains('active')) return;
        if (e.key === 'Escape') { overlay.classList.remove('active'); document.body.style.overflow = ''; }
        if (e.key === 'ArrowLeft') window.navigateLightbox(e, -1);
        if (e.key === 'ArrowRight') window.navigateLightbox(e, 1);
    });
})();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\frontend\events.blade.php ENDPATH**/ ?>