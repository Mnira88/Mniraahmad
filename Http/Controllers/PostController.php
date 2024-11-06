<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Manager;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{

    public function index()
    {
        $posts=Post::with('visitor','emotions')->orderByDesc('id')->get();
        return view('posts.index', compact('posts'));
    }

    public function newByManager()
    {
        $posts=Post::with('visitor','emotions')->where('hospital_id',session('user')->id)->where('is_new','1')->orderByDesc('id')->get();
        return view('posts.new', compact('posts'));
    }

    public function oldByManager()
    {
        $posts=Post::with('visitor','emotions')->where('hospital_id',session('user')->id)->where('is_new','0')->orderByDesc('id')->get();
        return view('posts.old', compact('posts'));
    }

    public function newbyVisitor()
    {
        $managers=Manager::orderByDesc('id')->get();
        $posts=Post::with('visitor','emotions')->where('visitor_id',session('user')->id)
                     ->where('is_new','1')->orderByDesc('id')->get();
        return view('posts.visitor_new', compact('posts','managers'));
    }

    public function oldbyVisitor()
    {
        $managers=Manager::orderByDesc('id')->get();
        $posts=Post::with('visitor','emotions')->where('visitor_id',session('user')->id)
                     ->where('is_new','0')->orderByDesc('id')->get();
        return view('posts.visitor_old', compact('posts','managers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
       // return "ok";
       $rules = [
        'visitor_id' => 'required',
        'hospital_id' => 'required',
        'content' => 'required',
        'traetment_date' => 'required',
        'department' => 'required',
    ];
    $validator = Validator::make($request->all(),$rules);
    if ($validator->fails()) {
        toastr()->error('Operation Failed');
        return redirect()->back()->withErrors($validator);
    }

    $input = $request->all();
    $input['is_new']='1';
    $post = Post::create($input);

    sleep(4);

    toastr()->success('Post Stored Successfully');
    return redirect()->back();

    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            // 'visitor_id' => 'required',
            // 'hospital_id' => 'required',
            'content' => 'required',
            'traetment_date' => 'required',
            'department' => 'required',
            // 'replay' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            toastr()->error('Operation Failed');
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();
        // return $request;
        if(session('user')->role_id==1)
            {
                $input['is_new']='1';
            }
        else
            {
                $input['is_new']='0';
            }

        // return "ok";
        $post = Post::findOrFail($id);
        // return $post;
        $post->update($input);

        toastr()->success('Post updated Successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->emotions()->delete();
        $post->delete();
        toastr()->success('Post Deleted Successfully');
        return redirect()->back();
    }
}
