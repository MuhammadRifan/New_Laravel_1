@extends('layouts.layout')

@section('title', 'Tags')

@section('content')
    <div class="container">
      <a href="/profil" class="btn btn-info">Back</a>
      <br><br>
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
      <form action="/tag/{{ $data->id }}" method="post" class="form-horizontal">
          <div class="form-group">
              <label class="col-sm-2 control-label">Choose Tags</label>
              <div class="col-sm-10">
                <select name="tag" class="form-control">
                    <option value="empty">-- Tags --</option>
                    @foreach ($tags as $tag)
                      <option value="{{ $tag->id }}"> {{ $tag->tag }}</option>
                    @endforeach
                </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" value="Add Tags" class="btn btn-primary">
            </div>
          </div>

          <!-- Harus ada bro -->
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="POST">
          <!-- Harus ada bro -->
      </form>
    </div>
@endsection
