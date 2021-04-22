@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/pegawai/' . $employee->user_id . '/absensi') }}" method="post">@csrf
                    <div class="row">
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
                                    <select class="form-control @error('jenis_kerja') is-invalid @enderror" name="jenis_kerja" id="jenis_kerja">
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
                                    <select class="form-control @error('kehadiran') is-invalid @enderror" name="kehadiran" id="kehadiran">
                                        <option {{ (old('kehadiran') == '0') ? 'selected' : '' }} value="0">Tanpa Keterangan</option>
                                        <option {{ (old('kehadiran') == '1') ? 'selected' : '' }} value="1">Hadir</option>
                                        <option {{ (old('kehadiran') == '2') ? 'selected' : '' }} value="2">Izin</option>
                                        <option {{ (old('kehadiran') == '3') ? 'selected' : '' }} value="3">Sakit</option>
                                        <option {{ (old('kehadiran') == '4') ? 'selected' : '' }} value="4">Cuti</option>
                                        <option {{ (old('kehadiran') == '5') ? 'selected' : '' }} value="5">Perjalanan Dinas</option>
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
                            <a href="{{ url('pegawai/' . $employee->user_id . '/absensi') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Setujui dan Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
