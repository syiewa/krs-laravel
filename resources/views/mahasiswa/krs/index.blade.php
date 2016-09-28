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
                    <form name="isi_krs" method="POST" action="{{!isset($krs) ? route('krs.store') : route('krs.update',$krs->id)}}">
                    {{ csrf_field() }}
                    @if(isset($krs))
                    <input type="hidden" name="_method" value="put">
                    @endif
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th colspan="12" class="text-center">MATA KULIAH YANG AKAN DITEMPUH PADA SEMESTER INI :</th>
                        </tr>
                        <tr>
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
                            <th></th>
                        </tr>
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
                                <tr>
                                    <td>{{$jadwal->dosen->kode_dosen}}</td>
                                    <td>{{$jadwal->dosen->nama_dosen}}</td>
                                    <td>{{$jadwal->kelas}}</td>
                                    <td>{{$jadwal->jadwal.' / '.$jadwal->ruang->nama_ruang}}</td>
                                    <td>{{$jadwal->kapasitas}}</td>
                                    <td>@if($peserta[$jadwal->id] > 0)
                                    <a href="{{route('krs.peserta',$jadwal->id)}}">{{$peserta[$jadwal->id]}}</a>
                                    @else
                                    {{$peserta[$jadwal->id]}}
                                    @endif</td>
                                    <td>
                                    @if($calon_peserta[$jadwal->id] > 0)
                                    <a href="{{route('krs.calonpeserta',$jadwal->id)}}">{{$calon_peserta[$jadwal->id]}}</a>
                                    @else
                                    {{$calon_peserta[$jadwal->id]}}
                                    @endif
                                    </td>
                                    <td>
                                        <div class="checkbox @if(isset($krs_jadwal)) @if(array_key_exists($jadwal->id,$krs_jadwal)) checked @endif @endif">
                                                <input type="checkbox" name="jadwal[{{$mk->id}}]" value="{{$jadwal->id}}" id="{{$mk->id.'-'.$jadwal->id.'-'.$mk->sks}}" class="cb_jadwal-{{$mk->id}}" @if(isset($krs_jadwal)) @if(array_key_exists($jadwal->id,$krs_jadwal)) checked @endif @endif>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan="10">Total SKS Yang Akan Ditempuh :</td>
                                <td colspan="2"><span id="sks">0</span> SKS</td>
                            </tr>
                        </tbody>
                    </table>
                    @if($matakuliah)
                    <input type="submit" class="btn btn-success" value="Simpan Data Kartu Rencana Study">
                    @endif
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('js')
    @parent
    <script>
        var max_sks = "{{$beban_studi}}";
        var src = {};
        var sks = 0;
        $("input:checkbox").each(function(e){
           var $this = $(this);
           if(this.checked){
                var parse = this.id.split('-');
                src[parse[0]] = this.id;
                sks = sks + parseInt(this.id.split('-')[2]);
                $('#sks').text(sks);
           }
        })
        $("input:checkbox").change(function(e) {
           sks  = 0;
           var $this = $(this);
           if(this.checked){
                var kelas = $(e.target).attr('class');
                $('.'+kelas).not(this).parent().closest('div').attr('class','checkbox');
                $('.'+kelas).not(this).attr('checked',false);
                var parse = e.target.id.split('-');
                src[parse[0]] = e.target.id;
           } else {
                var parse = e.target.id.split('-');
                src[parse[0]] = '';
           }
            $.each(src,function(key,value){
                if(value) {
                    sks = sks + parseInt(value.split('-')[2]);
                }
           });
            if(sks < 0){
                sks = 0;
            }
            if(sks > parseInt(max_sks)){
                alert('Maksimal Beban Studi');
                $('.'+kelas).parent().closest('div').attr('class','checkbox');
                $('.'+kelas).attr('checked',false);
                var parse = e.target.id.split('-');
                src[parse[0]] = '';
            } else {
                $('#sks').text(sks);
            }
           sks = 0;
        });
    </script>
@endsection