<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::orderBy('id', 'desc')->paginate(10); 
        $categories = Category::orderBy('id', 'desc')->get();

        return view('home', compact('posts', 'categories'));
    }
    
    public function allpost()
    {
        if (session()->get('role') == 'admin') {
            $posts = Post::orderBy('id', 'desc')->paginate(5); 
        } else {
            $posts = Post::where('user_id', session()->get('user_id'))->orderBy('id', 'desc')->paginate(5);
        }

        return view('Post.all', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('category', 'id')->all();
        return view('Post.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2000',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/user/addpost')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $file_name = time(). "_" . $file->getClientOriginalName();
            $file->move(public_path() . '/image', $file_name);
            
            $photo = Photo::create(['file_name' => $file_name]);
            $request['photo_id'] = $photo->id;
        } else {
            $request['photo_id'] = null;
        }

        Post::create([
            'user_id' => session()->get('user_id'),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'photo_id' => $request->photo_id,
            'slug' => Str::of($request->title)->slug('-')
        ]);

        if (session()->get('role') == 'admin') {
            return redirect('/user/ownpost');
        } else {
            return redirect('/user/allpost');
        }
    }

    public function ownpost() {
        $posts = Post::where('user_id', session()->get('user_id'))->orderBy('id', 'desc')->paginate(5);
        return view('Post.own', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (session()->get('user_id') == $post->user_id) {
            $categories = Category::pluck('category', 'id')->all();
            return view('Post.edit', compact('post', 'categories'));
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2000',
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/user/editpost/' . $post->slug)
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $file_name = time(). "_" . $file->getClientOriginalName();
            $file->move(public_path() . '/image', $file_name);
            
            if ($post->photo_id) {
                unlink(public_path() . '/image/' . $post->photo->file_name);
                Photo::find($post->photo_id)->delete();
            }

            $photo = Photo::create(['file_name' => $file_name]);
            $post->photo_id = $photo->id;
        }

        $post->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'photo_id' => $post->photo_id
        ]);

        if (session()->get('role') == 'admin') {
            return redirect('/user/ownpost');
        }
        return redirect('/user/allpost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if (session()->get('role') == 'admin' || session()->get('user_id') == $post->user_id) {
            if ($post->photo_id) {
                unlink(public_path() . '/image/' . $post->photo->file_name);
                Photo::find($post->photo_id)->delete();
            }
            $post->forceDelete();
        }

        return redirect()->back();
    }

    public function delete(Post $post)
    {
       if (session()->get('role') == 'admin' || session()->get('user_id') == $post->user_id) {
           $post->delete();
       }

       return redirect()->back();
    }

    public function trash() {
        if (session()->get('role') == 'admin') {
            $posts = Post::onlyTrashed()->orderBy('id', 'desc')->paginate(5);
        } else {
            $posts = Post::onlyTrashed()->where('user_id', session()->get('user_id'))->orderBy('id', 'desc')->paginate(5);
        }

        return view('Post.trash', compact('posts'));
    }

    public function restore($id) {
        $post = Post::withTrashed()->where('id', $id)->first();
        if (session()->get('role') == 'admin' || session()->get('user_id') == $post->user_id) {
            $post->restore();
        }

        return redirect()->back();
    }
}
