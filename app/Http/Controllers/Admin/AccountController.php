<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'user' => auth()->user(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        // Placeholder for future site-wide settings
        return back()->with('success', 'Settings saved successfully.');
    }
}
