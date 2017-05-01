@extends('layouts.layout')

@section('title', 'Create a Blog')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        <br><br>
        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red; list-style:none;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="/add" method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="name" name="judul" class="form-control" autofocus>
            </div>

            <div class="form-group">
                <label>Content Blog</label>
                <textarea type="text" name="isi" rows="25" cols="150" style="resize: vertical;" class="form-control"></textarea>
            </div>

            <input type="submit" name="submit" value="Tambah" class="btn btn-primary">

            <!-- Harus ada bro -->
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="POST">
            <!-- Harus ada bro -->
        </form>
    </div>
@endsection
