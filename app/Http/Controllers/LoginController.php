<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;
use App\Models\User;

class LoginController extends Controller
{
    public function index() {
        return view('Login.index');
    }

    public function login(Request $request) {
        $user = User::where(['email' => $request->email, 'active' => true])->first();

        if (Hash::check($request->password, $user->password)) {
           session(['user_email' => $request->email, 'role' => $user->role->name, 'name' => $user->name]);
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
