<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/save' , [Main::class, 'saveOverlay']);
Route::post('/new/map' , [Main::class, 'newMap']);
Route::delete('/delete/{id}' , [Main::class, 'deleteOverlay']);
Route::get('/retrive' , [Main::class, 'retriveOverlay']);
Route::get('/retrive/last' , [Main::class, 'retriveLastOverlay']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
