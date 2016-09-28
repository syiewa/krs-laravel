@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
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
                                <th>Aksi</th>
                            </tr>
                            <?php $total_sks =0 ?>
                            @foreach($krs as $telo)
                            @if(!isset($telo->nilai))
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
                                <td><a href="{{route('nilai.show',$telo->id)}}" class="btn btn-default">Masukkan Nilai</a></td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td colspan="3">Total SKS Yang Akan Ditempuh </td>
                                <td colspan="9">{{$total_sks}}</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <br />
                    <br />
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th colspan="8" class="text-center">
MATA KULIAH YANG TERSIMPAN :</th>
                            </tr>
                            <tr class="text-center">
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                                <th>Bobot</th>
                                <th>SKS x Bobot</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_sks =0;$total_bobot = 0; ?>
                            @foreach($nilai as $key=>$val)
                            <?php $val = $val; ?>                                
                                <tr>
                                    <td colspan="8"> Semester {{$key}} </td>
                                </tr>
                                @foreach($val as $kdetil=>$detil)
                                <tr>
                                    <td>{{$detil->jadwal->matakuliah->kd_mk}}</td>
                                    <td>{{$detil->jadwal->matakuliah->nama_mk}}</td>
                                    <td class="text-center">{{$detil->jadwal->matakuliah->semester}}</td>
                                    <?php 
                                        $total_bobot_mk = $detil->jadwal->matakuliah->sks * $detil->nilai->bobot->bobot;
                                        $total_sks = $total_sks + $detil->jadwal->matakuliah->sks; 
                                        $total_bobot = $total_bobot+$total_bobot_mk;
                                    ?>
                                    <td class="text-center">{{$detil->jadwal->matakuliah->sks}}</td>
                                    <td class="text-center">{{$detil->nilai->bobot->nilai}}</td>
                                    <td class="text-center">{{$detil->nilai->bobot->bobot}}</td>
                                    <td class="text-center">{{$total_bobot_mk}}</td>
                                    <form action="{{route('nilai.destroy',$detil->nilai->id)}}" method="POST">
                                    <td class="text-center">
                                    <a href="{{route('nilai.nilaiedit',$detil->id)}}" class="btn btn-default">Edit</a>
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Hapus" class="btn btn-danger">
                                    </td>
                                    </form>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">Jumlah SKS </td>
                                    <td colspan="1" class="text-center">{{$total_sks}}</td>
                                    <td colspan="3">IP Semester</td>
                                    <td colspan="1" class="text-center">{{round($total_bobot/$total_sks,2)}}</td>
                                </tr>
                                <?php $total_sks = 0;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection