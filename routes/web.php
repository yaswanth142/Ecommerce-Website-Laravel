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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[HomeController::class,'redirect']);


route::get('/',[HomeController::class,'index']);


route::get('/product',[AdminController::class,'product']);

route::post('/uploadproduct',[AdminController::class,'uploadproduct']);

route::get('/showproduct',[AdminController::class,'showproduct']);

route::get('/deleteproductitems/{id}',[AdminController::class,'deleteproductitems']);

route::get('/updateproductitems/{id}',
[AdminController::class,'updateproductitems']);

route::post('/updateproduct/{id}',
[AdminController::class,'updateproduct']);

route::get('/search',[HomeController::class,'search']);


route::post('/addcart/{id}',
[HomeController::class,'addcart']);

route::get('/showcart',[HomeController::class,'showcart']);

route::get('/delete/{id}',[HomeController::class,'deletecart']);

route::post('/order',[HomeController::class,'confirmorder']);

route::get('/showorder',[AdminController::class,'showorder']);

route::get('/updatestatus/{id}',[AdminController::class,'updatestatus']);
