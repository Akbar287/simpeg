@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Keluarga</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/pegawai/' . $employee->user_id . '/family/' . $family->family_id) }}" method="post">@csrf @method('put')
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                    </div>
                                    <input readonly type="text" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" value="{{$family->nik}}" id="NIK" name="nik" id="NIK">
                                    <div class="invalid-feedback">
                                        @error('nik') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input readonly type="text" autocomplete="off" class="form-control @error('name') is-invalid @enderror" value="{{$family->name}}" name="name" id="Nama">
                                    <div class="invalid-feedback">
                                        @error('name') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="TTL">TTL</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input readonly type="text" autocomplete="off" class="form-control @error('place_born') is-invalid @enderror" value="{{$family->place_born}}" name="place_born" id="TTL">
                                    <input readonly type="date" class="form-control @error('date_born') is-invalid @enderror" value="{{$family->date_born}}" name="date_born" id="TTL">
                                    <div class="invalid-feedback">
                                        @error('place_born') {{ $message }} @enderror
                                        @error('date_born') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="Pendidikan">Pendidikan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-graduation-cap"></i></div>
                                    </div>
                                    <select  disabled class="form-control @error('education') is-invalid @enderror" name="education" id="Pendidikan">
                                        <option value="Tidak Tamat SD" {{ $family->education == 'Tidak Tamat SD' ? 'selected' : '' }}>Tidak Tamat SD</option>
                                        <option value="SD" {{ $family->education == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SLTP" {{ $family->education == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                        <option value="SLTA" {{ $family->education == 'SLTA' ? 'selected' : '' }}>SLTA</option>
                                        <option value="S1" {{ $family->education == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ $family->education == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ $family->education == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('education') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="Pekerjaan">Pekerjaan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                                    </div>
                                    <input readonly type="text" autocomplete="off" class="form-control @error('work') is-invalid @enderror" value="{{$family->work}}" name="work" id="Pekerjaan">
                                    <div class="invalid-feedback">
                                        @error('work') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="Status">Status Hubungan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                                    </div>
                                    <select  disabled class="form-control @error('relationship') is-invalid @enderror" name="relationship" id="Status">
                                        <option value="Suami" {{ $family->relationship == 'Suami' ? 'selected' : '' }}>Suami</option>
                                        <option value="Istri" {{ $family->relationship == 'Istri' ? 'selected' : '' }}>Istri</option>
                                        <option value="Anak" {{ $family->relationship == 'Anak' ? 'selected' : '' }}>Anak</option>
                                        <option value="Orang Tua"{{ $family->relationship == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('relationship') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('/pegawai/'.$employee->user_id . '/family/' . $family->family_id . '/edit') }}" type="button" title="Ubah Data" class="btn btn-primary">Ubah</a>
                            <form action="{{ url('/pegawai/'.$employee->user_id . '/family/' . $family->family_id) }}">@csrf @method('delete')
                                <button type="submit" onclick="return confirm('Data Keluarga akan dihapus!\n Lanjutkan?')" title="Hapus Data" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
