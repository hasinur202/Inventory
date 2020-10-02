<?php

namespace App\Http\Controllers;

use App\Consignment;
use App\ConsignmentDetails;
use App\Book;
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

    public function getIdConsign(Request $request){

        return ConsignmentDetails::with('book')->where('consignment_id', $request->id)->get();

    }


    public function store(Request $request)
    {

        
        


        DB::beginTransaction();
        try{
            $consignment = Consignment::create($request->only(['consign_ref', 'supplier_id', 'total_price']));
            foreach($request->details as $key => $item){
               $consig = ConsignmentDetails::create(array_merge($item, ['qty' => $item['copies'], 'consignment_id' => $consignment->id]));
               

            //    $getqty = Book::where('id', $consig->book_id)->get(['available_quantity']);
            //    $totalqty = $getqty + $consig->qty;

               $bookk = Book::where('id', $consig->book_id)->update(['available_quantity' => $consig->qty]);
                
                
            }
            DB::commit();
            // return response(['message' => 'Consignment Created!']);
            return response(['bookk' => $bookk], 200);
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


    public function deleteConsignment(Request $request)
    {
        
        $consignmentDetails = ConsignmentDetails::findOrFail($request->id);

        $consignment = $consignmentDetails->consignment;

        DB::beginTransaction();

        try{

            $reducePrice = $consignmentDetails->total_price;

            $consignmentDetails->delete();
            
            $consignment->update(['total_price' => $consignment->total_price -= $reducePrice]);

            DB::commit();

        }catch(Exception $e){

            DB::rollback();

            return response(['message' => 'Opps! Some error!'], 500);

        }

        return response(['message' => 'Details Deleted Successfully!']);
    }

    public function updateConsignment(Request $request){

        $consignmentDetails = ConsignmentDetails::findOrfail($request->id);

        $consignment = $consignmentDetails->consignment;

        $reducedTotalPrice = $consignment->total_price - $consignmentDetails->total_price;

        $costPrice = $consignmentDetails->cost_price;
        
        $totalPrice = $request->qty * $costPrice;
        
        $consignmentDetails->update([
            'qty'   =>  $request->qty,
            'total_price'   =>  $totalPrice,
        ]);

        $consignment->update(['total_price' => $reducedTotalPrice + $totalPrice]);

        return response(['message' => 'Data Saved Successfully']);

    }
}