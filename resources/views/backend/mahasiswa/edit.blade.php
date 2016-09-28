@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
	        <h4 class="title">{{$title}}</h4>
	        <p class="category"></p>
	    </div>
	    <div class="content">
	    	<form action="{{route('mahasiswa.update',$mahasiswa->id)}}" method="POST">
	    	{{ csrf_field() }}
	    	<input type="hidden" name="mhs_id" value="$mahasiswa->id">
	    	<input type="hidden" name="_method" value="PUT">
	    	<div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('nim')) has-error @endif"">
	                    <label>NIM</label>
	                    <input type="text" class="form-control border-input" value="{{$mahasiswa->nim}}" name="nim">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('nim')}}</span>
	                </div>
	            </div>
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('angkatan')) has-error @endif"">
	                    <label>Angkatan</label>
	                    <input type="text" class="form-control border-input" value="{{$mahasiswa->angkatan}}" name="angkatan">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('angkatan')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-10">
	                <div class="form-group @if($errors->has('nama_mahasiswa')) has-error @endif"">
	                    <label>Nama mahasiswa</label>
	                    <input type="text" class="form-control border-input" value="{{$mahasiswa->nama_mahasiswa}}" name="nama_mahasiswa">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('nama_mahasiswa')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('jurusan')) has-error @endif"">
	                    <label>Jurusan</label>
	                    <select class="form-control border-input" name="jurusan">
	                    	@foreach($jurusan as $jur)
	                    	<option value="{{$jur}}" {{$mahasiswa->jurusan == $jur ? 'selected' : ''}}>{{$jur}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('jurusan')}}</span>
	                </div>
	            </div>
	            <div class="col-md-5">
	                <div class="form-group @if($errors->has('kelas_program')) has-error @endif"">
	                    <label>Kelas Program</label>
	                     <select class="form-control border-input" name="kelas_program">
	                    	@foreach($kelas as $program)
	                    	<option value="{{$program}}" {{$mahasiswa->kelas_program == $program ? 'selected' : ''}}>{{$program}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('kelas_program')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-10">
	                <div class="form-group @if($errors->has('dosen_id')) has-error @endif"">
	                    <label>Dosen Wali</label>
	                    <select class="form-control border-input" name="dosen_id">
	                    	@foreach($dosen as $kdos=>$vdos)
	                    	<option value="{{$kdos}}" {{$mahasiswa->dosen_id == $kdos ? 'selected' : ''}}>{{$vdos}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('dosen_id')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<a href="{{ route('mahasiswa.index') }}" class="btn btn-default">Cancel</a>
					<input type="submit" class="btn btn-default">
            	</div>
            </div>
	    	</form>
	    </div>
    </div>
</div>
@endsection