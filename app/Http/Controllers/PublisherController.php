<?php

namespace App\Http\Controllers;
use App\Publisher;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request, [
            'publisher' => 'required',
        ]);

        $publisher = new Publisher;
        $publisher->publisher = $request->publisher;
        $publisher->save();
        return response()->json([
            'publisher'=>$publisher
        ],200);
    }
}
