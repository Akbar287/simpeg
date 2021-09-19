@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Menu</h4>
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
                            <h4>Laporan Kerja Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <a class="menu-a" href="{{ url('/reporting/working') }}">Laporan Kerja</a>
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
                            <h4>Laporan Absensi </h4>
                        </div>
                        <div class="card-body">
                            <a class="menu-a" href="{{ url('/reporting/attendance') }}">Laporan Absensi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
