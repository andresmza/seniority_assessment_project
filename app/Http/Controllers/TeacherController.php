<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teachers/index', [
            'teachers' => User::role('teacher')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers/create');
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

        $teacher = User::create([
            'name' => $request->name ,
            'lastname' => $request->lastname ,
            'dni' => $request->dni ,
            'email' => $request->email ,
            'password' => bcrypt($request->password) ,
        ]);

        $teacher->assignRole('Teacher');

        return view('teachers/index', [
            'teachers' => User::role('teacher')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher)
    {
        // dd($teacher);
        // $teacher = Teacher::where('id', $teacher)->first();
        if ($teacher) {
            return response()->json($teacher, 200);
        } else {
            return response()->json(['message' => 'No teacher found.'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        if($teacher->hasRole('teacher')) {
            return view('teachers.edit', compact('teacher'));
        } else {
            return view('teachers/index', [
                'teachers' => User::role('teacher')->get(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'dni' => 'required|regex:/^[1-9](\d{6,7})$/',
            'email' => 'required|email|unique:users,email,' . $teacher->id,
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('info', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        $teacher->delete();

        if ($teacher) {
            return response()->json($teacher, 200);
        } else {
            return response()->json(['message' => 'No teacher found.'], 400);
        }
    }
}
