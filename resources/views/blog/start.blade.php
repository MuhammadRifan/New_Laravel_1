@extends('layouts.layout')

@section('title', 'Homepage')

@section('content')
    <div class="jumbotron">
        <p class="lead">
            @if (session('nama'))
                Welcome Back, {{ session('nama') }}
            @else
                Hello, Welcome to Our Blog
            @endif
        </p>
    </div>

    <div class="row marketing">
        <div class="col-md-9">
            @foreach ($data as $row)
                @foreach ($users as $user)
                    @if ($user->id == $row->author)
                        <h4><a href="/{{ $row->id }}">{{ $row->judul }}</a></h4>
                        <p style="font-size: 0.85em">
                            @if ($user->level == 0)
                                <span class="label label-danger">{{ $user->name }}</span>
                            @else
                                <span class="label label-success">{{ $user->name }}</span>
                            @endif

                            @if ($row->updated_at == '')
                                <span style="color: #999;">&nbsp;{{ $row->created_at }}</span>
                            @else
                                <span style="color: #999;">&nbsp;{{ $row->updated_at }}</span>
                            @endif
                        </p>
                        <p>{{ str_limit($row->isi, 150) }}</p>
                    @endif
                @endforeach
            @endforeach
        </div>
        <div class="col-md-3">
          @if (session('nama'))
              <h4>Tags</h4>
              @if (url()->current() != url(''))
                  <p><a href="/">Clear</a></p>
              @endif
              @foreach ($tags as $tag)
                    <p><a href="/tags/{{ $tag->id }}">{{ $tag->tag }}</a></p>
              @endforeach
          @endif
        </div>
    </div>
@endsection
