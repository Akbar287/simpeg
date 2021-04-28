@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Mutasi</h4>
                <div class="card-header-action">
                    <b>Status Mutasi: {{ Helper::statusMutation($mutation->status) }}</b>
                </div>
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
                                    <input type="text" readonly value="{{ $employee->name .' - ' .$employee->nip }}" class="form-control @error('employee') is-invalid @enderror" name="employee" id="employee">
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
                                    <select disabled class="custom-select @error('type_mutation') is-invalid @enderror" name="type_mutation" id="type_mutation">
                                        <option value="">{{ $mutation->type_mutation()->first()->type_mutation_name }}</option>
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
                                    <input readonly type="text" value="{{ $mutation->new_work_unit }}" autocomplete="off" class="form-control @error('work_unit') is-invalid @enderror" name="work_unit" id="work_unit">
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
                                    <input readonly type="text" value="{{ $mutation->region_work }}" autocomplete="off" class="form-control @error('region_work_unit') is-invalid @enderror" name="region_work_unit" id="region_work_unit">
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
                                    <input readonly type="text" value="{{ $mutation->address }}" autocomplete="off" class="form-control @error('address') is-invalid @enderror" name="address" id="address">
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
                                    @if($mutation->status == 3 || $mutation->status == 4)
                                    <input readonly type="text" value="{{ $mutation->decree()->first()->sk_number }}" autocomplete="off" class="form-control @error('sk_number') is-invalid @enderror" name="sk_number" id="sk_number">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-primary btn-generate" type="button">Generate</button>
                                        <button disabled class="btn btn-primary btn-check" type="button">Cek</button>
                                    </div>
                                    @else
                                    <input readonly type="text" value="" autocomplete="off" class="form-control @error('sk_number') is-invalid @enderror" name="sk_number" id="sk_number">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-primary btn-generate" type="button">Generate</button>
                                        <button disabled class="btn btn-primary btn-check" type="button">Cek</button>
                                    </div>
                                    @endif
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
                                    @if($mutation->status == 3 || $mutation->status == 4)
                                    <input readonly type="date" value="{{ $mutation->decree()->first()->sk_date_start }}" autocomplete="off" class="form-control @error('sk_date_start') is-invalid @enderror" name="sk_date_start" id="sk_date_start">
                                    @else
                                    <input readonly type="date" value="" autocomplete="off" class="form-control @error('sk_date_start') is-invalid @enderror" name="sk_date_start" id="sk_date_start">
                                    @endif
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
                                    @if($mutation->status == 3 || $mutation->status == 4)
                                    <select disabled class="custom-select @error('stamp') is-invalid @enderror" name="stamp" id="stamp">
                                        @if(!is_null($admins))
                                        <option value="">{{ $admins->name . ' - ' . $admins->nip }}</option>
                                        @else
                                        <option disabled value="">Anda Belum menambahkan Admin</option>
                                        @endif
                                    </select>
                                    @else
                                    <select disabled class="custom-select @error('stamp') is-invalid @enderror" name="stamp" id="stamp">
                                        <option value="">Belum Dipilih</option>
                                    </select>
                                    @endif
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
                                    @if($mutation->status == 3 || $mutation->status == 4)
                                    <textarea readonly  autocomplete="off" class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="5">{{ $mutation->decree()->first()->information }}</textarea>
                                    @else
                                    <textarea  autocomplete="off" class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="5"></textarea>
                                    @endif
                                    <div class="invalid-feedback">
                                        @error('information') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('/mutation') }}" type="button" title="Kembali" class="btn btn-primary">Kembali</a>
                            @if($mutation->status == 1)
                            <a href="{{ url('mutation/' . $mutation->mutation_id . '/edit') }}" type="button" title="Ubah Data" class="btn btn-success">Edit</a>
                            @elseif($mutation->status == 3)
                            <a target="_blank" href="{{ url('/pegawai/' . $employee->user_id . '/mutation/' . $mutation->mutation_id . '/print') }}" type="button" title="Cetak" class="btn btn-success">Cetak</a>
                            <div class="alert alert-info my-2">Saat Cetak ditekan otomatis status mutasi akan berubah menjadi Selesai!</div>
                            @elseif($mutation->status == 4)
                            <a target="_blank" href="{{ url('/pegawai/' . $employee->user_id . '/mutation/' . $mutation->mutation_id . '/print') }}" type="button" title="Cetak" class="btn btn-success">Cetak</a>
                            @else

                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
