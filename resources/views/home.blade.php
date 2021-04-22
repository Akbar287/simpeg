@extends('layouts.app')

@section('content')

@if(Auth::user()->role()->first()->name == 'admin')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Selamat Datang</h4>
                </div>
                <div class="card-body">
                    {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Admin</h4>
                </div>
                <div class="card-body">
                    {{$admin}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pegawai</h4>
                </div>
                <div class="card-body">
                    {{$employee}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pensiun</h4>
                </div>
                <div class="card-body">
                    {{$pensiun}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Cuti</h4>
                </div>
                <div class="card-body">
                    {{$furlough}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Golongan</h4>
            </div>
            <div class="card-body">
                <div style="width: 100%; height: 100%;" id="occupation-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Jabatan</h4>
            </div>
            <div class="card-body">
                <div style="width: 100%; height: 100%;" id="employment-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Pendidikan</h4>
            </div>
            <div class="card-body">
                <div style="width: 100%; height: 100%;" id="education-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Unit Kerja</h4>
            </div>
            <div class="card-body">
                <div style="width: 100%; height: 100%;" id="work-chart"></div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Selamat Datang</h4>
                </div>
                <div class="card-body">
                    {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4>Menu Pegawai</h4>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-menu">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Ubah Data Pribadi</h4>
                </div>
                <div class="card-body">
                    <a class="menu-a" href="{{ url('/pribadi') }}">Data Pribadi</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-menu">
            <div class="card-icon bg-primary">
                <i class="far fa-id-card"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Ajukan dan lihat proses Mutasi</h4>
                </div>
                <div class="card-body">
                    <a class="menu-a" href="{{ url('/izinmutasi') }}">Mutasi</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-menu">
            <div class="card-icon bg-primary">
                <i class="far fa-calendar-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Catat Kehadiran </h4>
                </div>
                <div class="card-body">
                    <a class="menu-a" href="{{ url('/absen') }}">Absensi</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-menu">
            <div class="card-icon bg-primary">
                <i class="far fa-calendar-minus"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Ajukan dan lihat proses Cuti </h4>
                </div>
                <div class="card-body">
                    <a class="menu-a" href="{{ url('/izincuti') }}">Cuti</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-menu">
            <div class="card-icon bg-primary">
                <i class="fas fa-pen"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Buat Laporan kerja setiap hari</h4>
                </div>
                <div class="card-body">
                    <a class="menu-a" href="{{ url('/laporan') }}">Laporan Kerja Harian</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 card-menu">
            <div class="card-icon bg-primary">
                <i class="far fa-calendar"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Lihat Jadwal kerja yang sudah ditetapkan</h4>
                </div>
                <div class="card-body">
                    <a class="menu-a" href="{{ url('/jadwal') }}">Jadwal Kerja</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
