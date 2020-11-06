<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller
{
    public function index() {
        return view('Login.index');
    }

    public function login(Request $request) {
        $password = DB::table('users')->where(['email' => $request->email, 'active' => true])->value('password');

        if (Hash::check($request->password, $password)) {
        //    if(isset($request->remember_me)) {
        //         $expire_timestamp = time() + 60 * 60 * 24 * 30;
        //         setcookie('laravel_login_remember', $request->_token, $expire_timestamp, '/');

        //         DB::update('update users set remember_token = ? where email = ?', [$request->_token, $request->email]);
        //    }
           session(['user_email' => $request->email]);
           return redirect('user');
        }

        return redirect('login')
                    ->withErrors(['error' => 'Your credentials are wrong'])
                    ->withInput();
    }

    public function logout() {
        session()->flush();
        
        return redirect('/');
    }
}
