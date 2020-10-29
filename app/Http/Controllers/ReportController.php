<?php

namespace App\Http\Controllers;

use App\Consignment;
use App\ConsignmentDetails;
use App\CustInventory;
use App\Invoice;
use App\InvoiceDetails;
use App\SuppIventory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function summeryReport(Request $request)
    {

        if(!$request->fixedDate && !$request->toDate && !$request->fromDate){
            return response(['message' => 'Fill up all data', 'errors' => ['fixedDate' => ['Select Fixed Date or Date Range'],
            'fromDate' => ['Select Fixed Date or Date Range'],
            'toDate' => ['Select Fixed Date or Date Range']]], 422);

        }else if(!$request->fixedDate){
            if(!$request->fromDate){
                return response(['message' => 'Select fromDate', 'errors' => ['fromDate' => ['Select From Date']]], 422);
            }
            if(!$request->toDate){
                return response(['message' => 'Select toDate', 'errors' => ['toDate' => ['Select To Date']]], 422);
            }
        }

            $purchaseData = ConsignmentDetails::query();
            $salesData = InvoiceDetails::query();
            $supplierData = SuppIventory::where('status',1);
            $customerData = CustInventory::where('status',1);

            $cash = Consignment::where('pay_mode','Cash');
            $card = Consignment::where('pay_mode','Card');
            $cheque = Consignment::where('pay_mode','Cheque');
            $due = Consignment::where('pay_mode','Due');

            $cashSale = Invoice::where('pay_mode','Cash');
            $cardSale = Invoice::where('pay_mode','Card');
            $chequeSale = Invoice::where('pay_mode','Cheque');
            $dueSale = Invoice::where('pay_mode','Due');


            if($request->filled('fixedDate')){
                $purchaseData->whereDate('created_at', $request->get('fixedDate'));
                $salesData->whereDate('created_at', $request->get('fixedDate'));
                $supplierData->whereDate('updated_at', $request->get('fixedDate'));
                $customerData->whereDate('updated_at', $request->get('fixedDate'));

                $cash->whereDate('created_at', $request->get('fixedDate'));
                $due->whereDate('created_at', $request->get('fixedDate'));
                $card->whereDate('created_at', $request->get('fixedDate'));
                $cheque->whereDate('created_at', $request->get('fixedDate'));

                $cashSale->whereDate('created_at', $request->get('fixedDate'));
                $cardSale->whereDate('created_at', $request->get('fixedDate'));
                $chequeSale->whereDate('created_at', $request->get('fixedDate'));
                $dueSale->whereDate('created_at', $request->get('fixedDate'));

            }
            else{
                $purchaseData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
                $salesData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
                $supplierData->whereBetween('updated_at', [$request->fromDate, $request->toDate]);
                $customerData->whereBetween('updated_at', [$request->fromDate, $request->toDate]);

                $cash->whereDate('created_at', [$request->fromDate, $request->toDate]);
                $due->whereDate('created_at', [$request->fromDate, $request->toDate]);
                $card->whereDate('created_at', [$request->fromDate, $request->toDate]);
                $cheque->whereDate('created_at', [$request->fromDate, $request->toDate]);

                $cashSale->whereDate('created_at', [$request->fromDate, $request->toDate]);
                $cardSale->whereDate('created_at', [$request->fromDate, $request->toDate]);
                $chequeSale->whereDate('created_at', [$request->fromDate, $request->toDate]);
                $dueSale->whereDate('created_at', [$request->fromDate, $request->toDate]);


            }

        return [
            'purchachedData'    =>  $purchaseData->selectRaw('sum(total_price) as totalPrice, sum(qty) as totalPurchased')->first(),
            'salesData'    =>  $salesData->selectRaw('sum(qty) as totalQty, sum(total_price) as totalPrice, sum(total_dis) as totalDiscount')->first(),
            'supplierData'    =>  $supplierData->selectRaw('sum(total_due) as totalDue, sum(total_paid) as totalPaid, sum(new_due) as currentDue')->first(),
            'customerData'    =>  $customerData->selectRaw('sum(total_due) as totalDue, sum(total_paid) as totalPaid, sum(new_due) as currentDue')->first(),

            'totalCash'    =>  $cash->selectRaw('sum(total_price) as totalCash')->first(),
            'totalDue'    =>  $due->selectRaw('sum(total_price) as totalDue')->first(),
            'totalCard'    =>  $card->selectRaw('sum(total_price) as totalCard')->first(),
            'totalCheque'    =>  $cheque->selectRaw('sum(total_price) as totalCheque')->first(),

            'totalCashSale'    =>  $cashSale->selectRaw('sum(total_price) as totalCash')->first(),
            'totalCardSale'    =>  $cardSale->selectRaw('sum(total_price) as totalCard')->first(),
            'totalChequeSale'    =>  $chequeSale->selectRaw('sum(total_price) as totalCheque')->first(),
            'totalDueSale'    =>  $dueSale->selectRaw('sum(total_price) as totalDue')->first(),


        ];

    }

    public function statementReport(Request $request)
    {

        if(!$request->fixedDate && !$request->toDate && !$request->fromDate){
            return response(['message' => 'Fill up all data', 'errors' => ['fixedDate' => ['Select Fixed Date or Date Range'],
            'fromDate' => ['Select Fixed Date or Date Range'],
            'toDate' => ['Select Fixed Date or Date Range']]], 422);

        }else if(!$request->fixedDate){
            if(!$request->fromDate){
                return response(['message' => 'Select fromDate', 'errors' => ['fromDate' => ['Select From Date']]], 422);
            }
            if(!$request->toDate){
                return response(['message' => 'Select toDate', 'errors' => ['toDate' => ['Select To Date']]], 422);
            }
        }

            $statementData = InvoiceDetails::with('book','book.authors');

            if($request->filled('fixedDate')){
                $statementData->whereDate('created_at', $request->get('fixedDate'));
            }
            else{
                $statementData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
            }

        return [
            'statementData'    =>  $statementData->get(),

        ];

    }










}
