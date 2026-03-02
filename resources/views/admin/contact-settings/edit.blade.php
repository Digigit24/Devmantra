@extends('layouts.admin')
@section('title', 'Contact Settings')

@section('content')
<form method="POST" action="{{ route('admin.contact-settings.update') }}">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Contact Information</h6>
                <div class="dm-form-group">
                    <label class="dm-form-label">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="dm-form-input" placeholder="+91-8042061247">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="dm-form-input" placeholder="support@devmantra.com">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Office Address</label>
                    <textarea name="address" class="dm-form-textarea" style="min-height:80px;">{{ old('address', $contact->address) }}</textarea>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Office Hours</label>
                    <input type="text" name="office_hours" value="{{ old('office_hours', $contact->office_hours) }}" class="dm-form-input" placeholder="Mon - Fri: 9:00 AM - 6:00 PM">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Google Map Embed URL</label>
                    <input type="text" name="google_map_embed" value="{{ old('google_map_embed', $contact->google_map_embed) }}" class="dm-form-input" placeholder="https://www.google.com/maps/embed?pb=...">
                    <div class="dm-form-hint">Paste the src URL from Google Maps embed iframe</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;">
                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Social Media Links</h6>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-facebook-f" style="margin-right:6px;"></i> Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $contact->facebook_url) }}" class="dm-form-input" placeholder="https://facebook.com/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-x-twitter" style="margin-right:6px;"></i> X (Twitter) URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $contact->twitter_url) }}" class="dm-form-input" placeholder="https://x.com/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-linkedin-in" style="margin-right:6px;"></i> LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $contact->linkedin_url) }}" class="dm-form-input" placeholder="https://linkedin.com/company/...">
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label"><i class="fa-brands fa-instagram" style="margin-right:6px;"></i> Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $contact->instagram_url) }}" class="dm-form-input" placeholder="https://instagram.com/...">
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100 mt-3">
                    <i class="fa-solid fa-check"></i> Save Settings
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
