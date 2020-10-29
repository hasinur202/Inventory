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

    public function uniqueISBN(){
        $data = Book::whereHas('consignmentDetails.consignment')->selectRaw('distinct(isbn)')->get();

        // $data = ConsignmentDetails::with('book')->distinct()->get(['isbn']);
        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
    }

    public function getConsignRefbyId(Request $request){

        $data = Consignment::whereHas('consignmentDetails.book', function($query) use ($request){
            $query->where('isbn', $request->isbn);
        })->selectRaw('distinct(consign_ref)')->get();

        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
    }



    public function getConsignRate()
    {
        $data = ConsignmentDetails::latest()->first();
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

            $lastConsign = Consignment::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
            $lastConsign= $lastConsign ? $lastConsign->consign_serial ? $lastConsign->consign_serial + 1 : 1 : 1;

            $consignment = Consignment::create(['consign_ref' => $request->consign_ref,
                'supplier_id' => $request->supplier_id,
                'pay_mode' => $request->pay_mode,
                'total_price' => $request->total_price,
                'consign_serial' => $lastConsign]);

            // $consignment = Consignment::create($request->only(['consign_ref', 'supplier_id', 'total_price']));
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
        $book = $consignmentDetails->book;

        DB::beginTransaction();

        try{

            $reducePrice = $consignmentDetails->total_price;
            $reduceQty = $consignmentDetails->qty;

            $consignmentDetails->delete();

            $consignment->update(['total_price' => $consignment->total_price -= $reducePrice]);

            $book->update(['available_quantity' => $book->available_quantity -= $reduceQty]);

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

    public function getLastConsignSerial()
    {
        $lastConsign = Consignment::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
        return  $lastConsign ? $lastConsign->consign_serial ? $lastConsign->consign_serial + 1 : 1 : 1;
    }



    public function delConsignmentById(Request $request){

        $custsales = Consignment::findOrFail($request->id);

        if($custsales->total_price == 0){
            ConsignmentDetails::where('consignment_id',$request->id)->delete();
            $custsales->delete();

            return response()->json([
                'message1'=> 'success'
            ],200);

        }else{
            return response()->json([
                'message'=> 'fail'
            ],200);
        }

    }

    public function getConsignmentData(Request $request)
    {
        return ConsignmentDetails::with('book')->whereHas('consignment', function($query) use ($request){
            $query->where('consign_ref', $request->consign_ref);
        })
        ->whereHas('book', function ($q1) use ($request){
            $q1->where('isbn', $request->isbn);
        })->first();
    }

    public function getConsignData(Request $request)
    {
        return ConsignmentDetails::with('book', 'book.authors')->whereHas('consignment', function($query) use ($request){
            $query->where('consign_ref', $request->consign_ref);
        })
        ->whereHas('book', function ($q1) use ($request){
            $q1->where('isbn', $request->isbn);
        })->first();

    }




}
