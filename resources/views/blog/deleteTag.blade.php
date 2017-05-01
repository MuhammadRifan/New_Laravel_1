@extends('layouts.layout')

@section('content')
    <div class="container">
        <form action="/tag-delete/{{ $data->id }}" method="post" class="form-inline">
            Are you sure to delete this "{{ $data->tag }}" tag ?
            <hr>

            <div class="form-group">
                <input type="submit" name="submit" value="Yes" class="form-control btn btn-danger">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="No" class="form-control btn btn-warning">
            </div>

            <!-- Harus ada bro -->
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="POST">
            <!-- Harus ada bro -->
        </form>
    </div>
@endsection
