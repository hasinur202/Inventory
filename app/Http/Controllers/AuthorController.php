<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Author;


class AuthorController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $data = Author::all();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }

    public function store(Request $request){
        $this->validate($request, [
            'author' => 'required',
        ]);

        $author = new Author;
        $author->author = $request->author;
        $author->save();
        return response()->json([
            'author'=>$author
        ],200);
    }





}
