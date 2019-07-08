<?php

namespace App\Http\Controllers;

use App\Bikestatus;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class BikestatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user1 = DB::select(DB::raw("SELECT MAX(status_id) as max FROM bikestatuses" ));
        $details = Bikestatus::paginate(6);
        return view('alluser\bikestatus.index', compact('details','user1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alluser\bikestatus.create');
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

            'status' => 'required|unique:bikestatuses,status',
        ]);
        $user = new Bikestatus([
            'status_id' => $request->get('status_id'),
            'status' => $request->get('status')
         
        ]);
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->status_id;
        $his->biketable = 'ข้อมูลสถานะจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();  
        return redirect()->route('bikestatus.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bikestatus  $bikestatus
     * @return \Illuminate\Http\Response
     */
    public function show(Bikestatus $bikestatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bikestatus  $bikestatus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Bikestatus::find($id);
        //dd($id);
        return view('alluser\bikestatus.edit', compact('user', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bikestatus  $bikestatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'status_id' => 'required',
                'status' => 'required'
            ]
        );

        $user = Bikestatus::find($id);
        $user->status_id = $request->get('status_id');
        $user->status = $request->get('status');
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->status_id;
        $his->biketable = 'ข้อมูลสถานะจักรยาน';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        return redirect()->route('bikestatus.index')->with('success', 'อัพเดทเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bikestatus  $bikestatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลสถานะจักรยาน';
        $his->employee_id = Auth::user()->employee_id ; 
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = Bikestatus::find($id);
        $user->delete();
        return redirect()->route('bikestatus.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
