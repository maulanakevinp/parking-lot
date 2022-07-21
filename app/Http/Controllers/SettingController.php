<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.index', [
            'setting' => Setting::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'price_per_hour' => ['required','numeric','min: 1000'],
        ],[],[
            'price_per_hour'    => 'Parkir per jam',
        ]);
        $setting->update($request->only('price_per_hour'));
        return back()->with('success', 'Pengaturan berhasil disimpan');
    }
}
