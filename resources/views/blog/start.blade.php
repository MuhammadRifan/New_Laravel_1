@extends('layouts.layout')

@section('content')
    <div class="container">
        <br>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <a href="/tambah" class="btn btn-info">Tambah Blog Baru</a>
            </div>
            
            <div class="panel-body">
                <?php $x = 1; ?>
                @foreach ($data as $row)
                    <h4><a href="/{{ $row->id }}">{{ $x++ }}.&nbsp;{{ $row->judul }}</a></h4>
                    {{ substr($row->isi, 0, 200) }} ...

                    <a href="/{{ $row->id }}">Baca seterusnya</a><br><br>

                    <a href="/{{ $row->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/{{ $row->id }}/hapus" class="btn btn-sm btn-danger">Hapus</a>
                    <br><br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
