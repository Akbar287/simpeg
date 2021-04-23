@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Data Pegawai</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <img width="300" class="img-responsive img-thumbnail" src="{{  asset('../images/profile/employee/'.$employee->profile_photo) }}" alt="Foto Profil" />
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
                                        <button class="btn btn-info btn-reset-pw-employee">Password Reset ke 123</button>
                                        <a href="{{ url('pegawai/' . $employee->user_id . '/edit') }}" title="Ubah Data" class="btn btn-primary">Ubah Data</a>
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
@endsection
