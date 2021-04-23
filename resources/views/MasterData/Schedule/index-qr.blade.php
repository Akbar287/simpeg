@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi Kode QR</h4>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <form action="{{ url('/jadwalkerja/qr') }}" method="get">@csrf
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-12 py-2 col-md-3">
                            <select name="status" id="status" class="custom-select">
                                <option value="0" {{ ("0" == $statusID) ? 'selected': '' }}>Semua Pegawai</option>
                                @if(!is_null($employee) && !empty($employee)) @foreach($employee as $employ)
                                <option value="{{ $employ->user_id }}" {{ ($employ->user_id == $statusID) ? 'selected': '' }}>{{ $employ->nip . ' - '.$employ->name }}</option>
                                @endforeach @endif
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 py-2 col-md-6">
                            <div class="row">
                                <div class="col-10">
                                    <input class="form-control" type="date" value="{{ $date }}" name="date" id="date">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary mx-2" type="submit"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="row">
            @foreach($data as $code)
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $code->user()->first()->name .' - '.$code->user()->first()->nip}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                {{ QrCode::size(200)->generate($code->random_string_barcode) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
