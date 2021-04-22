@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
                <div class="card-header-action">
                    <a href="{{ url('/absensi/create') }}" class="btn btn-primary">Tambah Data</a>
                    <a target="_blank" href="{{ url('/absensi/print?' . $dynamic_url) }}" class="btn btn-primary">Cetak</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <form action="{{ url('/absensi') }}" method="get">@csrf
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-12 py-2 col-md-3">
                            <select name="status" id="status" class="custom-select">
                                <option value="9" {{ ("9" == $statusID) ? 'selected': '' }}>Semua status</option>
                                @if(!is_null($status) && !empty($status)) @foreach($status as $statu)
                                <option value="{{ Helper::statusAttendanceArray($statu) }}" {{ (Helper::statusAttendanceArray($statu) == $statusID) ? 'selected': '' }}>{{ $statu }}</option>
                                @endforeach @endif
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 py-2 col-md-3">
                            <select name="employee" id="employee" class="custom-select">
                                <option value="0" {{ ("0" == $employeeID) ? 'selected': '' }}>Semua Pegawai</option>
                                @if(!is_null($employee) && !empty($employee)) @foreach($employee as $employ)
                                <option value="{{ $employ->user_id }}" {{ ($employ->user_id == $employeeID) ? 'selected': '' }}>{{ $employ->name . ' - ' . $employ->nip }}</option>
                                @endforeach @endif
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 py-2 col-md-6">
                            <div class="input-group input-daterange">
                                <input class="form-control" type="month" value="{{ $date }}" name="date" id="date">
                                <button class="btn btn-primary btn-sm mx-2" type="submit"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-hover table-data">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Kerja</th>
                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->name }}</td>
                                        <td>{{ Helper::time($attendance->date_work) }}</td>
                                        <td>{{ $attendance->jenis_kerja }}</td>
                                        <td>{{ $attendance->kehadiran_name }}</td>
                                        <td><a href="{{ url('/absensi/'.$attendance->attendance_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
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
