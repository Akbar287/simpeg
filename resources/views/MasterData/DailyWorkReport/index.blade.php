@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan Kerja</h4>
                <div class="card-header-action">
                    <a href="{{ url('/laporankerja/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <form action="{{ url('/laporankerja') }}" method="get">@csrf
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-12 py-2 col-md-6">
                            <select name="employee" id="status" class="custom-select">
                                <option value="0" {{ ("0" == $employeeID) ? 'selected': '' }}>Semua Pegawai</option>
                                @if(!is_null($employee) && !empty($employee)) @foreach($employee as $statu)
                                <option value="{{ $statu->user_id }}" {{ ($statu->user_id == $employeeID) ? 'selected': '' }}>{{ $statu->name . ' - '. $statu->nip }}</option>
                                @endforeach @endif
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 py-2 col-md-6">
                            <div class="input-group input-daterange">
                                <input class="form-control" type="date" value="{{ $date }}" name="date" id="date">
                                <button class="btn btn-primary btn-sm mx-2" type="submit"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-data">
                        <thead>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Aktivitas</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Helper::time($d->date_work) }}</td>
                                <td>{{ $d->nip }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ '2' }}</td>
                                <td><a href="{{ url('/laporankerja/' . $d->daily_work_report_id) }}" class="btn btn-primary btn-sm">Detail</a></td>
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
