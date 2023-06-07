<?php

use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerReport;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoicesReports;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes(['register' => false]);
Route::resource('sections', SectionController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('products', ProductController::class);
Route::resource('InvoicesDetails', InvoicesDetailsController::class);
Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);
Route::get('/Status_show/{id}', [InvoiceController::class, 'Status_show'])->name('Status_show');
Route::get('InvoicesDetails/view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'view_file'])->name('view_file');
Route::post('delete_file', [InvoicesDetailsController::class,'destroy']);
Route::get('InvoicesDetails/download_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'download'])->name('download_file');
Route::resource('invoices_attachments',InvoiceAttachmentsController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('Status_Update/{id}',[InvoiceController::class,'Status_Update'])->name('Status_Update');
Route::get('/partial', [App\Http\Controllers\InvoiceController::class, 'Invoice_Partial'])->name('partial');
Route::get('/paid', [App\Http\Controllers\InvoiceController::class, 'Invoice_Paid'])->name('paid');
Route::get('/unpaid', [App\Http\Controllers\InvoiceController::class, 'Invoice_unPaid'])->name('unpaid');
Route::resource('archive', InvoiceAchiveController::class);
Route::get('Print_invoice/{id}',[InvoiceController::class,'Print_invoice'])->name('Print_invoice');

    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::get('invoices_reports',[InvoicesReports::class,'index'])->name('invoices_reports.index');
    Route::post('Search_invoices',[InvoicesReports::class,'Search_invoices']) ;
    Route::get('customers_reports',[CustomerReport::class,'index'])->name('customers_reports.index');
    Route::post('Search_customers',[CustomerReport::class,'Search_customers']) ;
    