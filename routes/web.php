<?php

use App\Http\Controllers\bookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/' , [bookController::class , 'pos']);
Route::group(['prefix'=>'stocks'] , function() {
    Route::get('/' , [bookController::class , 'stocks']);
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
