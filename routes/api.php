<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/feeds/rss/upwork/{queryString}', 'Feeds\RssController@getUpwork');
Route::get('/feeds/rss/guru-com/{queryString}', 'Feeds\RssController@getGuruCom')->where(['queryString'=>'(.*)']);

Route::get('invoices', 'InvoiceController@index');
Route::get('invoices/{invoice}', 'InvoiceController@show');
Route::post('invoices', 'InvoiceController@store');
Route::put('invoices/{invoice}', 'InvoiceController@update');
Route::delete('invoices/{invoice}', 'InvoiceController@delete');

Route::get('invoice-recipients', 'InvoiceRecipientController@index');
Route::get('invoice-recipients/{invoiceRecipient}', 'InvoiceRecipientController@show');
Route::post('invoice-recipients', 'InvoiceRecipientController@store');
Route::put('invoice-recipients/{invoiceRecipient}', 'InvoiceRecipientController@update');
Route::delete('invoice-recipients/{invoiceRecipient}', 'InvoiceRecipientController@delete');

Route::get('invoice-items', 'InvoiceItemController@index');
Route::get('invoice-items/{invoiceItem}', 'InvoiceItemController@show');
Route::post('invoice-items', 'InvoiceItemController@store');
Route::put('invoice-items/{invoiceItem}', 'InvoiceItemController@update');
Route::delete('invoice-items/{invoiceItem}', 'InvoiceItemController@delete');