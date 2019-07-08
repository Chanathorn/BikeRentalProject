<?php

namespace App\Http\Controllers;

use App\Bike;
use App\Bikerental;
use Illuminate\Http\Request;
use DB;


class BikeRentalsIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    
        $q = 0;
        $user1 = DB::select(DB::raw("SELECT MAX(rental_id) as max FROM bikerentals " ));
        $user = Bike::where('status_id', 'LIKE', '%' . $q . '%')->orderBy('type_id','asc')
        ->paginate(6)->setPath('');
        //dd($user);
        return view('alluser\bikerentalindex.index',compact('user1'))->withDetails($user)->withQuery($q);

        
    }


   
    public function store(Request $req)
    {    
        $bike = Bike::with(['bikeprice'])->find($req->input('id'));
        return view('alluser\bikerentalindex.create' ,['bike'=>$bike]);
    }

    
    
}