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
Route::post('/storeAuthor', 'AuthorController@store');
Route::post('/storePublisher', 'PublisherController@store');
//Store Category
Route::post('/storeCategory', 'CategoryController@store');
//Store Book Info
Route::post('/storeBook', 'BookController@store');
//Store Supplier Info
Route::post('/storeSupplier', 'SupplierController@store');

Route::get('getBook', 'BookController@index');
//getBook by Id
// Route::get('/getBookbyId/{key}', 'BookController@getBookById');


//Get Author details
Route::get('/getAuthor', 'AuthorController@searchAuthor');
//get supplier
Route::get('/getSupplier', 'SupplierController@index');





//login/logout
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
