@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                  <p class="form-control-static">NIM</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="form-control-static">: {{$krs->mahasiswa->nim}}</p>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                  <p class="form-control-static">Nama</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="form-control-static">: {{$krs->mahasiswa->nama_mahasiswa}}</p>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                  <p class="form-control-static">Jurusan</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="form-control-static">: {{$krs->mahasiswa->jurusan}}</p>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                  <p class="form-control-static">Dosen Wali</p>
                                </div>
                                <div class="col-sm-9">
                                  <p class="form-control-static">: {{$krs->mahasiswa->dosen->nama_dosen}}</p>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-7">
                                  <p class="form-control-static">Semester Tahun Ajaran</p>
                                </div>
                                <div class="col-sm-5">
                                  <p class="form-control-static">: {{$thn_ajaran->keterangan}}</p>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-7">
                                  <p class="form-control-static">IP Semester Lalu/Beban Studi</p>
                                </div>
                                <div class="col-sm-5">
                                  <p class="form-control-static">: {{$ipk->IPK ? $ipk->IPK : 0}} / {{$beban_studi}}</p>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-7">
                                  <p class="form-control-static">Program Kelas</p>
                                </div>
                                <div class="col-sm-5">
                                  <p class="form-control-static">: {{$krs->mahasiswa->kelas_program}}</p>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-7">
                                  <p class="form-control-static">Semester</p>
                                </div>
                                <div class="col-sm-5">
                                  <p class="form-control-static">: {{$krs->semester}}</p>
                                </div>
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
                                @if($krs->status == 0)
                                <th>Aksi</th>
                                @endif
                            </tr>
                            <?php $total_sks =0 ?>
                            @foreach($krs->krsdetil as $telo)
                            @if(!$telo->nilai)
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
                                @if($krs->status == 0)
                                <form action="{{route('persetujuan.destroy',$telo->id)}}"" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <td><input type="submit" value="Batalkan" class="btn btn-danger"></td>
                                </form>
                                @endif
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td colspan="3">Total SKS Yang Akan Ditempuh </td>
                                <td colspan="9">{{$total_sks}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Status Persetujuan KRS :</td>
                                <td colspan="9">{{$krs->statuta}}</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    (+) Jika Anda menyetujui Rencana Study Mahasiswa yang bersangkutan silakan click tombol Setujui di bawah ini <br />
                    <form action="{{route('persetujuan.update',$krs->id)}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="status" value="{{$krs->status == 0 ? 1 : 0}}">
                    <input type="hidden" name="_method" value="put">
                    <input type="submit" value="{{$krs->status == 1 ? 'Batalkan Kartu Rencana Studi' : 'Setujui Kartu Rencana Studi'}}">
                    </form>
                </div>
            </div>
        </div>
@endsection