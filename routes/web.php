<?php

use App\Http\Controllers\bookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/' , [bookController::class , 'pos']);
Route::group(['prefix'=>'stocks'] , function() {
    Route::get('/' , [bookController::class , 'stocks']);
});

Route::group(['prefix'=>'order'] , function(){
    Route::post('/store' , [OrderController::class , 'store']);
    Route::get('/show/{id}' , [OrderController::class , 'show']);
});

Route::group(['prefix' => 'book'] , function() {
    Route::get('/index' , [bookController::class , 'index'])->name('book.index');
    Route::get('/edit/{id}' , [bookController::class , 'edit']);
    Route::put('/update/{id}' , [bookController::class , 'update']);
    Route::delete('/delete/{id}' , [bookController::class , 'delete']);
    Route::post('/store' , [bookController::class , 'store']);
    Route::get('/create' , [bookController::class , 'create']);
    Route::get('/show/{id}' , [bookController::class , 'show']);
    Route::get('/getApi' , [bookController::class , 'get']);
    Route::get('/categories' , [CategoryController::class , 'index']);
});

Route::group(['prefix' => 'api'] , function(){
    Route::get('/categories' , [CategoryController::class , 'get']);
    Route::get('/categories/{id}' , [CategoryController::class , 'show']);
    Route::post('/categories/create' , [CategoryController::class , 'store']);
    Route::put('/categories/update/{id}' , [CategoryController::class , 'update']);
    Route::delete('/categories/delete/{id}' , [CategoryController::class , 'delete']);
    Route::post('/stock/add' , [StockController::class , 'store'])->name('add.stock');
});

Route::group(['prefix' => 'customer'] , function(){
    Route::get('/check/{id}' , [CustomerController::class , 'checkId']);
    Route::get('/' , [CustomerController::class , 'index']);
    Route::get('/getCustomers' , [CustomerController::class , 'getCustomer']);
    Route::post('/store' , [CustomerController::class , 'store']);
    Route::put('/update/{id}' , [CustomerController::class , 'update']);
    Route::delete('/destroy/{id}' , [CustomerController::class , 'destroy']);
});
