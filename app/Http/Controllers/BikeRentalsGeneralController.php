<?php

namespace App\Http\Controllers;

use App\Bikerental;
use App\Bike;
use App\Member;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BikeRentalsGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $details = Bikerental::with(['member','bike'])->orderBy('rental_id','desc')->paginate(6);
        //dd($details);
        return view('alluser\bikerental1.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Bike::find($id);
        //dd($user);
        return view('alluser\bikerental1.create', compact('$user'));
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
            'rental_id' => 'required|unique:bikerentals,rental_id',
        ]);

        $user = new Bikerental([
            'rental_id' => $request->get('rental_id'),
            'member_id' => $request->get('member_id'),
            'bike_id' => $request->get('bike_id'),
            'repatriate' => $request->get('repatriate'),
            'received' => $request->get('received'),
            'price' => $request->get('price'),
            'changecash' => $request->get('changecash'),
            'employee_id' => $request->get('employee_id')
        ]);   
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->rental_id;
        $his->biketable = 'ข้อมูลการเช่าจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();  

        $status = Bike::find($request->input('bike_id'));
        $status->status_id = 2;
        $status->save();
        return redirect('/home/bikerental')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bikerental  $bikerental
     * @return \Illuminate\Http\Response
     */
    public function show(Bikerental $bikerental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bikerental  $bikerental
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Bikerental::find($id);
        //dd($user->address_member);
        return view('alluser\bikerental1.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bikerental  $bikerental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     

        $user = Bikerental::find($id);
        //dd($user);
        $user->rental_id = $request->get('rental_id');
        $user->member_id = $request->get('member_id');
        $user->bike_id = $request->get('bike_id');
        $user->repatriate = $request->get('repatriate');
        $user->received = $request->get('received');
        $user->price = $request->get('price');
        $user->changecash = $request->get('changecash');
        $user->save();
       
        $his = new Historybikes(); 
        $his->pk = $user->rental_id;
        $his->biketable = 'ข้อมูลการเช่าจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();  
        return redirect('/home/bikerental')->with('success', 'อัพเดทเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bikerental  $bikerental
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลการเช่าจักรยาน';
        $his->employee_id = Auth::user()->employee_id ; 
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = Bikerental::find($id);
        //dd($user);
        $status = Bike::find($user->bike_id);
        $status->status_id = 0;
        $status->save(); 
        $user->delete();
        return redirect('/home/bikerental')->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
