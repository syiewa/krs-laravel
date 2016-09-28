<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests\reqDosen;
use App\Http\Controllers\Controller;

use App\Models\Dosen;
use App\User;

class DosenCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Data Dosen';
        $this->data['dosen'] = Dosen::paginate(15);
        return view('backend.dosen.index',$this->data);
    }

    public function matakuliah($id){
        $this->data['dosen'] = Dosen::with('jadwal')->find($id);
        $this->data['title'] = 'Data Mata Kuliah dosen '.$this->data['dosen']->nama_dosen;
        return view('backend.dosen.matakuliah',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Tambah Data Dosen';
        return view('backend.dosen.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqDosen $request)
    {
        //
        $input = $request->all();
        $input['user_id'] = User::create(['username' => $input['kode_dosen'],'password' => bcrypt($input['kode_dosen']),'role' => 'dosen'])->id;
        $dosen = Dosen::create($input);
        return redirect()->route('dosen.index')->with('info','Data Dosen Berhasil Ditambahkan');
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
        $this->data['title'] = 'Edit Data Dosen';
        $this->data['dosen'] = Dosen::find($id);
        return view('backend.dosen.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqDosen $request, $id)
    {
        //
        $input = $request->except('_token','dosen_id');
        $dosen = Dosen::find($id);
        $dosen->update($input);
        User::find($dosen->user_id)->update(['username' => $input['kode_dosen'],'password' => bcrypt($input['kode_dosen']),'role' => 'dosen']);
        return redirect()->route('dosen.index')->with('info','Data Dosen berhasil diubah');
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
        Dosen::find($id)->delete();
        return redirect()->route('dosen.index')->with('info','Data Dosen berhasil dihapus');
    }
}
