<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function users() {
        $users = User::orderBy('id', 'desc')
            ->get();
        return view('admin.users',['users' => $users]);
    }
}
