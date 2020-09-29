<?php

namespace App\Http\Controllers;
use App\Consignment;
use Illuminate\Http\Request;

class ConsignmentController extends Controller
{

    public function index(){
        $data = Consignment::latest()->with('get_book','get_supplier')->get();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }


    public function store(Request $request){
        $this->validate($request, [
            'book_id'       => 'required',
            'supplier_id'   => 'required',
            'consign_ref'   => 'required',
            'copies'        => 'required',
            'pub_price'     => 'required',
            'sales_price'   => 'required',
            'cost_price'    => 'required',
            'total_price'   => 'required',
        ]);

        $consign = new Consignment;
        $consign->book_id       = $request->book_id;
        $consign->supplier_id   = $request->supplier_id;
        $consign->consign_ref   = $request->consign_ref;
        $consign->copies        = $request->copies;
        $consign->currency      = $request->currency;
        $consign->pub_price     = $request->pub_price;
        $consign->sales_price   = $request->sales_price;
        $consign->cost_price    = $request->cost_price;
        $consign->total_price   = $request->total_price;

        $consign->save();
        return response()->json([
            'consign'=>$consign
        ],200);
    }
}
