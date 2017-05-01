<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Database
use Illuminate\Support\Facades\Hash; // Hashing
use Illuminate\Routing\UrlGenerator; // URL

use App\Models\User;
use App\Models\Blog;
use App\Models\Tag;

class UserController extends Controller
{
    public function login()
    {
        return view('blog/login');
    }

    public function register()
    {
        return view('blog/register');
    }

    public function reg(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:password'
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 1
        ]);

        return redirect('/login');
    }

    public function log(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $users = DB::table('users')->where(
            'email', $request->email)
            ->get();

        if (count($users) > 0) {
            foreach ($users as $row) {
                if (Hash::check($request->password, $row->password)) {
                    session(['id' => $row->id,
                        'nama' => $row->name,
                        'level' => $row->level]);
                    return redirect('/');
                } else {
                    return redirect('/login')->with([
                        'status' => 'Maaf, Email atau Password yang anda masukkan salah',
                        'email' => $request->email
                    ]);
                }
            }
        } else {
            return redirect('/login')->with([
                'status' => 'Maaf, Email atau Password yang anda masukkan salah',
                'email' => $request->email
            ]);
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function profil()
    {
        $data = User::find(session('id'));

        $blogs = DB::table('tbl_blog')
            ->orderBy('updated_at', 'desc')
            ->get();

        $users = User::all();

        $tags = Tag::all();

        if (session('id')) {
            return view('user/profil', ['data' => $data, 'blogs' => $blogs, 'users' => $users, 'tags' => $tags]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function cprofile($id)
    {
        $data = User::find($id);

        if (session('id')) {
            return view('user/cprofile', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function cpass($id)
    {
        $data = User::find($id);

        if (session('id')) {
            return view('user/cpassword', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function cprof(Request $request, $id)
    {
        if ($request->lname == '') {
            $val = '';
        } else {
            $val = 'min:5';
        }

        if ($request->email != $request->prevemail) {
            $this->validate($request, [
                'name' => 'required|min:5',
                'email' => 'required|email|unique:users,email',
                'lname' => $val
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required|min:5',
                'email' => 'required|email',
                'lname' => $val
            ]);
        }

        User::find($id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'lname' => $request->lname,
                'level' => $request->level
        ]);

        if (session('id') == $id) {
            session(['nama' => $request->name]);
        }

        return redirect('/profil-user')->with([
            'status' => 'Profil has been updated',
        ]);
    }

    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ]);

        if (Hash::check($request->oldPassword, $request->passDatabase)) { //Hash::check('Baru', 'Lama')
            User::find($id)
                ->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return redirect('/profil-user')->with([
                'status' => 'The password has been changed'
            ]);
        } else {
            return redirect('/cpass/'.$id.'')->with([
                'status' => 'The old password didn\'t match with our database'
            ]);
        }
    }

    public function delete($id)
    {
        $data = User::find($id);

        if (session('level') == 0 && session()->has('id')) {
            return view('user/delete', ['data' => $data]);
        } else {
            abort(401, 'You must login first');
        }
    }

    public function del(Request $request, $id)
    {
        if ($request->submit == "Yes") {
            User::destroy($id);

            return redirect('/profil-user')->with([
                'status' => 'User has been deleted'
            ]);
        } else {
            return redirect('/profil');
        }
    }

    public function addUser()
    {
      if (session('level') == 0 && session()->has('id')) {
          return view('user/add');
      } else {
          abort(401, 'You must login first');
      }
    }

    public function add(Request $request)
    {
        if ($request->lname == '') {
            $val = '';
        } else {
            $val = 'min:5';
        }

        $this->validate($request, [
            'name' => 'required|min:5',
            'lname' => $val,
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:password'
        ]);

        User::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level
        ]);

        return redirect('/profil-user')->with([
            'status' => 'User has been added'
        ]);
    }
}
