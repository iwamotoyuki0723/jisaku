<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Product;
use App\Inventory;
use App\Store;
use App\Arrivalplan;

use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home'); // ログイン後のリダイレクト先を指定
        } else {
            return redirect('/login');
        }
    }
}
