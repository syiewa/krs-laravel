@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <th>Kode Tahun Ajaran</th>
                            <th>Keterangan</th>
                            <th>Tgl Kuliah</th>
                            <th>Tgl Awal Perwalian</th>
                            <th>Tgl Akhir Perwalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th><a href="{{route('thnajaran.create')}}" class="btn btn-default"><span class="ti-plus"></span> Tambah thnajaran</a></th>
                        </thead>
                        <tbody>
                            @foreach($thnajaran as $ta)
                            <form action="{{route('thnajaran.destroy',$ta->id)}}" method="post"  class="form-inline">
                            <tr>
                                <td>{{$ta->kd_tahun}}</td>
                                <td>{{$ta->keterangan}}</td>
                                <td>{{$ta->tgl_kuliah}}</td>
                                <td>{{$ta->tgl_awal_perwalian}}</td>
                                <td>{{$ta->tgl_akhir_perwalian}}</td>
                                <td>{{$ta->statuta}}</td>
                                <td colspan="2">
                                    <a href="{{route('thnajaran.edit',$ta->id)}}" class="btn btn-info"><i class="ti-pencil-alt"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete" >
                                    <button type="submit" class="btn btn-danger"><i class="ti-close"></i></a>
                                </td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{$thnajaran->links()}}
                </div>
            </div>
        </div>
@endsection