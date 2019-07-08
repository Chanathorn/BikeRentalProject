<?php

namespace App\Http\Controllers;

use App\Bikereturn;
use App\Bike;
use App\Bikerental;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BikeReturnsGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Bikereturn::with(['member','bike','bikerentals'])->orderBy('return_id','desc')->paginate(6);
        //dd($users);
        return view('alluser\bikereturn1.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alluser\bikereturn1.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'return_id' => 'required|unique:bikereturns,return_id'     
        ]); 

        $user = new Bikereturn([
            'return_id' => $request->get('return_id'),
            'member_id' => $request->get('member_id'),
            'rental_id' => $request->get('rental_id'),
            'bike_id' => $request->get('bike_id'),
            'return_date' => $request->get('return_date'),
            'received' => $request->get('received'),
            'fine' => $request->get('fine'),
            'changecash' => $request->get('changecash'),
            'employee_id' => $request->get('employee_id')

        ]);
        
        $his = new Historybikes(); 
        $his->pk = $user->return_id;
        $his->biketable = 'ข้อมูลการคืนจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user->save();
        $status = Bike::find($request->input('bike_id'));
        $status->status_id = 0;
        $status->save();
        
        $status1 = Bikerental::find($request->input('rental_id'));
        $status1->status_rental = 99998;
        $status1->save();

        return redirect('/home/bikereturn')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bikerturn  $bikerturn
     * @return \Illuminate\Http\Response
     */
    public function show(Bikerturn $bikerturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bikerturn  $bikerturn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Bikereturn::find($id);
        //dd($user->address_member);
        return view('alluser\bikereturn1.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bikerturn  $bikerturn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Bikereturn::find($id);
        //dd($user);
        $user->return_id = $request->get('return_id');
        $user->member_id = $request->get('member_id');
        $user->return_id = $request->get('return_id');
        $user->bike_id = $request->get('bike_id');
        $user->return_date = $request->get('return_date');
        $user->fine = $request->get('fine');
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->return_id;
        $his->biketable = 'ข้อมูลการคืนจักรยาน';
        $his->employee_id = $request->user()->employee_id; 
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        return redirect('/home/bikereturn')->with('success', 'อัพเดทเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bikerturn  $bikerturn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลการคืนจักรยาน';
        $his->employee_id = Auth::user()->employee_id ; 
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = Bikereturn::find($id);
        //dd($user);
        $user->delete();
        return redirect('/home/bikereturn')->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
