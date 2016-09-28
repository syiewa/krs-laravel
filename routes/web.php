<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/',function(){
	return view('auth.login');
})->middleware('guest');

// Routing untuk authentifikasi
Route::group(['namespace' => 'auth'],function(){
	Route::post('/login','LoginController@login')->name('login');
    Route::get('/logout',function(){
        Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::get('admin/resetpassword','LoginController@resetpass')->name('admin.resetpass')->middleware('admin');
    Route::get('mahasiswa/resetpassword','LoginController@resetpass')->name('mahasiswa.resetpass')->middleware('mahasiswa');
    Route::get('dosen/resetpassword','LoginController@resetpass')->name('dosen.resetpass')->middleware('dosen');
    Route::post('resetpassword','LoginController@reset')->name('reset');
});

// Routing untuk user level admin
Route::group(['namespace' => 'backend','prefix' => 'admin','middleware' => 'admin'], function() {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Route::get('/matakuliah/{id}/dosen','MkCtrl@dosen')->name('matakuliah.dosen');
    Route::get('/dosen/{id}/matakuliah','DosenCtrl@matakuliah')->name('dosen.matakuliah');
    Route::get('/', function () {
	    return view('backend.dashboard',['title' => 'Dashboard']);
	})->name('admin');
    Route::resource('dosen','DosenCtrl');
    Route::resource('mahasiswa','MhsCtrl');
    Route::resource('matakuliah','MkCtrl');
    Route::resource('ruang','RuangCtrl');
    Route::resource('jadwal','JadwalCtrl');
    Route::resource('thnajaran','TACtrl');

});

// Routing untuk user level mahasiswa
Route::group(['namespace' => 'mahasiswa','prefix' => 'mahasiswa','middleware' => 'mahasiswa'], function() {
    Route::get('/', function () {
        return view('mahasiswa.dashboard',['title' => 'Dashboard']);
    })->name('mahasiswa');

    Route::resource('krs','KrsCtrl');
    Route::get('krs/{id}/peserta','KrsCtrl@peserta')->name('krs.peserta');
    Route::get('krs/{id}/calonpeserta','KrsCtrl@show')->name('krs.calonpeserta');
    Route::resource('khs','KhsCtrl');

});

// Routing untuk user level dosen
Route::group(['namespace' => 'dosen','prefix' => 'dosen','middleware' => 'dosen'], function() {
    Route::get('/', function () {
        return view('dosen.dashboard',['title' => 'Dashboard']);
    })->name('dosen');

    Route::resource('persetujuan','DosenKrsCtrl');
    Route::resource('nilai','NilaiCtrl');
    Route::get('nilai/{id}/nilaiedit','NilaiCtrl@editnilai')->name('nilai.nilaiedit');
});
//Auth::routes();

Route::get('/home', 'HomeController@index');
