@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
                <div class="card-header-action">
                    <a href="{{ url('/pegawai/'. $employee->user_id .'/cuti/create') }}" class="btn btn-primary add-wu">Tambah Data</a>
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
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Berakhir</th>
                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->furlough()->get() as $furlough)
                                    <tr>
                                        <td>{{ $furlough->furlough_id }}</td>
                                        <td>{{ Helper::time($furlough->start_date) }}</td>
                                        <td>{{ Helper::time($furlough->finish_date) }}</td>
                                        <td>{{ Helper::statusFurlough($furlough->status) }}</td>
                                        <td><a href="{{ url('/pegawai/'.$employee->user_id . '/cuti/'.$furlough->furlough_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
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
