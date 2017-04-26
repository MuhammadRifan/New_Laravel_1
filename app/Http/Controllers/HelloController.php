<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Blog;

class HelloController extends Controller
{
    public function index()
    {
        $data = Blog::all();

        return view('blog/start', ['data' => $data]);
    }

    public function show($id)
    {
        $data = Blog::find($id);

        return view('blog/blog', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Blog::find($id);

        return view('blog/edit', ['data' => $data]);
    }

    public function tambah()
    {
        return view('blog/tambah');
    }

    public function update(Request $request, $id)
    {
        Blog::find($id)
            ->update([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        $data = Blog::find($id);

        return view('blog/blog', ['data' => $data]);
    }

    public function add(Request $request)
    {
        Blog::create([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        $data = DB::table('tbl_blog')->get();

        return view('blog/start', ['data' => $data]);
    }

    public function hapus($id)
    {
        $data = Blog::find($id);

        return view('blog/hapus', ['data' => $data]);
    }

    public function delete(Request $request, $id)
    {
      if ($request->submit == "Ya") {
          Blog::destroy($id);

          return redirect('/');
      } else {
          $data = Blog::find($id);

          return view('blog/blog', ['data' => $data]);
      }
    }
}
