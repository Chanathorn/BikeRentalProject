<?php

namespace App\Http\Controllers;

use App\Member;
//use App\Http\Controllers;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user1 = DB::select(DB::raw("SELECT MAX(member_id) as max FROM members" ));
        $details = Member::with(['user'])->orderBy('member_id','desc')->paginate(6);
        //dd($users);
        return view('alluser\member.index', compact('details','user1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alluser\member.create');
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
            'member_id' => 'required|unique:members,member_id',
        ]);
        $user = new Member([
            'member_id' => $request->get('member_id'),
            'name_member' => $request->get('name_member'),
            'lastname_member' => $request->get('lastname_member'),
            'gender_member' => $request->get('gender_member'),
            'mobile_member' => $request->get('mobile_member'),
            'email_member' => $request->get('email_member'),
            'address_member' => $request->get('address_member'),
            'fee' => $request->get('fee'),
            'employee_id' => $request->get('employee_id')
        ]);
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->member_id;
        $his->biketable = 'ข้อมูลสมาชิก';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();  
        return redirect()->route('member.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
    public function update(Request $request, $id)
    {   
        
        $user = Member::find($id);
       // $user->member_id = $request->get('member_id');
        $user->name_member = $request->get('name_member');
        $user->lastname_member = $request->get('lastname_member');
        $user->gender_member = $request->get('gender_member');
        $user->mobile_member = $request->get('mobile_member');
        $user->email_member = $request->get('email_member');
        $user->address_member = $request->get('address_member');
        $user->fee = $request->get('fee');
        $user->save();

        $his = new Historybikes(); 
        $his->pk = $user->member_id;
        $his->biketable = 'ข้อมูลสมาชิก';
        $his->employee_id = $request->user()->employee_id ; 
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();  
        return redirect()->route('member.index')->with('success', 'อัพเดทเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลสมาชิก';
        $his->employee_id = Auth::user()->employee_id ; 
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = Member::find($id);
        $user->delete();
        return redirect()->route('member.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
