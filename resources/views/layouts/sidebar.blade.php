@if(Auth::check())
<div class="sidebar" data-background-color="white" data-active-color="danger">
    <div class="sidebar-wrapper">

            @if(Auth::user()->role == 'admin')
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Selamat Datang {{Auth::user()->username}}
                </a>
            </div>

            <ul class="nav">
            <li class="{{Request::segment(2) == '' ? 'active' : ''}}">
                <a href="{{route('admin')}}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'dosen' ? 'active' : ''}}">
                <a href="{{route('dosen.index')}}">
                    <i class="ti-view-list-alt"></i>
                    <p>Dosen</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'mahasiswa' ? 'active' : ''}}">
                <a href="{{route('mahasiswa.index')}}">
                    <i class="ti-text"></i>
                    <p>Mahasiswa</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'matakuliah' ? 'active' : ''}}">
                <a href="{{route('matakuliah.index')}}">
                    <i class="ti-pencil-alt2"></i>
                    <p>Mata Kuliah</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'ruang' ? 'active' : ''}}">
                <a href="{{route('ruang.index')}}">
                    <i class="ti-map"></i>
                    <p>Ruang</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'jadwal' ? 'active' : ''}}">
                <a href="{{route('jadwal.index')}}">
                    <i class="ti-bell"></i>
                    <p>Jadwal Kuliah</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'thnajaran' ? 'active' : ''}}">
                <a href="{{route('thnajaran.index')}}">
                    <i class="ti-bell"></i>
                    <p>Tahun Ajaran</p>
                </a>
            </li>
            @elseif(Auth::user()->role == 'mahasiswa')
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Selamat Datang {{Auth::user()->mahasiswa->nama_mahasiswa}}
                </a>
            </div>

            <ul class="nav">
            <li class="{{Request::segment(2) == '' ? 'active' : ''}}">
                <a href="{{route('mahasiswa')}}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'krs' ? 'active' : ''}}">
                <a href="{{route('krs.index')}}">
                    <i class="ti-panel"></i>
                    <p>Kartu Rencana Studi</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'khs' ? 'active' : ''}}">
                <a href="{{route('khs.index')}}">
                    <i class="ti-panel"></i>
                    <p>Kartu Hasil Studi</p>
                </a>
            </li>
            @else
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Selamat Datang {{Auth::user()->dosen->nama_dosen}}
                </a>
            </div>

            <ul class="nav">
            <li class="{{Request::segment(2) == '' ? 'active' : ''}}">
                <a href="{{route('dosen')}}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'persetujuan' ? 'active' : ''}}">
                <a href="{{route('persetujuan.index')}}">
                    <i class="ti-panel"></i>
                    <p>Persetujuan KRS</p>
                </a>
            </li>
            <li class="{{Request::segment(2) == 'nilai' ? 'active' : ''}}">
                <a href="{{route('nilai.index')}}">
                    <i class="ti-panel"></i>
                    <p>Input Nilai</p>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
@endif