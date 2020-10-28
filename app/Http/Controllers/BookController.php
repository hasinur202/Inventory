<?php

namespace App\Http\Controllers;
use App\Book;
use App\Consignment;
use App\Invoice;
use App\InvoiceDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;
use Image;
class BookController extends Controller
{

    public function index(){
        $data = Book::with('authors','categories')->get();

        return response()->json([
            'data'=>$data,
            'message'=>'success'
        ],200);
    }


    public function store(Request $request){
        $this->validate($request, [
            'book_name' => 'required',
            'publisher' => 'required',
        ]);

        $book = new Book;
        if ($request->get('cover')) {
            $cover = $request->get('cover');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($cover, 0, strpos($cover, ';')))[1])[1];
            $img = Image::make($request->cover);
            $upload_path = public_path()."/images/";
            $img->save($upload_path.$name);
            $book->cover        = $name;
        }

        if(!$request->isbn){
            $book->isbn = $request->checkisbn;
            $lastIsbn = Book::where('isbn_serial', '!=', null)->orderBy('id', 'desc')->first();

            $lastIsbn = $lastIsbn ? $lastIsbn->isbn_serial ? $lastIsbn->isbn_serial + 1 : 1 : 1;
            $book->isbn_serial = $lastIsbn;
        }else{
            $book->isbn = $request->isbn;
        }
        $book->book_name    = $request->book_name;
        $book->copyright    = $request->copyright;
        $book->publisher    = $request->publisher;
        $book->edition      = $request->edition;
        $book->language     = $request->language;
        $book->country      = $request->country;
        $book->ref          = $request->ref;
        $book->status       = $request->status;
        $book->summary      = $request->summary;
        $book->year         = $request->year;
        $book->save();

        $arrAuth = array();
        foreach ($request->author as $item) {
            array_push($arrAuth,$item['id']);
        }

        $arrCat = array();
        foreach ($request->category as $item) {
            array_push($arrCat,$item['id']);
        }

        $book->authors()->sync($arrAuth);
        $book->categories()->sync($arrCat);

        return response()->json([
            'message'=>'success'
        ],200);

    }



    public function updateBook(Request $request){
        $book = Book::find($request->isbn);

        if ($request->get('cover') != $book->cover) {
            $cover = $request->get('cover');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($cover, 0, strpos($cover, ';')))[1])[1];
            $img = Image::make($request->cover);
            $upload_path = public_path()."/images/";
            $img->save($upload_path.$name);

            $book->cover        = $name;
        }else{
            $book->cover        = $request->cover;
        }

        $book->isbn         = $request->isbn;
        $book->book_name    = $request->book_name;
        $book->copyright    = $request->copyright;
        $book->publisher    = $request->publisher;
        $book->edition      = $request->edition;
        $book->language     = $request->language;
        $book->country      = $request->country;
        $book->ref          = $request->ref;
        $book->status       = $request->status;
        $book->summary      = $request->summary;
        $book->year         = $request->year;

        // $book->authors()->sync($request->author);
        // $book->categories()->sync($request->category);

        $arrAuth = array();
        foreach ($request->author as $item) {
            array_push($arrAuth,$item['id']);
        }

        $arrCat = array();
        foreach ($request->category as $item) {
            array_push($arrCat,$item['id']);
        }

        $book->authors()->sync($arrAuth);
        $book->categories()->sync($arrCat);


        $book->save();
        return response()->json([
            'book'=>'success'
        ],200);

    }


    public function deleteBook(Request $request){
        $book = Book::findOrFail($request->id)->delete();

        return response()->json([
            'book'=> $book
        ],200);
    }


    public function getBookForEdit(Request $request){
        $data = Book::with('authors','categories')->where('isbn', $request->isbn)->get();

        return response()->json([
            'data'=>$data
        ],200);
    }

    public function stockDetails(){
        $data = Book::where('available_quantity', '>', 0)->get();

        $sum = $data->sum('available_quantity');

        $consignment = Consignment::get();
        $consignTotal = $consignment->sum('total_price');

        $invoice = InvoiceDetails::get();
        $invoiceTotal = $invoice->sum('total_costprice');

        $availableTotal = $consignTotal - $invoiceTotal;


        return response()->json([
            'data' => $data,
            'totalQty'    =>  $sum,
            'totalAvailable'    =>  $availableTotal,
            'message' => "success"
        ], 200);


    }


    public function getLastBookSerial()
    {
        $lastIsbn = Book::where('isbn_serial', '!=', null)->orderBy('id', 'desc')->first();
        return  $lastIsbn ? $lastIsbn->isbn_serial ? $lastIsbn->isbn_serial + 1 : 1 : 1;
    }

}
