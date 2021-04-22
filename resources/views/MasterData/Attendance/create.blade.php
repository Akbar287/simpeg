@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ url('/absensi') }}" method="post">@csrf
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="employee">Pegawai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                            <select class="custom-select @error('employee') is-invalid @enderror" name="employee" id="employee">
                                                @if(!empty($employee))
                                                @foreach($employee as $employ)
                                                <option value="{{ $employ->user_id }}">{{ $employ->name . ' - ' . $employ->nip }}</option>
                                                @endforeach
                                                @else
                                                <option value="0">Belum ada Pegawai</option>
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                @error('employee') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="date_work">Tanggal Kerja</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="date" value="{{ old('date_work') }}" autocomplete="off" class="form-control @error('date_work') is-invalid @enderror" name="date_work" id="date_work">
                                            <div class="invalid-feedback">
                                                @error('date_work') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kerja">Jenis Kerja</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                            </div>
                                            <select class="custom-select @error('jenis_kerja') is-invalid @enderror" name="jenis_kerja" id="jenis_kerja">
                                                <option {{ (old('jenis_kerja') == 'WFO') ? 'selected' : ''  }} value="WFO">WFO</option>
                                                <option {{ (old('jenis_kerja') == 'WFH') ? 'selected' : ''  }} value="WFH">WFH</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                @error('jenis_kerja') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="start_work">Waktu Mulai Kerja</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="time" value="{{ old('start_work') ? old('start_work') : "07:00:00" }}" autocomplete="off" class="form-control @error('start_work') is-invalid @enderror" name="start_work" id="start_work">
                                            <div class="invalid-feedback">
                                                @error('start_work') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="finish_work">Waktu Selesai kerja</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                            <input type="time" value="{{ old('finish_work') ? old('finish_work') : "16:00:00" }}" autocomplete="off" class="form-control @error('finish_work') is-invalid @enderror" name="finish_work" id="finish_work">
                                            <div class="invalid-feedback">
                                                @error('finish_work') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="kehadiran">Kehadiran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-building"></i></div>
                                            </div>
                                            <select class="custom-select @error('kehadiran') is-invalid @enderror" name="kehadiran" id="kehadiran">
                                                @foreach($attendances as $kehadira)
                                                <option {{ $kehadira->kehadiran_id == old('kehadiran') ? 'selected' : '' }} value="{{ $kehadira->kehadiran_id }}">{{ $kehadira->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                @error('kehadiran') {{ $message }} @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="stamp">Diketahui oleh</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-stamp"></i></div>
                                            </div>
                                            <select class="custom-select @error('stamp') is-invalid @enderror" name="stamp" id="stamp">
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
                                <div class="col-12"></div>
                                <div class="col-12">
                                    <a href="{{ url('/absensi') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                                    <button type="submit" title="Simpan Data" class="btn btn-success">Setujui dan Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
