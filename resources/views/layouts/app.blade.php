<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NICT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @if(isset($title)) @if($title == 'Absensi' && Auth::user()->role()->first()->name == 'pegawai')<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>@endif @endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('images/logo.ico') }}" type="image/x-icon">

    <!-- Google Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="div-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="Employee" src="{{ asset('/images/profile/employee/' . Auth::user()->profile_photo) }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('/images/logo/logo.svg') }}" alt="logo" class="img-responsive" width="30"></a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('/images/logo/logo.svg') }}" alt="logo" class="img-responsive" width="30">
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ (Route::currentRouteName() == 'Dashboard') ? 'active': '' }}"><a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                        @if(Auth::user()->role()->first()->name == 'admin')
                        <li class="{{ (Route::currentRouteName() == 'Admin') ? 'active': '' }}"><a class="nav-link" href="{{ url('/admin') }}"><i class="fas fa-user-circle"></i><span>Data Admin</span></a></li>
                        <li class="menu-header">Kepegawaian</li>
                        <li class="nav-item dropdown {{ (Route::currentRouteName() == 'Jabatan' || Route::currentRouteName() == 'Golongan' || Route::currentRouteName() == 'Unit Kerja') ? 'active' : '' }}">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i><span>Data Master</span></a>
                            <ul class="dropdown-menu">
                                <li class="{{ (Route::currentRouteName() == 'Jabatan') ? 'active': '' }} "><a class="nav-link" href="{{ url('/jabatan') }}">Jabatan</a></li>
                                <li class="{{ (Route::currentRouteName() == 'Golongan') ? 'active': '' }} "><a class="nav-link" href="{{ url('/golongan') }}">Golongan</a></li>
                                <li class="{{ (Route::currentRouteName() == 'Unit Kerja') ? 'active': '' }} "><a class="nav-link" href="{{ url('/unitkerja') }}">Unit Kerja</a></li>
                            </ul>
                        </li>
                        <li class="{{ (Route::currentRouteName() == 'Pegawai') ? 'active': '' }}"><a class="nav-link" href="{{ url('/pegawai') }}"><i class="fas fa-users"></i><span>Data Pegawai</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Mutasi') ? 'active': '' }}"><a class="nav-link" href="{{ url('/mutation') }}"><i class="fas fa-id-card"></i><span>Mutasi</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Absensi') ? 'active': '' }}"><a class="nav-link" href="{{ url('/absensi') }}"><i class="fas fa-calendar-check"></i><span>Absensi</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Cuti') ? 'active': '' }} "><a class="nav-link" href="{{ url('/cuti') }}"><i class="fas fa-calendar-minus"></i><span>Cuti</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Laporan Kerja Harian') ? 'active': '' }} "><a class="nav-link" href="{{ url('/laporankerja') }}"><i class="fas fa-pen"></i><span>Laporan Kerja Harian</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Jadwal') ? 'active': '' }} "><a class="nav-link" href="{{ url('/jadwalkerja') }}"><i class="fas fa-calendar-alt"></i><span>Jadwal Kerja Pegawai</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Sasaran Kinerja Pegawai') ? 'active': '' }} "><a class="nav-link" href="{{ url('/skp') }}"><i class="fas fa-check"></i><span>Kinerja Pegawai</span></a></li>

                        @elseif(Auth::user()->role()->first()->name == 'pimpinan')
                        <li class="{{ (Route::currentRouteName() == 'Absensi') ? 'active': '' }}"><a class="nav-link" href="{{ url('/reporting/attendance') }}"><i class="fas fa-calendar-check"></i><span>Laporan Absensi</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Laporan Kerja Harian') ? 'active': '' }} "><a class="nav-link" href="{{ url('/reporting/working') }}"><i class="fas fa-pen"></i><span>Laporan Kerja Harian</span></a></li>

                        @else
                        <li class="{{ (Route::currentRouteName() == 'Pegawai') ? 'active': '' }}"><a class="nav-link" href="{{ url('/pribadi') }}"><i class="fas fa-users"></i><span>Data Pegawai</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Mutasi') ? 'active': '' }}"><a class="nav-link" href="{{ url('/izinmutasi') }}"><i class="fas fa-id-card"></i><span>Mutasi</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Absensi') ? 'active': '' }}"><a class="nav-link" href="{{ url('/absen') }}"><i class="fas fa-calendar-check"></i><span>Absensi</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Cuti') ? 'active': '' }} "><a class="nav-link" href="{{ url('/izincuti') }}"><i class="fas fa-calendar-minus"></i><span>Cuti</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Laporan Kerja Harian') ? 'active': '' }} "><a class="nav-link" href="{{ url('/laporan') }}"><i class="fas fa-pen"></i><span>Laporan Kerja Harian</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Jadwal') ? 'active': '' }} "><a class="nav-link" href="{{ url('/jadwal') }}"><i class="fas fa-calendar-alt"></i><span>Jadwal Kerja Pegawai</span></a></li>
                        <li class="{{ (Route::currentRouteName() == 'Sasaran Kinerja Pegawai') ? 'active': '' }} "><a class="nav-link" href="{{ url('/kinerja') }}"><i class="fas fa-check"></i><span>Kinerja Pegawai</span></a></li>
                        @endif
                    </ul>
                </aside>
            </div>
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    NICT {{ now()->year }} <div class="bullet"></div> Sistem Kepegawaian
                </div>
            </footer>
        </div>
    </div>
</body>

</html>
