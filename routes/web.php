<?php

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

Auth::routes([
    'register' => false,
]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    //Route::get('/users', 'UserController@show');

    Route::resource('customers', 'CustomerController');
    Route::resource('services', 'ServiceController');
    Route::resource('invoices', 'InvoiceController');

    Route::get('/invoices/{invoice}/preview', 'InvoiceController@preview')->name('invoices.preview');
    Route::post('/invoices/{invoice}/send', 'InvoiceController@send')->name('invoices.send');
});
