@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    @if(session('msg')){!! session('msg')  !!} @endif
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Kehadiran</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('absen/kehadiran') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group row justify-content-center">
                                <label>Jenis Kehadiran</label>
                                <div class="col-12">
                                    <div class="selectgroup w-100">
                                        @foreach($Kehadiran as $opt) @if($opt->kehadiran_id != 2)
                                        <label class="selectgroup-item">
                                            <input type="radio" name="kehadiran" value="{{ $opt->kehadiran_id }}" class="selectgroup-input">
                                            <span class="selectgroup-button">{{ $opt->name }}</span>
                                        </label>
                                        @endif @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                    </div>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" style="height: 100px;" cols="30" rows="10"></textarea>
                                    <div class="invalid-feedback">
                                        @error('keterangan') {{ $message }} @enderror
                                    </div>
                                </div>
                                <p class="text-muted ml-3">*Keterangan Wajib Diisi berisi alasan tidak bekerja</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group row justify-content-center">
                                <label for="image">Foto (Opsional)</label>
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                        <label class="custom-file-label" class="label-image" for="image">Pilih Foto</label>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Kehadiran akan disimpan! Lanjutkan?')">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
