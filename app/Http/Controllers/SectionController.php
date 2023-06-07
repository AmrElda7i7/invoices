<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sections= section::all();
        if(empty($section->description)) 
        {

        }
        return view('sections.sections',compact('sections'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_name'=>'required|unique:sections|max:255' ,
            'description'=>'required'
        ],[
            'section_name.required'=> 'يجب ادخال اسم القسم' ,
            'section_name.unique'=> '  اسم القسم مسجل مسبقا ' ,
            'section_name.max'=> 'لايجب ان يكون اسم القسم اكبر من 255 حرف' ,
            'description.required'=> 'يجب ادخال الوصف ' ,

        ]);
            section::create(
                [
                    'section_name'=>$request->section_name,
                    'description'=>$request->description,
                    'Created_by'=>auth()->user()->id
                    ]
                );
                return redirect()->back()->with('add',' تم الاضافة بنجاح') ;
        
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
    public function update(Request $request)
    {
        $id = $request->id ;
        $request->validate([
            'section_name'=>'required|max:255|unique:sections,section_name,'.$id ,
            'description'=>'required'
        ],[
            'section_name.required'=> 'يجب ادخال اسم القسم' ,
            'section_name.unique'=> '  اسم القسم مسجل مسبقا ' ,
            'section_name.max'=> 'لايجب ان يكون اسم القسم اكبر من 255 حرف' ,
            'description.required'=> 'يجب ادخال الوصف ' ,

        ]);
        section::where('id',$id)->update(
            [
                'section_name'=>$request->section_name,
                'description'=>$request->description,
            ]
            );
            return redirect()->back()->with('edit','تم التعديل بنجاح') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        section::where('id',$request->id)->delete() ;
        return redirect()->back()->with('delete','تم الحذف بنجاح') ;
    }
}
