<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('upload-route-details',[App\Http\Controllers\RouterDetailsController::class,'index']);
Route::post('import-router-details',[App\Http\Controllers\RouterDetailsController::class,'uploadExcel']);
Route::post('save-router-details',[App\Http\Controllers\RouterDetailsController::class,'saveRouterDetails']);