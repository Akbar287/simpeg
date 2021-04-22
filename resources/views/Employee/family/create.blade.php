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
                <form action="{{ url('/pegawai/' . $employee->user_id . '/family') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="NIK">NIK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control @error('nik') is-invalid @enderror" id="NIK" name="nik" id="NIK">
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
                                    <input type="text" autocomplete="off" class="form-control @error('name') is-invalid @enderror" name="name" id="Nama">
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
                                    <input type="text" autocomplete="off" class="form-control @error('place_born') is-invalid @enderror" name="place_born" id="TTL">
                                    <input type="date" class="form-control @error('date_born') is-invalid @enderror" name="date_born" id="TTL">
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
                                    <select class="form-control @error('education') is-invalid @enderror" name="education" id="Pendidikan">
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="Tidak Tamat SD">Tidak Tamat SD</option>
                                        <option value="SD">SD</option>
                                        <option value="SLTP">SLTP</option>
                                        <option value="SLTA">SLTA</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
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
                                    <input type="text" autocomplete="off" class="form-control @error('work') is-invalid @enderror" name="work" id="Pekerjaan">
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
                                    <select class="form-control @error('relationship') is-invalid @enderror" name="relationship" id="Status">
                                        <option value="">Pilih Status Hubungan</option>
                                        <option value="Suami">Suami</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Orang Tua">Orang Tua</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('relationship') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('pegawai/' . $employee->user_id . '/family') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
