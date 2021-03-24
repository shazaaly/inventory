<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenceController');
Route::apiResource('/customer', 'Api\CustomerController');

//
//salary
Route::post('salary/paid/{id}', 'Api\SalaryController@paid');
Route::get('/salary', 'Api\SalaryController@allSalary');
Route::get('/salary/view/{id}', 'Api\SalaryController@viewSalary');
Route::get('/edit-salary/{id}', 'Api\SalaryController@editSalary');
Route::post('/salary/update/{id}', 'Api\SalaryController@update');
//stock
Route::post('/stock/update/{id}', 'Api\ProductController@StockUpdate');

Route::get('/sub/product/{id}', 'Api\PosController@subproduct');
//Add to cart
Route::get('/addToCart/{id}', 'Api\CartController@AddToCart');


Route::get('/cart/product/', 'Api\CartController@CartProduct');

Route::get('/remove/cart/{id}', 'Api\CartController@removeCart');

//Increment and decrement in cart:

Route::get('/increment/{id}', 'Api\CartController@increment');
Route::get('/decrement/{id}', 'Api\CartController@decrement');

//vat
Route::get('/vats', 'Api\CartController@vats');




