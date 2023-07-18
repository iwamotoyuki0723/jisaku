<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;

use Illuminate\Support\Facades\Auth;


class DisplayController extends Controller
{
    public function login() {
        return view('login');
    }

    public function index() {

        $users = Auth::user()->users()->get();

        

        return view('home');
    }
}
