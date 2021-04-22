@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/pegawai/' . $employee->user_id . '/cuti') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="type_furlough">Alasan Cuti Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('type_furlough') }}" autocomplete="off" class="form-control @error('type_furlough') is-invalid @enderror" name="type_furlough" id="type_furlough">
                                    <div class="invalid-feedback">
                                        @error('type_furlough') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai Cuti</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ old('start_date') }}" autocomplete="off" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">
                                    <div class="invalid-feedback">
                                        @error('start_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="finish_date">Tanggal Selesai Cuti</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ old('finish_date') }}" autocomplete="off" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" id="finish_date">
                                    <div class="invalid-feedback">
                                        @error('finish_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="long_furlough">Lama Cuti</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-building"></i></div>
                                    </div>
                                    <select class="form-control @error('long_furlough') is-invalid @enderror" name="long_furlough" id="long_furlough">
                                        @for($i=1;$i <= 20; $i++)
                                        <option value="{{ $i }}" {{ ($i == old('long_furlough')) }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('long_furlough') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="in_number">Lama Cuti (Terbilang)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('in_number') }}" autocomplete="off" class="form-control @error('in_number') is-invalid @enderror" name="in_number" id="in_number">
                                    <div class="invalid-feedback">
                                        @error('in_number') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="time_format">Format Waktu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
                                    </div>
                                    <select class="form-control @error('time_format') is-invalid @enderror" name="time_format" id="time_format" >
                                        <option value="Hari">Hari</option>
                                        <option value="Minggu">Minggu</option>
                                        <option value="Bulan">Bulan</option>
                                        <option value="Tahun">Tahun</option>
                                        <option value="Abad">Abad</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('time_format') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="sk_number">No. SK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('sk_number') }}" autocomplete="off" class="form-control @error('sk_number') is-invalid @enderror" name="sk_number" id="sk_number">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-generate-cuti" type="button">Generate</button>
                                        <button class="btn btn-primary btn-check-cuti" type="button">Cek</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('sk_number') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="sk_date_start">Tanggal SK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ old('sk_date_start') }}" autocomplete="off" class="form-control @error('sk_date_start') is-invalid @enderror" name="sk_date_start" id="sk_date_start">
                                    <div class="invalid-feedback">
                                        @error('sk_date_start') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="stamp">Ditanda tangani oleh</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-stamp"></i></div>
                                    </div>
                                    <select class="form-control @error('stamp') is-invalid @enderror" name="stamp" id="stamp">
                                        @if(!is_null($admins))
                                        @foreach($admins as $admin)
                                        <option {{ (old('stamp') == $admin->user_id) ? 'selected' : '' }} value="{{ $admin->user_id }}">{{ $admin->name }} - {{ $admin->employment_name }}</option>
                                        @endforeach
                                        @else
                                        <option disabled value="">Anda Belum menambahkan Admin</option>
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('stamp') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-ketentuan">
                            <div class="form-group form-ketentuan">
                                <label for="ketentuan">Ketentuan</label>
                                <div class="input-group my-1 ketentuan-1">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">1</div>
                                    </div>
                                    <input type="text" autocomplete="off" name="ketentuan[]" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="float-right">
                                <div class="btn-group"><button type="button" class="btn btn-primary btn-sm btn-add-ketentuan">+ Ketentuan</button><button type="button" class="btn btn-danger btn-sm btn-remove-ketentuan">- Ketentuan</button></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="information">Keterangan</label>
                                <div class="input-group">
                                    <textarea value="{{ old('information') }}" autocomplete="off" class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="5"></textarea>
                                    <div class="invalid-feedback">
                                        @error('information') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('pegawai/' . $employee->user_id . '/cuti') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Setujui dan Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
