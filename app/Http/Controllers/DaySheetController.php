<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaySheetController extends Controller
{
    //
    public function index()
    {
        $orders_data = DB::table('orders')->orderBy('order_date','desc')->get();
        $service_data = DB::table('service_data')->orderBy('service_date','desc')->where('status',1)->get();

        return view('sv.daySheet.index');

    }

    public function fetchdata(Request $request){

        $request->validate([
            'fromDate'=>'required',
            'toDate'=>'required'
        ]);

        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        //dd($fromDate,$toDate);

        $orders_data = DB::table('orders')->select('order_id','paid','order_date')->whereBetween('order_date',[$fromDate,$toDate])->where('status',1)->get();
        $service_data = DB::table('service_data')->whereBetween('service_date',[$fromDate,$toDate])->where('status',1)->get();

        // $data=$orders_data->merge($service_data);

        $types = array('Order','Service','Expense');

        $links = array('/orders/manage/view_order/','/service/manage/view_service/');

        //$button = 

        foreach ($orders_data as $order) {
        
            $output[] = array( 		
                $types[0],
                $order->paid,
                '<a type="button" class="btn btn-primary" href="'.$links[0].$order->order_id.'"> <i class="glyphicon glyphicon-search"></i>View</a>', 		
                ); 	
        }
        foreach ($service_data as $service) {
        
            $output[] = array( 		
                $types[1],
                $service->paid_amt,
                '<a type="button" class="btn btn-primary" href="'.$links[1].$service->service_id.'"> <i class="glyphicon glyphicon-search"></i>View</a>', 		
                ); 	
        }

        //dd($data);

        return json_encode($output);

      
    }
}