@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan Harian Kerja Pegawai</h4>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                @if(Auth::user()->role()->first()->name != 'pimpinan')<form action="{{ url('/laporankerja') }}" method="#">@csrf @endif
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="employee">Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input readonly type="text" value="{{ $employee->name . ' - ' . $employee->nip }}" class="form-control @error('employee') is-invalid @enderror" name="employee" id="employee">
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
                                    <input readonly type="date" value="{{ $dailyWorkReport->date_work }}" autocomplete="off" class="form-control @error('date') is-invalid @enderror" name="date" id="date">
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
                                            <input readonly value="{{ $dwr->activity }}" type="text" autocomplete="off" name="activities[]" class="form-control">
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
                                            <input readonly value="{{ $dwr->result }}" type="text" autocomplete="off" name="result[]" class="form-control">
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
                                            <input readonly value="{{ $dwr->volume }}" type="text" autocomplete="off" name="volume[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                            <div class="col-12">
                                <div class="float-right">
                                    <div class="btn-group"><button disabled type="button" class="btn btn-primary btn-sm btn-add-kegiatan">+ Kegiatan</button><button disabled type="button" class="btn btn-danger btn-sm btn-remove-kegiatan">- Kegiatan</button></div>
                                </div>
                            </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <div class="input-group">
                                    <textarea readonly autocomplete="off" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5">{{ $dailyWorkReport->keterangan }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('keterangan') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @if(Auth::user()->role()->first()->name != 'pimpinan')<a href="{{ url('laporankerja') }}" title="Kembali" class="btn btn-info">Kembali</a>@else<a href="{{ url('reporting/working') }}" title="Kembali" class="btn btn-info">Kembali</a>@endif
                            @if(Auth::user()->role()->first()->name != 'pimpinan')
                            <button type="button" title="Hapus" class="btn btn-danger" onclick="(confirm('Data Laporan Kerja Harian akan dihapus!\nLanjutkan?')) ? document.getElementById('deleteReport').submit() : ''">Hapus</button>
                            <a href="{{ url('laporankerja/' . $dailyWorkReport->daily_work_report_id . '/edit') }}" title="Ubah Data" class="btn btn-success">Edit</a>
                            @endif
                            @if(Auth::user()->role()->first()->name != 'pimpinan')<a target="_blank" href="{{ url('laporankerja/' . $dailyWorkReport->daily_work_report_id . '/print') }}" title="Cetak Data" class="btn btn-primary">Cetak</a>@else<a target="_blank" href="{{ url('reporting/working/' . $dailyWorkReport->daily_work_report_id . '/print') }}" title="Cetak Data" class="btn btn-primary">Cetak</a>@endif
                        </div>
                    </div>
                @if(Auth::user()->role()->first()->name != 'pimpinan')</form><form action="{{ url('laporankerja/' . $dailyWorkReport->daily_work_report_id) }}" method="post" id="deleteReport">@csrf @method('delete')</form>@endif
            </div>
        </div>
    </div>
</div>
@endsection
