<?php

namespace App\Http\Controllers;


use App\Bikerental;
use App\Bike;
use Illuminate\Http\Request;
use DB;

class BikeReturnsIndexController extends Controller
{
    public function index()
    {   
        $q=99999;
        $user1 = DB::select(DB::raw("SELECT MAX(return_id) as max FROM bikereturns " ));
        $details = Bikerental::where('status_rental', 'LIKE', '%' . $q . '%')->orderBy('rental_id','desc')
        ->paginate(6);
        //dd($details);
        return view('alluser\bikereturnindex.index', compact('user1','details'));
    }

    
    public function store(Request $req)
    {    
        $user = Bikerental::find($req->input('id'));
        //dd($user);
        $user1 = Bike::find($user->bike_id);
        //dd($user1);
        return view('alluser\bikereturnindex.create', ['user'=>$user ,'user1' =>$user1]);

      /*  $user = Bike::with(['status_id'])->find($req->input('id'));
        dd($user);
        return view('alluser\bikerentalindex.create' ,['bike'=>$user]);*/
    }
}
