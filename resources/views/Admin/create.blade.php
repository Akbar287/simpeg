@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12">
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
                                    <div class="input-group">
                                        <select class="custom-select selector-{{$admin->user_id}}">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->name == 'admin' ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button @if($admin->user_id == Auth::user()->user_id) disabled @endif data-id="{{ $admin->user_id }}" class="btn btn-primary btn-change-role">Pilih</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
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
                                    <div class="input-group">
                                        <select class="custom-select selector-{{$employee->user_id}}">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->name == 'pegawai' ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button @if($employee->user_id == Auth::user()->user_id) disabled @endif data-id="{{ $employee->user_id }}" class="btn btn-primary btn-change-role">Pilih</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Pimpinan</h4>
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
                            @foreach($leaders as $leader)
                            <tr>
                                <td>{{$loop->iteration  }}</td>
                                <td>{{ $leader->nip }}</td>
                                <td>{{ $leader->name }}</td>
                                <td>
                                    <div class="input-group">
                                        <select class="custom-select selector-{{$leader->user_id}}">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->name == 'pimpinan' ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button @if($leader->user_id == Auth::user()->user_id) disabled @endif data-id="{{ $leader->user_id }}" class="btn btn-primary btn-change-role">Pilih</button>
                                        </div>
                                    </div>
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
