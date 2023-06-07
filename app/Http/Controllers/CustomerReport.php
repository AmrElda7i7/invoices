<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\section;
use Illuminate\Http\Request;

class CustomerReport extends Controller
{
    public function index()
    {
        $sections = section::all();
        return view('reports.customers_report',compact('sections'));
    }
    public function Search_customers(Request $request)
    {
        // if they did not specify date 
        $sections = section::all();
        if($request->Section && $request->product && $request->start_at=='' &&$request->end_at=='' )
        {
            $customers = Invoice::where('section_id',$request->Section)->where('product',$request->product)->get() ;
            return view('reports.customers_report',compact('sections'))->withDetails($customers) ;
        }
        
        else{
            $start_at=$request->start_at ;
            $end_at= $request->end_at;
            $customers= Invoice::whereBetween('invoice_date',[$start_at,$end_at])->where('section_id',$request->Section)->where('product',$request->product)->get() ;
            return view('reports.customers_report',compact('sections'))->withDetails($customers) ;

        }
    }
}
