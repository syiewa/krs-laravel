<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests\reqMhs;
use App\Http\Controllers\Controller;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\User;

class MhsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Data Mahasiswa';
        $this->data['mahasiswa'] = Mahasiswa::orderBy('nim')->paginate(15);
        return view('backend.mahasiswa.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Tambah Data Mahasiswa';
        $this->data['dosen'] = Dosen::pluck('nama_dosen','id');
        $this->data['jurusan'] = ['Teknik Informatika','Sistem Informasi','Manajemen Informatika'];
        $this->data['kelas'] = ['Pagi','Sore'];
        return view('backend.mahasiswa.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqMhs $request)
    {
        //
        $input = $request->all();
        $input['user_id'] = User::create(['username' => $input['nim'],'password' => bcrypt($input['nim']),'role' => 'mahasiswa'])->id;
        Mahasiswa::create($input);
        return redirect()->route('mahasiswa.index')->with('info','Mahasiswa Berhasil Ditambahkan');
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
        $this->data['title'] = 'Edit Data Mahasiswa';
        $this->data['mahasiswa'] = Mahasiswa::find($id);
        $this->data['dosen'] = Dosen::pluck('nama_dosen','id');
        $this->data['jurusan'] = ['Teknik Informatika','Sistem Informasi','Manajemen Informatika'];
        $this->data['kelas'] = ['Pagi','Sore'];
        return view('backend.mahasiswa.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->except('_method','_token','mhs_id');
        $mhs = Mahasiswa::find($id);
        $mhs->update($input);
        $input['user_id'] = User::find($mhs->user_id)->update(['username' => $input['nim'],'password' => bcrypt($input['nim']),'role' => 'mahasiswa']);
        return redirect()->route('mahasiswa.index')->with('info','Data Mahasiswa berhasil diubah');
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
        Mahasiswa::find($id)->delete();
        return redirect()->route('mahasiswa.index')->with('info','Data Mahasiswa berhasil dihapus');
    }
}
