<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Bikerental;
use App\Bike;
use App\Bikereturn;
use App\User;
use PDF;

class PDFGeneralController extends Controller
{

    public function pdf($id){
        $Member = Member::find($id);
        $user = User::find($Member->employee_id);
        $pdf = PDF::loadView('pdf.pdf', ['Member'=>$Member,'user'=>$user]);
        return @$pdf->stream();
    } 
    public function pdfrental($id){
        $Bikerental = Bikerental::find($id);
        //dd($Bikerental->member_id);
        $Bikerental1 = Member::find($Bikerental->member_id);
        $Bikerental2 = Bike::find($Bikerental->bike_id);
        //dd($Bikerental1);
        $pdf = PDF::loadView('pdf.pdfRen', ['Bikerental'=>$Bikerental,'Bikerental1'=>$Bikerental1,'Bikerental2'=>$Bikerental2]);
        return @$pdf->stream();
    } 
    public function pdfreturn($id){
        $Bikereturn = Bikereturn::find($id);
        //dd($Bikerental->member_id);
        $Bikerental = Bikerental::find($Bikereturn->rental_id);
        $Bikereturn1 = Member::find($Bikereturn->member_id);
        $Bikereturn2 = Bike::find($Bikereturn->bike_id);
        //dd($Bikerental1);
        $pdf = PDF::loadView('pdf.pdfRet', ['Bikerental'=>$Bikerental,'Bikereturn'=>$Bikereturn,'Bikereturn1'=>$Bikereturn1,'Bikereturn2'=>$Bikereturn2]);
        return @$pdf->stream();
    } 

    public function __construct()
{
    set_time_limit(8000000);
}
 
}
