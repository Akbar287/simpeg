@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Sasaran kinerja Pegawai</h4>
                <div class="card-header-action">
                    <a href="{{ url('/skp/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <form action="{{ url('/skp') }}" method="get">@csrf
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-12 py-2 col-md-3">
                            <select name="employee" id="employee" class="custom-select">
                                <option value="0" {{ ("0" == $employeeID) ? 'selected': '' }}>Semua Pegawai</option>
                                @if(!is_null($employee) && !empty($employee)) @foreach($employee as $employ)
                                <option value="{{ $employ->user_id }}" {{ (($employ->user_id == $employeeID) ? "selected" : '') }}>{{ $employ->name .' - '. $employ->nip }}</option>
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
                                        <th>Awal Periode</th>
                                        <th>Akhir Periode</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $skp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Helper::time($skp->start_date) }}</td>
                                        <td>{{ Helper::time($skp->finish_date) }}</td>
                                        <td>{{ $skp->user()->first()->name }}</td>
                                        <td>{{ $skp->rating_result }}</td>
                                        <td><a href="{{ url('skp/'.$skp->employee_work_objective_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
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
