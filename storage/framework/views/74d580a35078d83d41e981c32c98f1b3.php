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
    $title    = $data['title']    ?? 'Meet Our Team';
    $subtitle = $data['subtitle'] ?? 'The people behind Devmantra who drive excellence every day.';

    $founders = $data['founders'] ?? [
        ['name' => 'Vikash Tatia',  'role' => 'Founder & MD',        'photo' => 'assets/img/team/6.png'],
        ['name' => 'Nidhi Tatia',   'role' => 'Founder & Director',  'photo' => 'assets/img/team/7.png'],
    ];
    $partners = $data['partners'] ?? [
        ['name' => 'Sankaranarayanan',   'role' => 'Director & Associate Partner',         'photo' => 'assets/img/team/8.png'],
        ['name' => 'Kamal Parakh',       'role' => 'Associate Director & Senior Partner',  'photo' => 'assets/img/team/9.png'],
        ['name' => 'Darshit Bombaywala','role' => 'Associate Partner',                     'photo' => 'assets/img/team/10.png'],
        ['name' => 'Pawan Bhotika',     'role' => 'Advisor - Agri Business',              'photo' => 'assets/img/team/11.png'],
        ['name' => 'BC Datta',          'role' => 'Associate Director - Corporate Affairs','photo' => 'assets/img/team/12.png'],
    ];
    $teamMembers = $data['team_members'] ?? [
        ['name' => 'Abhinaya U',       'role' => 'Associate - Investment Banking', 'photo' => 'assets/img/team/1.png'],
        ['name' => 'Sandeep Dhupar',   'role' => 'Associate Director',             'photo' => 'assets/img/team/2.png'],
        ['name' => 'Jalandhar Behera', 'role' => 'Associate VP - FAO Services',    'photo' => 'assets/img/team/3.png'],
        ['name' => 'Rajani M',         'role' => 'Talent Acquisition Lead',        'photo' => 'assets/img/team/4.png'],
        ['name' => 'Namrata Parakh',   'role' => 'Associate - Intl Relations',     'photo' => 'assets/img/team/5.png'],
    ];
?>

<!-- team section start -->
<section class="dm-team-section">
    <div class="container">
        <div class="dm-team-header text-center">
            <h2 class="dm-team-main-title"><?php echo e($title); ?></h2>
            <p class="dm-team-main-subtitle"><?php echo e($subtitle); ?></p>
        </div>

        <?php if(!empty($founders)): ?>
        <!-- Founders -->
        <h3 class="dm-team-group-title">Founders</h3>
        <div class="row dm-team-row justify-content-center">
            <?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="<?php echo e(asset($member['photo'] ?? 'assets/img/team/6.jpg')); ?>" alt="<?php echo e($member['name'] ?? ''); ?>" loading="lazy">
                    </div>
                    <span class="dm-team-role"><?php echo e($member['role'] ?? ''); ?></span>
                    <h4 class="dm-team-name"><?php echo e($member['name'] ?? ''); ?></h4>
                    <?php if(!empty($member['linkedin'])): ?>
                    <a href="<?php echo e($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="dm-team-linkedin" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($partners)): ?>
        <!-- Partners & Advisory Board -->
        <h3 class="dm-team-group-title">Partners & Advisory Board</h3>
        <div class="row dm-team-row justify-content-center">
            <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="<?php echo e(asset($member['photo'] ?? 'assets/img/team/8.jpg')); ?>" alt="<?php echo e($member['name'] ?? ''); ?>">
                    </div>
                    <span class="dm-team-role"><?php echo e($member['role'] ?? ''); ?></span>
                    <h4 class="dm-team-name"><?php echo e($member['name'] ?? ''); ?></h4>
                    <?php if(!empty($member['linkedin'])): ?>
                    <a href="<?php echo e($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="dm-team-linkedin" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($teamMembers)): ?>
        <!-- Team -->
        <h3 class="dm-team-group-title">Team</h3>
        <div class="row dm-team-row justify-content-center">
            <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="<?php echo e(asset($member['photo'] ?? 'assets/img/team/1.png')); ?>" alt="<?php echo e($member['name'] ?? ''); ?>">
                    </div>
                    <span class="dm-team-role"><?php echo e($member['role'] ?? ''); ?></span>
                    <h4 class="dm-team-name"><?php echo e($member['name'] ?? ''); ?></h4>
                    <?php if(!empty($member['linkedin'])): ?>
                    <a href="<?php echo e($member['linkedin']); ?>" target="_blank" rel="noopener noreferrer" class="dm-team-linkedin" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- team section end -->
<?php /**PATH C:\Users\hrith\ritik\Devmantranew\resources\views/components/service-sections/page-team.blade.php ENDPATH**/ ?>