<?php

namespace App\Http\Controllers;
use App\Book;
use App\Invoice;
use App\InvoiceDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function invoiceStore(Request $request){


            $lastInvoice = Invoice::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
            $lastInvoice = $lastInvoice ? $lastInvoice->invoice_serial ? $lastInvoice->invoice_serial + 1 : 1 : 1;

            // $invoice = Invoice::create($request->only(['invoice_ref', 'total_price', 'total_discount', 'pay_mode', 'cus_name','invoice_serial' => $lastInvoice]));
            $invoice = Invoice::create(['invoice_ref'=>$request->invoice_ref,
            'total_price' => $request->total_price,
            'total_discount' => $request->total_discount,
            'pay_mode' => $request->pay_mode,
            'cus_name' => $request->cus_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'invoice_serial' => $lastInvoice]);


            foreach($request->details as $key => $item){
                // dd($item);
               $invoi = InvoiceDetails::create(array_merge($item, ['qty' => $item['copies'], 'invoice_id' => $invoice->id]));
               $book = Book::where('id', $invoi->book_id)->first();

               $book->update(['available_quantity' => $book->available_quantity - $invoi->qty]);
            }

            return response(['invoice' => $invoice]);

    }


    public function index()
    {
        $data = Invoice::latest()->get();
        return response()->json([
            'data' => $data,
            'message' => "success"
        ], 200);
    }

    public function getIdInvoice(Request $request){
        return InvoiceDetails::with('book')->where('invoice_id', $request->id)->get();
    }

    public function deleteInvoice(Request $request){
        $invoiceDetails = InvoiceDetails::findOrFail($request->id);
        $invoice = $invoiceDetails->invoice;
        $book = $invoiceDetails->book;


        DB::beginTransaction();
        try{
            $reducePrice = $invoiceDetails->total_price;
            $reduceDiscount = $invoiceDetails->total_dis;
            $increaseBook = $invoiceDetails->qty;

            $invoiceDetails->delete();

            //deduct total price and total discount cause of decresing sale qty
            $invoice->update(['total_price' => $invoice->total_price -= $reducePrice,
            'total_discount' => $invoice->total_discount -= $reduceDiscount]);

            //case of decreasing book sale qty, so available quantity will be increase.
            $book->update(['available_quantity' => $book->available_quantity += $increaseBook]);

            DB::commit();

        }catch(Exception $e){
            DB::rollback();
            return response(['message' => 'Opps! Some error!'], 500);
        }
        return response(['message' => 'Details Deleted Successfully!']);
    }


    public function updateInvoiceItem(Request $request){

        $invoiceDetails = InvoiceDetails::findOrfail($request->id);

        $invoice = $invoiceDetails->invoice;

        $book = $invoiceDetails->book;

        $reducedTotalPrice = $invoice->total_price - $invoiceDetails->total_price;

        $reducedTotalQty = $book->available_quantity + $invoiceDetails->qty;

        // $costPrice = $invoiceDetails->cost_price;
        // $totalPrice = $request->qty * $costPrice;

        $invoiceDetails->update([
            'qty'           => $request->qty,
            'unit_price'    => $request->unit_price,
            'discount_p'    => $request->discount_p,
            'rate'          => $request->rate,
            'discount'      => $request->discount,
            'total_costprice' => $request->total_costprice,
            'total_price'   => $request->total_price,
        ]);

        $invoice->update(['total_price' => $reducedTotalPrice + $request->total_price]);

        $book->update(['available_quantity' => $reducedTotalQty - $request->qty]);

        return response(['message' => 'Data Saved Successfully']);

    }


    public function getLastInvoiceSerial()
    {
        $lastInvoice = Invoice::whereDate('created_at', date('Y-m-d'))->orderBy('id', 'desc')->first();
        return  $lastInvoice ? $lastInvoice->invoice_serial ? $lastInvoice->invoice_serial + 1 : 1 : 1;
    }

    public function latestInvoiceDetails(){

        $data = Invoice::latest()->first();

        $data2 = InvoiceDetails::with('book')->where('invoice_id',$data->id)->get();
       $data3 = $data2->sum('qty');

        // $data2->qty->count();

        return response()->json([
            'data' => $data,
            'data2' => $data2,
            'totalqty' => $data3,
            'message' => "success"
        ], 200);

    }


    public function delSalesById(Request $request){

        $custsales = Invoice::findOrFail($request->id);
        if($custsales->total_price == 0){
            InvoiceDetails::where('invoice_id',$request->id)->delete();
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



}
