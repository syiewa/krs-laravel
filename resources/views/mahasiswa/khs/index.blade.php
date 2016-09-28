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
                            <tr class="text-center">
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                                <th>Bobot</th>
                                <th>SKS x Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($khs)
                            <?php $total_sks =0;$total_bobot = 0;$total_ipk = 0;$total_semester = 0; ?>
                            @foreach($khs as $key=>$value)                            
                                <tr>
                                    <td colspan="7"> Semester {{$value->semester}} </td>
                                </tr>
                                @foreach($value->krsdetil as $k=>$detil)
                                @if(isset($detil->nilai))
                                <tr>
                                    <td>{{$detil->jadwal->matakuliah->kd_mk}}</td>
                                    <td>{{$detil->jadwal->matakuliah->nama_mk}}</td>
                                    <td>{{$detil->jadwal->matakuliah->semester}}</td>
                                    <td>{{$detil->jadwal->matakuliah->sks}}</td>
                                    <?php 
                                        $total_bobot_mk = $detil->jadwal->matakuliah->sks * $detil->nilai['bobot']['bobot'];
                                        $total_sks = $total_sks + $detil->jadwal->matakuliah->sks; 
                                        $total_bobot = $total_bobot+$total_bobot_mk;
                                    ?>
                                    <td class="text-center">{{$detil->nilai['bobot']['nilai']}}</td>
                                    <td class="text-center">{{$detil->nilai['bobot']['bobot']}}</td>
                                    <td class="text-center">{{$total_bobot_mk}}</td>
                                </tr>
                                @endif
                                @endforeach
                                <?php $ip_semester =round($total_bobot/$total_sks,2); ?>
                                <tr>
                                    <td colspan="2">Jumlah SKS </td>
                                    <td colspan="1" class="text-center">{{$total_sks}}</td>
                                    <td colspan="3">IP Semester</td>
                                    <td colspan="1" class="text-center">{{$ip_semester}}</td>
                                </tr>
                                <?php 
                                    $total_semester = $loop->count;
                                    $total_ipk = $total_ipk + $ip_semester ;
                                    $total_sks = 0;
                                    $total_bobot_mk = 0;
                                    $total_bobot = 0;
                                 ?>
                            @endforeach
                            <tr>
                                <td colspan="6" >IPK</td>
                                <td class="text-center">{{$total_semester > 0 ? round($total_ipk / $total_semester,2) : 0}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection