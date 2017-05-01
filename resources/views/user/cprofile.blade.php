@extends('layouts.layout')

@section('title', 'Update Profil')

@section('content')
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/cprof/{{ $data->id }}" method="post" class="form-horizontal">
        <a href="{{ url()->previous() }}" class="btn btn-info btn-sm">Back</a>
        <br><br>

        <div class="form-group">
            <label class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="{{ $data->name }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" name="lname" class="form-control" value="{{ $data->lname }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="hidden" name="prevemail" class="form-control" value="{{ $data->email }}">
                <input type="text" name="email" class="form-control" value="{{ $data->email }}">
            </div>
        </div>

        @if (session('level') == 0)
            <div class="form-group">
                <label class="col-sm-2 control-label">Level</label>
                <div class="col-sm-10">
                    <select name="level" class="form-control">
                        @if ($data->level == 1)
                            <option value="1" selected>Member</option>
                            <option value="0">Admin</option>
                        @else
                            @if (session('id') != $data->id)
                                <option value="1" disabled>Member</option>
                                <option value="0" selected disabled>Admin</option>
                                <input type="hidden" name="level" class="form-control" value="{{ $data->level }}">
                            @else
                                <option value="1">Member</option>
                                <option value="0" selected>Admin</option>
                            @endif
                        @endif
                    </select>
                    @if ($data->level == 0 && (session('id') != $data->id))
                        <i style="color:red;">you can't demote another admin</i>
                    @endif
                </div>
            </div>
        @else
            <input type="hidden" name="level" class="form-control" value="{{ $data->level }}">
        @endif

        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </div>
        </div>

        <!-- Harus ada bro -->
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
        <!-- Harus ada bro -->
    </form>
@endsection
