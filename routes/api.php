<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

});

Route::apiResource('/employe','EmployeController');
Route::apiResource('/supplier','SupplierController');
Route::apiResource('/category','CategoryController');
Route::apiResource('/product','ProductController');
Route::apiResource('/expense','ExpenseController');
Route::apiResource('/salary','SalaryController');
Route::apiResource('/customer','CustomerController');

Route::Get('/edit/salary/{id}','NewController@EditSalary');
Route::Post('/update/salary/{id}','NewController@UpdateSalary');
Route::Post('/stock/update/product/{id}','NewController@UpdateStock');

Route::get('/getting/product/{id}','PosController@GetProduct');
Route::get('/addTocart/{id}','PosController@AddTocart');
Route::get('/allCart','PosController@AllCart');
Route::get('/removeCart/{id}','PosController@RemoveCart');
Route::get('/increment/{id}','PosController@Increment');
Route::get('/decrement/{id}','PosController@Decrement');

Route::get('/vat','PosController@Vat');
Route::post('/orderdone','PosController@OrderDone');

Route::get('/orders','OrderController@TodayOrder');
Route::get('/order/details/{id}','OrderController@OrderDetails');
Route::get('/order/orderdetails/{id}','OrderController@OrderDetailsAll');
Route::post('/search/date','OrderController@SearchOrderDate');
Route::post('/search/month','OrderController@SearchMonth');

// Home route
Route::get('/today/sell','OrderController@TodaySale');
Route::get('/today/income','OrderController@TodayIncome');
Route::get('/today/due','OrderController@TodayDue');
Route::get('/today/expense','OrderController@TodayExpense');
Route::get('/stockout','OrderController@Stockout');