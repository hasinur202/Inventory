<?php

namespace App\Http\Controllers;

use App\ConsignmentDetails;
use App\CustInventory;
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
            $supplierData = SuppIventory::query();
            $customerData = CustInventory::query();

            if($request->filled('fixedDate')){
                $purchaseData->whereDate('created_at', $request->get('fixedDate'));
                $salesData->whereDate('created_at', $request->get('fixedDate'));
                $supplierData->whereDate('updated_at', $request->get('fixedDate'));
                $customerData->whereDate('updated_at', $request->get('fixedDate'));
            }
            else{
                $purchaseData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
                $salesData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
                $supplierData->whereBetween('updated_at', [$request->fromDate, $request->toDate]);
                $customerData->whereBetween('updated_at', [$request->fromDate, $request->toDate]);
            }

        return [
            'purchachedData'    =>  $purchaseData->selectRaw('sum(total_price) as totalPrice, sum(qty) as totalPurchased')->first(),
            'salesData'    =>  $salesData->selectRaw('sum(qty) as totalQty, sum(total_price) as totalPrice, sum(total_dis) as totalDiscount')->first(),
            'supplierData'    =>  $supplierData->selectRaw('sum(total_due) as totalDue, sum(total_paid) as totalPaid, sum(new_due) as currentDue')->first(),
            'customerData'    =>  $customerData->selectRaw('sum(total_due) as totalDue, sum(total_paid) as totalPaid, sum(new_due) as currentDue')->first(),

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
        
            $statementData = InvoiceDetails::query();

            if($request->filled('fixedDate')){
                $statementData->whereDate('created_at', $request->get('fixedDate'));
            }
            else{
                $statementData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
            }

        return [
            'statementData'    =>  $statementData,

        ];

    }










}
