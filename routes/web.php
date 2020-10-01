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


//getBook
Route::get('getBook', 'BookController@index');
//Get Author details
Route::get('/getAuthor', 'AuthorController@index');
//get supplier
Route::get('/getSupplier', 'SupplierController@index');
//get Consignment
Route::get('/getConsignment', 'ConsignmentController@index');
Route::post('/final-update', 'ConsignmentController@final_update');


//login/logout
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
