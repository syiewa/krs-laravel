@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
	        <h4 class="title">{{$title}}</h4>
	        <p class="category"></p>
	    </div>
	    <div class="content">
	    	<form action="{{route('nilai.update',$krs->nilai->id)}}" method="POST">
	    	{{ csrf_field() }}
	    	<input type="hidden" name="_method" value="PUT">
	    	<div class="row">
		    	<div class="col-md-5">
	                <div class="form-group">
	                    <label>NIM</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->krs->mahasiswa->nim}}" name="nim" disabled>
	                </div>
	            </div>
	            <div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Nama Mahasiswa</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->krs->mahasiswa->nama_mahasiswa}}" name="nim" disabled>
	                </div>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Kode Mata Kuliah</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->jadwal->matakuliah->kd_mk}}" name="kd_mk" disabled>
	                </div>
	            </div>
	            <div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Nama Mata Kuliah</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->jadwal->matakuliah->nama_mk}}" name="nama_mk" disabled>
	                </div>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Kode Dosen</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->jadwal->dosen->kode_dosen}}" name="kode_dosen" disabled>
	                </div>
	            </div>
	            <div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Nama Dosen</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->jadwal->dosen->nama_dosen}}" name="nama_dosen" disabled>
	                </div>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Tahun Ajaran</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->jadwal->thnajaran->keterangan}}" name="tahun_ajaran" disabled>
	                </div>
	            </div>
	            <div class="col-md-5">
		    	 	<div class="form-group">
	                    <label>Semester Ditempuh</label>
	                    <input type="text" class="form-control border-input" value="{{$krs->krs->semester}}" name="semester" disabled>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-10">
	                <div class="form-group">
	                    <label>Nilai</label>
	                    <select class="form-control border-input" name="bobot_id">
	                    	@foreach($nilai as $kNilai => $vNilai)
	                    	<option value="{{$kNilai}}" {{$krs->nilai->bobot_id == $kNilai ? 'selected' : ''}}>{{$vNilai}}</option>
	                    	@endforeach
	                    </select>
	                </div>
	            </div>
	            <input type="hidden" name="krsdetil_id" value="{{$krs->id}}">
	            <input type="hidden" name="krs_id" value="{{$krs->krs->id}}">
            <div class="row">
            	<div class="col-md-12">
            		<div class="form-group">
						<input type="submit" class="btn btn-default">
					</div>
            	</div>
            </div>
	    	</form>
	    </div>
    </div>
</div>
@endsection