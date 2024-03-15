<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);

        return view('settings.index', compact('setting'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'logo' => 'mimes:png,jpg,webp',
            'tax' => 'numeric',
        ]);

        $setting = Setting::find(1);

        $file = $request->file('logo');

        if($file)
        {
            File::delete(public_path('/images/'.$setting->logo));
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images/'), $file_name);

            $setting->update([
                'logo' => $file_name,
                'hex_code' => $request->hex_code,
                'tax' => $request->tax
            ]);
        }

        $setting->update([
            'logo' => $setting->logo,
            'hex_code' => $request->hex_code,
            'tax' => $request->tax
        ]);

        return redirect('/dashboard');
    }
}
