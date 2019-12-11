<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function loginForm()
    {
        return view('auth.login_form');
    }
}
