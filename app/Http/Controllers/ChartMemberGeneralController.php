<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Member;
use DB;

class ChartMemberGeneralController extends Controller
{
    public function index()
        {
        $date = date('Y');
        $results = DB::select(DB::raw("select count(*) as num, DATE_FORMAT(created_at, '%Y-%m') as date from members where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
        $month = [];
        $fee = [];
        foreach ($results as $i) {
            $month[] = $i->date;
            $fee[] = $i->num * 50;
        }
        $chart = Charts::create('line', 'highcharts')
            ->title('รายได้จากค่าธรรมเนียมรายเดือน')
            ->elementLabel('รายได้')
            ->labels($month)
            ->values($fee)
            ->dimensions(1000, 500)
            ->responsive(true);
        return view('chart1.chartmember', compact('chart')); 
        }

}
