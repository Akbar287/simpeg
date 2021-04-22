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
                            <div class="row">
                                <div class="col-6 kegiatan-1">
                                    <div class="form-group">
                                        <label for="activities">Kegiatan/Aktivitas</label>
                                        <div class="input-group my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">1</div>
                                            </div>
                                            <input type="text" autocomplete="off" name="activities[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 kegiatan-1">
                                    <div class="form-group">
                                        <label for="result">Hasil</label>
                                        <div class="input-group my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">1</div>
                                            </div>
                                            <input type="text" autocomplete="off" name="result[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 kegiatan-1">
                                    <div class="form-group">
                                        <label for="volume">Jumlah/Bobot</label>
                                        <div class="input-group my-1">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">1</div>
                                            </div>
                                            <input type="text" autocomplete="off" name="volume[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <textarea autocomplete="off" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="5">{{ old('keterangan') }}</textarea>
                                    <div class="invalid-feedback">
                                        @error('keterangan') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('laporan') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
