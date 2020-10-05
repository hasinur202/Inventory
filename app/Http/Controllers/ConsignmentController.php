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


    public function detailsForInvoice(){
        // $data = ConsignmentDetails::with('book:isbn,book_name,available_quantity', 'consignment:consign_ref')->get();
        $data = ConsignmentDetails::with('book','consignment')->get();

        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
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

               $book = Book::where('id', $consig->book_id)->first();

               $book->update(['available_quantity' => $book->available_quantity + $consig->qty]);
            }

            DB::commit();
            return response(['message' => 'Consignment Created!']);
            // return response(['bookk' => $bookk], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response(['message' => 'Opps! some Error!'], 500);
        }

    }

    // public function final_update(Request $request)
    // {
    //     $data = Consignment::where('hide', 1)->update(['hide' => 0]);
    //     // $data->hide = 0;

    //     // $data->save();
    //     return response(['message', 'Updated!'], 200);
    // }

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

        $book = $consignmentDetails->book;

        $reducedTotalPrice = $consignment->total_price - $consignmentDetails->total_price;

        $reducedTotalQty = $book->available_quantity - $consignmentDetails->qty;

        // $costPrice = $consignmentDetails->cost_price;

        // $totalPrice = $request->qty * $costPrice;

        $consignmentDetails->update([
            'qty'   =>  $request->qty,
            'pub_price' => $request->pub_price,
            'cost_price' => $request->cost_price,
            'sales_price' => $request->sales_price,
            'conv_rate' => $request->conv_rate,
            'st_rate' => $request->st_rate,
            'total_price'   =>  $request->total_price,
        ]);

        $consignment->update(['total_price' => $reducedTotalPrice + $request->total_price]);

        $book->update(['available_quantity' => $reducedTotalQty + $request->qty]);

        return response(['message' => 'Data Updated Successfully']);

    }
}
