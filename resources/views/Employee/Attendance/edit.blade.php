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
                <form action="{{ url('pegawai/' . $employee->user_id . '/absensi/' . $attendance->attendance_id) }}" method="POST"">@csrf @method('put')
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="date_work">Tanggal Kerja</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ $attendance->date_work }}" autocomplete="off" class="form-control @error('date_work') is-invalid @enderror" name="date_work" id="date_work">
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
                                        <option {{ ($attendance->jenis_kerja == 'WFO') ? 'selected' : ''  }} value="WFO">WFO</option>
                                        <option {{ ($attendance->jenis_kerja == 'WFH') ? 'selected' : ''  }} value="WFH">WFH</option>
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
                                    <input type="time" value="{{ $attendance->start_work ? $attendance->start_work : "07:00:00" }}" autocomplete="off" class="form-control @error('start_work') is-invalid @enderror" name="start_work" id="start_work">
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
                                    <input type="time" value="{{ $attendance->finish_work ? $attendance->finish_work : "16:00:00" }}" autocomplete="off" class="form-control @error('finish_work') is-invalid @enderror" name="finish_work" id="finish_work">
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
                                        @foreach($kehadiran as $kehadira)
                                        <option {{ ($kehadira->kehadiran_id == $attendance->kehadiran()->first()->toArray()['kehadiran_id']) ? 'selected' : '' }} value="{{ $kehadira->kehadiran_id }}">{{ $kehadira->name }}</option>
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
                                        <option {{ ($attendance->stamp == $admin->user_id) ? 'selected' : '' }} value="{{ $admin->user_id }}">{{ $admin->name }} - {{ $admin->employment_name }}</option>
                                        @endforeach
                                        @else
                                        <option value="">Anda Belum menambahkan Admin</option>
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
                                    <textarea autocomplete="off" class="form-control @error('information') is-invalid @enderror" name="information" id="information" cols="5">{{ $attendance->information }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('information') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('pegawai/' . $employee->user_id . '/absensi') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Simpan Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
