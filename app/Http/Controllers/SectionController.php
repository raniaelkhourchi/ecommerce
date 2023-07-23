<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionController extends Controller
{
   
    public function index()
    {
        $A=section::all();
        return view('section.section',compact('A'));
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validated = $request->validate([
            'section_name' => 'required|unique:sections',
            'description' => 'required',

        ]);
        
            Section::create([
                'section_name' => $request->input('section_name'),
                'description' => $request->input('description'),
                'created_by' => Auth::user()->name,
            ]);
            session()->flash('Add', 'Successfully Saved');
            return redirect('/section');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ]);
//2 end section is the model's name
        $section = section::find($id);
        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit','The section has been updated successfully');
        return redirect('/section');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        section::find($id)->delete();
        session()->flash('delete','The section has been deleted successfully');
        return redirect('/section');
    }
}
