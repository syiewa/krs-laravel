<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests\reqRuang;
use App\Http\Controllers\Controller;
use App\Models\Ruang;

class RuangCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Data Ruang';
        $this->data['ruang'] = Ruang::paginate(15);
        return view('backend.ruang.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Tambah Data Ruang';
        return view('backend.ruang.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqRuang $request)
    {
        //
        Ruang::create($request->all());
        return redirect()->route('ruang.index')->with('info','Data ruang berhasil ditambahkan');
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
        $this->data['title'] = 'Edit Data Ruang';
        $this->data['ruang'] = Ruang::find($id);
        return view('backend.ruang.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqRuang $request, $id)
    {
        //
        $input = $request->except('_token','_method');
        Ruang::find($id)->update($input);
        return redirect()->route('ruang.index')->with('info','Ruang berhasil diubah');
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
        Ruang::find($id)->delete();
        return redirect()->route('ruang.index')->with('info','Ruang berhasil dihapus');
    }
}
