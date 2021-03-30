<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Category;
use App\Restaurant;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::namespace('Api')->group( function(){
    Route::get('/{slug}/statistics', 'HomeController@charts')->name('charts');
    Route::get('/{slug}/statisticsYears', 'HomeController@year');
    Route::get('/restaurants', 'HomeController@allCategories');
    Route::get('/restaurants/{category}', 'HomeController@filter');
    Route::get('/categories', 'HomeController@categories');
    // Route::get('/{slug}', 'HomeController@details');
});
