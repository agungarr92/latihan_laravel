@extends('adminlte::page')

@section('title', 'Pengelolaan Buku')

@section('content_header')
    <h1>Pengelolaan Buku</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan Buku')}}</div>
                    <div class="card-body">
                        <button class=""></button>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>JUDUL</th>
                                    <th>PENULIS</th>
                                    <th>TAHUN</th>
                                    <th>PENERBIT</th>
                                    <th>COVER</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $book->judul }}</td>
                                        <td>{{ $book->penulis }}</td>
                                        <td>{{ $book->tahun }}</td>
                                        <td>{{ $book->penerbit }}</td>
                                        <td>
                                            @if($book->cover !== null)
                                                <img src="{{asset'(storage/cover_buku/'.$book->cover) }}" width="100px"/>
                                                @else
                                                    [Gambar tidak tersedia]
                                                @endif
                                                </td>
                                            <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
