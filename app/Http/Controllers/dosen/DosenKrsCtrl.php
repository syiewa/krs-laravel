<?php

namespace App\Http\Controllers\dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\ThnAjaran;
use App\Models\Nilai;
use App\Models\Krs;
use App\Models\KrsDetil;
use App\Models\Dosen;
use App\Models\Jadwal;

class DosenKrsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $this->data['title'] = "Persetujuan KRS - Sistem Informasi Akademik Online";
        $this->data['mahasiswa'] = Dosen::Bimbingan(Auth::user()->dosen->id);
        return view('dosen.persetujuan.index',$this->data);

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
        $this->data['krs'] = Krs::find($id);
        $this->data['title'] = 'Detail Kartu Rencana Studi - '.$this->data['krs']->mahasiswa->nama_mahasiswa;
        $mahasiswa_id = $this->data['krs']->mahasiswa->id;
        $this->data['thn_ajaran'] = ThnAjaran::where('status',1)->first();
        $this->data['ipk'] = Nilai::Ipk($mahasiswa_id,$this->data['krs']->semester);
        $this->data['beban_studi'] = Nilai::MaxSks($this->data['ipk']);
        $this->data['peserta'] = Jadwal::Peserta();
        $this->data['calon_peserta'] = Jadwal::CalonPeserta();
        return view('dosen.persetujuan.edit',$this->data);
        
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
        KRS::find($id)->update(['status' => $request->input('status'),'tgl_persetujuan' => date('Y-m-d')]);
        $info = $request->input('status') == 1 ? 'KRS berhasil disetujui' : 'KRS berhasil dibatalkan';
        return redirect()->route('persetujuan.index')->with('info',$info);
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
        KrsDetil::find($id)->delete();
        return redirect()->back()->with('info','Jadwal Berhasil Dihapus');
    }
}
