@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Mutasi</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/izinmutasi') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="type_mutation">Jenis Mutasi Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <select class="custom-select @error('type_mutation') is-invalid @enderror" name="type_mutation" id="type_mutation">
                                        <option value="">Pilih Jenis Mutasi</option>
                                        @foreach($type_mutations as $type_mutation)
                                        <option {{ (old('type_mutation') == $type_mutation->type_mutation_name) ? 'selected' : '' }} value="{{ $type_mutation->type_mutation_id }}">{{ $type_mutation->type_mutation_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('type_mutation') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="work_unit">Unit Kerja</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-building"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('work_unit') }}" autocomplete="off" class="form-control @error('work_unit') is-invalid @enderror" name="work_unit" id="work_unit">
                                    <div class="invalid-feedback">
                                        @error('work_unit') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="region_work_unit">Wilayah Unit Kerja</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('region_work_unit') }}" autocomplete="off" class="form-control @error('region_work_unit') is-invalid @enderror" name="region_work_unit" id="region_work_unit">
                                    <div class="invalid-feedback">
                                        @error('region_work_unit') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('address') }}" autocomplete="off" class="form-control @error('address') is-invalid @enderror" name="address" id="address">
                                    <div class="invalid-feedback">
                                        @error('address') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('/izinmutasi') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Ajukan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
