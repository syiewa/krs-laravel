@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
	        <h4 class="title">{{$title}}</h4>
	        <p class="category"></p>
	    </div>
	    <div class="content">
	    	<form action="{{route('matakuliah.update',$matakuliah->id)}}" method="POST">
	    	{{ csrf_field() }}
	    	<input type="hidden" name="_method" value="PUT">
	    	<input type="hidden" name="mk_id" value="{{$matakuliah->id}}">
	    	<div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('kd_mk')) has-error @endif">
	                    <label>Kode MK</label>
	                    <input type="text" class="form-control border-input" value="{{$matakuliah->kd_mk}}" name="kd_mk">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('kd_mk')}}</span>
	                </div>
	            </div>
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('sks')) has-error @endif">
	                    <label>SKS</label>
	                    <input type="text" class="form-control border-input" value="{{$matakuliah->sks}}" name="sks">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('sks')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-10">
	                <div class="form-group @if($errors->has('nama_mk')) has-error @endif">
	                    <label>Nama matakuliah</label>
	                    <input type="text" class="form-control border-input" value="{{$matakuliah->nama_mk}}" name="nama_mk">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('nama_mk')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('semester')) has-error @endif">
	                    <label>Semester</label>
	                    <input type="text" class="form-control border-input" value="{{$matakuliah->semester}}" name="semester">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('semester')}}</span>
	                </div>
	            </div>
	            <div class="col-md-5">
	                <div class="form-group @if($errors->has('prasyarat_mk')) has-error @endif">
	                    <label>Pra Syarat</label>
	                    <select class="form-control border-input" name="prasyarat_mk">
	                    	<option value="" {{$matakuliah->prasyarat_mk == '' ? 'selected' : ''}}>Tidak Ada</option> 
	                    	@foreach($prasyarat as $kMk => $vMk)
	                    	<option value="{{$kMk}}" {{$matakuliah->prasyarat_mk == $kMk ? 'selected' : ''}}>{{$vMk}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('prasyarat_mk')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('jurusan')) has-error @endif">
	                    <label>Jurusan</label>
	                    <select class="form-control border-input" name="jurusan">
	                    	@foreach($jurusan as $jur)
	                    	<option value="{{$jur}}" {{$matakuliah->jurusan == $jur ? 'selected' : ''}}>{{$jur}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('jurusan')}}</span>
	                </div>
	            </div>
	     
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<a href="{{ route('matakuliah.index') }}" class="btn btn-default">Cancel</a>
					<input type="submit" class="btn btn-default">
            	</div>
            </div>
	    	</form>
	    </div>
    </div>
</div>
@endsection