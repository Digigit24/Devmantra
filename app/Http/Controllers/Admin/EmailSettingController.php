<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSettingController extends Controller
{
    public function edit()
    {
        $emailSetting = EmailSetting::instance();

        return view('admin.email-settings.edit', compact('emailSetting'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'smtp_host' => 'required|string|max:255',
            'smtp_port' => 'required|integer|between:1,65535',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:1000',
            'smtp_encryption' => 'required|in:tls,ssl',
            'from_name' => 'required|string|max:255',
            'from_email' => 'required|email|max:255',
            'reply_to_email' => 'nullable|email|max:255',
            'enable_reply_feature' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'business_email_domains' => 'nullable|string|max:1000',
        ]);

        // Convert checkbox strings to booleans
        $validated['enable_reply_feature'] = $request->boolean('enable_reply_feature');
        $validated['is_active'] = $request->boolean('is_active');

        // If password is not provided, keep the existing one
        if (empty($validated['smtp_password'])) {
            $emailSetting = EmailSetting::instance();
            if ($emailSetting->smtp_password) {
                unset($validated['smtp_password']);
            }
        }

        $emailSetting = EmailSetting::instance();
        $emailSetting->update($validated);

        return redirect()->route('admin.email-settings.edit')
            ->with('success', 'Email settings updated successfully.');
    }

    public function test(Request $request)
    {
        try {
            $emailSetting = EmailSetting::instance();

            if (!$emailSetting->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email settings are not active. Please enable them first.',
                ], 422);
            }

            // Set the mail configuration dynamically
            config([
                'mail.mailers.smtp.host' => $emailSetting->smtp_host,
                'mail.mailers.smtp.port' => $emailSetting->smtp_port,
                'mail.mailers.smtp.username' => $emailSetting->smtp_username,
                'mail.mailers.smtp.password' => $emailSetting->smtp_password_decrypted,
                'mail.mailers.smtp.encryption' => $emailSetting->smtp_encryption,
                'mail.from.address' => $emailSetting->from_email,
                'mail.from.name' => $emailSetting->from_name,
            ]);

            // Send test email to the logged-in admin
            $testEmail = auth()->user()->email;

            Mail::raw(
                'This is a test email to verify your SMTP configuration is working correctly. If you received this email, your email settings are configured properly.',
                function ($message) use ($emailSetting, $testEmail) {
                    $message->to($testEmail)
                        ->subject('Email Settings Test - ' . config('app.name'))
                        ->from($emailSetting->from_email, $emailSetting->from_name);
                }
            );

            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully to ' . $testEmail . '. Please check your inbox.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Email settings test failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Test email failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
