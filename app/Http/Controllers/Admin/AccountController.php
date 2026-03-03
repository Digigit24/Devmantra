<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    // ── Profile ───────────────────────────────────────────────

    public function profile()
    {
        return view('admin.account.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    // ── Change Password ──────────────────────────────────────

    public function password()
    {
        return view('admin.account.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    // ── Settings ─────────────────────────────────────────────

    public function settings()
    {
        return view('admin.account.settings', [
            'user'     => auth()->user(),
            'settings' => SiteSetting::all_cached(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'brand_color_from'      => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'brand_color_to'        => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'primary_button_text'   => ['nullable', 'string', 'max:120'],
            'primary_button_url'    => ['nullable', 'string', 'max:500'],
            'secondary_button_text' => ['nullable', 'string', 'max:120'],
            'secondary_button_link' => ['nullable', 'string', 'max:500'],
        ]);

        $keys = ['brand_color_from', 'brand_color_to', 'primary_button_text', 'primary_button_url', 'secondary_button_text', 'secondary_button_link'];

        foreach ($keys as $key) {
            SiteSetting::set($key, $request->input($key, ''));
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
