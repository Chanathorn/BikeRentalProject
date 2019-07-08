<?php

namespace App\Http\Controllers;

use App\Bike;
use App\Bikeprice;
use App\Bikestatus;
use App\Historybikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class BikeGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user1 = DB::select(DB::raw("SELECT MAX(bike_id) as max FROM bikes" ));
        $details = Bike::with(['bikeprice', 'bikestatus'])->orderBy('status_id','asc')->orderBy('bike_id','desc')->paginate(6);
        //dd($users);paginate(6);    
        $details1 = Bikeprice::all();   
        $details2 = Bikestatus::all();
        return view('alluser\bike1.index', compact('details','details1','details2','user1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $details = Bikeprice::all();
        return view('alluser\bike1.create',compact('details'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bike_id' => 'required|unique:bikes,bike_id',
            
        ]);
        $user = new Bike([
            'bike_id' => $request->get('bike_id'),
            'brand' => $request->get('brand'),
            'generation' => $request->get('generation'),
            'type_id' => $request->get('type_id'),
            'status_id' => $request->get('status_id')

        ]);
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->bike_id;
        $his->biketable = 'ข้อมูลจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save(); 
        return redirect('/home/bike')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id)
    {
        $user = Bike::find($id); 
        $type = Bikeprice::find($user->type_id);
        $type1 = Bikestatus::find($user->status_id);
        $details = Bikeprice::all();   
        $details1 = Bikestatus::all();     
        return view('alluser\bike.edit', compact('user','id','type','type1','details','details1'));
    }

   
    public function update(Request $request, $id)
    {
        $user = Bike::find($id);
        $user->bike_id = $request->get('bike_id');
        $user->brand = $request->get('brand');
        $user->generation = $request->get('generation');
        $user->type_id = $request->get('type_id');
        $user->status_id = $request->get('status_id');
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->bike_id;
        $his->biketable = 'ข้อมูลจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        return redirect('/home/bike')->with('success', 'อัพเดทเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลจักรยาน';
        $his->employee_id = Auth::user()->employee_id;
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = Bike::find($id);
        $user->delete();
        return redirect('/home/bike')->with('success', 'ลบข้อมูลเรียบร้อย');
    }

    
}
