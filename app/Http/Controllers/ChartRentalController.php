<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use DB;

class ChartRentalController extends Controller
{
    public function index()
        {
        $date = date('Y');
        $results = DB::select(DB::raw("select sum(price) as num, DATE_FORMAT(created_at, '%Y-%m') as date from bikerentals where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
        $month = [];
        $fee = [];
        foreach ($results as $i) {
            $month[] = $i->date;
            $fee[] = $i->num;
        }
        $chart = Charts::create('line', 'highcharts')
            ->title('รายได้จากค่าเช่าจักรยานรายเดือน')
            ->elementLabel('รายได้')
            ->labels($month)
            ->values($fee)
            ->dimensions(1000, 500)
            ->responsive(true);
        return view('chart.chartrental', compact('chart')); 
        }
}
