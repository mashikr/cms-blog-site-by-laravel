<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\AccountActivation;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    public function index() {
        return view('Register.index');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_active_hash' => $request->_token
        ]);

        Mail::to($user->email)->send(new AccountActivation($user->account_active_hash));

        return redirect('/register/success');
    }

    public function activation($token) {
        $user = User::where('account_active_hash', $token)->update(['active' => 1, 'account_active_hash' => 1]);

        return redirect('/register/active');
    }
}
