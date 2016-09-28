<?php

namespace App\Http\Controllers\mahasiswa;

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
use App\Models\Jadwal;
use DB;

class krsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] = 'Kartu Rencana Studi';
        $this->data['mahasiswa'] = Auth::user()->mahasiswa;
        $program = $this->data['mahasiswa']->kelas_program;
        $mahasiswa_id = Auth::user()->mahasiswa->id;
        $jurusan = Auth::user()->mahasiswa->jurusan;
        $this->data['thn_ajaran'] = ThnAjaran::where('status',1)->first();
        $this->data['peserta'] = Jadwal::Peserta();
        $this->data['calon_peserta'] = Jadwal::CalonPeserta();
        $this->data['semester'] = Nilai::whereHas('krsdetil',function($q) use($mahasiswa_id){
            $q->whereHas('krs',function($q) use ($mahasiswa_id) {
                $q->where('mahasiswa_id',$mahasiswa_id);
            });
        })->max('semester_ditempuh') + 1;
        $this->data['ipk'] = Nilai::Ipk($mahasiswa_id,$this->data['semester']);
        $this->data['beban_studi'] = Nilai::MaxSks($this->data['ipk']);
        $krs = Krs::where([['mahasiswa_id',$mahasiswa_id],['semester',$this->data['semester']]])->first();
        $this->data['matakuliah'] = MataKuliah::where('jurusan',$jurusan)->whereHas('jadwal', function ($query) use ($program) {
                                        $query->where('program',$program)->whereHas('thnajaran',function($query){
                                            $query->where('status',1);
                                        });
                                    })->with(['jadwal' => function($q) use ($program) {
                                        $q->where('program',$program)->whereHas('thnajaran',function($q){
                                            $q->where('status',1);
                                        });
                                    }])->get();
        $check = Krs::where([['mahasiswa_id',$mahasiswa_id],['thnajaran_id',$this->data['thn_ajaran']->id],['status',2]])->first();
/*        echo "<pre>".var_dump($check,true)."</pre>";

        echo "<pre>".print_r(DB::getQueryLog(),true)."</pre>";
        // die();*/
        if($check){
            $this->data['matakuliah'] = [];
        }
        if($krs){
            if($krs->status == 1){
                return redirect()->route('krs.edit',$krs->id);
            }
            $this->data['krs'] = $krs;
            $this->data['krs_jadwal'] = Krs::find($krs->id)->krsdetil->pluck('krs_id','jadwal_id')->toArray();
        }
        return view('mahasiswa.krs.index',$this->data);
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
        $input = $request->input('jadwal');
        $mahasiswa_id = Auth::user()->mahasiswa->id;
        $krs = Krs::updateOrCreate(
            [
                'mahasiswa_id' => $mahasiswa_id,
                'tgl_krs' => date('Y-m-d'),
                'semester' => Nilai::whereHas('krsdetil',function($q) use($mahasiswa_id){
                    $q->whereHas('krs',function($q) use ($mahasiswa_id) {
                        $q->where('mahasiswa_id',$mahasiswa_id);
                    });
                })->max('semester_ditempuh') + 1,
                'thnajaran_id' => ThnAjaran::where('status',1)->first()->id,
            ]);
        foreach($input as $key=>$value){
            KrsDetil::create(['krs_id' => $krs->id , 'jadwal_id' => $value]);
        }
        return redirect()->route('krs.index')->with('info','Kartu Rencana Studi berhasil disimpan...!!! Silahkan menghubungi bagian administrasi untuk melakukan pembayaran.');

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
        $this->data['mahasiswa'] = KrsDetil::where('jadwal_id',$id)->whereHas('krs' , function($q){
            $q->where('status',0);
        })->get();
        $nama_mk = $this->data['mahasiswa']->first()->jadwal->matakuliah->nama_mk;
        $nama_dosen = $this->data['mahasiswa']->first()->jadwal->dosen->nama_dosen;
        $this->data['title'] = "Daftar Calon Peserta Mata Kuliah ".$nama_mk." - Dosen ".$nama_dosen;
        return view('mahasiswa.krs.show',$this->data);
    }

    public function peserta($id){
        $this->data['mahasiswa'] = KrsDetil::where('jadwal_id',$id)->whereHas('krs' , function($q){
            $q->where('status',1);
        })->get();
        $nama_mk = $this->data['mahasiswa']->first()->jadwal->matakuliah->nama_mk;
        $nama_dosen = $this->data['mahasiswa']->first()->jadwal->dosen->nama_dosen;
        $this->data['title'] = "Daftar Peserta Mata Kuliah ".$nama_mk." - Dosen ".$nama_dosen;
        return view('mahasiswa.krs.show',$this->data);
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
        $this->data['title'] = 'Kartu Rencana Studi';
        $this->data['mahasiswa'] = Auth::user()->mahasiswa;
        $program = $this->data['mahasiswa']->kelas_program;
        $mahasiswa_id = Auth::user()->mahasiswa->id;
        $this->data['thn_ajaran'] = ThnAjaran::where('status',1)->first();
        $this->data['matakuliah'] = MataKuliah::whereHas('jadwal', function ($query) use ($program) {
                                        $query->where('program',$program)->whereHas('thnajaran',function($query){
                                            $query->where('status',1);
                                        });
                                    })->with('jadwal')->get();
        $this->data['peserta'] = Jadwal::Peserta();
        $this->data['calon_peserta'] = Jadwal::CalonPeserta();
        $this->data['semester'] = Nilai::whereHas('krsdetil',function($q) use ($mahasiswa_id){
            $q->whereHas('krs',function($q) use ($mahasiswa_id) {
                $q->where('mahasiswa_id',$mahasiswa_id);
            });
        })->max('semester_ditempuh') + 1;
        $this->data['ipk'] = Nilai::Ipk(Auth::user()->mahasiswa->id,$this->data['semester']);
        $this->data['beban_studi'] = Nilai::MaxSks($this->data['ipk']);
        return view('mahasiswa.krs.edit',$this->data)->with('info','Kartu Rencana Studi anda sudah disetujui. Untuk melakukan perubahan jadwal atau jadwal kuliah, silahkan hubungi dosen wali.');
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
        KrsDetil::where('krs_id',$id)->delete();
        $input = $request->input('jadwal');
        foreach($input as $key=>$value){
            KrsDetil::create(['krs_id' => $id, 'jadwal_id' => $value]);
        }
        return redirect()->route('krs.index')->with('info','KRS berhasil ditambahkan');
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
    }
}
