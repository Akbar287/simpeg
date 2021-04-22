@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan Harian Kerja Pegawai</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/laporankerja/' .  $dailyWorkReport->daily_work_report_id) }}" method="post">@csrf @method('put')
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="employee">Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="hidden" name="employee" value="{{ $employID->user_id }}">
                                    <select disabled class="custom-select @error('employee') is-invalid @enderror" name="employee" id="employee">
                                        @if(!empty($employee))
                                        @foreach($employee as $employ)
                                        <option {{ ($employ->user_id == $employID->user_id) ? 'selected' : '' }} value="{{ $employ->user_id }}">{{ $employ->name . ' - ' . $employ->nip }}</option>
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
                                <label for="date">Tanggal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ $dailyWorkReport->date_work }}" autocomplete="off" class="form-control @error('date') is-invalid @enderror" name="date" id="date">
                                    <div class="invalid-feedback">
                                        @error('date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-kegiatan">
                            @foreach($dailyWorkReport->activity()->get() as $dwr)
                            <div class="row">
                                <div class="col-6 kegiatan-{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="activities">Hasil Kegiatan</label>
                                        <div class="input-group my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $loop->iteration }}</div>
                                            </div>
                                            <input value="{{ $dwr->activity }}" type="text" autocomplete="off" name="activities[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 kegiatan-{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="result">Hasil</label>
                                        <div class="input-group my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $loop->iteration }}</div>
                                            </div>
                                            <input value="{{ $dwr->result }}" type="text" autocomplete="off" name="result[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 kegiatan-{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="volume">Jumlah</label>
                                        <div class="input-group my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $loop->iteration }}</div>
                                            </div>
                                            <input value="{{ $dwr->volume }}" type="text" autocomplete="off" name="volume[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                            <div class="col-12">
                                <div class="float-right">
                                    <div class="btn-group"><button type="button" class="btn btn-primary btn-sm btn-add-kegiatan">+ Kegiatan</button><button type="button" class="btn btn-danger btn-sm btn-remove-kegiatan">- Kegiatan</button></div>
                                </div>
                            </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <div class="input-group">
                                    <textarea autocomplete="off" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5">{{ $dailyWorkReport->keterangan }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('keterangan') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('laporankerja/' . $dailyWorkReport->daily_work_report_id) }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
