<?php

namespace App\Http\Controllers;

use App\Bikereturn;
use App\Bike;
use App\Bikerental;
use App\Historybikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HiddenController extends Controller
{
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
        
        

        $user->save();
        $status = Bike::find($request->input('bike_id'));
        $status->status_id = 3;
        $status->save();
        
        $status1 = Bikerental::find($request->input('rental_id'));
        $status1->status_rental = 99997;
        $status1->save();

        return redirect()->route('bikereturn.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }
}