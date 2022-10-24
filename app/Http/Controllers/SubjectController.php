<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subjects/index', [
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects/create');
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
            'name' => 'required|unique:subjects|max:255',
            'description' => 'required|max:255',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'duration' => 'required|regex:/^[1-9](\d*)$/',
        ]);

        $validated = $request->validate([
            'name' => 'required|max:255|unique:subjects,name,'. $subject->id,
            'description' => 'required|max:255',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'duration' => 'required|regex:/^[1-9](\d*)$/',
        ]);

        Subject::create($request->except('_token'));

        return view('subjects/index', [
            'subjects' => Subject::all(),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        // dd($subject);
        // $subject = Subject::where('id', $subject)->first();
        if($subject){
            return response()->json($subject,200);
        }else{
            return response()->json(['message' => 'No subject found.'],400);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:subjects,name,'. $subject->id,
            'description' => 'required|max:255',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'duration' => 'required|regex:/^[1-9](\d*)$/',
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')->with('info', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        if($subject){
            return response()->json($subject,200);
        }else{
            return response()->json(['message' => 'No subject found.'],400);
        }
    }
    
}
