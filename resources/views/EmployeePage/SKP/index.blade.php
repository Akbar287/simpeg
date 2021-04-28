@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Sasaran kinerja Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-hover table-data">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Awal Periode</th>
                                        <th>Akhir Periode</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::user()->employee_work_objective()->get() as $skp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Helper::time($skp->start_date) }}</td>
                                        <td>{{ Helper::time($skp->finish_date) }}</td>
                                        <td>{{ $skp->rating_result }}</td>
                                        <td><a href="{{ url('kinerja/'.$skp->employee_work_objective_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
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
