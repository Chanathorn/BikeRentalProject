<?php

namespace App\Http\Controllers\user;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use DB;


class UserGeneralController extends Controller
{
    public function index()
    {
        $user1 = DB::select(DB::raw("SELECT MAX(employee_id) as max FROM users" ));
        $details = User::paginate(6);
        return view('auth\users1.index', compact('details','user1'));
    }  
    public function edit($id) 
    {
        $user = User::find($id);
        return view('auth\users1.edit', compact('user', 'id'));
    } 
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->gender = $request->get('gender');
        $user->mobile = $request->get('mobile');
        $user->address = $request->get('address');
        $user->save();

        $his = new Historybikes();
        $his->pk = $user->employee_id;
        $his->biketable = 'ข้อมูลสมาชิก';
        $his->employee_id = $request->user()->employee_id;
        $his->event = 'แก้ไขข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        /*$user1 = DB::select(DB::raw("SELECT MAX(employee_id) as max FROM users" ));
        $details = User::paginate(6);
        return view('auth\users1.index', compact('details','user1'))->with('success', 'อัพเดทเรียบร้อย');*/
        return redirect('/home/users')->with('success', 'อัพเดทเรียบร้อย');
    }
}
