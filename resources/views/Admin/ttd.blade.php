@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Daftarkan TTD</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="kbw-signature" style="width: 300px;margin: 20px 0; height: 240px;border: 1px solid rgba(59, 53, 53, 0.233);" ></div>
                    </div>
                    <div class="col-12 text-center">
                        <a href="{{ url()->previous() }}" class="btn btn-info" >Kembali</a>
                        <button class="btn btn-danger" id="clear">Hapus</button>
                        <button class="btn btn-success btn-save-signature" data-id="{{ Auth::user()->user_id }}">Simpan TTD</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
