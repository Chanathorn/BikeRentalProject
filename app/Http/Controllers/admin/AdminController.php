<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller

{  
    public function index()
    {  
        return view('admin/dashboard');
    }
}
