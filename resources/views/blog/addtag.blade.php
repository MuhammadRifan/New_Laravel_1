@extends('layouts.layout')

@section('title', 'Add New Tag')

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

        <form action="/newtag" method="post" class="form-horizontal">
          <div class="form-group">
              <label class="col-sm-2 control-label">New Tag</label>
              <div class="col-sm-10">
                <input type="text" name="tag" class="form-control" autofocus>
              </div>
          </div>

          <div class="col-sm-2"></div>

            <input type="submit" name="submit" value="Add New" class="btn btn-primary">

            <!-- Harus ada bro -->
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="POST">
            <!-- Harus ada bro -->
        </form>
    </div>
@endsection
