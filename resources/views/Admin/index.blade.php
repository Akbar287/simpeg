@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ Route::currentRouteName() }}</h4>
                <div class="card-header-action">
                    <a href="{{ url('/admin/create') }}" class="btn btn-primary">Atur Admin</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-data">
                        <thead>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{$loop->iteration  }}</td>
                                <td><figure class="avatar mr-2 avatar-xl"><img src="{{ asset('/images/profile/employee/'.$admin->profile_photo) }}" alt="{{ $admin->name }}" class="img-thumbnail img-responsive" /></figure></td>
                                <td>{{ $admin->nip }}</td>
                                <td>{{ $admin->name }}</td>
                                <td><a href="{{ url('/admin/' . $admin->user_id) }}" class="btn btn-primary btn-sm rounded" title="Detail"><i class="fas fa-file-alt"></i> Detail</a></td>
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
