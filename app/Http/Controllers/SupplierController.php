<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{ 
    public function index(){
        $data = Supplier::where('hide', 1)->get();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }

    
    public function updateSuppById(Request $request)
    {
        $sup = Supplier::findOrFail($request->id);

        // $sup->update(['hide' => 0]);
        $sup->hide = 0;
        $sup->save();

        return response(['message', 'updated'], 200);
    }





    public function store(Request $request){
        $this->validate($request, [
            'supplier'  => 'required',
        ]);

        $supplier = new Supplier;
        $supplier->supplier = $request->supplier;
        $supplier->phone    = $request->phone;
        $supplier->email    = $request->email;
        $supplier->address  = $request->address;

        $supplier->save();
        return response()->json([
            'supplier'=>$supplier
        ],200);
    }

    public function updateSupplier(Request $request){

        $supplier = Supplier::find($request->id);

        $supplier->supplier = $request->supplier;
        $supplier->address  = $request->address;
        $supplier->phone    = $request->phone;
        $supplier->email    = $request->email;

        $supplier->save();
        return response()->json([
            'supplier'=> $supplier
        ],200);

    }


}
