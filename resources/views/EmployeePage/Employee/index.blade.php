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
                                <img width="300" class="img-responsive img-thumbnail" src="{{  asset('../images/profile/employee/'.$employee->profile_photo) }}" alt="Foto Profil" />
                                <div class="m-2 text-center">
                                    @if($employee->signature()->first())
                                    <button class="btn btn-primary btn-show-sig">Tampilkan TTD</button>
                                    <div class="kbw-signature" style="width: 300px;margin: 20px 0; height: 240px;border: 1px solid rgba(59, 53, 53, 0.233);display:none;" ></div>
                                    @else
                                    <a class="btn btn-primary" href="{{ url('pribadi/ttd') }}">Daftarkan TTD</a>
                                    @endif
                                    @if($employee->user_id == Auth::user()->user_id) <div class="row btn-sig">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" id="clear" style="display:none;">Hapus</button>
                                            <button class="btn btn-primary btn-save-signature" data-id="{{ Auth::user()->user_id }}" style="display:none;">Simpan TTD</button>
                                        </div>
                                    </div>
                                    @endif
                                    <p style="display: none;" class="text-muted"></p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="ml-5">
                                    <h1 class="">{{$employee->name}}</h1>
                                    <p class="text-muted">{{ ($employee->employment()->first() ? $employee->employment()->first()->toArray()['employment_name'] : '-') }}</p>
                                    <hr>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="text-right">Jenis Kelamin</td>
                                                <td class="pl-3">{{ $employee->gender }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Tempat, Tanggal Lahir</td>
                                                <td class="pl-3">{{ $employee->place_born . ', '.Helper::time($employee->date_born) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Umur</td>
                                                <td class="pl-3">{{ Helper::age($employee->date_born) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Gol. Darah</td>
                                                <td class="pl-3">{{ $employee->blood_type }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Agama</td>
                                                <td class="pl-3">{{ $employee->religion }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Status pernikahan</td>
                                                <td class="pl-3">{{ $employee->marital_status }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">No. Telp</td>
                                                <td class="pl-3">{{ $employee->telephone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Email</td>
                                                <td class="pl-3">{{ $employee->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Alamat</td>
                                                <td class="pl-3">{{ $employee->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Golongan</td>
                                                <td class="pl-3">{{ ($employee->occupation_group()->first() ? $employee->occupation_group()->first()->toArray()['occupation_group_name'] : '-') }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Unit Kerja</td>
                                                <td class="pl-3">{{ ($employee->work_unit()->first() ? $employee->work_unit()->first()->toArray()['work_unit_name'] : '-') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="my-3">
                                        @if($employee->user_id == Auth::user()->user_id) <button class="btn btn-info" id="btn-change-pw">Ganti Password</button> @endif
                                        @if($employee->user_id == Auth::user()->user_id) <a class="btn btn-primary" href="{{ url('pribadi/photo') }}">Ubah Foto</a> @endif
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
