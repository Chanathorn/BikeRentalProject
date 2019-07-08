<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use DB;

class UsersController extends Controller
{
    public function index()
    {
        $user1 = DB::select(DB::raw("SELECT MAX(employee_id) as max FROM users" ));
        $details = User::paginate(6);
        return view('auth\users.index', compact('details','user1'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'unique:users,employee_id',
            'email' => 'unique:users,email',
        ]);

        //zdd($request->password);

        $user = new User([
            'employee_id' => $request->get('employee_id'),
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'gender' => $request->get('gender'),
            'mobile' => $request->get('mobile'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->password)

        ]);
        $user->save();

        $his = new Historybikes();
        $his->pk = $user->employee_id;
        $his->biketable = 'ข้อมูลสมาชิก';
        $his->employee_id = $request->user()->employee_id;
        $his->event = 'เพิ่มข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();
        return redirect()->route('users.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function edit($id) 
    {
        $user = User::find($id);
        return view('auth\users.edit', compact('user', 'id'));
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
        return redirect()->route('users.index')->with('success', 'อัพเดทเรียบร้อย');
    }

    public function destroy($id)
    {
        $his = new Historybikes();
        $his->pk = $id;
        $his->biketable = 'ข้อมูลสมาชิก';
        $his->employee_id = Auth::user()->employee_id;
        $his->event = 'ลบข้อมูล';
        $his->datetime = date('Y-m-d H:i:s');
        $his->save();

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }
}
