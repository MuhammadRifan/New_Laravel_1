@extends('layouts.layout')

@section('title', 'Login')

@section('content')

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif

    <form action="/log" method="post">
        <div class="form-group">
            <label>Email</label><br>
            <input type="text" name="email" class="form-control" value="{{ session('email') }}" autofocus>
        </div>

        <div class="form-group">
            <label>Password</label><br>
            <input type="password" name="password" class="form-control">
        </div>

        <input type="submit" name="submit" value="Login" class="btn btn-primary">

        <!-- Harus ada bro -->
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
        <!-- Harus ada bro -->
    </form>
@endsection
