@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Absensi</h4>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="employee">Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <select class="custom-select" id="employee">
                                        @foreach($users as $user)
                                        <option value="{{$user->user_id}}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('employee') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="date">Periode</label>
                                <div class="input-group">
                                    <div class="input-group input-daterange">
                                        <input class="form-control" type="month" value="{{ $date }}" name="date" id="date">
                                        <button class="btn btn-primary btn-sm mx-2" type="submit"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="employee">Pegawai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <select class="custom-select" id="employee">
                                        @foreach($users as $user)
                                        <option value="{{$user->user_id}}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('employee') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="date">Periode</label>
                                <div class="input-group">
                                    <div class="input-group input-daterange">
                                        <input class="form-control" type="month" value="{{ $date }}" name="date" id="date">
                                        <button class="btn btn-primary btn-sm mx-2" type="submit"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
