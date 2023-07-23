<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoicesController;


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

Auth::routes();
//Auth::routes(['registre'=>false]);  //ila knt bgha ghir ana li nthkm f wach n add a user or not

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('invoices', InvoicesController::class);
Route::resource('section', SectionController::class);
Route::resource('product', ProductController::class);
// Route for displaying the create invoice form
Route::get('/add_invoice', [InvoicesController::class,'create'])->name('add_invoice');

// Resourceful route for InvoiceAttachmentsController
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

// Route for fetching products based on section ID
Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);

// Route for editing invoice details
Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);

// Route for downloading an attachment file
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);

// Route for opening/viewing an attachment file
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);

// Route for deleting an attachment file
Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

// Route for editing an invoice
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);

// Route for showing payment status
Route::get('/Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');

// Route for updating payment status
Route::post('/Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');


Route::resource('Archive', InvoiceAchiveController::class);

Route::get('Invoice_Paid', [InvoicesController::class, 'Invoice_Paid']);
Route::get('Invoice_UnPaid', [InvoicesController::class, 'Invoice_UnPaid']);

Route::get('Invoice_Partial', [InvoicesController::class, 'Invoice_Partial']);

Route::get('export_invoices', [InvoicesController::class, 'export']);

Route::get('Print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);




Route::get('/{page}', [AdminController::class, 'index']);
