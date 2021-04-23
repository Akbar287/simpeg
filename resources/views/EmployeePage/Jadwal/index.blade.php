@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    @if(session('msg')){!! session('msg')  !!} @endif
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Jadwal Kerja Bulan Ini</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-data">
                        <thead>
                            <th>Tanggal</th>
                            <th>Jenis Kerja</th>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr {{ ($schedule->hari_kerja == date('Y-m-d') ? 'style="background: rgba(74, 168, 231, 0.219)"' : '') }}>
                                <td>{{ Helper::time($schedule->hari_kerja) }}</td>
                                <td>{{ $schedule->jenis_kerja }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
