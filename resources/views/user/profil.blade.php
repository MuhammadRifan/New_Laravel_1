@extends('layouts.layout')

@section('title')
    @if (session('level') == 0)
        Admin Panel
    @else
        {{ session('nama') }}'s, Profil Panel
    @endif
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container">
        <dl class="dl-horizontal">
            <dt>First Name</dt>
                <dd>{{ $data->name }}</dd>
            <dt>Last Name</dt>
                <dd>{{ $data->lname }}</dd>
            <dt>Email</dt>
                <dd>{{ $data->email }}</dd>
        </dl>

        <a href="/cprofile/{{ $data->id }}" class="btn btn-info btn-sm">Change Your Profile</a>
        <a href="/cpass/{{ $data->id }}" class="btn btn-info btn-sm">Change Your Password</a>
    </div>
    <hr>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                @if (session('level') == 0)
                    @if (url()->current() == url('/profil-user'))
                        <a href="/profil-blog" class="btn btn-info btn-sm">Blog List</a>
                        <a href="/profil-user" class="btn btn-warning btn-sm active">User List</a>
                        <a href="/tag-list" class="btn btn-info btn-sm">Tag List</a>
                        <a href="/add-user" class="btn btn-info btn-sm">Add New User</a>
                    @elseif (url()->current() == url('/tag-list'))
                        <a href="/profil-blog" class="btn btn-info btn-sm">Blog List</a>
                        <a href="/profil-user" class="btn btn-info btn-sm">User List</a>
                        <a href="/tag-list" class="btn btn-warning btn-sm active">Tag List</a>
                        <a href="/addtag" class="btn btn-info btn-sm">Add New Tag</a>
                    @else
                        <a href="/profil-blog" class="btn btn-warning btn-sm active">Blog List</a>
                        <a href="/profil-user" class="btn btn-info btn-sm">User List</a>
                        <a href="/tag-list" class="btn btn-info btn-sm">Tag List</a>
                        <a href="/tambah" class="btn btn-info btn-sm">Create a blog</a>
                    @endif
                @else
                    <a href="/tambah" class="btn btn-info btn-sm">Create a blog</a>
                @endif
            </div>

            <div class="panel-body">
                @if (session('level') == 0)
                    @if (url()->current() == url('/profil-user'))
                        This is the whole user
                    @else
                        This is the whole blog
                    @endif
                @else
                    This is your blogs
                @endif
            </div>

            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        @if(url()->current() == url('/profil-user') && session('level') == 0)
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Action</th>
                        @elseif (url()->current() == url('/tag-list') && session('level') == 0)
                            <th class="text-center">Tag Name</th>
                            <th class="text-center">Action</th>
                        @else
                            <th class="text-center">Title</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Updated at</th>
                            <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    <?php $x = 1; ?>
                    @if (session('level') == 1)
                        @foreach ($blogs as $blog)
                            @if ($blog->author == $data->id)
                                <tr>
                                  <td>{{ $x++ }}</td>
                                  <td><a href="/{{ $blog->id }}">{{ $blog->judul }}</a></td>
                                  <td>{{ $blog->created_at }}</td>
                                  <td>{{ $blog->updated_at }}</td>
                                  <td>
                                    <a href="/{{ $blog->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    @if ($blog->tags == 0)
                                        <a href="/{{ $blog->id }}/tags" class="btn btn-warning btn-sm">Add Tags</a>
                                    @else
                                        <a href="/{{ $blog->id }}/deltag" class="btn btn-danger btn-sm">Delete Tag</a>
                                    @endif
                                    <a href="/{{ $blog->id }}/hapus" class="btn btn-danger btn-sm">Delete</a>
                                  </td>
                                </tr>
                            @endif
                        @endforeach
                    @elseif (session('level') == 0)
                        @if (url()->current() == url('/profil-user'))
                            @foreach ($users as $user)
                                @if ($user->id != session('id'))
                                    <tr>
                                        <td>{{ $x++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if ($user->lname == '')
                                                -
                                            @else
                                                {{ $user->lname }}
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <a href="/cprofile/{{ $user->id }}" class="btn btn-warning btn-sm">Edit Profile</a>
                                            <a href="/cpass/{{ $user->id }}" class="btn btn-warning btn-sm">Change Password</a>

                                            @if ($user->level == 0)
                                                <a href="/delprofile/{{ $user->id }}" class="btn btn-danger btn-sm disabled">Delete</a>
                                            @else
                                                <a href="/delprofile/{{ $user->id }}" class="btn btn-danger btn-sm">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @elseif (url()->current() == url('tag-list'))
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $x++ }}</td>
                                    <td>{{ $tag->tag }}</td>
                                    <td>
                                        <a href="/edit-tag/{{ $tag->id }}" class="btn btn-warning btn-sm">Edit Tag</a>
                                        <a href="/delete-tag/{{ $tag->id }}" class="btn btn-danger btn-sm">Delete Tag</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $x++ }}</td>
                                    <td><a href="/{{ $blog->id }}">{{ $blog->judul }}</a></td>
                                    <td>{{ $blog->created_at }}</td>
                                    <td>{{ $blog->updated_at }}</td>
                                    <td>
                                        <a href="/{{ $blog->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                        @if ($blog->tags == 0)
                                            <a href="/{{ $blog->id }}/tags" class="btn btn-warning btn-sm">Add Tags</a>
                                        @else
                                            <a href="/{{ $blog->id }}/deltag" class="btn btn-danger btn-sm">Delete Tag</a>
                                        @endif
                                        <a href="/{{ $blog->id }}/hapus" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                  </tbody>
            </table>
        </div>
    </div>
@endsection
