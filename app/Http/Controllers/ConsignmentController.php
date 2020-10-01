<?php

namespace App\Http\Controllers;

use App\Consignment;
use App\ConsignmentDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsignmentController extends Controller
{

    public function index()
    {
        $data = Consignment::latest()->with('get_book', 'get_supplier')->get();
        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
    }

    public function getSaleConsign(){

       //
    }

    public function getIdConsign($consign_ref){

        $data2 = Consignment::where('consign_ref', $consign_ref)->get('id');
        $data = ConsignmentDetails::where('consignment_id',$data2)->get('cost_price');
        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);

    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $consignment = Consignment::create($request->only(['consign_ref', 'supplier_id', 'total_price']));
            foreach($request->details as $key => $item){
                ConsignmentDetails::create(array_merge($item, ['qty' => $item['copies'], 'consignment_id' => $consignment->id]));
            }
            DB::commit();
            return response(['message' => 'Consignment Created!']);
        }catch(Exception $e){
            DB::rollBack();
            return response(['message' => 'Opps! some Error!'], 500);
        }
    }

    public function final_update(Request $request)
    {
        $data = Consignment::where('hide', 1)->update(['hide' => 0]);

        // $data->hide = 0;

        // $data->save();

        return response(['message', 'Updated!'], 200);
    }

    // public function saveConsignment(Request $request)
    // {
    //     [
    //         'ref' => '1234',
    //         'total_price'   =>  2000,
    //         'supplier_id'   =>  2,
    //         'details'   =>  [
    //             [
    //                 'book_id'   =>  1,
    //                 'cost_price'    =>  100,
    //                 'quantity'  =>  10,
    //                 'prict' =>  100,
    //             ],
    //             [
    //                 'book_id'   =>  1,
    //                 'cost_price'    =>  100,
    //                 'quantity'  =>  10,
    //                 'prict' =>  100,
    //             ]
    //         ]
    //     ];

    //     $consignment = Consignment::create(['ref'   => $request->data[0]['ref'], 'supplier' => $request->data[0]['supp']]);

    //     foreach($request->data[0]['details'] as $singleData){
    //         cd::create([''])
    //     }
    // }
}
