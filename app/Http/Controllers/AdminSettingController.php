<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        return view('admin.settings.index', compact('settings'));
    }

    public function settings_update($id, Request $request)
    {
        $this->validate($request, [
            'tel' => 'required',
            'email' => 'required',
        ]);

        $settings = Setting::find($id);
        $settings->tel = $request->tel;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->schedule = $request->schedule;

        $settings->save();

        return redirect()->route('admin_settings');
    }
}
