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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/', 'HomeController@index');

// Route::get('{path}', "HomeController@index")->where(['path', '.*-in-.*|stay-in-.*']);

//vue route
//Store Author
Route::post('/storeAuthor', 'AuthorController@store');
//Store Publisher
Route::post('/storePublisher', 'PublisherController@store');
//Store Category
Route::post('/storeCategory', 'CategoryController@store');
//Store Book Info
Route::post('/storeBook', 'BookController@store');
//Store Supplier Info
Route::post('/storeSupplier', 'SupplierController@store');
//Store Consignment Info
Route::post('/storeConsignment', 'ConsignmentController@store');

Route::post('/final-update', 'ConsignmentController@final_update');
//store invoice
Route::post('/storeInvoice', 'InvoiceController@invoiceStore');

//getBook
Route::get('getBook', 'BookController@index');
//Get Author details
Route::get('/getAuthor', 'AuthorController@index');
//get supplier
Route::get('/getSupplier', 'SupplierController@index');
//get Consignment
Route::get('/getConsignment', 'ConsignmentController@index');
//get invoice list

Route::get('/getInvoices', 'InvoiceController@index');

//get details for invoice/sale
Route::get('/getDetailsForInvoice', 'ConsignmentController@detailsForInvoice');

//get Invoice details by id
Route::get('/getInvoiceId', 'InvoiceController@getIdInvoice');
//get consignment by id
Route::get('/getConsignId', 'ConsignmentController@getIdConsign');

//delete Consignment
Route::post('/delete-consignment', 'ConsignmentController@deleteConsignment');

//delete invoice
Route::post('/delete-invoice', 'InvoiceController@deleteInvoice');

//update consignment
Route::post('/update-consignment-details', 'ConsignmentController@updateConsignment');

//update consignment
Route::post('/update-invoice-details', 'InvoiceController@updateInvoiceItem');


Route::get('/getConsignSale', 'ConsignmentController@getSaleConsign');
//view stock details
Route::get('/getStockDetails', 'BookController@stockDetails');


//login/logout
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
