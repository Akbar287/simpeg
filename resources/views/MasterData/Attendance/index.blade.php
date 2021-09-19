@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
                <div class="card-header-action">
                    @if(Auth::user()->role()->first()->name != 'pimpinan') <a href="{{ url('/absensi/create') }}" class="btn btn-primary">Tambah Data</a> @endif
                    <button class="btn btn-primary" id="print_attendance">Cetak</button>
                </div>
            </div>
            <form class="modal-part" id="modal-print">
                <p>Cetak Laporan Absensi Pegawai</p>
                <div class="form-group">
                    <label for="employee">Pegawai</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <select class="custom-select" name="user" id="employee">
                            @foreach($users as $user)
                            <option value="{{$user->user_id}}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('employee') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="date">Periode</label>
                        <div class="input-group">
                            <div class="input-group input-daterange">
                                <input class="form-control" type="month" value="{{ date('Y-m') }}" name="date" id="date">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                @if(Auth::user()->role()->first()->name == 'pimpinan')<form action="{{urL('/reporting/attendance')}}" method="get"> @else <form action="{{urL('/absensi')}}" method="get"> @endif @csrf
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
                                        <td>@if(Auth::user()->role()->first()->name == 'pimpinan')<a href="{{ url('/reporting/attendance/'.$attendance->attendance_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a>@else <a href="{{ url('/absensi/'.$attendance->attendance_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a> @endif</td>
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
