@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    @if(session('msg')){!! session('msg')  !!} @endif
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
            </div>
            <div class="card-body">
                <div class="empty-state" data-height="400">
                    <div class="empty-state-icon">
                        @if($checkNow) <i class="fas fa-file-alt"></i> @else <i class="fas fa-file"></i>  @endif
                    </div>
                    <h2>@if($checkNow) Laporan Sudah dibuat @else Laporan Belum ada @endif</h2>
                    <p class="lead">
                        @if($checkNow)
                        Pada hari <b>{{ Helper::convertDate(strftime('%A')) }}</b> tertanggal <b>{{ Helper::time(date('Y-m-d')) }}</b> Anda telah membuat laporan kerja harian</b>.
                        @else
                        Pada hari <b>{{ Helper::convertDate(strftime('%A')) }}</b> tertanggal <b>{{ Helper::time(date('Y-m-d')) }}</b> Anda belum membuat laporan kerja harian.
                        @endif
                    </p>
                    @empty($checkNow->finish_work)
                    @if($checkNow)<a href="{{ url('laporan/' . $checkNow->daily_work_report_id) }}" class="btn btn-primary mt-4 btn-lg"> Ubah Laporan @else <a href="{{ url('laporan/create') }}" class="btn btn-primary mt-4 btn-lg"> Buat Laporan @endif</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Riwayat Laporan Bulan Ini</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover table-data">
                    <thead>
                        <th>Tanggal</th>
                        <th>Aktivitas</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ Helper::time($report->date_work) }}</td>
                            <td>{{ $report->activity()->count() }}</td>
                            <td><a href="{{ url('/laporan/' . $report->daily_work_report_id) }}" class="btn btn-primary btn-sm">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
