@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
                <div class="card-header-action">
                    <a href="{{ url('/izincuti/create') }}" class="btn btn-primary add-wu">Ajukan Cuti</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-data">
                        <thead>
                            <th>No</th>
                            <th>Mulai Cuti</th>
                            <th>Selesai Cuti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach(Auth::user()->furlough()->get() as $furlough)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Helper::time($furlough->start_date) }}</td>
                                <td>{{ Helper::time($furlough->finish_date) }}</td>
                                <td>{{ Helper::statusFurlough($furlough->status) }}</td>
                                <td><a href="{{ url('/izincuti/' . $furlough->furlough_id) }}" class="btn btn-primary btn-sm">Detail</a></td>
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
