@extends('layouts.layout')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="header">
	        <h4 class="title">{{$title}}</h4>
	        <p class="category"></p>
	    </div>
	    <div class="content">
	    	<form action="{{route('thnajaran.update',$thajaran->id)}}" method="POST">
	    	{{ csrf_field() }}
	    	<input type="hidden" name="_method" value="PUT">
            <div class="row">
		    	<div class="col-md-6">
	                <div class="form-group @if($errors->has('kd_tahun')) has-error @endif">
	                    <label>Kode Tahun Ajaran</label>
	                    <input type="text" class="form-control border-input" value="{{$thajaran->kd_tahun}}" name="kd_tahun">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('kd_tahun')}}</span>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group @if($errors->has('keterangan')) has-error @endif">
	                    <label>Keterangan</label>
	                    <input type="text" class="form-control border-input" value="{{$thajaran->keterangan}}" name="keterangan">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('keterangan')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
		    	<div class="col-md-4">
	                <div class="form-group @if($errors->has('tgl_kuliah')) has-error @endif">
	                    <label>Tgl Kuliah</label>
	                    <input type="text" class="form-control border-input" value="{{$thajaran->tgl_kuliah}}" name="tgl_kuliah">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('tgl_kuliah')}}</span>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class="form-group @if($errors->has('tgl_awal_perwalian')) has-error @endif">
	                    <label>Tgl Awal Perwalian</label>
	                    <input type="text" class="form-control border-input" value="{{$thajaran->tgl_awal_perwalian}}" name="tgl_awal_perwalian">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('tgl_awal_perwalian')}}</span>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class="form-group @if($errors->has('tgl_akhir_perwalian')) has-error @endif">
	                    <label>Tgl Akhir Perwalian</label>
	                    <input type="text" class="form-control border-input" value="{{$thajaran->tgl_akhir_perwalian}}" name="tgl_akhir_perwalian">
	                    <span id="helpBlock2" class="help-block">{{$errors->first('tgl_akhir_perwalian')}}</span>
	                </div>
	            </div>
            </div>
            <div class="row">
            	<div class="col-md-4">
	            	<div class="checkbox form-group">
					    <label>
					      <input type="checkbox" class="form-control" value="1" name="status" @if($thajaran->status == 1) checked @endif> Active
					    </label>
					</div>
				</div>
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<a href="{{ route('thnajaran.index') }}" class="btn btn-default">Cancel</a>
					<input type="submit" class="btn btn-default" value="Simpan">
            	</div>
            </div>
	    	</form>
	    </div>
    </div>
</div>
@endsection