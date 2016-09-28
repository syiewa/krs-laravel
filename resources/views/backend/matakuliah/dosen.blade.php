@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <th>Kode MataKuliah</th>
                            <th>Nama Matakuliah</th>
                            <th>Kode Dosen</th>
                            <th>NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Jadwal</th>
                        </thead>
                        <tbody>
                            @foreach($matakuliah->jadwal as $dos)
                            <form action="{{route('dosen.destroy',$dos->id)}}" method="post"  class="form-inline">
                            <tr>
                                <td>{{$matakuliah->kd_mk}}</td>
                                <td>{{$matakuliah->nama_mk}}</td>
                                <td>{{$dos->dosen->kode_dosen}}</td>
                                <td>{{$dos->dosen->nidn}}</td>
                                <td>{{$dos->dosen->nama_dosen}}</td>
                                <td>{{$dos->jadwal.' / '.$dos->ruang->nama_ruang}}</td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection