@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Data Admin</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <img width="300" class="img-responsive img-thumbnail" src="{{  asset('../images/profile/employee/'.$admin->profile_photo) }}" alt="Foto Profil" />
                            </div>
                            <div class="col-md-9">
                                <div class="ml-5">
                                    <h1 class="">{{$admin->name}}</h1>
                                    <p class="text-muted">{{ ($admin->employment()->first() ? $admin->employment()->first()->toArray()['employment_name'] : '-') }}</p>
                                    <hr>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="text-right">Jenis Kelamin</td>
                                                <td class="pl-3">{{ $admin->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Tempat, Tanggal Lahir</td>
                                                <td class="pl-3">{{ $admin->place_born . ', '.Helper::time($admin->date_born) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Umur</td>
                                                <td class="pl-3">{{ Helper::age($admin->date_born) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Gol. Darah</td>
                                                <td class="pl-3">{{ $admin->blood_type }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Agama</td>
                                                <td class="pl-3">{{ $admin->religion }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Status pernikahan</td>
                                                <td class="pl-3">{{ $admin->marital_status }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">No. Telp</td>
                                                <td class="pl-3">{{ $admin->telephone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Email</td>
                                                <td class="pl-3">{{ $admin->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Alamat</td>
                                                <td class="pl-3">{{ $admin->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Golongan</td>
                                                <td class="pl-3">{{ ($admin->occupation_group()->first() ? $admin->occupation_group()->first()->toArray()['occupation_group_name'] : '-') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Unit Kerja</td>
                                                <td class="pl-3">{{ ($admin->work_unit()->first() ? $admin->work_unit()->first()->toArray()['work_unit_name'] : '-') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="my-3">
                                        @if($admin->user_id == Auth::user()->user_id) <button class="btn btn-info" id="btn-change-pw">Ganti Password</button> @else <button class="btn btn-info btn-reset-pw-employee">Password Reset ke 123</button> @endif
                                        @if($admin->user_id == Auth::user()->user_id) <a href="{{ url('admin/photo') }}" title="Ubah Foto" class="btn btn-success">Ubah Foto</a> @endif
                                        @if($admin->user_id == Auth::user()->user_id) <a href="{{ url('admin/' . $admin->user_id . '/edit') }}" title="Ubah Data" class="btn btn-primary">Ubah Data</a> @endif
                                        @if($admin->user_id == Auth::user()->user_id) <a href="{{ url('admin/ttd') }}" title="Ubah Data" class="btn btn-primary">Ubah TTD Digital</a> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form class="modal-part" id="modal-change-password"><div class="form-group"><label>Password</label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-key"></i></div></div><input type="password" class="form-control input-password" autocomplete="off" name="text"></div></div><div class="form-group"><label>Konfirmasi Password</label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-key"></i></div></div><input type="password" class="form-control input-password-confirm" autocomplete="off" name="text"></div><div><p class="text-muted">Password harus memiliki panjang 8-12 karakter</p></div></div></form>
@endsection
