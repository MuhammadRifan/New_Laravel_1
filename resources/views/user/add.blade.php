@extends('layouts.layout')

@section('title', 'Add New User')

@section('content')
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
    <br><br>

    <form action="/adduser" method="post">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="name" class="form-control" autofocus>
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control">
        </div>

        <div class="form-group">
            <label>Choose Level</label>
            <select name="level" class="form-control">
                  <option value="1">Member</option>
                  <option value="0">Admin</option>
            </select>
        </div>

        <input type="submit" name="submit" value="Add" class="btn btn-primary">

        <!-- Harus ada bro -->
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
        <!-- Harus ada bro -->
    </form>
@endsection
