<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WpUsers;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (count(WpUsers::where('user_email', $request->input('email'))->get()) && count(WpUsers::where('user_pass', $request->input('password'))->get())) {
            Session::put('user_email', $request->input('email'));
            return redirect()->route('posts.index');
        }else {
            dd('---------------------------------------');
        }
    }
}