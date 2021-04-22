@extends('layouts.app')

@section('content')

<div class="section-header">
    <h1>{{ Route::currentRouteName() }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Pegawai</div>
    </div>
</div>
<div class="row">
    <div class=" col-12">
        <div class="card card-shadow">
            <div class="card-header">
                <h4>Menu Kepegawaian</h4>
                <div class="card-header-action">
                    <b>{{ $employee->name . ' - ' .$employee->nip }}</b>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(isset($title)) @if($title == 'Keluarga')<div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id) }}" class="btn btn-sm btn-success btn-block">Kembali</a></div>@else <div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id . '/family') }}" class="btn btn-sm btn-primary btn-block">Keluarga</a></div> @endif
                    @if($title == 'Pendidikan')<div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id) }}" class="btn btn-sm btn-success btn-block">Kembali</a></div>@else <div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id . '/education') }}" class="btn btn-sm btn-primary btn-block">Pendidikan</a></div>@endif
                    @if($title == 'Mutasi')<div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id) }}" class="btn btn-sm btn-success btn-block">Kembali</a></div>@else <div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id . '/mutation') }}" class="btn btn-sm btn-primary btn-block">Mutasi</a></div>@endif
                    @if($title == 'Cuti')<div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id) }}" class="btn btn-sm btn-success btn-block">Kembali</a></div>@else <div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id . '/cuti') }}" class="btn btn-sm btn-primary btn-block">Cuti</a></div>@endif
                    @if($title == 'SKP')<div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id) }}" class="btn btn-sm btn-success btn-block">Kembali</a></div>@else <div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id . '/skp') }}" class="btn btn-sm btn-primary btn-block">SKP</a></div>@endif
                    @if($title == 'Absensi')<div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id) }}" class="btn btn-sm btn-success btn-block">Kembali</a></div>@else <div class="col-12 col-sm-6 col-md-2 mb-1"><a href="{{ url('pegawai/' . $employee->user_id . '/absensi') }}" class="btn btn-sm btn-primary btn-block">Absensi</a></div>@endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@yield('subcontent')
@endsection
