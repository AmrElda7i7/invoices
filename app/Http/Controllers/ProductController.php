<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sections = section::all();
        $products = product::all();

        return view('products.products', compact(['sections', 'products']));
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
            'product_name' => 'required|unique:products|max:255',
            'description' => 'required',
            'section_id' => 'required',
        ], [
                'product_name.required' => 'يجب ادخال اسم المنتج',
                'product_name.unique' => '  اسم المنتج مسجل مسبقا ',
                'product_name.max' => 'لايجب ان يكون اسم المنتج اكبر من 255 حرف',
                'description.required' => 'يجب ادخال الوصف ',
                'section_id.required' => 'يجب ادخال القسم ',

            ]);
        product::create(
            [
                'Product_name' => $request->product_name,
                'description' => $request->description,
                'section_id' => $request->section_id,
            ]
        );
        return redirect()->back()->with('add', 'تم الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id = $request->pro_id;
        $request->validate([
            'Product_name' => 'required|max:255|unique:products,Product_name,' . $id,
            'description' => 'required',
            'section_name' => 'required',
        ], [
                'Product_name.required' => 'يجب ادخال اسم المنتج',
                'Product_name.unique' => '  اسم المنتج مسجل مسبقا ',
                'Product_name.max' => 'لايجب ان يكون اسم المنتج اكبر من 255 حرف',
                'description.required' => 'يجب ادخال الوصف ',
                'section_name.required' => 'يجب ادخال القسم ',

            ]);
        $section_id = section::where('section_name', $request->section_name)->pluck('id')->first();
        product::where('id', $id)->update(
            [
                'Product_name' => $request->Product_name,
                'description' => $request->description,
                'section_id' => $section_id
            ]
        );

        return redirect()->back()->with('edit', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        product::where('id', $request->pro_id)->delete();
        return redirect()->back()->with('delete', 'تم الحذف بنجاح');
    }
}