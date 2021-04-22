@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Pegawai</h4>
                <div class="card-header-action">
                    <a href="{{ url('/pegawai/create') }}" class="btn btn-primary">Tambah Pegawai</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-employees">
                        <thead>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$loop->iteration  }}</td>
                                <td><figure class="avatar mr-2 avatar-xl"><img src="{{ asset('/images/profile/employee/'.$employee->profile_photo) }}" alt="{{ $employee->name }}" class="img-thumbnail img-responsive" /></figure></td>
                                <td>{{ $employee->nip }}</td>
                                <td>{{ $employee->name }}</td>
                                <td><a href="{{ url('/pegawai/' . $employee->user_id) }}" class="btn btn-primary btn-sm rounded" title="Detail"><i class="fas fa-file-alt"></i> Detail</a></td>
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
