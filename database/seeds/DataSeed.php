<?php

use Illuminate\Database\Seeder;

class DataSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $jurusan = ['Sistem Informasi','Teknik Informatika','Manajemen Informatika'];
        $kelas =['Pagi','Sore'];
        $ajaran = ['Genap','Ganjil'];
        $hari = ['Mon', 'Tue','Wed','Thu','Fri','Sat'];
       	$faker = Faker\Factory::create();

        App\Models\Dosen::truncate();
        App\Models\Mahasiswa::truncate();
        App\Models\MataKuliah::truncate();
        App\User::truncate();

        App\User::create([
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ]);
        $bobot = ['A' => 4,'B' => 3,'C' => 2,'D' => 1,'E' => 0];
        foreach ($bobot as $key => $value) {
            App\Models\Bobot::create([
                    'bobot' => $value,
                    'nilai' => $key,
                ]);
        }
        foreach(range(1,20) as $index)  
        {  
            $kd_dosen = 'D'.$faker->unique()->randomNumber($nbDigits = 3);
            $duser_id = App\User::create([
               'username' => $kd_dosen,
                'password' => bcrypt($kd_dosen),
                'role' => 'dosen'
            ])->id;
            App\Models\Dosen::create([  
                'kode_dosen' => $kd_dosen,
				'nidn' => $faker->unique()->randomNumber($nbDigits = 5),
				'nama_dosen' => $faker->name,
                'user_id' => $duser_id,
            ]);  
            $id = App\Models\Dosen::pluck('id')->toArray();
            $nim = $faker->unique()->randomNumber($nbDigits = 5);
            $muser_id = App\User::create([
                            'username' => $nim,
                            'password' => bcrypt($nim),
                            'role' => 'mahasiswa'
                        ])->id;
            App\Models\Mahasiswa::create([
                'nim' => $nim,
                'nama_mahasiswa' => $faker->name,
                'angkatan' => $faker->year($max = 'now'),
                'jurusan' => $faker->randomElement($array = $jurusan),
                'kelas_program' => $faker->randomElement($array = $kelas),
                'dosen_id' => $faker->randomElement($array = $id),
                'user_id' => $muser_id,
            ]);

            App\Models\MataKuliah::create([
                'kd_mk' => $faker->unique()->randomNumber($nbDigits = 6),
                'nama_mk' => $faker->unique()->company,
                'sks' => mt_rand(1,6),
                'semester' => mt_rand(1,8),
                'prasyarat_mk' => NULL,
                'jurusan' => $faker->randomElement($array = $jurusan)
            ]);

            App\Models\Ruang::create([
                'nama_ruang' => $faker->unique()->city,
            ]);

            $tgl_awal = $faker->unique()->date($format = 'Y-m-d',$max= 'now');
            $tgl_akhir_dt = $faker->unique()->dateTimeInInterval($startDate = $tgl_awal, $interval = '+ 1 years', $timezone = date_default_timezone_get());
            $tgl_akhir = date('Y-m-d',strtotime($tgl_akhir_dt->date));
            $tgl_kuliah_dt = $faker->dateTimeBetween($startDate = $tgl_awal, $endDate = strtotime($tgl_akhir), $timezone = date_default_timezone_get());
            $tgl_kuliah = $tgl_kuliah_dt->format('Y-m-d');
            $rand_ajaran = $faker->randomElement($array = $ajaran);
            $kd_ajaran = $rand_ajaran.'-'.date('Y',strtotime($tgl_awal)).'/'.date('Y',strtotime('+1 years',strtotime($tgl_awal)));
            $keterangan = $rand_ajaran .' '.date('Y',strtotime($tgl_awal)).' - '.date('Y',strtotime('+1 years',strtotime($tgl_awal)));

            $thnajaran = App\Models\ThnAjaran::create([
                'kd_tahun' => $kd_ajaran,
                'keterangan' => $keterangan,
                'tgl_kuliah' => $tgl_kuliah,
                'tgl_awal_perwalian' => $tgl_awal,
                'tgl_akhir_perwalian' => $tgl_akhir,
                'status' => rand(0,1),
                ]);
            if($thnajaran->status == 1){
                App\Models\ThnAjaran::where('id','!=',$thnajaran->id)->update(['status' => 0]);
            }
        }

        $max_mk_id = App\Models\MataKuliah::count();
        $max_dosen_id = App\Models\Dosen::count();
        $max_ruang_id = App\Models\Ruang::count();
        $max_thnajaran_id = App\Models\ThnAjaran::where('status',1)->get();
        foreach(range(1,20) as $index)  
        { 
            App\Models\Jadwal::create([
                'mk_id' => mt_rand(1,$max_mk_id),
                'dosen_id' => mt_rand(1,$max_dosen_id),
                'thnajaran_id' => $max_thnajaran_id->first()->id,
                'hari' => $faker->randomElement($hari),
                'waktu_mulai' => $faker->time($format = 'H:i:s', $max = 'now'),
                'waktu_selesai' => $faker->time($format = 'H:i:s', $max = 'now'),
                'program' => $faker->randomElement($array = $kelas),
                'kelas' => strtoupper($faker->randomLetter),
                'kapasitas' => $faker->numberBetween($min = 1, $max = 100),
                'ruang_id' => mt_rand(1,$max_ruang_id),
            ]);
        }
    }
}
