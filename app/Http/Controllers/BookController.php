<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class BookController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        $data = Book::all();
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
            'isbn'      => 'required',
            'author'    => 'required',
            'copyright' => 'required',
            'book_name' => 'required',
            'category'  => 'required',
            'publisher' => 'required',
            'edition'   => 'required',
            'language'  => 'required',
        ]);

        if ($request->get('cover')) {
            $cover = $request->get('cover');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($cover, 0, strpos($cover, ';')))[1])[1];
            $img = Image::make($request->cover);
            $upload_path = public_path()."/images/";
            $img->save($upload_path.$name);
        }

        $book = new Book;
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
        $book->cover        = $name;
        $book->summary      = $request->summary;
        $book->year         = $request->year;

        $book->save();
        return response()->json([
            'book'=>$book
        ],200);
    }

    public function stockDetails(){
        $data = Book::where('available_quantity', '>', 0)->get();
        
        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
        

    }

}
