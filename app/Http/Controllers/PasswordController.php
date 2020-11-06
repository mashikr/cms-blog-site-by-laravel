<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Password_reset;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    public function sendmail(Request $request) {
        $id = User::where(['email' => $request->email, 'active' => true])->value('id');
        
        if ($id) {
            $token = Str::random(128);

            Password_reset::insert([
                'email' => $request->email,
                'token' => $token
            ]);

            Mail::to($request->email)->send(new ResetPassword($token));

            return redirect('sendmail');
        }

        return redirect('resetmail')
                ->withErrors(['error' => 'This email doesn\'t exists'])
                ->withInput();
    }

    public function resetpassword($token) {
        $email = Password_reset::where('token', $token)->value('email');

        if ($email) {
            return view('Password.reset', ['email' => $email, 'code' => $token]);
        }

        return view('Password.invalid');
    }

    public function setPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        if ($validator->fails()) {
            return redirect('resetpassword/'. $request->code)
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        Password_reset::where(['email' => $request->email])->delete();

        return redirect('resetpassword');
    }
}
