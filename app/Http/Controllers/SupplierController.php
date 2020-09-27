<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
<<<<<<< HEAD
    public function index(){

=======
    
    public function index(){
        
>>>>>>> 73134112e99528f9923f4572277b04a40abe2bce
        $data = Supplier::all();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }
<<<<<<< HEAD

=======
    
    
>>>>>>> 73134112e99528f9923f4572277b04a40abe2bce
    public function store(Request $request){
        $this->validate($request, [
            'supplier'  => 'required',
            'address'   => 'required',
            'mobile'    => 'required',
        ]);

        $supplier = new Supplier;
        $supplier->supplier = $request->supplier;
        $supplier->address  = $request->address;
        $supplier->phone    = $request->phone;
        $supplier->fax      = $request->fax;
        $supplier->mobile   = $request->mobile;
        $supplier->email    = $request->email;

        $supplier->save();
        return response()->json([
            'supplier'=>$supplier
        ],200);
    }
}
