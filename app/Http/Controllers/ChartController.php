<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Member;
use DB;

class ChartController extends Controller
{
    public function index()
    {   $date = date('Y');
        $results = DB::select(DB::raw("SELECT SUM(fee) as sum FROM members WHERE DATE_FORMAT(created_at, '%Y')  = '$date' " ));
        $results1 = DB::select(DB::raw("SELECT SUM(price) as sum FROM bikerentals WHERE DATE_FORMAT(created_at, '%Y')  = '$date' " ));
        $results2 = DB::select(DB::raw("SELECT SUM(fine) as sum FROM bikereturns WHERE DATE_FORMAT(created_at, '%Y')  = '$date' " ));
        //dd($results);
        //$fee = $results[0];
        //dd($fee);   
        $results3 =$results[0]->sum+$results1[0]->sum+$results2[0]->sum;
        $chart = Charts::create('pie', 'highcharts')
                            ->title('กราฟรายรับรายปี')
                            ->labels(['Fee','price','fine'])
                            ->values([$results[0]->sum,$results1[0]->sum,$results2[0]->sum])
                            ->dimensions(1000,500)
                            ->responsive(true);
        return view('chart.chart', compact('chart','results3')); 
        }

}
