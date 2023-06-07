<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //ll
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $details = invoices_Details::where('id_Invoice', $id)->get();
        $attachments = invoice_attachments::where('invoice_id', $id)->get();

        return view('invoices.details_invoice', compact('invoices', 'details', 'attachments'));
    }
    public function view_file($invoice_number,$file_name)
    {
        $pathToFile=public_path('attachments/'.$invoice_number.'/'.$file_name) ;
        return response()->file($pathToFile);
    }
    public function download($invoice_number,$file_name)
    {
        return response()->download(public_path('attachments/'.$invoice_number.'/'.$file_name));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete_file(Request $request)
    {
        
    }
    public function destroy(Request $request)
    {
        invoice_attachments::where('id',$request->id_file)->delete();
        Storage::disk('uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
       
    }
}