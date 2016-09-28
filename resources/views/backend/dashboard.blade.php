@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
                    <p>Selamat Datang di Sistem Perwalian Intranet Online STIKOM PGRI Banyuwangi. Setelah melakukan login pertama kali ke Sistem Perwalian Intranet Online ini, harap segera melakukan pergantian password pada menu Pengaturan Akun, guna menanggulangi hal-hal yang tidak diinginkan.</p>
                    <div id="list">
                        <ul>
                            <li><strong>Persetujuan Kartu Rencana Studi KRS</strong><br>Untuk Melakukan Persetujuan KRS Pada Mahasiswa Yang Dibimbing</li>
                            <li><strong>Daftar Mahasiswa Bimbingan</strong><br>Melihat daftar mahasiswa yang masuk dalam bimbingan Dosen PA</li>
                            <li><strong>Nilai Mahasiswa</strong><br>Mengisi nilai mahasiswa yang dibimbing</li>
                            <li><strong>Log Out</strong><br>Keluar dari sistem perwalian online</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection