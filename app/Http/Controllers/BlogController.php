<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Models\Blog;
use App\Models\User;
use App\Models\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $data = DB::table('tbl_blog')
              ->orderBy('updated_at', 'desc')
              ->get();

        $tags = Tag::all();

        $users = User::all();

        return view('blog/start', ['data' => $data, 'users' => $users, 'tags' => $tags]);
    }

    public function FilterTags($id)
    {
        $data = DB::table('tbl_blog')
              ->where('tags', $id)
              ->orderBy('updated_at', 'desc')
              ->get();

        $tags = Tag::all();

        $users = User::all();

        return view('blog/start', ['data' => $data, 'users' => $users, 'tags' => $tags]);
    }

    public function show($id)
    {
        $data = Blog::find($id);

        $tags = Tag::all();

        return view('blog/blog', ['data' => $data, 'tags' => $tags]);
    }

    public function edit($id)
    {
        $data = Blog::find($id);

        if (session('level') == 0 || $data->author == session('id')) {
            return view('blog/edit', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function tambah()
    {
        if (session('nama')) {
            return view('blog/tambah');
        } else {
            abort(401, 'You must login first');
        }
    }

    public function update(Request $request, $id)
    {
        Blog::find($id)
            ->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);

        return redirect('/profil')->with([
            'status' => 'Blog has been updated'
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|unique:tbl_blog,judul',
            'isi' => 'required|alpha_dash'
        ]);

        Blog::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta'),
            'author' => session('id'),
            'tags' => 0
        ]);

        return redirect('/profil');
    }

    public function hapus($id)
    {
        $data = Blog::find($id);

        if (session('level') == 0 || $data->author == session('id')) {
            return view('blog/hapus', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function delete(Request $request, $id)
    {
      if ($request->submit == "Yes") {
          Blog::destroy($id);

          return redirect('/profil')->with([
              'status' => 'Blog has been deleted'
          ]);
      } else {
          return redirect('/profil');
      }
    }

    public function addtag()
    {
        if (session('level') == 0 && session()->has('nama')) {
            return view('blog/addtag');
        } else {
            abort(401, 'You must login first');
        }
    }

    public function tags($id)
    {
      $tags = Tag::all();
      $data = Blog::find($id);

      if (session()->has('level')) {
          return view('blog/tag', ['tags' => $tags, 'data' => $data]);
      } else {
          abort(401, 'You must login first');
      }
    }

    public function newtag(Request $request)
    {
      $this->validate($request, [
          'tag' => 'required|unique:tags,tag',
      ]);

      Tag::create([
        'tag' => $request->tag
      ]);

      return redirect('/tag-list')->with([
          'status' => 'Tag has been created'
      ]);
    }

    public function tag(Request $request, $id)
    {
      Blog::find($id)->update([
        'tags' => $request->tag,
        'updated_at' => Carbon::now('Asia/Jakarta')
      ]);

      return redirect('/profil')->with([
          'status' => 'Tag has been added'
      ]);
    }

    public function deltag($id)
    {
        Blog::find($id)->update([
          'tags' => 0,
          'updated_at' => Carbon::now('Asia/Jakarta'),
        ]);

        return redirect('/profil')->with([
            'status' => 'Tag has been deleted'
        ]);
    }

    public function editTag($id)
    {
        $data = Tag::find($id);

        if (session('level') == 0 && session()->has('nama')) {
            return view('blog/editTag', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function tagEdit(Request $request, $id)
    {
        Tag::find($id)
            ->update([
            'tag' => $request->tag
        ]);

        return redirect('/tag-list')->with([
            'status' => 'Tag has been updated'
        ]);
    }

    public function deleteTag($id)
    {
        $data = Tag::find($id);

        if (session('level') == 0 && session()->has('nama')) {
            return view('blog/deleteTag', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function tagDelete(Request $request, $id)
    {
      if ($request->submit == "Yes") {
          Tag::destroy($id);

          return redirect('/tag-list')->with([
              'status' => 'Tag has been deleted'
          ]);
      } else {
          return redirect('/tag-list');
      }
    }
}
