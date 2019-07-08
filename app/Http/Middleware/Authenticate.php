<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {       
            //return "/login"; //ทำให้หน้า ต้อง login ก่อนถึงจะเข้าได้       
        if (! $request->expectsJson()) {
            return route('login');  // ทำให้ถ้าเข้าหน้าที่ต้องlogin จะขึ้น 404 / 403
        }
    }
}
