<?php

namespace App\Http\Controllers;

use App\Bike;
use App\Bikerental;
use Illuminate\Http\Request;
use DB;


class BikeRentalsGeneralIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$details = Bike::with(['bikeprice','bikestatus'])->orderBy('status_id','asc')->orderBy('type_id','asc')->paginate(6);   
        $q = 0;
        $user1 = DB::select(DB::raw("SELECT MAX(rental_id) as max FROM bikerentals " ));
        $user = Bike::where('status_id', 'LIKE', '%' . $q . '%')->orderBy('type_id','asc')
        ->paginate(6)->setPath('');
        //dd($user1);
        return view('alluser\bikerentalindex1.index',compact('user1'))->withDetails($user)->withQuery($q);


        //return view('alluser\bikerentalindex.index', compact('details'));
        
    }

    
   
    public function store(Request $req)
    {    
        $bike = Bike::with(['bikeprice'])->find($req->input('id'));
        return view('alluser\bikerentalindex1.create' ,['bike'=>$bike]);
    }

    
    
}