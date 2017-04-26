@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ $data->judul }}</h1>
        <br>

        <p>{!! nl2br($data->isi) !!}</p>
        <br>

        <a href="/" class="btn btn-primary">Back to Home</a>
    </div>
@endsection
