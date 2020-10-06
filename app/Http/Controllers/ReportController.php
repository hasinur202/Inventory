<?php

namespace App\Http\Controllers;

use App\ConsignmentDetails;
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

            if($request->filled('fixedDate')){
                $purchaseData->whereDate('created_at', $request->get('fixedDate'));
            }
            else{
                $purchaseData->whereBetween('created_at', [$request->fromDate, $request->toDate]);
            }


        return [
            'purchachedData'    =>  $purchaseData->selectRaw('sum(total_price) as totalPrice, sum(qty) as totalPurchased')->first(),
        ];

        


    }
}
