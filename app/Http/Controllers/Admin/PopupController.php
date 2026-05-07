<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function edit()
    {
        return view('admin.popup.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'popup_headline'           => 'nullable|string|max:300',
            'popup_subtext'            => 'nullable|string|max:1000',
            'popup_points'             => 'nullable|string',
            'popup_primary_cta_text'   => 'nullable|string|max:120',
            'popup_primary_cta_url'    => 'nullable|string|max:500',
            'popup_secondary_cta_text' => 'nullable|string|max:120',
            'popup_secondary_cta_url'  => 'nullable|string|max:500',
            'popup_supporting_text'    => 'nullable|string|max:300',
            'popup_trigger_scroll'     => 'nullable|integer|min:10|max:95',
            'popup_timer_delay'        => 'nullable|integer|min:1|max:120',
        ]);

        SiteSetting::setMany([
            'popup_enabled'            => $request->boolean('popup_enabled') ? '1' : '0',
            'popup_show_exit_intent'   => $request->boolean('popup_show_exit_intent') ? '1' : '0',
            'popup_show_scroll'        => $request->boolean('popup_show_scroll') ? '1' : '0',
            'popup_timer_enabled'      => $request->boolean('popup_timer_enabled') ? '1' : '0',
            'popup_headline'           => $request->input('popup_headline', ''),
            'popup_subtext'            => $request->input('popup_subtext', ''),
            'popup_points'             => $request->input('popup_points', ''),
            'popup_primary_cta_text'   => $request->input('popup_primary_cta_text', ''),
            'popup_primary_cta_url'    => $request->input('popup_primary_cta_url', ''),
            'popup_secondary_cta_text' => $request->input('popup_secondary_cta_text', ''),
            'popup_secondary_cta_url'  => $request->input('popup_secondary_cta_url', ''),
            'popup_supporting_text'    => $request->input('popup_supporting_text', ''),
            'popup_trigger_scroll'     => $request->input('popup_trigger_scroll', '55'),
            'popup_timer_delay'        => $request->input('popup_timer_delay', '8'),
        ]);

        return redirect()->route('admin.popup.edit')
            ->with('success', 'Popup settings saved successfully.');
    }
}
