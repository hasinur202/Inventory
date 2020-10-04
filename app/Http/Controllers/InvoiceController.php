<?php

namespace App\Http\Controllers;
use App\Book;
use App\Invoice;
use App\Customer;
use App\InvoiceDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoiceStore(Request $request){
        // DB::beginTransaction();
        // try{
            Customer::create($request->only(['cus_name', 'phone', 'email', 'address']));

            $invoice = Invoice::create($request->only(['invoice_ref', 'consign_ref', 'cus_id', 'total_price', 'pay_mode']));

            foreach($request->details as $key => $item){

               $invoi = InvoiceDetails::create(array_merge($item, ['qty' => $item['copies'], 'invoice_id' => $invoice->id]));

               $book = Book::where('id', $invoi->book_id)->first();

               $book->update(['available_quantity' => $book->available_quantity - $invoi->qty]);
            }

            // DB::commit();
            return response(['message' => 'Invoice Created!']);
        // }catch(Exception $e){
        //     DB::rollBack();
        //     return response(['message' => 'Opps! some Error!'], 500);
        // }
    }
}
