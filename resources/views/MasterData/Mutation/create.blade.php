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
                <form action="{{ url('/mutation') }}" method="post">@csrf
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
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="sk_number">No. SK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                    </div>
                                    <input type="text" value="{{ old('sk_number') }}" autocomplete="off" class="form-control @error('sk_number') is-invalid @enderror" name="sk_number" id="sk_number">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-generate" type="button">Generate</button>
                                        <button class="btn btn-primary btn-check" type="button">Cek</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('sk_number') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="sk_date_start">Tanggal SK</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ old('sk_date_start') }}" autocomplete="off" class="form-control @error('sk_date_start') is-invalid @enderror" name="sk_date_start" id="sk_date_start">
                                    <div class="invalid-feedback">
                                        @error('sk_date_start') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="stamp">Ditanda tangani oleh</label>
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
                        <div class="col-12">
                            <a href="{{ url('/mutation') }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" title="Simpan Data" class="btn btn-success">Setujui dan Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
