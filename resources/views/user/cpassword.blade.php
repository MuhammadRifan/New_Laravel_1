@extends('layouts.layout')

@section('title', 'Change Password')

@section('content')
    <ul>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @elseif (session('status'))
            <li>{{ session('status') }}</li>
        @endif
    </ul>

    <form action="/password/{{ $data->id }}" method="post">
        <input type="hidden" name="passDatabase" class="form-control" value="{{ $data->password }}">

        <div class="form-group">
            <label>Old Password</label><br>
            <input type="password" name="oldPassword" class="form-control">
        </div>

        <div class="form-group">
            <label>New Password</label><br>
            <input type="password" name="newPassword" class="form-control">
        </div>

        <div class="form-group">
            <label>Confirm New Password</label><br>
            <input type="password" name="confirmPassword" class="form-control">
        </div>

        <input type="submit" name="submit" value="Change Password" class="btn btn-primary">

        <!-- Harus ada bro -->
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="POST">
        <!-- Harus ada bro -->
    </form>
@endsection
