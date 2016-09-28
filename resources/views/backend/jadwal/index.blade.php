@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content table-responsive">
                    <a href="{{route('jadwal.create')}}" class="btn btn-default btn-xs"><span class="ti-plus"></span> Tambah Jadwal</a>
                    <table class="table table-condensed">
                        <thead>
                            <th>Kode Mata Kuliah</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>SKS</th>
                            <th colspan="2">Dosen</th>
                            <th>Kelas</th>
                            <th>Jadwal</th>
                            <th>Quota</th>
                            <th>Peserta</th>
                            <th>Calon Peserta</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($matakuliah as $mk)
                            <tr>
                                <td rowspan="{{$mk->jadwal->count()+1}}">{{$mk->kd_mk}}</td>
                                <td rowspan="{{$mk->jadwal->count()+1}}">{{$mk->nama_mk}}</td>
                                <td rowspan="{{$mk->jadwal->count()+1}}">{{$mk->semester}}</td>
                                <td rowspan="{{$mk->jadwal->count()+1}}">{{$mk->sks}}</td>
                            </tr>
                                @foreach($mk->jadwal as $jadwal)
                                <form action="{{route('jadwal.destroy',$jadwal->id)}}" method="post"  class="form-inline">
                                <tr>
                                    <td>{{$jadwal->dosen->kode_dosen}}</td>
                                    <td>{{$jadwal->dosen->nama_dosen}}</td>
                                    <td>{{$jadwal->kelas}}</td>
                                    <td>{{$jadwal->jadwal.' / '.$jadwal->ruang->nama_ruang}}</td>
                                    <td>{{$jadwal->kapasitas}}</td>
                                    <td>{{$peserta[$jadwal->id]}}</td>
                                    <td>{{$calon_peserta[$jadwal->id]}}</td>
                                    <td>
                                        <a href="{{route('jadwal.edit',$jadwal->id)}}" class="btn btn-info btn-xs"><i class="ti-pencil-alt"></i></a>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete" >
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{$matakuliah->links()}}
                </div>
            </div>
        </div>
@endsection