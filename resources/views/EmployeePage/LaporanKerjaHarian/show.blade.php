@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    @if(session('msg')){!! session('msg')  !!} @endif
    <div class="col-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Laporan Kerja Harian</h4>
            </div>
            <div class="card-body">
                <form class="wizard-content mt-2" action="{{ url('/laporan') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 form-kegiatan">
                            @foreach($laporan->activity()->get() as $activity)
                            <div class="row">
                                <div class="col-6 kegiatan-{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="activities">Hasil Kegiatan</label>
                                        <div class="input-group my-{{ $loop->iteration }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $loop->iteration }}</div>
                                            </div>
                                            <input readonly value="{{ $activity->activity }}" type="text" autocomplete="off" name="activities[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 kegiatan-{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="result">Hasil</label>
                                        <div class="input-group my-{{ $loop->iteration }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $loop->iteration }}</div>
                                            </div>
                                            <input readonly value="{{ $activity->result }}" type="text" autocomplete="off" name="result[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 kegiatan-{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="volume">Jumlah/Bobot</label>
                                        <div class="input-group my-{{ $loop->iteration }}">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{ $loop->iteration }}</div>
                                            </div>
                                            <input readonly value="{{ $activity->volume }}" type="text" autocomplete="off" name="volume[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <div class="input-group">
                                    <textarea readonly autocomplete="off" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5">{{ $laporan->keterangan }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('keterangan') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('laporan') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <a href="{{ url('laporan/' . $laporan->daily_work_report_id . '/edit') }}" title="Ubah" class="btn btn-success">Ubah</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
