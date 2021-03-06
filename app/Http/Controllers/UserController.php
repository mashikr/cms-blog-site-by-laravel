<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() {
        $user = User::where('email', session('user_email'))->first();

        $stat['posts_count'] = Post::where('user_id', session('user_id'))->count();
        if (session('role') == 'admin') {
            $stat['own_posts_count'] = $stat['posts_count'];
            $stat['posts_count'] = Post::all()->count();
            $stat['users_count'] = User::where('role_id', 2)->count();
        }
        $stat['comments_count'] = Comment::where('user_id', session('user_id'))->count();
        $stat['categories_count'] = Comment::all()->count();
        
        return view('User.index', ['user' => $user, 'stat' => $stat]);
    }

    public function profile() {
        $user = User::where('email', session('user_email'))->first();
        
        return view('User.profile', ['user' => $user]);
    }

    public function updatename(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:2555'
        ]);

        if ($validator->fails()) {
            return redirect('/user/profile')
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('email', session('user_email'))->update(['name' => $request->name]);
        session(['name' => $request->name]);
        return redirect('/user/profile');
    }

    public function updatepassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'required|min:6|same:new_password'
        ]);

        if ($validator->fails()) {
            return redirect('/user/profile')
                        ->withErrors($validator);
        }

        $user = User::where('email', session('user_email'))->first();
        if (Hash::check($request->password, $user->password)) {
            $user->update(['password' => Hash::make($request->new_password)]);
            return redirect('/user/profile')->with('updatepassword', 'success | password updated.');
        }

        return redirect('/user/profile')
                    ->withErrors(['password' => 'Password wrong!']);
    }

    public function updateimage(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect('/user/profile')
                        ->withErrors($validator);
        }

        $file=$request->file('image');
        $file_name = time(). "_" . $file->getClientOriginalName();
        $file->move(public_path() . '/image', $file_name);
        
        $user = User::where('email', session('user_email'))->first();
        if ($user->photo_id != 1) {
            unlink(public_path() . '/image/' . $user->photo->file_name);
            Photo::find($user->photo_id)->delete();
        }
        
        $photo = Photo::create(['file_name' => $file_name]);
        User::where('email', session('user_email'))->update(['photo_id' => $photo->id]);
        return redirect('/user/profile');
    }

    public function show() {
        $users = User::where('role_id', 2)->paginate(5);
        return view('User.show', compact('users'));
    }

    public function comments() {
        $comments = Comment::where('user_id', session('user_id'))->orderBy('id', 'desc')->paginate(10);
        return view('User.comments', compact('comments'));
    }
}
