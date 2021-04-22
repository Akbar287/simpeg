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
                        @if($checkNow) @empty($checkNow->finish_work) <i class="fas fa-calendar-day"></i> @else <i class="fas fa-calendar-check"></i> @endif @else <i class="fas fa-calendar"></i>  @endif
                    </div>
                        <h2>@if($checkNow) @if($checkNow->kehadiran()->first()->kehadiran_id != 2) Kehadiran telah dicatat @else Absen Berhasil @endif @else @if($schedule) {{ $schedule->jenis_kerja }} @else Tidak Dijadwalkan @endif @endif</h2>
                        <p class="lead">
                            @if($checkNow)
                            @if($checkNow->kehadiran()->first()->kehadiran_id != 2)
                            Anda tidak masuk karena <b>{{ $checkNow->kehadiran()->first()->name }}</b> pada hari <b>{{ Helper::convertDate(strftime('%A')) }}</b> tertanggal <b>{{ Helper::time(date('Y-m-d')) }}</b>.
                            @else
                            Pada hari <b>{{ Helper::convertDate(strftime('%A')) }}</b> tertanggal <b>{{ Helper::time(date('Y-m-d')) }}</b> Anda telah bekerja secara <b>{{ $checkNow->jenis_kerja }}</b>. @empty($checkNow->finish_work) Jangan Lupa untuk mengisi Absen Penutup. @endif
                            @endif
                            @else
                            @if($schedule)
                            Pada hari <b>{{ Helper::convertDate(strftime('%A')) }}</b> tertanggal <b>{{ Helper::time(date('Y-m-d')) }}</b> Anda dijadwalkan bekerja secara <b>{{ ($schedule->jenis_kerja == 'WFO') ? $schedule->jenis_kerja . ' (Work From Office)' : $schedule->jenis_kerja . ' (Work From Home)'}}</b>.
                            @else Pada hari <b>{{ Helper::convertDate(strftime('%A')) }}</b> tertanggal <b>{{ Helper::time(date('Y-m-d')) }}</b> Anda <b>Tidak dijadwalkan</b> untuk bekerja. namun bisa melakukan absen dan tercatat di laporan.
                            @endif
                            @endif
                        </p>
                        @empty($checkNow->finish_work)
                        <div class="row">
                            <a href="{{ url('absen/create') }}" class="btn btn-primary mt-4 mx-2 btn-lg">@if($checkNow) Absen Penutup @else Absen @endif</a>
                            @if(!$checkNow)<a href="{{ url('absen/kehadiran') }}" class="btn mt-4 btn-lg mx-2 btn-info">Tidak Hadir</a>@endif
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Riwayat Absensi</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover table-data">
                    <thead>
                        <th>Tanggal</th>
                        <th>Jenis Kerja</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ Helper::time($attendance->date_work) }}</td>
                            <td>{{ ($attendance->kehadiran()->first()->kehadiran_id == 2) ? $attendance->jenis_kerja : '-' }}</td>
                            <td>{{ $attendance->kehadiran()->first()->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
