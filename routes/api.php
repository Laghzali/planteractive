<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\main;
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
Route::post('/contact', [main::class , 'sendEmail']);
Route::post('/save/existing' , [main::class, 'saveExistingOverlay']);
Route::post('/save' , [main::class, 'saveOverlay']);
Route::post('/new/map' , [main::class, 'newMap2jpg']);
Route::get('/retrive/maps' , [main::class, 'retriveMaps']);
Route::delete('/delete/{id}' , [main::class, 'deleteOverlay']);
Route::get('/retrive/{map_id}' , [main::class, 'retriveOverlay']);
Route::get('/retrive/last' , [main::class, 'retriveLastOverlay']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
