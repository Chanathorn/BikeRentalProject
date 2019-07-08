<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use DB;

class ChartReturnGeneralController extends Controller
{
    public function index()
    {
    $date = date('Y');
    $results = DB::select(DB::raw("select sum(fine) as num, DATE_FORMAT(created_at, '%Y-%m') as date from bikereturns where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
    $month = [];
    $fee = [];
    foreach ($results as $i) {
        $month[] = $i->date;
        $fee[] = $i->num;
    }
    $chart = Charts::create('line', 'highcharts')
        ->title('รายได้จากค่าปรับรายเดือน')
        ->elementLabel('รายได้')
        ->labels($month)
        ->values($fee)
        ->dimensions(1000, 500)
        ->responsive(true);
    return view('chart1.chartreturn', compact('chart')); 
    }
}
