<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Input;
use App\Bikeprice;
use App\Member;
use App\User;
use App\Bike;
use App\Bikestatus;
use App\Bikerental;
use App\Bikereturn;
use App\Historybikes;


Auth::routes();

Route::get('/', function () {
    return view('welcome'); // หน้าก่อน login
});



//Route for normal user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    

    Route::any('/home/member/search', function () {
        $q = Input::get('q');
        $user1 = DB::select(DB::raw("SELECT MAX(member_id) as max FROM members" ));
        if ($q != "") {
            $user = Member::where('member_id', 'LIKE', '%' . $q . '%')
                ->orWhere('name_member', 'LIKE', '%' . $q . '%')
                ->orWhere('lastname_member', 'LIKE', '%' . $q . '%')
                ->orWhere('gender_member', 'LIKE', '%' . $q . '%')
                ->orWhere('mobile_member', 'LIKE', '%' . $q . '%')
                ->orWhere('address_member', 'LIKE', '%' . $q . '%')
                ->orWhere('fee', 'LIKE', '%' . $q . '%')
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\member1.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('alluser\member1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });


    Route::any('/home/users/search', function () {
        $q = Input::get('q');
        $user1 = DB::select(DB::raw("SELECT MAX(employee_id) as max FROM users" ));
        if ($q != "") {
            $user = User::where('employee_id', 'LIKE', '%' . $q . '%')
                ->orWhere('mobile', 'LIKE', '%' . $q . '%')
                ->orWhere('gender', 'LIKE', '%' . $q . '%')
                ->orWhere('address', 'LIKE', '%' . $q . '%')
                ->orWhere('name', 'LIKE', '%' . $q . '%')
                ->orWhere('lastname', 'LIKE', '%' . $q . '%')
                ->orWhere('email', 'LIKE', '%' . $q . '%')
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('auth\users1.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('auth\users1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    Route::any('/home/bike/search', function () {
        $q = Input::get('q');
        $details1 = Bikeprice::all();
        $details2 = Bikestatus::all();
        $user1 = DB::select(DB::raw("SELECT MAX(bike_id) as max FROM bikes" ));
        if ($q != "") {
            $user = Bike::where('bike_id', 'LIKE', '%' . $q . '%')
                ->orWhere('brand', 'LIKE', '%' . $q . '%')
                ->orWhere('generation', 'LIKE', '%' . $q . '%')
                ->orWhereHas('bikeprice', function ($query) use ($q) {
                    $query->where('bike_type', 'like', '%' . $q . '%')
                        ->orWhere('price', 'like', '%' . $q . '%');
                })
                ->orWhereHas('bikestatus', function ($query) use ($q) {
                    $query->where('status', 'like', '%' . $q . '%');
                })
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\bike1.index',compact('user1'))->withDetails($user)->withDetails1($details1)->withDetails2($details2)->withQuery($q);
        }
        return view('alluser\bike1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

  /*  Route::any('/dashboard/bikestatus/search', function () {
        $q = Input::get('q');
        $user1 = DB::select(DB::raw("SELECT MAX(status_id) as max FROM bikestatuses" ));
        if ($q != "") {
            $user = Bikestatus::where('status_id', 'LIKE', '%' . $q . '%')
                ->orWhere('status', 'LIKE', '%' . $q . '%')
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\bikestatus.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('alluser\bikestatus.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });*/

    Route::any('/home/bikerentalindex/search', function () {
        $q = Input::get('q');
        $q1 = 0;
        $user1 = DB::select(DB::raw("SELECT MAX(bike_id) as max FROM bikes" ));
        if ($q != "") {
            $user = Bike::Where('bike_id', 'LIKE', '%' . $q . '%')->where('status_id', '=', 0)
                ->orWhere('brand', 'LIKE', '%' . $q . '%')->where('status_id', '=', 0)
                ->orWhere('generation', 'LIKE', '%' . $q . '%')->where('status_id', '=', 0)
                ->orWhereHas('bikeprice', function ($query) use ($q) {
                    $query->where('bike_type', 'like', '%' . $q . '%')->where('status_id', '=', 0)
                        ->orWhere('price', 'like', '%' . $q . '%')->where('status_id', '=', 0);
                })
                ->orWhereHas('bikestatus', function ($query) use ($q) {
                    $query->where('status', 'like', '%' . $q . '%')->where('status_id', '=', 0);
                })
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\bikerentalindex1.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('alluser\bikerentalindex1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    Route::any('/home/bikerental/search', function () {
        $q = Input::get('q');
        $user1 = DB::select(DB::raw("SELECT MAX(rental_id) as max FROM bikerentals " ));
        if ($q != "") {
            $user = Bikerental::where('rental_id', 'LIKE', '%' . $q . '%')
                ->orWhere('member_id', 'LIKE', '%' . $q . '%')
                ->orWhere('bike_id', 'LIKE', '%' . $q . '%')
                ->orWhere('repatriate', 'LIKE', '%' . $q . '%')
                ->orWhere('price', 'LIKE', '%' . $q . '%')
                ->orWhere('status_rental', 'LIKE', '%' . $q . '%')
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\bikerental1.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('alluser\bikerental1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    Route::any('/home/bikereturnindex/search', function () {
        $q = Input::get('q');
        $user1 = DB::select(DB::raw("SELECT MAX(return_id) as max FROM bikereturns "));
        if ($q != "") {
            $user = Bikerental::where('rental_id', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                ->orWhere('member_id', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                ->orWhere('bike_id', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                ->orWhere('repatriate', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\bikereturnindex1.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('alluser\bikereturnindex1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    Route::any('/home/bikereturn/search', function () {
        $q = Input::get('q');
        $user1 = DB::select(DB::raw("SELECT MAX(return_id) as max FROM bikereturns "));
        if ($q != "") {
            $user = Bikereturn::where('return_id', 'LIKE', '%' . $q . '%')
                ->orWhere('rental_id', 'LIKE', '%' . $q . '%')
                ->orWhere('bike_id', 'LIKE', '%' . $q . '%')
                ->orWhere('return_date', 'LIKE', '%' . $q . '%')
                ->orWhere('fine', 'LIKE', '%' . $q . '%')
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('alluser\bikereturn1.index',compact('user1'))->withDetails($user)->withQuery($q);
        }
        return view('alluser\bikereturn1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    Route::any('/home/historybikes/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $user = Historybikes::where('pk', 'LIKE', '%' . $q . '%')
                ->orWhere('employee_id', 'LIKE', '%' . $q . '%')
                ->orWhere('event', 'LIKE', '%' . $q . '%')
                ->orWhere('datetime', 'LIKE', '%' . $q . '%')
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('admin\historybikes1.index')->withDetails($user)->withQuery($q);
        }
        return view('admin\historybikes1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    Route::any('/home/historybikes/searchdate', function () {
        $q = Input::get('q');
        $qq = Input::get('qq');
        if ($q != "" && $qq != "") {
            $user = Historybikes::wheredate('datetime', '>=', $q)
                ->wheredate('datetime', '<=', $qq)
                ->paginate(6)->setPath('');
            $user->appends(array(
                'q' => Input::get('q')
            ));
            $user->appends(array(
                'qq' => Input::get('qq')
            ));
            if (count($user) > 0)
                return view('admin\historybikes1.index')->withDetails($user)->withQuery($q);
        }
        return view('admin\historybikes1.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
    });

    //search Chart

    Route::any('/home/chart/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            // dd($date);
            $results = DB::select(DB::raw("SELECT SUM(fee) as sum FROM members WHERE DATE_FORMAT(created_at, '%Y')  = '$date' "));
            $results1 = DB::select(DB::raw("SELECT SUM(price) as sum FROM bikerentals WHERE DATE_FORMAT(created_at, '%Y')  = '$date' "));
            $results2 = DB::select(DB::raw("SELECT SUM(fine) as sum FROM bikereturns WHERE DATE_FORMAT(created_at, '%Y')  = '$date' "));
            //dd($results2[0]->sum);
            $results3 =$results[0]->sum+$results1[0]->sum+$results2[0]->sum;
            if ($results[0]->sum != null && $results1[0]->sum != null && $results2[0]->sum != null) {
                $chart = Charts::create('pie', 'highcharts')
                    ->title('กราฟรายรับรายปี')
                    ->labels(['Fee', 'price', 'fine'])
                    ->values([$results[0]->sum, $results1[0]->sum, $results2[0]->sum])
                    ->dimensions(1000, 500)
                    ->responsive(true);
                return view('chart1.chart', compact('chart','results3'));
            }
            if ($results[0]->sum == null && $results1[0]->sum != null && $results2[0]->sum != null) { 
                $chart = Charts::create('pie', 'highcharts')
                    ->title('กราฟรายรับรายปี')
                    ->labels(['price', 'fine'])
                    ->values([$results1[0]->sum, $results2[0]->sum])
                    ->dimensions(1000, 500)
                    ->responsive(true);               
                return view('chart1.chart', compact('chart','results3'));
            }
            if($results1[0]->sum == null && $results[0]->sum != null && $results2[0]->sum != null) { 
                $chart = Charts::create('pie', 'highcharts')
                    ->title('กราฟรายรับรายปี')
                    ->labels(['Fee', 'fine'])
                    ->values([$results[0]->sum,$results2[0]->sum])
                    ->dimensions(1000, 500)
                    ->responsive(true);               
                return view('chart1.chart', compact('chart','results3'));
            }
            if ($results2[0]->sum == null && $results[0]->sum != null && $results1[0]->sum != null) {
                $chart = Charts::create('pie', 'highcharts')
                    ->title('กราฟรายรับรายปี')
                    ->labels(['Fee', 'price'])
                    ->values([$results[0]->sum, $results1[0]->sum])
                    ->dimensions(1000, 500)
                    ->responsive(true);
                return view('chart1.chart', compact('chart','results3'));
            }
           if($results[0]->sum == null && $results1[0]->sum == null && $results2[0]->sum == null)
           return view('chart1.chart',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chart',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    Route::any('/home/chartmember/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            $results = DB::select(DB::raw("select count(*) as num, DATE_FORMAT(created_at, '%Y-%m') as date from members where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
            $month = [];
            $fee = [];
           // dd($results[0]->num);
            foreach ($results as $i) {
                $month[] = $i->date;
                $fee[] = $i->num * 25;
            }
            if ($results != []) {
            $chart = Charts::create('line', 'highcharts')
                ->title('รายได้จากค่าธรรมเนียมรายเดือน')
                ->elementLabel('รายได้')
                ->labels($month)
                ->values($fee)
                ->dimensions(1000, 500)
                ->responsive(true);
            return view('chart1.chartmember', compact('chart')); }  
            else
            return view('chart1.chartmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chartmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    Route::any('/home/chartrental/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            $results = DB::select(DB::raw("select sum(price) as num, DATE_FORMAT(created_at, '%Y-%m') as date from bikerentals where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
            $month = [];
            $fee = [];
           // dd($results[0]->num);
            foreach ($results as $i) {
                $month[] = $i->date;
                $fee[] = $i->num ;
            }
            if ($results != []) {
            $chart = Charts::create('line', 'highcharts')
                ->title('รายได้จากค่าเช่าจักรยานรายเดือน')
                ->elementLabel('รายได้')
                ->labels($month)
                ->values($fee)
                ->dimensions(1000, 500)
                ->responsive(true);
            return view('chart1.chartrental', compact('chart')); }  
            else
            return view('chart1.chartrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chartrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    Route::any('/home/chartreturn/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            $results = DB::select(DB::raw("select sum(fine) as num, DATE_FORMAT(created_at, '%Y-%m') as date from bikereturns where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
            $month = [];
            $fee = [];
           // dd($results[0]->num);
            foreach ($results as $i) {
                $month[] = $i->date;
                $fee[] = $i->num ;
            }
            if ($results != []) {
            $chart = Charts::create('line', 'highcharts')
                ->title('รายได้จากค่าปรับรายเดือน')
                ->elementLabel('รายได้')
                ->labels($month)
                ->values($fee)
                ->dimensions(1000, 500)
                ->responsive(true);
            return view('chart1.chartreturn', compact('chart')); }  
            else
            return view('chart1.chartreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chartreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    Route::any('/home/chartallmember/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            $users = Member::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $date)->get();
            if ($users != []) {                
                $chart = Charts::database($users, 'bar', 'highcharts')
                  ->title("จำนวนสมาชิกที่สมัครต่อเดือน")
                  ->elementLabel("ผู้ใช้ทั้งหมด")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth($date,true)
                  ->labels(['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']);     
              return view('chart1.chartallmember', compact('chart')); }  
            else
            return view('chart1.chartallmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chartallmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    Route::any('/home/chartallrental/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            $users = Bikerental::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $date)->get();
            if ($users != []) {                
                $chart = Charts::database($users, 'bar', 'highcharts')
                  ->title("จำนวนการเช่าต่อเดือน")
                  ->elementLabel("ผู้ใช้ทั้งหมด")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth($date,true)
                  ->labels(['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']);     
              return view('chart1.chartallrental', compact('chart')); }  
            else
            return view('chart1.chartallrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chartallrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    Route::any('/home/chartallreturn/search', function () {
        $q = Input::get('q');
        if ($q != "") {
            $date = $q;
            $users = Bikereturn::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $date)->get();
            if ($users != []) {                
                $chart = Charts::database($users, 'bar', 'highcharts')
                  ->title("จำนวนการคืนต่อเดือน")
                  ->elementLabel("ผู้ใช้ทั้งหมด")
                  ->dimensions(1000, 500)
                  ->responsive(true)
                  ->groupByMonth($date,true)
                  ->labels(['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']);     
              return view('chart1.chartallreturn', compact('chart')); }  
            else
            return view('chart1.chartallreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
        }
        return view('chart1.chartallreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
    });

    //UserFolder
    Route::resource('/home/historybikes', 'admin\HistorybikesGeneralController');
    Route::resource('/home/users', 'user\UserGeneralController');
    //AllFolder
    Route::resource('/home/member', 'MemberGeneralController');
    Route::resource('/home/bike', 'BikeGeneralController');
    //Route::resource('/dashboard/bikeprice', 'BikePriceController');
    Route::resource('/home/bikerentalindex', 'BikeRentalsGeneralIndexController');
    Route::resource('/home/bikerental', 'BikeRentalsGeneralController');
    Route::resource('/home/bikereturnindex', 'BikeReturnsGeneralIndexController');
    Route::resource('/home/bikereturn', 'BikeReturnsGeneralController');
    //Route::resource('/dashboard/bikestatus', 'BikestatusController');
    Route::resource('/home/bikereturncreate', 'HiddenController');

    //PDF
    Route::post('/home/member/pdf/{id}', 'PDFGeneralController@pdf');
    Route::post('/home/bikerental/pdf/{id}','PDFGeneralController@pdfrental');
    Route::post('/home/bikereturn/pdf/{id}','PDFGeneralController@pdfreturn');
    
    //chart
    Route::resource('/home/chart', 'ChartGeneralController');
    Route::resource('/home/chartmember', 'ChartMemberGeneralController');
    Route::resource('/home/chartrental', 'ChartRentalGeneralController');
    Route::resource('/home/chartreturn', 'ChartReturnGeneralController');
    Route::resource('/home/chartallmember', 'ChartAllMemberGeneralController');
    Route::resource('/home/chartallrental', 'ChartAllRentalGeneralController');
    Route::resource('/home/chartallreturn', 'ChartAllReturnGeneralController');

    //email
    Route::post('/home/email', 'EmailsController@post');
    

});











































//Route for admin
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['admin']], function () {

        Route::get('/dashboard', 'admin\AdminController@index');
        Route::get('/dashboard/users/register', 'admin\UsersController@create');
        Route::get('/dashboard/bikerental/{id}', 'BikeRentalsController@create');
        Route::get('/dashboard/bikerentalindex/create', 'BikeRentalsIndexController@store');
        Route::get('/dashboard/bikerental/create', 'BikeRentalsController@create');
        Route::get('/dashboard/bikereturn/create', 'BikeReturnsController@create');
        Route::get('/dashboard/bikerental/{id}', 'BikeRentalsController@create');

        //create
        Route::get('/dashboard/member/create', 'MemberController@create');
        Route::get('/dashboard/bike/create', 'BikeController@create');
        Route::get('/dashboard/bikeprice/create', 'BikeController@create');
        Route::get('/dashboard/bikestatus/create', 'BikestatusController@create');


        //destroy
        Route::get('/dashboard/bike/{id}', 'BikeController@destroy');
        Route::get('/dashboard/member/{id}', 'MemberController@destroy');
        Route::get('/dashboard/users/{id}', 'UsersController@destroy');
        Route::get('/dashboard/bikeprice/{id}', 'BikepriceController@destroy');
        Route::get('/dashboard/bikerental/{id}', 'BikeRentalsController@destroy');

        //search //สถานะการใช้งานต้องมีปุ่มเพิ่มมั้ย
        Route::any('/dashboard/bikeprice/search', function () {
            $user1 = DB::select(DB::raw("SELECT MAX(type_id) as max FROM bikeprices" ));
            $q = Input::get('q');
            if ($q != "") {
                $user = Bikeprice::where('type_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('bike_type', 'LIKE', '%' . $q . '%')
                    ->orWhere('price', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bikeprice.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\bikeprice.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/member/search', function () {
            $q = Input::get('q');
            $user1 = DB::select(DB::raw("SELECT MAX(member_id) as max FROM members" ));
            if ($q != "") {
                $user = Member::where('member_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('name_member', 'LIKE', '%' . $q . '%')
                    ->orWhere('lastname_member', 'LIKE', '%' . $q . '%')
                    ->orWhere('gender_member', 'LIKE', '%' . $q . '%')
                    ->orWhere('mobile_member', 'LIKE', '%' . $q . '%')
                    ->orWhere('address_member', 'LIKE', '%' . $q . '%')
                    ->orWhere('fee', 'LIKE', '%' . $q . '%')
                    ->orWhere('employee_id', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\member.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\member.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });


        Route::any('/dashboard/users/search', function () {
            $q = Input::get('q');
            $user1 = DB::select(DB::raw("SELECT MAX(employee_id) as max FROM users" ));
            if ($q != "") {
                $user = User::where('employee_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('mobile', 'LIKE', '%' . $q . '%')
                    ->orWhere('gender', 'LIKE', '%' . $q . '%')
                    ->orWhere('address', 'LIKE', '%' . $q . '%')
                    ->orWhere('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $q . '%')
                    ->orWhere('email', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('auth\users.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('auth\users.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/bike/search', function () {
            $q = Input::get('q');
            $details1 = Bikeprice::all();
            $details2 = Bikestatus::all();
            $user1 = DB::select(DB::raw("SELECT MAX(bike_id) as max FROM bikes" ));
            if ($q != "") {
                $user = Bike::where('bike_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('brand', 'LIKE', '%' . $q . '%')
                    ->orWhere('generation', 'LIKE', '%' . $q . '%')
                    ->orWhereHas('bikeprice', function ($query) use ($q) {
                        $query->where('bike_type', 'like', '%' . $q . '%')
                            ->orWhere('price', 'like', '%' . $q . '%');
                    })
                    ->orWhereHas('bikestatus', function ($query) use ($q) {
                        $query->where('status', 'like', '%' . $q . '%');
                    })
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bike.index',compact('user1'))->withDetails($user)->withDetails1($details1)->withDetails2($details2)->withQuery($q);
            }
            return view('alluser\bike.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/bikestatus/search', function () {
            $q = Input::get('q');
            $user1 = DB::select(DB::raw("SELECT MAX(status_id) as max FROM bikestatuses" ));
            if ($q != "") {
                $user = Bikestatus::where('status_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('status', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bikestatus.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\bikestatus.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/bikerentalindex/search', function () {
            $q = Input::get('q');
            $q1 = 0;
            $user1 = DB::select(DB::raw("SELECT MAX(bike_id) as max FROM bikes" ));
            if ($q != "") {
                $user = Bike::Where('bike_id', 'LIKE', '%' . $q . '%')->where('status_id', '=', 0)
                    ->orWhere('brand', 'LIKE', '%' . $q . '%')->where('status_id', '=', 0)
                    ->orWhere('generation', 'LIKE', '%' . $q . '%')->where('status_id', '=', 0)
                    ->orWhereHas('bikeprice', function ($query) use ($q) {
                        $query->where('bike_type', 'like', '%' . $q . '%')->where('status_id', '=', 0)
                            ->orWhere('price', 'like', '%' . $q . '%')->where('status_id', '=', 0);
                    })
                    ->orWhereHas('bikestatus', function ($query) use ($q) {
                        $query->where('status', 'like', '%' . $q . '%')->where('status_id', '=', 0);
                    })
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bikerentalindex.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\bikerentalindex.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/bikerental/search', function () {
            $q = Input::get('q');
            $user1 = DB::select(DB::raw("SELECT MAX(rental_id) as max FROM bikerentals " ));
            if ($q != "") {
                $user = Bikerental::where('rental_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('member_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('bike_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('repatriate', 'LIKE', '%' . $q . '%')
                    ->orWhere('price', 'LIKE', '%' . $q . '%')
                    ->orWhere('status_rental', 'LIKE', '%' . $q . '%')
                    ->orWhere('employee_id', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bikerental.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\bikerental.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/bikereturnindex/search', function () {
            $q = Input::get('q');
            $user1 = DB::select(DB::raw("SELECT MAX(return_id) as max FROM bikereturns "));
            if ($q != "") {
                $user = Bikerental::where('rental_id', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                    ->orWhere('member_id', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                    ->orWhere('bike_id', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                    ->orWhere('repatriate', 'LIKE', '%' . $q . '%')->where('status_rental', '=', 99999)
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bikereturnindex.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\bikereturnindex.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/bikereturn/search', function () {
            $q = Input::get('q');
            $user1 = DB::select(DB::raw("SELECT MAX(return_id) as max FROM bikereturns "));
            if ($q != "") {
                $user = Bikereturn::where('return_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('rental_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('bike_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('return_date', 'LIKE', '%' . $q . '%')
                    ->orWhere('fine', 'LIKE', '%' . $q . '%')
                    ->orWhere('employee_id', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('alluser\bikereturn.index',compact('user1'))->withDetails($user)->withQuery($q);
            }
            return view('alluser\bikereturn.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/historybikes/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $user = Historybikes::where('pk', 'LIKE', '%' . $q . '%')
                    ->orWhere('employee_id', 'LIKE', '%' . $q . '%')
                    ->orWhere('event', 'LIKE', '%' . $q . '%')
                    ->orWhere('datetime', 'LIKE', '%' . $q . '%')
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                if (count($user) > 0)
                    return view('admin\historybikes.index')->withDetails($user)->withQuery($q);
            }
            return view('admin\historybikes.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        Route::any('/dashboard/historybikes/searchdate', function () {
            $q = Input::get('q');
            $qq = Input::get('qq');
            if ($q != "" && $qq != "") {
                $user = Historybikes::wheredate('datetime', '>=', $q)
                    ->wheredate('datetime', '<=', $qq)
                    ->paginate(6)->setPath('');
                $user->appends(array(
                    'q' => Input::get('q')
                ));
                $user->appends(array(
                    'qq' => Input::get('qq')
                ));
                if (count($user) > 0)
                    return view('admin\historybikes.index')->withDetails($user)->withQuery($q);
            }
            return view('admin\historybikes.index')->withMessage('ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !');
        });

        //search Chart

        Route::any('/dashboard/chart/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                // dd($date);
                $results = DB::select(DB::raw("SELECT SUM(fee) as sum FROM members WHERE DATE_FORMAT(created_at, '%Y')  = '$date' "));
                $results1 = DB::select(DB::raw("SELECT SUM(price) as sum FROM bikerentals WHERE DATE_FORMAT(created_at, '%Y')  = '$date' "));
                $results2 = DB::select(DB::raw("SELECT SUM(fine) as sum FROM bikereturns WHERE DATE_FORMAT(created_at, '%Y')  = '$date' "));
                //dd($results2[0]->sum);
                $results3 =$results[0]->sum+$results1[0]->sum+$results2[0]->sum;
                if ($results[0]->sum != null && $results1[0]->sum != null && $results2[0]->sum != null) {
                    $chart = Charts::create('pie', 'highcharts')
                        ->title('กราฟรายรับรายปี')
                        ->labels(['Fee', 'price', 'fine'])
                        ->values([$results[0]->sum, $results1[0]->sum, $results2[0]->sum])
                        ->dimensions(1000, 500)
                        ->responsive(true);
                    return view('chart.chart', compact('chart','results3'));
                }
                if ($results[0]->sum == null && $results1[0]->sum != null && $results2[0]->sum != null) { 
                    $chart = Charts::create('pie', 'highcharts')
                        ->title('กราฟรายรับรายปี')
                        ->labels(['price', 'fine'])
                        ->values([$results1[0]->sum, $results2[0]->sum])
                        ->dimensions(1000, 500)
                        ->responsive(true);               
                    return view('chart.chart', compact('chart','results3'));
                }
                if($results1[0]->sum == null && $results[0]->sum != null && $results2[0]->sum != null) { 
                    $chart = Charts::create('pie', 'highcharts')
                        ->title('กราฟรายรับรายปี')
                        ->labels(['Fee', 'fine'])
                        ->values([$results[0]->sum,$results2[0]->sum])
                        ->dimensions(1000, 500)
                        ->responsive(true);               
                    return view('chart.chart', compact('chart','results3'));
                }
                if ($results2[0]->sum == null && $results[0]->sum != null && $results1[0]->sum != null) {
                    $chart = Charts::create('pie', 'highcharts')
                        ->title('กราฟรายรับรายปี')
                        ->labels(['Fee', 'price'])
                        ->values([$results[0]->sum, $results1[0]->sum])
                        ->dimensions(1000, 500)
                        ->responsive(true);
                    return view('chart.chart', compact('chart','results3'));
                }
               if($results[0]->sum == null && $results1[0]->sum == null && $results2[0]->sum == null)
               return view('chart.chart',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chart',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        Route::any('/dashboard/chartmember/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                $results = DB::select(DB::raw("select count(*) as num, DATE_FORMAT(created_at, '%Y-%m') as date from members where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
                $month = [];
                $fee = [];
               // dd($results[0]->num);
                foreach ($results as $i) {
                    $month[] = $i->date;
                    $fee[] = $i->num * 25;
                }
                if ($results != []) {
                $chart = Charts::create('line', 'highcharts')
                    ->title('รายได้จากค่าธรรมเนียมรายเดือน')
                    ->elementLabel('รายได้')
                    ->labels($month)
                    ->values($fee)
                    ->dimensions(1000, 500)
                    ->responsive(true);
                return view('chart.chartmember', compact('chart')); }  
                else
                return view('chart.chartmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chartmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        Route::any('/dashboard/chartrental/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                $results = DB::select(DB::raw("select sum(price) as num, DATE_FORMAT(created_at, '%Y-%m') as date from bikerentals where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
                $month = [];
                $fee = [];
               // dd($results[0]->num);
                foreach ($results as $i) {
                    $month[] = $i->date;
                    $fee[] = $i->num ;
                }
                if ($results != []) {
                $chart = Charts::create('line', 'highcharts')
                    ->title('รายได้จากค่าเช่าจักรยานรายเดือน')
                    ->elementLabel('รายได้')
                    ->labels($month)
                    ->values($fee)
                    ->dimensions(1000, 500)
                    ->responsive(true);
                return view('chart.chartrental', compact('chart')); }  
                else
                return view('chart.chartrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chartrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        Route::any('/dashboard/chartreturn/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                $results = DB::select(DB::raw("select sum(fine) as num, DATE_FORMAT(created_at, '%Y-%m') as date from bikereturns where DATE_FORMAT(created_at, '%Y') = '$date' group by date order by date desc"));
                $month = [];
                $fee = [];
               // dd($results[0]->num);
                foreach ($results as $i) {
                    $month[] = $i->date;
                    $fee[] = $i->num ;
                }
                if ($results != []) {
                $chart = Charts::create('line', 'highcharts')
                    ->title('รายได้จากค่าปรับรายเดือน')
                    ->elementLabel('รายได้')
                    ->labels($month)
                    ->values($fee)
                    ->dimensions(1000, 500)
                    ->responsive(true);
                return view('chart.chartreturn', compact('chart')); }  
                else
                return view('chart.chartreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chartreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        Route::any('/dashboard/chartallmember/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                $users = Member::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $date)->get();
                if ($users != []) {                
                    $chart = Charts::database($users, 'bar', 'highcharts')
                      ->title("จำนวนสมาชิกที่สมัครต่อเดือน")
                      ->elementLabel("ผู้ใช้ทั้งหมด")
                      ->dimensions(1000, 500)
                      ->responsive(true)
                      ->groupByMonth($date,true)
                      ->labels(['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']);     
                  return view('chart.chartallmember', compact('chart')); }  
                else
                return view('chart.chartallmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chartallmember',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        Route::any('/dashboard/chartallrental/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                $users = Bikerental::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $date)->get();
                if ($users != []) {                
                    $chart = Charts::database($users, 'bar', 'highcharts')
                      ->title("จำนวนการเช่าต่อเดือน")
                      ->elementLabel("ผู้ใช้ทั้งหมด")
                      ->dimensions(1000, 500)
                      ->responsive(true)
                      ->groupByMonth($date,true)
                      ->labels(['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']);     
                  return view('chart.chartallrental', compact('chart')); }  
                else
                return view('chart.chartallrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chartallrental',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        Route::any('/dashboard/chartallreturn/search', function () {
            $q = Input::get('q');
            if ($q != "") {
                $date = $q;
                $users = Bikereturn::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), $date)->get();
                if ($users != []) {                
                    $chart = Charts::database($users, 'bar', 'highcharts')
                      ->title("จำนวนการคืนต่อเดือน")
                      ->elementLabel("ผู้ใช้ทั้งหมด")
                      ->dimensions(1000, 500)
                      ->responsive(true)
                      ->groupByMonth($date,true)
                      ->labels(['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม']);     
                  return view('chart.chartallreturn', compact('chart')); }  
                else
                return view('chart.chartallreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);  
            }
            return view('chart.chartallreturn',['message'=>'ไม่พบข้อมูล, ลองค้นหาอีกครั้ง !']);
        });

        //AdminFolder
        Route::resource('/dashboard/historybikes', 'admin\HistorybikesController');
        Route::resource('/dashboard/users', 'admin\UsersController');
        //AllFolder
        Route::resource('/dashboard/member', 'MemberController');
        Route::resource('/dashboard/bike', 'BikeController');
        Route::resource('/dashboard/bikeprice', 'BikePriceController');
        Route::resource('/dashboard/bikerentalindex', 'BikeRentalsIndexController');
        Route::resource('/dashboard/bikerental', 'BikeRentalsController');
        Route::resource('/dashboard/bikereturnindex', 'BikeReturnsIndexController');
        Route::resource('/dashboard/bikereturn', 'BikeReturnsController');
        Route::resource('/dashboard/bikestatus', 'BikestatusController');
        Route::resource('/dashboard/bikereturncreate', 'HiddenController');

        //PDF
        Route::post('/dashboard/member/pdf/{id}', 'PDFController@pdf');
        Route::post('/dashboard/bikerental/pdf/{id}','PDFController@pdfrental');
        Route::post('/dashboard/bikereturn/pdf/{id}','PDFController@pdfreturn');
        Route::post('/dashboard/bikereturndisppear/pdf/{id}','PDFController@pdfreturndisppear');
        
        //chart
        Route::resource('/dashboard/chart', 'ChartController');
        Route::resource('/dashboard/chartmember', 'ChartMemberController');
        Route::resource('/dashboard/chartrental', 'ChartRentalController');
        Route::resource('/dashboard/chartreturn', 'ChartReturnController');
        Route::resource('/dashboard/chartallmember', 'ChartAllMemberController');
        Route::resource('/dashboard/chartallrental', 'ChartAllRentalController');
        Route::resource('/dashboard/chartallreturn', 'ChartAllReturnController');
        Route::resource('/dashboard/bikerentalcreate', 'ChartAllReturnController');
        //Route::get('bar-chart', 'ChartController@index');
        Route::post('/dashboard/email', 'EmailsController@post');
    });
});
