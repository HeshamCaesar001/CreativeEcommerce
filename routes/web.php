<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//Route::get('/redirect',[HomeController::class,'redirect']);
Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/view_category',[AdminController::class,'viewCategory']);
Route::post('/addCategory',[AdminController::class,'AddCategory']);
Route::delete('/categoryDelete/{category}',[AdminController::class,'categoryDestroy'])->name("cate.delete");
Route::get('/montagat',[AdminController::class,'allProducts'])->name('montagat');
Route::get('/addProduct',[AdminController::class,'AddProduct']);
Route::post('/saveProduct',[AdminController::class,'saveProduct']);
Route::delete('/productDelete/{product}',[AdminController::class,'productDestroy'])->name("product.delete");
Route::get('/Editproduct/{product}',[AdminController::class,'EditProduct'])->name("product.edit");
Route::post('/updateProduct/{product}',[AdminController::class,'updateProduct'])->name("product.update");
Route::get('/productDetails/{product}',[HomeController::class,'ShowProduct'])->name("product.details");
Route::get('/showCart',[HomeController::class,'showCart'])->name("showCart");
Route::post('/addtocart/{product}',[HomeController::class,'AddCart'])->name("add.cart");
Route::delete('/cartDelete/{cart}',[HomeController::class,'DeleteFromCart'])->name("cart.delete");
Route::get('/cash_order',[HomeController::class,'CashOrder'])->name("cashOrder");
Route::get('/stripe/{totalPrice}',[HomeController::class,'stripe'])->name("stripe");
Route::get('/orders',[AdminController::class,'ShowOrders'])->name("show.orders");
Route::get('/delivered/{order}',[AdminController::class,'DeliveredOrder'])->name("delivered");
Route::get('/printPDf/{order}',[AdminController::class,'PrintPDF'])->name("print.pdf");
Route::get('/sendEmail/{order}',[AdminController::class,'SendEmail'])->name("send.email");

Route::post('stripe/{totalPrice}', [HomeController::class,'stripePost'])->name('stripe.post');
Route::post('/notifyUser/{order}', [AdminController::class,'notifyUser'])->name('notify.user');
Route::get('/search', [AdminController::class,'searchOrder'])->name('order.search');


