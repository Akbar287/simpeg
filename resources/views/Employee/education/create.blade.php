@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Pendidikan</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/pegawai/' . $employee->user_id . '/education') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="principal">Kepala Sekolah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('principal') }}" autocomplete="off" class="form-control @error('principal') is-invalid @enderror" id="principal" name="principal" id="principal">
                                    <div class="invalid-feedback">
                                        @error('principal') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="grade">Tingkat</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-graduation-cap"></i></div>
                                    </div>
                                    <select class="form-control @error('grade') is-invalid @enderror" name="grade" id="grade">
                                        <option value="">Pilih Pendidikan</option>
                                        <option {{ (old('grade') == 'Tidak Tamat SD') ? 'selected' : '' }} value="Tidak Tamat SD">Tidak Tamat SD</option>
                                        <option {{ (old('grade') == 'SD') ? 'selected' : '' }} value="SD">SD</option>
                                        <option {{ (old('grade') == 'SLTP') ? 'selected' : '' }} value="SLTP">SLTP</option>
                                        <option {{ (old('grade') == 'SLTA') ? 'selected' : '' }} value="SLTA">SLTA</option>
                                        <option {{ (old('grade') == 'S1') ? 'selected' : '' }} value="S1">S1</option>
                                        <option {{ (old('grade') == 'S2') ? 'selected' : '' }} value="S2">S2</option>
                                        <option {{ (old('grade') == 'S3') ? 'selected' : '' }} value="S3">S3</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('grade') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="school_name">Nama Sekolah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-building"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('school_name') }}" autocomplete="off" class="form-control @error('school_name') is-invalid @enderror" name="school_name" id="Nama">
                                    <div class="invalid-feedback">
                                        @error('school_name') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="location">Alamat</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('location') }}" autocomplete="off" class="form-control @error('location') is-invalid @enderror" name="location" id="location">
                                    <div class="invalid-feedback">
                                        @error('location') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="major">Jurusan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-shapes"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('major') }}" autocomplete="off" class="form-control @error('major') is-invalid @enderror" name="major" id="major">
                                    <div class="invalid-feedback">
                                        @error('major') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="diploma_number">No. Ijazah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('diploma_number') }}" autocomplete="off" class="form-control @error('diploma_number') is-invalid @enderror" name="diploma_number" id="diploma_number">
                                    <div class="invalid-feedback">
                                        @error('diploma_number') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="diploma_date">Tanggal Ijazah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ old('diploma_date') }}" autocomplete="off" class="form-control @error('diploma_date') is-invalid @enderror" name="diploma_date" id="diploma_date">
                                    <div class="invalid-feedback">
                                        @error('diploma_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="diploma_file">File Ijazah</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-file-upload"></i></div>
                                    </div>
                                    <input type="file" autocomplete="off" class="form-control @error('diploma_file') is-invalid @enderror" name="diploma_file" id="diploma_file">
                                    <div class="invalid-feedback">
                                        @error('diploma_file') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="final_grade">Tandai Sebagai Pendidikan Akhir</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-stamp"></i></div>
                                    </div>
                                    <select class="form-control @error('final_grade') is-invalid @enderror" name="final_grade" id="final_grade">
                                        <option {{ (old('final_grade') == '0') ? 'selected' : '' }} value="0">Tidak</option>
                                        <option {{ (old('final_grade') == '1') ? 'selected' : '' }} value="1">Ya</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('final_grade') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" title="Kembali" class="btn btn-primary">Kembali</button>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
