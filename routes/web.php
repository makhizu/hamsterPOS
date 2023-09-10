<?php

use App\Http\Controllers\datamaster\JenisController;
use App\Http\Controllers\datamaster\ProductHeaderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\datamaster\SizeController;
use App\Http\Controllers\datamaster\TipeModelController;
use App\Http\Controllers\datamaster\WarnaController;
use Illuminate\Support\Facades\Route;


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

/////////////////////////////////////////////// REQUIRED SESSION (MUST LOGIN)//////////////////////////////////////////
Route::middleware(['auth'])->group(function () {

    
    Route::get('/home', function () {
    return view('welcome');
})->middleware('auth');


/////////////////////////////// Data Master ///////////////////////////////////////////////////
Route::group(['prefix' => '/datamaster'], function () {
    
    Route::get('/size', [SizeController::class, 'index'])->name('size.show');
    Route::post('/size/create', [SizeController::class, 'store'])->name('size.create');
    Route::put('/size/edit/{id}', [SizeController::class, 'update'])->name('size.update');
    Route::delete('/size/delete/{id}', [SizeController::class, 'delete'])->name('size.delete');
    
    Route::get('/jenis', [JenisController::class, 'index'])->name('jenis.show');
    Route::post('/jenis/create', [JenisController::class, 'store'])->name('jenis.create');
    Route::put('/jenis/edit/{id}', [JenisController::class, 'update'])->name('jenis.update');
    Route::delete('/jenis/delete/{id}', [JenisController::class, 'delete'])->name('jenis.delete');
    
    Route::resource('/model', TipeModelController::class);
    Route::resource('/warna', WarnaController::class);

    Route::resource('/produk', ProductHeaderController::class);
    Route::post('/get-model', [ProductHeaderController::class, 'getModel'])->name('get.model');
});
///////////////////////////// END Data Master /////////////////////////////////////////////////

});
/////////////////////////////////////////////// END REQUIRED SESSION (MUST LOGIN)//////////////////////////////////////////


Route::get('/' , [LoginController::class, 'index'])->middleware('guest');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);               
Route::post('/logout', [LoginController::class, 'logout']);         




