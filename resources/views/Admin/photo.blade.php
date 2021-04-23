@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Ubah Foto</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/photo') }}" method="post" enctype="multipart/form-data">@csrf
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="img img-thumbnail img-responsive" id="img-profile-photo" width="300" src="{{ asset('images/profile/employee/' . Auth::user()->profile_photo) }}" alt="profile">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group row justify-content-center">
                                <label for="image">Foto</label>
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image-profile">
                                        <label class="custom-file-label" class="label-image" for="image">Pilih Foto</label>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-2">
                            <a href="{{ url()->previous() }}" class="btn btn-info">Kembali</a>
                            <button type="button" class="btn btn-warning btn-reload-profile" style="display: none;">Batalkan</button>
                            <button type="submit" class="btn btn-success ">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
