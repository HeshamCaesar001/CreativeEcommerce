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
Route::get('/',[HomeController::class,'index']);
Route::get('/view_category',[AdminController::class,'viewCategory']);
Route::post('/addCategory',[AdminController::class,'AddCategory']);
Route::delete('/categoryDelete/{category}',[AdminController::class,'categoryDestroy'])->name("cate.delete");
Route::get('/montagat',[AdminController::class,'allProducts'])->name('montagat');
Route::get('/addProduct',[AdminController::class,'AddProduct']);
Route::post('/saveProduct',[AdminController::class,'saveProduct']);
Route::delete('/productDelete/{product}',[AdminController::class,'productDestroy'])->name("product.delete");
Route::get('/Editproduct/{product}',[AdminController::class,'EditProduct'])->name("product.edit");
Route::post('/updateProduct/{product}',[AdminController::class,'updateProduct'])->name("product.update");
