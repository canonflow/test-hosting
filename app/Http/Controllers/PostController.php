<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PostController extends Controller
{
    public function index() {
        $posts = Auth::user()->posts()->get();

        return view('posts', compact('posts'));
    }

    public function store(Request $request) {
        $fileName = time() . '.' . $request->file('post')->getClientOriginalExtension();
        Gdrive::put($fileName, $request->file('post'));
        //return back()->with('success', 'Berhasil menyimpan post!');
        // dd(public_path('storage'), storage_path('app/storage'));
        //dd(__DIR__);
        // $request->validate([
        //     'post' => ['required', 'file', 'max:100000', 'mimes:jpeg,jpg,png']
        // ]);

        // $post = $request->file('post');
        // // dd($post);
        // $path = $post->storeAs(
        //     'public/test',"" . time() . '.png', ['disks' => 'public']
        // );
        // dd($path);
        $user = Auth::user();

        $post = new Post;
        $post->user_id = $user->id;
        $fileName = time() . '.' . $request->file('post')->getClientOriginalExtension();
        $request->file('post')->storeAs(
            'public/posts/'. $user->name, $fileName, ['disks' => 'public']
        );
        $post->url = "storage/posts/" . $user->name . "/" . $fileName;
        $post->save();

        // if (file_exists("../../../public/storage")) {
        //     rmdir("../../../public/storage");
        // }
        // $res = shell_exec("ls");
        // dd($res);

        // if (file_exists('storage')) {
        //     shell_exec('rm -rf storage');
        // }

        // \Illuminate\Support\Facades\Artisan::call('storage:link');
        // //shell_exec("ln -s ../storage/app/public storage/public");

        return back()->with('success', 'Berhasil menyimpan post!');
    }
}
