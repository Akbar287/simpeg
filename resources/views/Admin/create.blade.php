@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Admin</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-data table-admin">
                        <thead>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{$loop->iteration  }}</td>
                                <td>{{ $admin->nip }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>
                                    <button @if($admin->user_id == Auth::user()->user_id) disabled @endif class="btn btn-remove-admin btn-sm btn-primary" data-id="{{ $admin->user_id }}">Jadikan Pegawai</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-data table-employee">
                        <thead>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$loop->iteration  }}</td>
                                <td>{{ $employee->nip }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>
                                    <button class="btn btn-add-admin btn-sm btn-primary" data-id="{{ $employee->user_id }}">Jadikan Admin</button>
                                </td>
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
