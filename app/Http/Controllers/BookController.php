<?php

namespace App\Http\Controllers;
use App\Book;
use App\Consignment;
use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;
use Image;
class BookController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        $data = Book::all();

        // $bookid = $data->id->latest()->first();
        return response()->json([
            'data'=>$data,
            'message'=>'success'
        ],200);
    }

    // public function getBookById($key){
    //     $data = Book::find($key);
    //     return response()->json([
    //         'data'=>$data,
    //         'message'=>'success'
    //     ],200);
    // }

    //ekhon data entry daw mia
    //ekktu wait koro

    public function store(Request $request){
        $this->validate($request, [
            'author'    => 'required',
            'book_name' => 'required',
            'category'  => 'required',
            'publisher' => 'required',
            'isbn' => 'unique',
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
        $book->author       = $request->author;
        $book->copyright    = $request->copyright;
        $book->category     = $request->category;
        $book->publisher    = $request->publisher;
        $book->edition      = $request->edition;
        $book->language     = $request->language;
        $book->country      = $request->country;
        $book->ref          = $request->ref;
        $book->status       = $request->status;
        $book->summary      = $request->summary;
        $book->year         = $request->year;
        $book->save();

        return response()->json([
            'message'=>'success'
        ],200);

    }



    public function updateBook(Request $request){
        $book = Book::find($request->id);

        // if ($request->get('cover')) {
        //     $cover = $request->get('cover');
        //     $name = Str::random(5).'.' . explode('/', explode(':', substr($cover, 0, strpos($cover, ';')))[1])[1];
        //     $img = Image::make($request->cover);
        //     $upload_path = public_path()."/images/";
        //     $img->save($upload_path.$name);

        //     $book->cover        = $name;
        // }

        $book->isbn         = $request->isbn;
        $book->book_name    = $request->book_name;
        $book->author       = $request->author;
        $book->copyright    = $request->copyright;
        $book->category     = $request->category;
        $book->publisher    = $request->publisher;
        $book->edition      = $request->edition;
        $book->language     = $request->language;
        $book->country      = $request->country;
        $book->ref          = $request->ref;
        $book->status       = $request->status;
        $book->summary      = $request->summary;
        $book->year         = $request->year;


        $book->save();
        return response()->json([
            'book'=>$book
        ],200);

    }





    public function stockDetails(){
        $data = Book::where('available_quantity', '>', 0)->get();

        $sum = $data->sum('available_quantity');

        $consignment = Consignment::get();
        $consignTotal = $consignment->sum('total_price');

        $invoice = Invoice::get();
        $invoiceTotal = $invoice->sum('total_price');

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
