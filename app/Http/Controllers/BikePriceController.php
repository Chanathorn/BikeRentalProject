<?php

namespace App\Http\Controllers;

use App\Bikeprice;
use App\Historybikes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DB;

class BikePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user1 = DB::select(DB::raw("SELECT MAX(type_id) as max FROM bikeprices" ));
        $details = Bikeprice::paginate(6);
        return view('alluser\bikeprice.index', compact('details','user1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alluser\bikeprice.create');
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
            'bike_type' => 'unique:bikeprices,bike_type',
            'price' => ''
        ]);
        $user = new Bikeprice([
            'type_id' => $request->get('type_id'),
            'bike_type' => $request->get('bike_type'),
            'price' => $request->get('price'),
        ]);
        $user->save();
        //dd($user->type_id);
        $his = new Historybikes();
        $his->pk = $user->type_id;
        $his->biketable = 'ข้อมูลประเภทและราคา';
        $his->employee_id = $request->user()->employee_id;
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        return redirect()->route('bikeprice.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
    
    public function update(Request $request, $id)
    {
        //dd($id);
        $this->validate( 
            $request,
            [         
                'price' => 'required'
            ]
        );       
                

        $user = Bikeprice::find($id);
        $user->price = $request->get('price');
        $user->save();

        $his = new Historybikes();
        $his->pk = $user->type_id;
        $his->biketable = 'ข้อมูลประเภทและราคา';
        $his->employee_id = $request->user()->employee_id;
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        return redirect()->route('bikeprice.index')->with('success', 'อัพเดทเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bikeprice  $bikeprice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลประเภทและราคา';
        $his->employee_id = Auth::user()->employee_id;
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = Bikeprice::find($id);
        $user->delete();
        return redirect()->route('bikeprice.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }

   

}