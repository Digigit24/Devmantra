<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    
    <url>
        <loc><?php echo e(url('/')); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc><?php echo e(url('/about')); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/contact')); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/blog')); ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/newsletter')); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/reports')); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/case-study')); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/alert')); ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc><?php echo e(url('/events')); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?php echo e(url('/careers')); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc><?php echo e(url('/privacy-policy')); ?></loc>
        <changefreq>yearly</changefreq>
        <priority>0.30</priority>
    </url>
    <url>
        <loc><?php echo e(url('/india-europe-benchmarking-calculator')); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>

    
    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/services/' . $service->slug)); ?></loc>
        <lastmod><?php echo e($service->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.90</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/blog/' . $blog->slug)); ?></loc>
        <lastmod><?php echo e($blog->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $caseStudies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caseStudy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/case-study/' . $caseStudy->slug)); ?></loc>
        <lastmod><?php echo e($caseStudy->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/reports/' . $report->slug)); ?></loc>
        <lastmod><?php echo e($report->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsletter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/newsletter/' . $newsletter->slug)); ?></loc>
        <lastmod><?php echo e($newsletter->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/alert/' . $alert->slug)); ?></loc>
        <lastmod><?php echo e($alert->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/events/' . $event->slug)); ?></loc>
        <lastmod><?php echo e($event->updated_at->toAtomString()); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.60</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/careers/' . $career->slug)); ?></loc>
        <lastmod><?php echo e($career->updated_at->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.60</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</urlset>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\sitemap.blade.php ENDPATH**/ ?>