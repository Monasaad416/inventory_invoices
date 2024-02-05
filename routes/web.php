<?php

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PrintInvoiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductOutsideInvoiceController;

use App\Models\Product;
use Illuminate\Support\Facades\Response;
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::prefix('/')->middleware(['auth', 'verified'])->group(function(){
//     Route::get('/',[HomeController::class,'index'])->name('index');
//     Route::resources([

//     ]);
// });
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::prefix('/')->middleware(['auth','auto_check_permission'])->group(function(){


    //Home Page//
    Route::get('/',[HomeController::class,'index'])->name('index');

    //livewire//
    // Route::get('/settings/dit',[SettingController::class,'edit'])->name('settings.edit');

    Route::view('/units','admin.pages.units.index')->name('units');
    Route::view('/products/{filter?}','admin.pages.products.index')->name('products');
   
    Route::view('/products/pdf','admin.pages.products.exportToPdf')->name('products.pdf');
    Route::view('/invoices/{statusFilter?}','admin.pages.invoices.index')->name('invoices');
    Route::view('/invoices/create','admin.pages.invoices.create')->name('invoices.create');
    Route::view('/invoices/show/{id}','admin.pages.invoices.show')->name('invoices.show');
    Route::view('/permissions','admin.pages.permissions.index')->name('permissions');
    Route::view('/users','admin.pages.users.index')->name('users');




    //controllers//
    
    Route::get('/roles',[RoleController::class,'index'])->name('roles');
    Route::post('/roles/store',[RoleController::class,'store'])->name('roles.store');
    Route::post('/roles/update/{id}',[RoleController::class,'update'])->name('roles.update');
    Route::post('/roles/delete/{id}',[RoleController::class,'delete'])->name('roles.delete');
    Route::get('/invoices/print/{id}',[PrintInvoiceController::class,'print'])->name('invoices.print');

    // Route::get('/products/pdf',function(){
    //             $products = Product::with('unit')->latest()->get();
    //     $pdf = PDF::loadView('admin.pages.products.export_to_pdf', compact('products'));

    //     return response()->streamDownload(function () use ($pdf) {
    //      $pdf->stream();
    //     }, 'products.pdf');

    // })->name('products.pdf');


    // Route::get('/invoice/pdf/{id}',function($id){
    //     $invoice= App\Models\Invoice::findOrFail($id);
    //     //dd($invoice);
    //     $invoiceProducts = App\Models\InvoiceProduct::where('invoice_id',$invoice->id)->get();
    //     //dd($invoiceProducts);

    //     $pdf = PDF::loadView('admin.pages.invoices.export_to_pdf', ['invoiceProducts'=>$invoiceProducts , 'invoice' =>$invoice]);

    //     return response()->streamDownload(function () use ($pdf) {
    //         $pdf->stream();
    //         }, 'invoice.pdf');

    // })->name('invoice.pdf');






    // Route::get('/products/pdf',function(){
    //     $products=Product::all();
    //     return view('admin.pages.products.export_to_pdf',compact('products'));
    // })->name('products.pdf');

    Route::get('/notifications',[NotificationController::class,'index'])->name('notifications');
    Route::get('/notifications/show/{id}',[NotificationController::class,'show'])->name('notifications.show');
    Route::get('/notification/unread/{id}',function(){
        Auth::user()->notifications::where('id',$id)->markAsRead();
    })->name('notification.unread');



    Route::get('/user/edit-profile',[ProfileController::class,'editProfile'])->name('user.edit_profile');
    Route::post('/user/update-profile',[ProfileController::class,'updateProfile'])->name('user.update_profile');

    Route::get('/user/change-password',[ProfileController::class,'editPassword'])->name('user.edit_password');
    Route::post('/user/update-password',[ProfileController::class,'updatepassword'])->name('user.update_password');

    Route::get('/settings/edit',[SettingController::class,'edit'])->name('settings.edit');
    Route::post('/settings/updtae',[SettingController::class,'update'])->name('settings.update');


    // Livewire::setUpdateRoute(function ($handle) {
    //     return Route::post('/update', $handle);
    // });
});

require __DIR__.'/auth.php';
