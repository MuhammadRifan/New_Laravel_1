@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/reg" method="post">
        <div class="form-group">
            <label>Nama</label><br>
            <input type="text" name="nama" class="form-control" autofocus>
        </div>

        <div class="form-group">
            <label>Email</label><br>
            <input type="text" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label>Password</label><br>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label>Confirm Password</label><br>
            <input type="password" name="confirmPassword" class="form-control">
        </div>

        <input type="submit" name="submit" value="Register" class="btn btn-primary">

        <!-- Harus ada bro -->
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
        <!-- Harus ada bro -->
    </form>
@endsection
