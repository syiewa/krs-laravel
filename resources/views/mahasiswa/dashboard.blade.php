@extends('layouts.layout')

@section('content')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$title}}</h4>
                    <p class="category"></p>
                </div>
                <div class="content">
                    <p>Selamat Datang di Sistem Perwalian Kampus Naskeleng. Setelah melakukan login pertama kali ke Sistem Perwalian Intranet Online ini, harap segera melakukan pergantian password pada menu Pengaturan Akun, guna menanggulangi hal-hal yang tidak diinginkan.</p>
                    <div id="list">
                        <ul>
                            <li><strong>Kartu Rencana Studi</strong><br>Mengisi atau mengedit kartu rencana studi</li>
                            <li><strong>Kartu Hasil Studi</strong><br>Melihat nilai per semester yang telah ditempuh</li>
                            <li><strong>Info Kampus</strong><br>Melihat info seputar kampus dan perkuliahan</li>
                            <li><strong>Log Out</strong><br>Keluar dari sistem perwalian online</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endsection