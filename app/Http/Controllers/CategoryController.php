<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request, [
            'category' => 'required',
        ]);

        $category = new Category;
        $category->category = $request->category;
        $category->save();
        return response()->json([
            'category'=>$category
        ],200);
    }
}
