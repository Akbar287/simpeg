@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Mutasi</h4>
                <div class="card-header-action">
                    <a href="{{ url('/izinmutasi/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-data">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Unit Kerja</th>
                                        <th>Waktu Dibuat</th>
                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::user()->mutation()->get() as $mutation)
                                    <tr>
                                        <td>{{ $mutation->mutation_id }}</td>
                                        <td>{{ $mutation->new_work_unit }}</td>
                                        <td>{{ Helper::time($mutation->date_mutation) }}</td>
                                        <td>{{ Helper::statusMutation($mutation->status) }}</td>
                                        <td><a href="{{ url('izinmutasi/'.$mutation->mutation_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
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
