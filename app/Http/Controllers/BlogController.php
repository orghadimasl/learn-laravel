<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogController extends Controller
{
    public function index(Request $request)
    {

        
        $title = $request->title;
        // Query Builder
        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('created_at', 'desc')->paginate(10);
        // dd($blogs);
        

        // Elequent ORM
        $blogs = Blog::where('title', 'LIKE', '%' . $title . '%')->orderBy('created_at', 'desc')->paginate(10);
        return view('blog', ['blogs' => $blogs, 'title' => $title]);

    }

    public function create()
    {
        return view('/blogs/create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:blogs|max:20',
            'description' => 'required',
            'status' => 'required'
        ]);
        
        // Query Builder
        // $data = DB::table('blogs')->insert([
        //     'title' => $request->title,
        //     'descripsi' => $request->description,
        //     'status' => $request->status,
        //     'user_id' => fake()->numberBetween(307, 406),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // Elequent ORM
        $id_min = User::pluck('id')->min();
        $id_max = User::pluck('id')->max();
        $data = Blog::create([
            'title' => $request->title,
            'descripsi' => $request->description,
            'status' => $request->status,
            'user_id' => fake()->numberBetween($id_min, $id_max)
        ]);

        if (!$data) {
            return redirect()->route('blog.index')->with('error', 'Blog tidak berhasil di input');
        }

        return redirect()->route('blog.index')->with('success', 'New Blog berhasil di input');
    }

    public function show($id)
    {
        // Query Builder
        // $blog = DB::table('blogs')->where('id', $id)->first();

        // Elequent ORM
        $blog = Blog::findOrFail($id);
        // if (!$blog) {
        //     abort(404);
        // }
        return view('/blogs/detail', ['blog' => $blog]);
    }

    public function edit($id)
    {
        // Query Builder
        // $blog = DB::table('blogs')->where('id', $id)->first();

        // Elequent ORM
        $blog = Blog::findOrFail($id);
        return view('/blogs/edit', ['blog' => $blog]);
    }

    public function update($id, Request $request) 
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' .$id. '|max:255',
            'description' => 'required',
            'status' => 'required'
        ]);

        // DB::table('blogs')->where('id', $id)->update([
        //     'title' => $request->title,
        //     'descripsi' => $request->description,
        //     'status' => $request->status,
        //     'user_id' => fake()->numberBetween(307, 406),
        //     'updated_at' => now()
        // ]);

        $blog = Blog::findOrFail($id);
        $blog->update();

        $id_min = User::pluck('id')->min();
        $id_max = User::pluck('id')->max();
        $data = Blog::create([
            'title' => $request->title,
            'descripsi' => $request->description,
            'status' => $request->status,
            'user_id' => fake()->numberBetween($id_min, $id_max)
        ]);
        return redirect()->route('blog.index')->with('success', 'Data berhasil di edit');
    }

    public function delete($id)
    {
        // $blog = DB::table('blogs')->where('id', $id)->delete();
        $blog = Blog::destroy($id);

        if(!$blog) {
            return redirect()->route('blog.index')->with('failed', 'Blog tidak berhasil di hapus');
        }
            return redirect()->route('blog.index')->with('success', 'Blog berhasil di hapus');
        
    }

    public function trash()
    {
        $blogs = Blog::onlyTrashed()->get();
        return view('blogs.restore', ['blogs' => $blogs]);
    }

    public function restore($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id)->restore();
        
        return redirect()->route('blog.index')->with('success', 'Blog berhasil di restore');
    }

    public function homepage()
    {
        $blogs = Blog::with('user')->where('status', 'Active')->orderBy('created_at', 'desc')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function detail($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blogs.show', compact('blog'));
    }
}
