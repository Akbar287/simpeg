@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Mutasi</h4>
                <div class="card-header-action">
                    <b>Status: {{ Helper::statusMutation($mutation->status) }}</b>
                </div>
            </div>
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="wizard-steps">
                            @if($mutation->status == 0)
                            <div class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibuat
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-danger">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibatalkan
                                </div>
                            </div>
                            @elseif($mutation->status == 5)
                            <div class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibuat
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-danger">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Ditolak
                                </div>
                            </div>
                            @else
                            <div class="wizard-step wizard-step-{{($mutation->status >= 1) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-pen"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Dibuat
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-{{($mutation->status >= 2) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-signature"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Disetujui
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-{{($mutation->status >= 3) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-file-signature"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Terbit SK
                                </div>
                            </div>
                            <div class="wizard-step wizard-step-{{($mutation->status == 4) ? 'success' : 'active'}}">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Selesai
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{ url('/izinmutasi') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="type_mutation">Jenis Mutasi Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <select disabled class="custom-select @error('type_mutation') is-invalid @enderror" name="type_mutation" id="type_mutation">
                                        @foreach($type_mutations as $type_mutation)
                                        <option {{ ($mutation->type_mutation()->first()->type_mutation_id == $type_mutation->type_mutation_id) ? 'selected' : '' }} value="{{ $type_mutation->type_mutation_id }}">{{ $type_mutation->type_mutation_name }}</option>
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
                        <div class="col-12">
                            <a href="{{ url('/izinmutasi') }}" type="button" title="Kembali" class="btn btn-primary">Kembali</a>
                            @if($mutation->status == 1)
                            <a href="{{ url('izinmutasi/' . $mutation->mutation_id . '/edit') }}" type="button" title="Ubah Data" class="btn btn-success">Edit</a>
                            <button type="button" title="Batalkan Mutasi" class="btn btn-danger" onclick="(confirm('Data Mutasi akan dibatalkan!\nLanjutkan?')) ? document.getElementById('cancelMutation').submit() : ''">Batalkan Mutasi</button>
                            @elseif($mutation->status == 4)
                            <a target="_blank" href="{{ url('/izinmutasi/' . $mutation->mutation_id . '/print') }}" type="button" title="Cetak" class="btn btn-success">Cetak</a>
                            @else
                            @endif
                        </div>
                    </div>
                </form><form action="{{ url('izinmutasi/' . $mutation->mutation_id) }}" method="post" id="cancelMutation">@csrf @method('delete')</form>
            </div>
        </div>
    </div>
</div>
@endsection
