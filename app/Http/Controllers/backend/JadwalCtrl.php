<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests\reqJadwal;
use App\Http\Controllers\Controller;

use App\Models\MataKuliah;
use App\Models\Jadwal;
use App\Models\ThnAjaran;
use App\Models\Dosen;
use App\Models\Ruang;

class JadwalCtrl extends Controller
{
    private $hari = ['Mon' => 'Senin','Tue' => 'Selasa' , 'Wed' => 'Rabu','Thu' => 'Kamis','Fri'=>'Jumat','Sat' => 'Sabtu'];
    private $kelas = ['Pagi','Sore'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Data Jadwal Kuliah';
        $thn_ajaran = ThnAjaran::where('status',1)->first();
        $this->data['matakuliah'] = MataKuliah::whereHas('jadwal',function($q) use($thn_ajaran){
            $q->where('thnajaran_id',$thn_ajaran->id);
        })->with(['jadwal' => function($q) use($thn_ajaran){
            $q->where('thnajaran_id',$thn_ajaran->id);
        }])->orderBy('semester')->paginate(15);
        //echo "<pre>".print_r($this->data['matakuliah']->toArray(),true)."</pre>";
        $this->data['peserta'] = Jadwal::Peserta();
        $this->data['calon_peserta'] = Jadwal::CalonPeserta();
        return view('backend.jadwal.index',$this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['title'] = 'Tambah Data Jadwal Kuliah';
        $this->data['thn_ajaran'] = ThnAjaran::where('status',1)->orderBy('tgl_awal_perwalian')->pluck('keterangan','id');
        $this->data['matakuliah'] = MataKuliah::SelectBox();
        $this->data['dosen'] = Dosen::SelectBox();
        $this->data['hari'] = $this->hari;
        $this->data['kelas'] = $this->kelas;
        $this->data['ruang'] = Ruang::pluck('nama_ruang','id');
        return view('backend.jadwal.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reqJadwal $request)
    {
        //
        Jadwal::create($request->all());
        return redirect()->route('jadwal.index')->with('info','Jadwal Berhasil ditambah');
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
        $this->data['title'] = 'Edit Data Jadwal Kuliah';
        $this->data['thn_ajaran'] = ThnAjaran::where('status',1)->orderBy('tgl_awal_perwalian')->pluck('keterangan','id');
        $this->data['matakuliah'] = MataKuliah::SelectBox();
        $this->data['dosen'] = Dosen::SelectBox();
        $this->data['hari'] = $this->hari;
        $this->data['kelas'] = $this->kelas;
        $this->data['ruang'] = Ruang::pluck('nama_ruang','id');
        $this->data['jadwal'] = Jadwal::find($id);
        return view('backend.jadwal.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqJadwal $request, $id)
    {
        //
        $input = $request->except('_token','_method');
        Jadwal::find($id)->update($input);
        return redirect()->route('jadwal.index')->with('info','Jadwal Berhasil diubah');
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
        Jadwal::find($id)->delete();
        return redirect()->route('jadwal.index')->with('info','Jadwal Berhasil dihapus');
    }
}
