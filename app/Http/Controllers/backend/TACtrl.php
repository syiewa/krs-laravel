<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests\reqTA;
use App\Http\Controllers\Controller;
use App\Models\ThnAjaran;

class TACtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Data Tahun Ajaran';
        $this->data['thnajaran'] = ThnAjaran::orderBy('status','desc')->paginate(15);
        return view('backend.thnajaran.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Buat Tahun Ajaran';
        return view('backend.thnajaran.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqTA $request)
    {
        //
        if($request->has('status'))
            ThnAjaran::where('status',1)->update(['status' => 0]);
        ThnAjaran::create($request->all());
        return redirect()->route('thnajaran.index')->with('info','Tahun Ajaran berhasil ditambahkan');

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
        $this->data['title'] = 'Edit Data Tahun Ajaran';
        $this->data['thajaran'] = ThnAjaran::find($id);
        return view('backend.thnajaran.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqTA $request, $id)
    {
        //
        if($request->has('status'))
            ThnAjaran::where('status',1)->update(['status' => 0]);
        $input = $request->except('_token','_method');
        ThnAjaran::find($id)->update($input);
        return redirect()->route('thnajaran.index')->with('info','Tahun Ajaran berhasil diubah');
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
        ThnAjaran::find($id)->delete();
         return redirect()->route('thnajaran.index')->with('info','Tahun Ajaran berhasil dihapus');
    }
}
