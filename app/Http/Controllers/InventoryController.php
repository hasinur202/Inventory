<?php

namespace App\Http\Controllers;

use App\CustInventory;
use App\SuppIventory;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function storeIventorySup(Request $request){
        $this->validate($request, [
            'supplier'  => 'required',
            'total_due' => 'required',

        ]);

        $inventory = new SuppIventory();
        $inventory->supplier    = $request->supplier;
        $inventory->total_due    = $request->total_due;
        $inventory->total_paid    = $request->total_paid;
        $inventory->new_due     = $request->new_due;
        $inventory->pay     = $request->pay;

        $inventory->save();
        return response()->json([
            'inventory'=> $inventory
        ],200);
    }


    public function storeIventoryCus(Request $request){
        $this->validate($request, [
            'cus_name'  => 'required',
            'total_due' => 'required',

        ]);

        $inventory = new CustInventory();
        $inventory->cus_name    = $request->cus_name;
        $inventory->total_due    = $request->total_due;
        $inventory->total_paid    = $request->total_paid;
        $inventory->new_due     = $request->new_due;
        $inventory->pay     = $request->pay;

        $inventory->save();
        return response()->json([
            'inventory'=> $inventory
        ],200);
    }




    public function updateSuppInventory(Request $request){

        $inventory = SuppIventory::find($request->id);

        $inventory->supplier    = $request->supplier;
        $inventory->total_due    = $request->total_due;
        $inventory->total_paid    = $inventory->total_paid + $request->pay;
        $inventory->new_due     = $inventory->total_due - $inventory->total_paid;
        $inventory->pay     = $request->pay;

        $inventory->save();
        return response()->json([
            'inventory'=> $inventory
        ],200);

    }

    public function updateCusInventory(Request $request){

        $inventory = CustInventory::find($request->id);

        $inventory->cus_name    = $request->cus_name;
        $inventory->total_due    = $request->total_due;
        $inventory->total_paid    = $inventory->total_paid + $request->pay;
        $inventory->new_due     = $inventory->total_due - $inventory->total_paid;
        $inventory->pay     = $request->pay;

        $inventory->save();
        return response()->json([
            'inventory'=> $inventory
        ],200);

    }



    public function getInventorySupp(){
        $data = SuppIventory::get();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }


    public function getInventoryCus(){
        $data = CustInventory::get();
        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }



    public function deleteSupInventoryById(Request $request){

        $suppinven = SuppIventory::findOrFail($request->id)->delete();

        return response()->json([
            'suppinven'=> $suppinven
        ],200);
    }

    public function deleteCusInventoryById(Request $request){

        $custinven = CustInventory::findOrFail($request->id)->delete();

        return response()->json([
            'custinven'=> $custinven
        ],200);
    }



}
