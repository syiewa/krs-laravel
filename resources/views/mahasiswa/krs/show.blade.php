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
                            <th>Jurusan</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $mhs)
                            <tr>
                                <td>{{$mhs->krs->mahasiswa->nim}}</td>
                                <td>{{$mhs->krs->mahasiswa->nama_mahasiswa}}</td>
                                <td>{{$mhs->krs->mahasiswa->jurusan}}</td>
                                <td>{{$mhs->krs->statuta}}</td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection