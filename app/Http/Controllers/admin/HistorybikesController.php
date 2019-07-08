<?php

namespace App\Http\Controllers\admin;

use App\Historybikes;
use App\Http\Controllers\Controller;


class HistorybikesController extends Controller
{
    public function index()
    {
        $details = Historybikes::orderBy('id','desc')->paginate(6);
        return view('admin\historybikes.index', compact('details'));
    }
}
