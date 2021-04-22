@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
                <div class="card-header-action">
                    <b>Status Cuti: {{ Helper::statusMutation($furlough->status) }}</b>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/pegawai/' . $employee->user_id . '/cuti') }}" method="post">@csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="type_furlough">Alasan Cuti Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <input readonly type="text" value="{{ $furlough->type_furlough }}" autocomplete="off" class="form-control @error('type_furlough') is-invalid @enderror" name="type_furlough" id="type_furlough">
                                    <div class="invalid-feedback">
                                        @error('type_furlough') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai Cuti</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input readonly type="date" value="{{ $furlough->start_date }}" autocomplete="off" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">
                                    <div class="invalid-feedback">
                                        @error('start_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="finish_date">Tanggal Selesai Cuti</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input readonly type="date" value="{{ $furlough->finish_date }}" autocomplete="off" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" id="finish_date">
                                    <div class="invalid-feedback">
                                        @error('finish_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="long_furlough">Lama Cuti</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-building"></i></div>
                                    </div>
                                    <select disabled class="form-control @error('long_furlough') is-invalid @enderror" name="long_furlough" id="long_furlough">
                                        @for($i=1;$i <= 20; $i++)
                                        <option value="{{ $i }}" {{ ($i == $furlough->long_furlough) }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('long_furlough') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="in_number">Lama Cuti (Terbilang)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-id-card-alt"></i></div>
                                    </div>
                                    <input readonly type="text" value="{{ $furlough->in_number }}" autocomplete="off" class="form-control @error('in_number') is-invalid @enderror" name="in_number" id="in_number">
                                    <div class="invalid-feedback">
                                        @error('in_number') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="time_format">Format Waktu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
                                    </div>
                                    <select disabled class="form-control @error('time_format') is-invalid @enderror" name="time_format" id="time_format" >
                                        <option value="Hari">Hari</option>
                                        <option value="Minggu">Minggu</option>
                                        <option value="Bulan">Bulan</option>
                                        <option value="Tahun">Tahun</option>
                                        <option value="Abad">Abad</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('time_format') {{ $message }} @enderror
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
                                    @if($furlough->status == 3 || $furlough->status == 4)
                                    <input readonly type="text" value="{{ $furlough->decree()->first()->sk_number }}" autocomplete="off" class="form-control @error('sk_number') is-invalid @enderror" name="sk_number" id="sk_number">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-primary btn-generate-cuti" type="button">Generate</button>
                                        <button disabled class="btn btn-primary btn-check-cuti" type="button">Cek</button>
                                    </div>
                                    @else
                                    <input readonly type="text" value="" autocomplete="off" class="form-control @error('sk_number') is-invalid @enderror" name="sk_number" id="sk_number">
                                    <div class="input-group-append">
                                        <button disabled class="btn btn-primary btn-generate-cuti" type="button">Generate</button>
                                        <button disabled class="btn btn-primary btn-check-cuti" type="button">Cek</button>
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
                                    @if($furlough->status == 3 || $furlough->status == 4)
                                    <input readonly type="date" value="{{ $furlough->decree()->first()->sk_date_start }}" autocomplete="off" class="form-control @error('sk_date_start') is-invalid @enderror" name="sk_date_start" id="sk_date_start">
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
                                    @if($furlough->status == 3 || $furlough->status == 4)
                                    <select disabled class="form-control @error('stamp') is-invalid @enderror" name="stamp" id="stamp">
                                        @if(!is_null($admins))
                                        <option value="">{{ $admins->name . ' - ' . $admins->nip }}</option>
                                        @else
                                        <option disabled value="">Anda Belum menambahkan Admin</option>
                                        @endif
                                    </select>
                                    @else
                                    <select disabled class="form-control @error('stamp') is-invalid @enderror" name="stamp" id="stamp">
                                        <option value="">Belum Dipilih</option>
                                    </select>
                                    @endif
                                    <div class="invalid-feedback">
                                        @error('stamp') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-ketentuan">
                            <div class="form-group form-ketentuan">
                                <label for="ketentuan">Ketentuan</label>
                                @if($furlough->provision()->count() == 0)
                                <p class="text-danger text-center">Tidak ada Ketentuan</p>
                                @else
                                @foreach($furlough->provision()->get() as $ket)
                                <div class="input-group my-{{$loop->iteration}} ketentuan-{{$loop->iteration}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{$loop->iteration}}</div>
                                    </div>
                                    <input readonly type="text" value="{{$ket->provision_name}}" autocomplete="off" name="ketentuan[]" class="form-control">
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="float-right">
                                <div class="btn-group"><button disabled type="button" class="btn btn-primary btn-sm btn-add-ketentuan">+ Ketentuan</button><button disabled type="button" class="btn btn-danger btn-sm btn-remove-ketentuan">- Ketentuan</button></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="information">Keterangan</label>
                                <div class="input-group">
                                    @if($furlough->status == 3 || $furlough->status == 4)
                                    <textarea readonly autocomplete="off" class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="5">{{ $furlough->decree()->first()->information }}</textarea>
                                    @else
                                    <textarea readonly autocomplete="off" class="form-control @error('information') is-invalid @enderror" name="information" id="information" rows="5"></textarea>
                                    @endif
                                    <div class="invalid-feedback">
                                        @error('information') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ url('/pegawai/' . $employee->user_id . '/cuti') }}" type="button" title="Kembali" class="btn btn-primary">Kembali</a>
                            @if($furlough->status == 1)
                            <a href="{{ url('/pegawai/' . $employee->user_id . '/cuti/' . $furlough->furlough_id . '/edit') }}" type="button" title="Ubah Data" class="btn btn-success">Edit</a>
                            @elseif($furlough->status == 3)
                            <a target="_blank" href="{{ url('/pegawai/' . $employee->user_id . '/cuti/' . $furlough->furlough_id . '/print') }}" type="button" title="Cetak" class="btn btn-success">Cetak</a>
                            <div class="alert alert-info my-2">Saat Cetak ditekan otomatis status cuti akan berubah menjadi Selesai!</div>
                            @elseif($furlough->status == 4)
                            <a target="_blank" href="{{ url('/pegawai/' . $employee->user_id . '/cuti/' . $furlough->furlough_id . '/print') }}" type="button" title="Cetak" class="btn btn-success">Cetak</a>
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
