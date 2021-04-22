@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
                <div class="card-header-action">
                    <a href="{{ url('/pegawai/'. $employee->user_id .'/absensi/create') }}" class="btn btn-primary add-wu">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('msg')){!! session('msg')  !!} @endif
                        <div class="table-responsive">
                            <table class="table table-hover table-data">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Kerja</th>
                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->attendance()->get() as $attendance)
                                    <tr>
                                        <td>{{ $attendance->attendance_id }}</td>
                                        <td>{{ Helper::time($attendance->date_work) }}</td>
                                        <td>{{ $attendance->jenis_kerja }}</td>
                                        <td>{{ $attendance->kehadiran()->first()->toArray()['name'] }}</td>
                                        <td><a href="{{ url('/pegawai/'.$employee->user_id . '/absensi/'.$attendance->attendance_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
