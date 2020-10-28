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
//store User
Route::post('/storeUser', 'UserController@userStore');

//store User
Route::post('/storeSetting', 'SettingController@store');

//store User
Route::post('/updateSetting/{id}', 'SettingController@update');

//getBook
Route::get('getSettingData', 'SettingController@getData');
//getBook
Route::get('getBook', 'BookController@index');
//Get Author details
Route::get('/getAuthor', 'AuthorController@index');
//Get Author details
Route::get('/getPublisher', 'PublisherController@index');
//Get Author details
Route::get('/getCategory', 'CategoryController@index');
//get supplier
Route::get('/getSupplier', 'SupplierController@index');
//get Consignment
Route::get('/getConsignment', 'ConsignmentController@index');
//get Consignment static rate and conv. rate
Route::get('/getRate', 'ConsignmentController@getConsignRate');

//get supplier from consignemtn
Route::get('/getSuppConsign', 'InventoryController@SupplierGetConsign');
//get all info customer inventory
Route::get('/getCustDetailsById', 'InventoryController@getDetailsCustId');
//get all info customer inventory
Route::get('/getSuppDetailsById', 'InventoryController@getDetailsSuppId');
//get invoice list
Route::get('/getInvoices', 'InvoiceController@index');

//get unique consign isbn
Route::get('/uniqueConsignIsbn', 'ConsignmentController@uniqueISBN');
//get Invoice details by id
Route::get('/getInvoiceId', 'InvoiceController@getIdInvoice');
//get consignment by id
Route::get('/getConsignId', 'ConsignmentController@getIdConsign');

//get consignment Ref by id
Route::post('/getConsignRef', 'ConsignmentController@getConsignRefbyId');
//get consignment by id
Route::get('/getUserDetails', 'UserController@index');

Route::get('get-consignment-data', 'ConsignmentController@getConsignmentData');

//edit book by id
Route::post('get-edit-book', 'BookController@getBookForEdit');

//delete Book
Route::post('/deleteBookById', 'BookController@deleteBook');
//delete Consignment
Route::post('/delete-consignment', 'ConsignmentController@deleteConsignment');

//delete invoice
Route::post('/delete-invoice', 'InvoiceController@deleteInvoice');

//update consignment
Route::post('/update-consignment-details', 'ConsignmentController@updateConsignment');

//update supplier details
Route::post('/update-supplier-details', 'SupplierController@updateSupplier');

//update supplier details
Route::post('/update-user-details', 'UserController@updateUser');

//update supplier Inventory details
Route::post('/update-supinventory-details', 'InventoryController@updateSuppInventory');
//update customer Inventory details
Route::post('/update-cusinventory-details', 'InventoryController@updateCusInventory');

//Delete sales history By Id
Route::post('/deleteSalesById', 'InvoiceController@delSalesById');

//Delete consignment history By Id
Route::post('/deleteConsignById', 'ConsignmentController@delConsignmentById');


//Delete Supplier By Id
Route::post('/deleteSuppById', 'SupplierController@updateSuppById');
//Delete User By Id
Route::post('/deleteUserById', 'UserController@deleteUserById');

//Delete supplier inventory By Id
Route::post('/deleteInvenSuppById', 'InventoryController@deleteSupInventoryById');
//Delete customer inventory By Id
Route::post('/deleteIvenCusById', 'InventoryController@deleteCusInventoryById');
//Create Supplier Inventory
Route::post('/storeSuppInventory', 'InventoryController@storeIventorySup');
//Create customer Inventory
Route::post('/storeCusInventory', 'InventoryController@storeIventoryCus');

//update consignment
Route::post('/update-invoice-details', 'InvoiceController@updateInvoiceItem');

//update book
Route::post('/update-book-details', 'BookController@updateBook');

Route::get('/getConsignSale', 'ConsignmentController@getSaleConsign');
//view stock details
Route::get('/getStockDetails', 'BookController@stockDetails');
//view supplier inventory details
Route::get('/getSupInventory', 'InventoryController@getInventorySupp');
//view customer inventory details
Route::get('/getCusInventory', 'InventoryController@getInventoryCus');

//login/logout
Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');

Route::get('sales-summery-report', 'ReportController@summeryReport');
Route::get('sales-statement-report', 'ReportController@statementReport');

Route::get('get-last-invoice-serial', 'InvoiceController@getLastInvoiceSerial');

Route::get('get-last-consign-serial', 'ConsignmentController@getLastConsignSerial');
Route::get('get-last-isbn-serial', 'BookController@getLastBookSerial');
Route::get('getLatestInvoiceDetails', 'InvoiceController@latestInvoiceDetails');

