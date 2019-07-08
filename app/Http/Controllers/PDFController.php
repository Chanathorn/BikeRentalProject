<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Bikerental;
use App\Bike;
use App\Bikereturn;
use App\User;
use PDF;
use \Milon\Barcode\DNS2D;



class PDFController extends Controller
{

    public function pdf($id){
        $Member = Member::find($id);
        $user = User::find($Member->employee_id);
      //  $pdfqr = new DNS2D();
       // $pdfqr->setStorPath(__DIR__."/cache/");
       // echo $pdfqr->getBarcodeHTML("1234555","QRCODE",3,3);
        //dd($pdfqr);
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
    public function pdfreturndisppear($id){
        $Bikereturn = Bikereturn::find($id);
        //dd($Bikerental->member_id);
        $Bikerental = Bikerental::find($Bikereturn->rental_id);
        $Bikereturn1 = Member::find($Bikereturn->member_id);
        $Bikereturn2 = Bike::find($Bikereturn->bike_id);
        //dd($Bikerental1);
        $pdf = PDF::loadView('pdf.pdfDis', ['Bikerental'=>$Bikerental,'Bikereturn'=>$Bikereturn,'Bikereturn1'=>$Bikereturn1,'Bikereturn2'=>$Bikereturn2]);
        return @$pdf->stream();
    }

    public function __construct()
{
    set_time_limit(8000000);
}
 
   /* public function pdf($id) {
        $PDF=Member::find($id);
        //dd($PDF);
        $view=\View::make('pdf.pdf',compact('PDF'));
        $html=$view->render();
        $pdf=new PDF();
        $pdf::SetTitle('บัตรสมาชิก');
        $pdf::Addpage();
        $pdf::SetFont('freeserif');
        $pdf::WriteHTML($html,true,false,true,false);
        $pdf::Output('report.pdf');
    }

    public function pdfrental($id) {
        $PDF=Member::find($id);
        //dd($PDF);
        $view=\View::make('pdf.pdfrental',compact('PDF'));
        $html=$view->render();
        $pdf=new PDF();
        $pdf::SetTitle('บัตรสมาชิก');
        $pdf::Addpage();
        $pdf::SetFont('freeserif');
        $pdf::WriteHTML($html,true,false,true,false);
        $pdf::Output('report.pdf');
    }

    public function pdfreturn($id) {
        $PDF=Member::find($id);
        //dd($PDF);
        $view=\View::make('pdf.pdfreturn',compact('PDF'));
        $html=$view->render();
        $pdf=new PDF();
        $pdf::SetTitle('บัตรสมาชิก');
        $pdf::Addpage();
        $pdf::SetFont('freeserif');
        $pdf::WriteHTML($html,true,false,true,false);
        $pdf::Output('report.pdf');
    } */

 /*//Routes  (web.php in case laravel version >= 5.4)
Route::get('/pdf', 'PdfController@pdfStream')->name('pdfStream');

//PdfController.php
public function pdfStream(Request $request){
   $data["info"] = "I is usefull!";
   $pdf = PDF::loadView('whateveryourviewname', $data);
   return $pdf->stream('whateveryourviewname.pdf');
} 


//yourViewPage.blade.php
<a href="{{route("pdfStream")}}" target="_blank" > click me to pdf </a>*/
}
