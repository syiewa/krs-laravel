<?php

namespace App\Http\Controllers\dosen;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\Models\Krs;
use App\Models\KrsDetil;
use App\Models\Jadwal;
use App\Models\Bobot;
use App\Models\Nilai;
use App\Models\ThnAjaran;
use App\Models\Mahasiswa;

class NilaiCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Input Nilai';
        $this->data['mahasiswa'] = Mahasiswa::where('dosen_id',Auth::user()->dosen->id)->with(['krs' => function ($q){
                $thnajaran = ThnAjaran::where('status',1)->first();
                $q->where([['status','!=',0],['thnajaran_id',$thnajaran->id]])->whereHas('krsdetil',function($e){
                    $e->whereHas('jadwal' , function ($j){
                        $thnajaran = ThnAjaran::where('status',1)->first();
                        $j->where('thnajaran_id',$thnajaran->id);
                    });
                });
        }])->get();
        return view('dosen.nilai.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Nilai::create($request->except('krs_id'));
        Krs::find($request->input('krs_id'))->update(['status' => 2]);
        return redirect()->route('nilai.edit',$request->input('krs_id'))->with('info','Nilai berhasil ditambahkan');
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
        $this->data['title'] = 'Masukkan Nilai';
        $this->data['krs'] = KrsDetil::find($id);
        $this->data['nilai'] = Bobot::pluck('nilai','id');
        return view('dosen.nilai.create',$this->data);
    }

    /*
     * Edit Nilai
     * @param int $id
    */

    public function editnilai($id)
    {
        $this->data['title'] = 'Edit Nilai';
        $this->data['krs'] = KrsDetil::find($id);
        $this->data['nilai'] = Bobot::pluck('nilai','id');
        return view('dosen.nilai.editnilai',$this->data);
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
        $this->data['krs'] = KrsDetil::where('krs_id',$id)->with('nilai')->get();
        $this->data['title'] = 'Nilai - Kartu Hasil Studi '.$this->data['krs']->first()->krs->mahasiswa->nama_mahasiswa;
        $this->data['nilai'] = KrsDetil::TblNilai($id);
        $this->data['peserta'] = Jadwal::Peserta();
        return view('dosen.nilai.edit',$this->data);

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
        $input = $request->except('krs_id');
        Nilai::find($id)->update($input);
        return redirect()->route('nilai.edit',$request->input('krs_id'))->with('info','Nilai berhasil diubah');
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
        Nilai::find($id)->delete();
        return redirect()->back()->with('info','Nilai berhasil dihapus');
    }
}
