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
                            <th>NIM</th>
                            <th>Nama mahasiswa</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>Kelas Program</th>
                            <th>Aksi</th>
                            <th><a href="{{route('mahasiswa.create')}}" class="btn btn-default"><span class="ti-plus"></span> Tambah mahasiswa</a></th>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $mhs)
                            <form action="{{route('mahasiswa.destroy',$mhs->id)}}" method="post"  class="form-inline">
                            <tr>
                                <td>{{$mhs->nim}}</td>
                                <td>{{$mhs->nama_mahasiswa}}</td>
                                <td>{{$mhs->angkatan}}</td>
                                <td>{{$mhs->jurusan}}</td>
                                <td>{{$mhs->kelas_program}}</td>
                                <td colspan="2">
                                    <a href="{{route('mahasiswa.edit',$mhs->id)}}" class="btn btn-info"><i class="ti-pencil-alt"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete" >
                                    <button type="submit" class="btn btn-danger"><i class="ti-close"></i></a>
                                </td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{$mahasiswa->links()}}
                </div>
            </div>
        </div>
@endsection