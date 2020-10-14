<?php

namespace App\Http\Controllers;

use App\CustInventory;
use App\SuppIventory;
use App\Consignment;
use App\CustInventoryDetails;
use App\SuppIventoryDetails;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function SupplierGetConsign(){

        $data = Consignment::with('get_supplier')->get();

        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
    }

    public function storeIventorySup(Request $request){

        $suppInvent = SuppIventory::create(['consign_ref' => $request->consign_ref,
                'supplier' => $request->supplier,
                'total_due' => $request->total_due,
                'total_paid' => $request->total_paid,
                'new_due' => $request->new_due]);

        SuppIventoryDetails::create(['pay' => $request->pay, 'supp_id' => $suppInvent->id]);

        return response()->json([
            'message'=> 'success'
        ],200);

    }


    public function storeIventoryCus(Request $request){

        $custInvent = CustInventory::create(['invoice_ref' => $request->invoice_ref,
                'cus_name' => $request->cus_name,
                'total_due' => $request->total_due,
                'total_paid' => $request->total_paid,
                'new_due' => $request->new_due]);

        CustInventoryDetails::create(['pay' => $request->pay, 'cust_id' => $custInvent->id]);

        return response()->json([
            'message'=> 'success'
        ],200);
    }



    public function updateSuppInventory(Request $request){

        $inventory = SuppIventory::find($request->id);

        $inventory->supplier    = $request->supplier;
        $inventory->total_due    = $request->total_due;
        $inventory->total_paid    = $inventory->total_paid + $request->pay;
        $inventory->new_due     = $inventory->total_due - $inventory->total_paid;
        $inventory->save();

        SuppIventoryDetails::create(['pay' => $request->pay, 'supp_id' => $inventory->id]);


        return response()->json([
            'message'=> 'success'
        ],200);

    }

    public function updateCusInventory(Request $request){

        $inventory = CustInventory::find($request->id);

        $inventory->cus_name    = $request->cus_name;
        $inventory->total_due    = $request->total_due;
        $inventory->total_paid    = $inventory->total_paid + $request->pay;
        $inventory->new_due     = $inventory->total_due - $inventory->total_paid;
        $inventory->save();

        CustInventoryDetails::create(['pay' => $request->pay, 'cust_id' => $inventory->id]);


        return response()->json([
            'message'=> 'success'
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

        $suppinven = SuppIventoryDetails::where('supp_id',$request->id)->delete();
        SuppIventory::findOrFail($request->id)->delete();

        return response()->json([
            'suppinven'=> $suppinven
        ],200);
    }

    public function deleteCusInventoryById(Request $request){

        $custinven = CustInventoryDetails::where('supp_id',$request->id)->delete();
        CustInventory::findOrFail($request->id)->delete();

        return response()->json([
            'custinven'=> $custinven
        ],200);
    }


    public function getDetailsCustId(Request $request){

        $inventCust = CustInventory::where('id', $request->id)->get();
        $inventCustDetails = CustInventoryDetails::where('cust_id', $request->id)->get();

        return response()->json([
            'inventCust'=> $inventCust,
            'inventCustDetails'=> $inventCustDetails,
        ],200);
    }

    public function getDetailsSuppId(Request $request){

        $inventSupp = SuppIventory::where('id', $request->id)->get();
        $inventSuppDetails = SuppIventoryDetails::where('supp_id', $request->id)->get();

        return response()->json([
            'inventSupp'=> $inventSupp,
            'inventSuppDetails'=> $inventSuppDetails,
        ],200);
    }



}
