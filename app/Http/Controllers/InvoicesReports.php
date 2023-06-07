<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReports extends Controller
{
    //

    public function index()
    {
        return view('reports.invoices_reports');
    }
    public function Search_invoices(Request $request){

        $rdio = $request->rdio;
    
    
     // في حالة البحث بنوع الفاتورة
        
        if ($rdio == 1) {
           
           
     // في حالة عدم تحديد تاريخ
            if ($request->type && $request->start_at =='' && $request->end_at =='') {
                
               $invoices = invoice::where('Status','=',$request->type)->get();
               $type = $request->type;
               return view('reports.invoices_reports',compact('type'))->withDetails($invoices) ;
            }
            
            // في حالة تحديد تاريخ استحقاق
            else {
               
              $start_at = ($request->start_at);
              $end_at = ($request->end_at);
              $type = $request->type;
              $invoices = invoice::whereBetween('invoice_date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
              return view('reports.invoices_reports',compact('type','start_at','end_at'))->withDetails($invoices);
              
            }
    
     
            
        } 
        
    //====================================================================
        
    // في البحث برقم الفاتورة
        else {
            
            $invoices = Invoice::where('invoice_number','=',$request->invoice_number)->get();
            return view('reports.invoices_reports')->withDetails($invoices);
            
        }
    
        
         
        }
}
