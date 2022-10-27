<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
// use Cmixin\EnhancedPeriod;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins/index', [
            'admins' => User::role('admin')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'dni' => 'required|regex:/^[1-9](\d{6,7})$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:255|min:6',
            'confirm_password' => 'required|max:255|min:6|same:password',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $admin->assignRole('Admin');

        return redirect()->route('admins.index')->withInfo('Admin created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        if ($admin) {
            return response()->json($admin, 200);
        } else {
            return response()->json(['message' => 'No admin found.'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        if ($admin->hasRole('admin')) {
            return view('admins.edit', compact('admin'));
        } else {
            return view('admins/index', [
                'admins' => User::role('admin')->get(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'dni' => 'required|regex:/^[1-9](\d{6,7})$/',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $admin->update($request->all());

        return redirect()->route('admins.index')->withInfo('Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        if ($admin) {
            return response()->json($admin, 200);
        } else {
            return response()->json(['message' => 'No admin found.'], 400);
        }
    }
}
