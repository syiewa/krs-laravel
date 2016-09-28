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
                            <th>Kode Dosen</th>
                            <th>Nama Dosen</th>
                            <th>Kode MataKuliah</th>
                            <th>Nama Matakuliah</th>
                            <th>Jadwal</th>
                        </thead>
                        <tbody>
                            @foreach($dosen->jadwal as $dos)
                            <tr>
                                <td>{{$dosen->kode_dosen}}</td>
                                <td>{{$dosen->nama_dosen}}</td>
                                <td>{{$dos->matakuliah->kd_mk}}</td>
                                <td>{{$dos->matakuliah->nama_mk}}</td>
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