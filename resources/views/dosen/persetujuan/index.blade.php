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
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jurusan</th>
                            <th>Semester</th>
                            <th>Program Kelas</th>
                            <th>Status Persetujuan</th>
                            <th>SKS</th>
                            <th>Detail KRS</th>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $mhs)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$mhs->nim}}</td>
                                <td>{{$mhs->nama_mahasiswa}}</td>
                                <td>{{$mhs->jurusan}}</td>
                                <td>{{$mhs->semester}}</td>
                                <td>{{$mhs->kelas_program}}</td>
                                <td>
                                @if(isset($mhs->status))
                                    @if($mhs->status == 0)
                                        Belum Disetujui
                                    @elseif($mhs->status == 1)
                                        Sudah Disetujui
                                    @elseif($mhs->status == 2)
                                        Sudah Dinilai
                                    @endif
                                @else 
                                    Belum KRS
                                @endif</td>
                                <td>{{$mhs->j_sks}}</td>
                                <td>
                                @if(isset($mhs->krsid) && $mhs->status != 2)
                                <a href="{{route('persetujuan.edit',$mhs->krsid)}}"" class="btn btn-default">Lihat KRS</a>
                                @endif
                                </td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection