<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
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
