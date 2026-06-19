
<style>
footer.z-index-1 { background-color: #001d30; }
.cr-footer-bg { display: none; }
</style>
<footer class="z-index-1 include-bg">
    <div class="cr-footer-bg">
        <img src="<?php echo e(asset('assets/img/home-13/footer/cr-footer-bg.png')); ?>" alt="" loading="lazy">
    </div>
    <div class="dgm-footer-area cr-footer-area pb-60">
        <div class="container container-1230">
            <div class="cr-footer-border-wrap pt-140">
                <div class="cr-footer-inner-warp z-index-1">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-40 tp_fade_anim" data-delay=".3">
                            <div class="dgm-footer-widget cr-footer-col-1 z-index-1">
                                <div class="dgm-footer-logo mb-20">
                                    <a href="<?php echo e(route('home')); ?>"><img style="border-radius: 20px;" data-width="160px" src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra"></a>
                                </div>
                                <div class="dgm-footer-widget-paragraph mb-30">
                                    <p>Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy.</p>
                                </div>
                                <?php $instaUrl = $footerContact->instagram_url ?: 'https://www.instagram.com/devmantra_official/'; ?>
                                <?php if($footerContact->facebook_url || $footerContact->twitter_url || $footerContact->linkedin_url || $instaUrl || $footerContact->whatsapp_url): ?>
                                <div class="cr-footer-widget-social mb-35">
                                    <div class="tp-footer-widget-social">
                                        <?php if($footerContact->facebook_url): ?>
                                        <a href="<?php echo e($footerContact->facebook_url); ?>" target="_blank" rel="noopener" aria-label="Facebook"><span><i class="fa-brands fa-facebook-f"></i></span></a>
                                        <?php endif; ?>
                                        <?php if($footerContact->twitter_url): ?>
                                        <a href="<?php echo e($footerContact->twitter_url); ?>" target="_blank" rel="noopener" aria-label="X"><span><i class="fa-brands fa-x-twitter"></i></span></a>
                                        <?php endif; ?>
                                        <?php if($footerContact->linkedin_url): ?>
                                        <a href="<?php echo e($footerContact->linkedin_url); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><span><i class="fa-brands fa-linkedin-in"></i></span></a>
                                        <?php endif; ?>
                                        <a href="<?php echo e($instaUrl); ?>" target="_blank" rel="noopener" aria-label="Instagram"><span><i class="fa-brands fa-instagram"></i></span></a>
                                        <?php if($footerContact->whatsapp_url): ?>
                                        <a href="<?php echo e($footerContact->whatsapp_url); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><span><i class="fa-brands fa-whatsapp"></i></span></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 mb-40 tp_fade_anim" data-delay=".5">
                            <div class="dgm-footer-widget app-footer-widget cr-footer-col-2">
                                <h4 class="dgm-footer-widget-title">Quick Links</h4>
                                <div class="dgm-footer-widget-menu">
                                    <ul>
                                        <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                        <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                                        <li><a href="<?php echo e(route('blog.index')); ?>">Blog</a></li>
                                        <li><a href="<?php echo e(route('newsletter.index')); ?>">Newsletter</a></li>
                                        <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                                        <li><a href="<?php echo e(route('privacy-policy')); ?>">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 mb-40 tp_fade_anim" data-delay=".7">
                            <div class="dgm-footer-widget app-footer-widget cr-footer-col-3">
                                <h4 class="dgm-footer-widget-title">Expertise</h4>
                                <div class="dgm-footer-widget-menu">
                                    <ul>
                                        <?php $__currentLoopData = $footerServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('service.show', $fs->slug)); ?>"><?php echo e($fs->title); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3 mb-40 tp_fade_anim" data-delay=".9">
                            <div class="dgm-footer-widget app-footer-widget cr-footer-col-4">
                                <h4 class="dgm-footer-widget-title">Contact</h4>
                                <?php if($footerContact->phone): ?>
                                <div class="app-footer-widget-info mb-20">
                                    <div class="app-footer-widget-info-title">Call us</div>
                                    <a class="tp-line-white" href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $footerContact->phone)); ?>"><?php echo e($footerContact->phone); ?></a>
                                </div>
                                <?php endif; ?>
                                <?php if($footerContact->email): ?>
                                <div class="app-footer-widget-info mb-20">
                                    <div class="app-footer-widget-info-title">Email</div>
                                    <a class="tp-line-white" href="mailto:<?php echo e($footerContact->email); ?>"><?php echo e($footerContact->email); ?></a>
                                </div>
                                <?php endif; ?>
                                <?php if($footerContact->address): ?>
                                <div class="app-footer-widget-info">
                                    <div class="app-footer-widget-info-title">Address</div>
                                    <a><?php echo e($footerContact->address); ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tp-copyright-2-area tp-copyright-2-border cr-copyright-border">
        <div class="container container-1430">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="app-copyright-text text-center z-index-1">
                        <p>&copy; <?php echo e(date('Y')); ?> Dev Mantra. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\frontend\partials\footer.blade.php ENDPATH**/ ?>