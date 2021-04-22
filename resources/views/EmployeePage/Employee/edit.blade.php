@extends('layouts.app')

@section('content')
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
                                    <form action="{{ url('admin/' . $employee->user_id) }}" method="post">@csrf @method('put')
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-at"></i></div>
                                                        </div>
                                                        <input type="text" autocomplete="off" class="form-control @error('email') is-invalid @enderror" value="{{$employee->email}}" name="email" id="email">
                                                        <div class="invalid-feedback">
                                                            @error('email') {{ $message }} @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Jenis Kelamin</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-venus-mars"></i></div>
                                                        </div>
                                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                                            <option {{ $employee->gender == 'Pria' ? 'selected' : '' }} value="Pria">Pria</option>
                                                            <option {{ $employee->gender == 'Wanita' ? 'selected' : '' }} value="Wanita">Wanita</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @error('gender') {{ $message }} @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="employment">Jabatan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-sitemap"></i></div>
                                                        </div>
                                                        <select class="form-control @error('employment') is-invalid @enderror" name="employment" id="employment">
                                                        @if(!empty($employments)))
                                                            @foreach($employments as $employment)
                                                            <option {{ $employment['employment_name'] == $employee->employment()->first()->toArray()['employment_name'] ? 'selected': '' }} value="{{ $employment['employment_id'] }}">{{ $employment['employment_name'] }}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="">Belum Ada Jabatan</option>
                                                        @endif
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        @error('employment') {{ $message }} @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="TTL">TTL</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                        </div>
                                                        <input type="text" autocomplete="off" class="form-control @error('place_born') is-invalid @enderror" value="{{$employee->place_born}}" name="place_born" id="TTL">
                                                        <input type="date" class="form-control @error('date_born') is-invalid @enderror" value="{{$employee->date_born}}" name="date_born" id="TTL">
                                                        <div class="invalid-feedback">
                                                            @error('place_born') {{ $message }} @enderror
                                                            @error('date_born') {{ $message }} @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="blood_type">Golongan Darah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-tint"></i></div>
                                                        </div>
                                                        <select class="form-control @error('blood_type') is-invalid @enderror" name="blood_type" id="blood_type">
                                                            <option {{ $employee->blood_type == 'A' ? 'selected' : '' }} value="A">A</option>
                                                            <option {{ $employee->blood_type == 'B' ? 'selected' : '' }} value="B">B</option>
                                                            <option {{ $employee->blood_type == 'AB' ? 'selected' : '' }} value="AB">AB</option>
                                                            <option {{ $employee->blood_type == 'O' ? 'selected' : '' }} value="O">O</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @error('blood_type') {{ $message }} @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="religion">Agama</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-praying-hands"></i></div>
                                                        </div>
                                                        <select class="form-control @error('religion') is-invalid @enderror" name="religion" id="religion">
                                                            <option {{ $employee->religion == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
                                                            <option {{ $employee->religion == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen</option>
                                                            <option {{ $employee->religion == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
                                                            <option {{ $employee->religion == 'Buddha' ? 'selected' : '' }} value="Buddha">Buddha</option>
                                                            <option {{ $employee->religion == 'Konghucu' ? 'selected' : '' }} value="Konghucu">Konghucu</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @error('religion') {{ $message }} @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="marital_status">Status pernikahan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-ring"></i></div>
                                                        </div>
                                                        <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" id="marital_status">
                                                            <option {{ $employee->marital_status == 'Lajang' ? 'selected' : '' }} value="Lajang">Lajang</option>
                                                            <option {{ $employee->marital_status == 'Menikah' ? 'selected' : '' }} value="Menikah">Menikah</option>
                                                            <option {{ $employee->marital_status == 'Cerai' ? 'selected' : '' }} value="Cerai">Cerai</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            @error('marital_status') {{ $message }} @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="telephone_number">No. Telepon</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                                        </div>
                                                        <input type="text" autocomplete="off" class="form-control @error('telephone_number') is-invalid @enderror" value="{{$employee->telephone_number}}" name="telephone_number" id="telephone_number">
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        @error('telephone_number') {{ $message }} @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="occupation">Golongan / Pangkat</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                                                        </div>
                                                        <select class="form-control @error('occupation') is-invalid @enderror" name="occupation" id="occupation">
                                                            @if(!empty($occupations)))
                                                            @foreach($occupations as $occupation)
                                                            <option {{ $occupation['occupation_group_name'] == $employee->occupation_group()->first()->toArray()['occupation_group_name'] ? 'selected': '' }} value="{{ $occupation['occupation_group_id'] }}">{{ $occupation['occupation_group_name'] }}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="">Belum Ada Golongan / Pangkat</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        @error('occupation') {{ $message }} @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="work_unit">Unit kerja</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-sitemap"></i></div>
                                                        </div>
                                                        <select class="form-control @error('work_unit') is-invalid @enderror" name="work_unit" id="work_unit">
                                                        @if(!empty($work_units)))
                                                            @foreach($work_units as $work_unit)
                                                            <option {{ $work_unit['work_unit_name'] == $employee->work_unit()->first()->toArray()['work_unit_name'] ? 'selected': '' }} value="{{ $work_unit['work_unit_id'] }}">{{ $work_unit['work_unit_name'] }}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="">Belum Ada Unit Kerja</option>
                                                        @endif
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        @error('work_unit') {{ $message }} @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-home"></i></div>
                                                        </div>
                                                        <textarea autocomplete="off" class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{$employee->address}}</textarea>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        @error('address') {{ $message }} @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-3">
                                            <a href="{{ url('admin/' . $employee->user_id) }}" class="btn btn-info">Batalkan</a>
                                            <button type="submit" title="Simpan Data" class="btn btn-primary">Ubah Data</button>
                                        </div>
                                    </form>
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
