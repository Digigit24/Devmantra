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
    $clienteleTitle      = $data['clientele_title']      ?? 'Our Clientele';
    $featuresLabel       = $data['features_label']       ?? 'What We Do';
    $featuresTitle       =  'Financial and Advisory Expertise' ?? $data['features_title'] ;
    $featuresDescription = $data['features_description'] ?? '';
?>

<div class="cr-brand-area cr-brand-ptb fix cr-multi-border-bottom">
    <div class="container container-1230">
        <div class="cr-multi-border ">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="cr-brand-heading text-center mb-60">
                        <div class="ca-brand-sub mb-70">
                            <img src="<?php echo e(asset('assets/img/home-13/brand/brand-sub.png')); ?>" alt="" loading="lazy">
                        </div>
                        <div class="tp_text_anim">
                           

                            <div class="tp-section-subtitle-gradient ct mb-20"><?php echo e($clienteleTitle); ?></div>
                        </div>

                        <h3 class="tp-section-title-onest fs-72">Trusted by Leaders</h3>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="cr-brand-wrapper pb-80">
                        <div class="swiper-container app-brand-active fix">
                            <div class="swiper-wrapper slider-transtion">
                                <?php for($i = 1; $i <= 20; $i++): ?>
                                <div class="swiper-slide">
                                    <div class="app-brand-item">
                                        <img src="<?php echo e(asset('assets/img/logo/'.$i.'.png')); ?>" alt="" loading="lazy">
                                    </div>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <div class="cr-brand-bottom">
                        <img src="<?php echo e(asset('assets/img/home-13/brand/brand-bottom.png')); ?>" alt="" loading="lazy">
                    </div>
                </div>
            </div>

            <!-- VALUES 6-CARD GRID -->
            <div class="row values-card">
                <div class="col-lg-12">
                    <div class="text-center mb-40">
                        <div class="tp-section-subtitle-gradient ct mb-15">What Drives Us</div>
                        <h4 class="tp-section-title-onest" style="font-size:42px;">Our Values</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="cr-feature-item hight mb-15">
                        <div class="cr-feature-thumb big anim-zoomin-wrap text-center">
                            <div class="cr-feature-thumb big text-center" style="padding:20px 30px;">
                                <div class="mv-grid">
                                    <div class="mv-card">
                                        <h4>Our Mission</h4>
                                        <p>Our mission is to empower businesses across the globe by providing comprehensive financial and management consulting services that drive growth, ensure compliance, and enhance operational efficiency. We strive to build lasting relationships with our clients based on trust, transparency, and a deep understanding of their unique needs.</p>
                                    </div>
                                    <div class="mv-card">
                                        <h4>Our Vision</h4>
                                        <p>Our vision is to be the premier finance and management consulting firm recognized for our unwavering commitment to excellence, innovation, and integrity. We aim to be the trusted advisor for businesses across markets of all sizes, helping them navigate the complexities of the financial world and achieve their strategic objectives.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="dm-values-grid">
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="<?php echo e(asset('assets/img/logo/icon/1.png')); ?>" alt="" loading="lazy"></div>
                            <h5>Trust</h5>
                            <p style="color: black;">We build strong, lasting relationships with our clients based on mutual trust and respect. Our commitment to integrity ensures that we always act in the best interest of our clients.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="<?php echo e(asset('assets/img/logo/icon/2.png')); ?>" alt="" loading="lazy"></div>
                            <h5>Transparency</h5>
                            <p style="color: black;">We maintain open and honest communication, ensuring our clients are fully informed and confident in their financial decisions.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="<?php echo e(asset('assets/img/logo/icon/3.png')); ?>" alt="" loading="lazy"></div>
                            <h5>Integrity</h5>
                            <p style="color: black;">We uphold the highest ethical standards in all our dealings, ensuring fairness and honesty. Integrity is the foundation of our practice, guiding our actions and decisions.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="<?php echo e(asset('assets/img/logo/icon/4.png')); ?>" alt="" loading="lazy"></div>
                            <h5>Tech Integration</h5>
                            <p style="color: black;">We leverage the latest technology to provide innovative solutions that enhance efficiency, accuracy, and convenience for our clients.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="<?php echo e(asset('assets/img/logo/icon/5.png')); ?>" alt="" loading="lazy"></div>
                            <h5>Excellence</h5>
                            <p style="color: black;">We are committed to delivering the highest quality services and continuously improving our processes. Our dedication to excellence drives us to exceed client expectations.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="<?php echo e(asset('assets/img/logo/icon/6.png')); ?>" alt="" loading="lazy"></div>
                            <h5>Client-Centric Approach</h5>
                            <p style="color: black;">We prioritize the needs and goals of our clients, offering tailored solutions that align with their unique requirements.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\page-clientele.blade.php ENDPATH**/ ?>