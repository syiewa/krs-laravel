@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIM</label>
                                <input type="text" class="form-control border-input" value="{{$mahasiswa->nim}}" name="nim" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <input type="text" class="form-control border-input" value="{{$thn_ajaran->keterangan}}" name="thn_ajaran" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control border-input" value="{{$mahasiswa->nama_mahasiswa}}" name="nama_mahasiswa" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>IP Semester Tahun Lalu</label>
                                <input type="text" class="form-control border-input" value="{{$ipk->IPK}}" name="thn_ajaran" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Beban Study Maks</label>
                                <input type="text" class="form-control border-input" value="{{$beban_studi}}" name="thn_ajaran" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" class="form-control border-input" value="{{$mahasiswa->jurusan}}" name="jurusan" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Program</label>
                                <input type="text" class="form-control border-input" value="{{$mahasiswa->kelas_program}}" name="kelas_program" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dosen Wali</label>
                                <input type="text" class="form-control border-input" value="{{$mahasiswa->dosen->nama_dosen}}" name="nama_dosen" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Semester Yang Akan Ditempuh</label>
                                <input type="text" class="form-control border-input" value="{{$semester}}" name="kelas_program" disabled>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th colspan="11" class="text-center">MATA KULIAH YANG AKAN DITEMPUH PADA SEMESTER INI :</th>
                            </tr>
                            <tr>
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Jadwal</th>
                                <th>Quota</th>
                                <th>Peserta</th>
                                <th>Calon Peserta</th>
                            </tr>
                            <?php $total_sks =0 ?>
                            @foreach($krs->krsdetil as $telo)
                            <tr>
                                <td>{{$telo->jadwal->matakuliah->kd_mk}}</td>
                                <td>{{$telo->jadwal->matakuliah->nama_mk}}</td>
                                <td>{{$telo->jadwal->matakuliah->semester}}</td>
                                <?php 
                                    $total_sks = $total_sks + $telo->jadwal->matakuliah->sks; 
                                ?>
                                <td>{{$telo->jadwal->matakuliah->sks}}</td>
                                <td>{{$telo->jadwal->dosen->nama_dosen}}</td>
                                <td>{{$telo->jadwal->program}}</td>
                                <td>{{$telo->jadwal->jadwal}}</td>
                                <td>{{$telo->jadwal->kapasitas}}</td>
                                <td>{{$peserta[$telo->jadwal->id]}}</td>
                                <td>{{$calon_peserta[$telo->jadwal->id]}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Total SKS Yang Akan Ditempuh </td>
                                <td colspan="9">{{$total_sks}}</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
