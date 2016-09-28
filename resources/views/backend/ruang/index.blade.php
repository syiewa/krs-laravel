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
                            <th>Nama Ruang</th>
                            <th>Aksi</th>
                            <th><a href="{{route('ruang.create')}}" class="btn btn-default"><span class="ti-plus"></span> Tambah Ruang</a></th>
                        </thead>
                        <tbody>
                            @foreach($ruang as $rg)
                            <form action="{{route('ruang.destroy',$rg->id)}}" method="post"  class="form-inline">
                            <tr>
                                <td>{{$rg->nama_ruang}}</td>
                                <td colspan="2">
                                    <a href="{{route('ruang.edit',$rg->id)}}" class="btn btn-info"><i class="ti-pencil-alt"></i></a>
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete" >
                                    <button type="submit" class="btn btn-danger"><i class="ti-close"></i></a>
                                </td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                    {{$ruang->links()}}
                </div>
            </div>
        </div>
@endsection