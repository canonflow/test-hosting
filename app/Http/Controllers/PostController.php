<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() {
        $posts = Auth::user()->posts()->get();

        return view('posts', compact('posts'));
    }

    public function store(Request $request) {
        $request->validate([
            'post' => ['required', 'file', 'max:100000', 'mimes:jpeg,jpg,png']
        ]);

        // $post = $request->file('post');
        // // dd($post);
        // $path = $post->storeAs(
        //     'public/test',"" . time() . '.png', ['disks' => 'public']
        // );
        // dd($path);
        $user = Auth::user();

        $post = new Post;
        $post->user_id = $user->id;
        $fileName = time() . '.png';
        $request->file('post')->storeAs(
            'public/posts/'. $user->name, $fileName, ['disks' => 'public']
        );
        $post->url = "storage/posts/" . $user->name . "/" . $fileName;
        $post->save();

        return back()->with('success', 'Berhasil menyimpan post!');
    }
}
