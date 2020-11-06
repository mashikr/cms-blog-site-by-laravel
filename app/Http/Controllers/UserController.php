<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $user = User::where('email', session('user_email'))->first();
        return view('User.index', ['user' => $user]);
    }
}
