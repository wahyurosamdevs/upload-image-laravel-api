<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
Route::resource('products', 'API\ProductController');
Route::get('products/{id}/search/', 'API\ProductController@search');
Route::middleware('auth:api')->group( function () {

});

Route::prefix('v1')->group(function () {
    Route::prefix('Document')->group(function () {
        Route::get('/', 'API\DocumentController@index');
        Route::get('/image', 'API\DocumentController@url');
        Route::post('store', 'API\DocumentController@store');
    });
});