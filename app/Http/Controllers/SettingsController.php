<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('admins.index');
        }
        
        $settings = Settings::find(1);
        // dd($settings);
        return view('settings.index', ['settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('admins.index');
        }

        $settings = Settings::find(1);
        // dd($settings);
        return view('settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('admins.index');
        }
        
        $validated = $request->validate([
            'max_courses_per_student' => 'required|integer|between:0,100',
            'max_courses_per_teacher_per_week' => 'required|integer|between:0,100',
            'percentage_by_subject' => 'required|integer|between:0,100',
        ]);

        $settings = Settings::find(1);

        $settings->update([
            'max_courses_per_student' => (int)$request->max_courses_per_student,
            'max_courses_per_teacher_per_week' => (int)$request->max_courses_per_teacher_per_week,
            'percentage_by_subject' => (int)$request->percentage_by_subject,
        ]);

        return redirect()->route('settings.index')->withInfo('Settings updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
