<?php $__env->startSection('title', 'Contact Settings'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('admin.contact-settings.update')); ?>">
    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Contact Information</h6>
                <div class="dm-form-group">
                    <label class="dm-form-label">Phone Number</label>
                    <input type="text" name="phone" value="<?php echo e(old('phone', $contact->phone)); ?>" class="dm-form-input" placeholder="+91-80-42061247">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Email Address</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $contact->email)); ?>" class="dm-form-input" placeholder="support@devmantra.com">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Office Address</label>
                    <textarea name="address" class="dm-form-textarea" style="min-height:80px;"><?php echo e(old('address', $contact->address)); ?></textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Office Hours</label>
                    <input type="text" name="office_hours" value="<?php echo e(old('office_hours', $contact->office_hours)); ?>" class="dm-form-input" placeholder="Mon - Fri: 9:00 AM - 6:00 PM">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Google Map Embed URL</label>
                    <input type="text" name="google_map_embed" value="<?php echo e(old('google_map_embed', $contact->google_map_embed)); ?>" class="dm-form-input" placeholder="https://www.google.com/maps/embed?pb=...">
                    <div class="dm-form-hint">Paste the src URL from Google Maps embed iframe</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Social Media Links</h6>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-facebook-f" style="margin-right:6px;"></i> Facebook URL</label>
                    <input type="url" name="facebook_url" value="<?php echo e(old('facebook_url', $contact->facebook_url)); ?>" class="dm-form-input" placeholder="https://facebook.com/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-x-twitter" style="margin-right:6px;"></i> X (Twitter) URL</label>
                    <input type="url" name="twitter_url" value="<?php echo e(old('twitter_url', $contact->twitter_url)); ?>" class="dm-form-input" placeholder="https://x.com/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-linkedin-in" style="margin-right:6px;"></i> LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="<?php echo e(old('linkedin_url', $contact->linkedin_url)); ?>" class="dm-form-input" placeholder="https://linkedin.com/company/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-instagram" style="margin-right:6px;"></i> Instagram URL</label>
                    <input type="url" name="instagram_url" value="<?php echo e(old('instagram_url', $contact->instagram_url)); ?>" class="dm-form-input" placeholder="https://instagram.com/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-whatsapp" style="margin-right:6px;"></i> WhatsApp URL</label>
                    <input type="url" name="whatsapp_url" value="<?php echo e(old('whatsapp_url', $contact->whatsapp_url)); ?>" class="dm-form-input" placeholder="https://wa.me/919876543210">
                    <div class="dm-form-hint">Use format: https://wa.me/&lt;phone number with country code&gt;</div>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100 mt-3">
                    <i class="fa-solid fa-check"></i> Save Settings
                </button>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\contact-settings\edit.blade.php ENDPATH**/ ?>