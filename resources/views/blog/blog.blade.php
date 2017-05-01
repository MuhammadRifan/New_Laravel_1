@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1 class="text-center">{{ $data->judul }}</h1>
        <br>

        <p>{!! nl2br($data->isi) !!}</p>
        <br>

        <dl>
          <dt>Tags</dt>
          <dd>
            <ul class="list-inline">
              @foreach ($tags as $tag)
                @if ($tag->id == $data->tags)
                    <li><span class="glyphicon glyphicon-tags"></span> &nbsp;{{ $tag->tag }}</li>
                @endif
              @endforeach
            </ul>
          </dd>
        </dl>

        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>
@endsection
