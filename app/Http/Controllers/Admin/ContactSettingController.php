<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $contact = ContactSetting::instance();

        return view('admin.contact-settings.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'google_map_embed' => 'nullable|string|max:2000',
            'facebook_url' => 'nullable|url|max:500',
            'twitter_url' => 'nullable|url|max:500',
            'linkedin_url' => 'nullable|url|max:500',
            'instagram_url' => 'nullable|url|max:500',
            'whatsapp_url' => 'nullable|url|max:500',
            'office_hours' => 'nullable|string|max:500',
        ]);

        $contact = ContactSetting::instance();
        $contact->update($validated);

        return redirect()->route('admin.contact-settings.edit')->with('success', 'Contact settings updated successfully.');
    }
}
