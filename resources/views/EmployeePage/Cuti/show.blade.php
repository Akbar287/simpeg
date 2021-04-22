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
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="wizard-steps">
                            @if($furlough->status == 0)
                            <div class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibuat
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-danger">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibatalkan
                                </div>
                            </div>
                            @elseif($furlough->status == 5)
                            <div class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibuat
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-danger">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Ditolak
                                </div>
                            </div>
                            @else
                            <div class="wizard-step wizard-step-{{($furlough->status >= 1) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibuat
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-{{($furlough->status >= 2) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-signature"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Disetujui
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-{{($furlough->status >= 3) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Terbit SK
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-{{($furlough->status == 4) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Selesai
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{ url('/izincuti') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="type_furlough">Alasan Cuti Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <input readonly type="text" value="{{ $furlough->type_furlough }}" autocomplete="off" class="form-control @error('type_furlough') is-invalid @enderror" name="type_furlough" id="type_furlough">
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
                                    <input readonly type="date" value="{{ $furlough->start_date }}" autocomplete="off" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">
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
                                    <input readonly type="date" value="{{ $furlough->finish_date }}" autocomplete="off" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" id="finish_date">
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
                                    <select disabled class="custom-select @error('long_furlough') is-invalid @enderror" name="long_furlough" id="long_furlough">
                                        @for($i=1;$i <= 20; $i++)
                                        <option value="{{ $i }}" {{ ($i == $furlough->long_furlough) }}>{{ $i }}</option>
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
                                    <input readonly type="text" value="{{ $furlough->in_number }}" placeholder="Cth: Satu" autocomplete="off" class="form-control @error('in_number') is-invalid @enderror" name="in_number" id="in_number">
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
                                    <select disabled class="custom-select @error('time_format') is-invalid @enderror" name="time_format" id="time_format" >
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
                            <a href="{{ url('/izincuti') }}" type="button" title="Kembali" class="btn btn-primary">Kembali</a>
                            @if($furlough->status == 1)
                            <a href="{{ url('izincuti/' . $furlough->furlough_id . '/edit') }}" type="button" title="Ubah Data" class="btn btn-success">Edit</a>
                            <button type="button" title="Batalkan Cuti" class="btn btn-danger" onclick="(confirm('Data Cuti akan dibatalkan!\nLanjutkan?')) ? document.getElementById('cancelCuti').submit() : ''">Batalkan Cuti</button>
                            @elseif($furlough->status == 4)
                            <a target="_blank" href="{{ url('/izincuti/' . $furlough->furlough_id . '/print') }}" type="button" title="Cetak" class="btn btn-success">Cetak</a>
                            @else
                            @endif
                        </div>
                    </div>
                </form><form action="{{ url('izincuti/' . $furlough->furlough_id) }}" method="post" id="cancelCuti">@csrf @method('delete')</form>
            </div>
        </div>
    </div>
</div>
@endsection
