<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $blogs = DB::table('blogs')->where('title', 'LIKE', '%' . $title . '%')->orderBy('created_at', 'desc')->paginate(10);
        // dd($blogs);
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
        $data = DB::table('blogs')->insert([
            'title' => $request->title,
            'descripsi' => $request->description,
            'status' => $request->status,
            'user_id' => fake()->numberBetween(307, 406),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$data) {
            return redirect()->route('blog.index')->with('error', 'Blog tidak berhasil di input');
        }

        return redirect()->route('blog.index')->with('success', 'New Blog berhasil di input');
    }

    public function show($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if (!$blog) {
            abort(404);
        }
        return view('/blogs/detail', ['blog' => $blog]);
    }

    public function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('/blogs/edit', ['blog' => $blog]);
    }

    public function update($id, Request $request) 
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' .$id. '|max:255',
            'description' => 'required',
            'status' => 'required'
        ]);

        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'descripsi' => $request->description,
            'status' => $request->status,
            'user_id' => fake()->numberBetween(307, 406),
            'updated_at' => now()
        ]);
        return redirect()->route('blog.index')->with('success', 'Data berhasil di edit');
    }

    public function delete($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->delete();

        if(!$blog) {
            return redirect()->route('blog.index')->with('failed', 'Blog tidak berhasil di hapus');
        }
            return redirect()->route('blog.index')->with('success', 'Blog berhasil di hapus');
        
    }
}
