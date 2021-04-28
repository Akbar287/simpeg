@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
                <div class="card-header-action">
                    <b>Status: {{ Helper::statusFurlough($furlough->status) }}</b>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/izincuti/' . $furlough->furlough_id) }}" method="post">@csrf @method('put')
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="type_furlough">Alasan Cuti Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <input type="text" value="{{ $furlough->type_furlough }}" autocomplete="off" class="form-control @error('type_furlough') is-invalid @enderror" name="type_furlough" id="type_furlough">
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
                                    <input type="date" value="{{ $furlough->start_date }}" autocomplete="off" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">
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
                                    <input type="date" value="{{ $furlough->finish_date }}" autocomplete="off" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" id="finish_date">
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
                                    <select class="custom-select @error('long_furlough') is-invalid @enderror" name="long_furlough" id="long_furlough">
                                        @for($i=1;$i <= 20; $i++)
                                        <option value="{{ $i }}" {{ ($i == $furlough->long_furlough) ? 'selected' :'' }}>{{ $i }}</option>
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
                                    <input type="text" value="{{ $furlough->in_number }}" placeholder="Cth: Satu" autocomplete="off" class="form-control @error('in_number') is-invalid @enderror" name="in_number" id="in_number">
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
                                    <select class="custom-select @error('time_format') is-invalid @enderror" name="time_format" id="time_format" >
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
                        <div class="col-12">
                            <a href="{{ url('/izincuti/' . $furlough->furlough_id) }}" type="button" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
