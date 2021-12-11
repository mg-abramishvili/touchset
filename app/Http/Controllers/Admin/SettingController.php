<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        return view('admin.settings.index', compact('settings'));
    }

    public function index_data()
    {
        return Setting::find(1);
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
        $settings->email_for_orders = $request->email_for_orders;
        $settings->address = $request->address;
        $settings->schedule = $request->schedule;

        $settings->save();
    }
}
