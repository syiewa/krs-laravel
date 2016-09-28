<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests\reqMk;
use App\Http\Controllers\Controller;

use App\Models\MataKuliah;
use App\Models\Jadwal;
class MkCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Data Mata Kuliah';
        $this->data['matakuliah'] = MataKuliah::orderBy('semester')->paginate(15);
        return view('backend.matakuliah.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Tambah Mata Kuliah';
        $this->data['jurusan'] = ['Teknik Informatika','Sistem Informasi','Manajemen Informatika'];
        $this->data['prasyarat'] = MataKuliah::pluck('nama_mk','kd_mk');
        return view('backend.matakuliah.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqMk $request)
    {
        //
        MataKuliah::create($request->all());
        return redirect()->route('matakuliah.index')->with('info','Mata Kuliah Berhasil Ditambahkan');
    }

    public function dosen($id){
        $this->data['matakuliah'] = MataKuliah::has('jadwal')->with('jadwal')->find($id);
        $this->data['title'] = 'Data Dosen Matakuliah '.$this->data['matakuliah']->nama_mk;
        return view('backend.matakuliah.dosen',$this->data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->data['matakuliah'] = MataKuliah::find($id);
        $this->data['title'] = 'Tambah Mata Kuliah';
        $this->data['jurusan'] = ['Teknik Informatika','Sistem Informasi','Manajemen Informatika'];
        $this->data['prasyarat'] = MataKuliah::pluck('nama_mk','kd_mk');
        return view('backend.matakuliah.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqMk $request, $id)
    {
        //
        $input = $request->except('_token','_method','mk_id');
        MataKuliah::find($id)->update($input);
        return redirect()->route('matakuliah.index')->with('info','Mata Kuliah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MataKuliah::find($id)->delete();
        return redirect()->route('matakuliah.index')->with('info','Mata Kuliah berhasil dihapus');
    }
}
