@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
	        <h4 class="title">{{$title}}</h4>
	        <p class="category"></p>
	    </div>
	    <div class="content">
	    	<form action="{{route('jadwal.store')}}" method="POST">
	    	{{ csrf_field() }}
            <div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('mk_id')) has-error @endif">
	                    <label>Matakuliah</label>
	                    <select class="form-control border-input" name="mk_id">
	                    	@foreach($matakuliah as $mkK => $mkV)
	                    	<option value="{{$mkK}}" {{old('mk_id') == $mkK ? 'selected' : ''}}>{{$mkV}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('mk_id')}}</span>
	                </div>
	            </div>
                <div class="col-md-5">
	                <div class="form-group @if($errors->has('dosen_id')) has-error @endif">
	                    <label>Dosen</label>
	                    <select class="form-control border-input" name="dosen_id">
	                    	@foreach($dosen as $dosenK => $dosenV)
	                    	<option value="{{$dosenK}}" {{old('dosen_id') == $dosenK ? 'selected' : ''}}>{{$dosenV}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('dosen_id')}}</span>
	                </div>
	            </div>
            </div>
	    	<div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('hari')) has-error @endif">
	                    <label>Hari</label>
	                    <select class="form-control border-input" name="hari">
	                    	@foreach($hari as $hK => $hV)
	                    	<option value="{{$hK}}" {{old('hari') == $hK ? 'selected' : ''}}>{{$hV}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('hari')}}</span>
	                </div>
	            </div>
	            <div class="col-md-2">
	                <div class="form-group @if($errors->has('waktu_mulai')) has-error @endif">
	                    <label>Jam Mulai</label>
	                    <input type="text" class="form-control border-input" value="{{old('waktu_mulai')}}" name="waktu_mulai">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('waktu_mulai')}}</span>
	                </div>
	            </div>
	            <div class="col-md-2">
	                <div class="form-group @if($errors->has('waktu_selesai')) has-error @endif">
	                    <label>Jam Selesai</label>
	                    <input type="text" class="form-control border-input" value="{{old('waktu_selesai')}}" name="waktu_selesai">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('waktu_selesai')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('ruang_id')) has-error @endif">
	                    <label>Ruang</label>
	                    <select class="form-control border-input" name="ruang_id">
	                    	@foreach($ruang as $ruangK => $ruangV)
	                    	<option value="{{$ruangK}}" {{old('ruang_id') == $ruangK ? 'selected' : ''}}>{{$ruangV}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('ruang_id')}}</span>
	                </div>
	            </div>
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('thnajaran_id')) has-error @endif">
	                    <label>Tahun Ajaran</label>
	                    <select class="form-control border-input" name="thnajaran_id">
	                    	@foreach($thn_ajaran as $thnajaranK => $thnajaranV)
	                    	<option value="{{$thnajaranK}}" {{old('thnajaran_id') == $thnajaranK ? 'selected' : ''}}>{{$thnajaranV}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('thnajaran_id')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-5">
	                <div class="form-group @if($errors->has('kapasitas')) has-error @endif">
	                    <label>Kapasitas Kelas</label>
	                    <input type="text" class="form-control border-input" value="{{old('kapasitas')}}" name="kapasitas">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('kapasitas')}}</span>
	                </div>
	            </div>
	            <div class="col-md-2">
	                <div class="form-group @if($errors->has('program')) has-error @endif">
	                    <label>Program</label>
	                    <select class="form-control border-input" name="program">
	                    	@foreach($kelas as $kK)
	                    	<option value="{{$kK}}" {{old('program') == $kK ? 'selected' : ''}}>{{$kK}}</option>
	                    	@endforeach
	                    </select>
	                    <span id="helpBlock2" class="help-block">{{$errors->first('program')}}</span>
	                </div>
	            </div>
	            <div class="col-md-2">
	                <div class="form-group @if($errors->has('kelas')) has-error @endif">
	                    <label>Kelas</label>
	                    <input type="text" class="form-control border-input" value="{{old('kelas')}}" name="kelas">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('kelas')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<a href="{{ route('jadwal.index') }}" class="btn btn-default">Cancel</a>
					<input type="submit" class="btn btn-default">
            	</div>
            </div>
	    	</form>
	    </div>
    </div>
</div>
@endsection