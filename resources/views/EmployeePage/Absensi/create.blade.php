@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    @if(session('msg')){!! session('msg')  !!} @endif
    <div class="col-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                @if($checkNow) @empty($checkNow->finish_work)<h4>Absensi Penutup</h4> @endif @else<h4>Absensi</h4>@endif
            </div>
            @if($checkNow)
            @empty($checkNow->finish_work)
            <div class="card-body">
                <form class="wizard-content mt-2" action="{{ url('/absen') }}" method="post">@csrf
                    <div class="wizard-pane">
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left" for="date_work">Tanggal</label>
                            <div class="col-lg-4 col-md-6">
                                <input readonly type="date" name="date_work" id="date_work" value="{{ $checkNow->date_work }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left" for="start_work">Jam Masuk</label>
                            <div class="col-lg-4 col-md-6">
                                <input readonly type="time" name="start_work" id="start_work" value="{{ $checkNow->start_work }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left" for="finish_work">Jam Pulang</label>
                            <div class="col-lg-4 col-md-6">
                                <input readonly type="time" name="finish_work" id="finish_work" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left mt-2">Jenis Kerja</label>
                            <div class="col-lg-4 col-md-6">
                                <div class="selectgroup w-100">
                                    @if($checkNow->jenis_kerja == 'WFO')
                                    <label class="selectgroup-item">
                                        <input type="radio" readonly name="jenis_kerja" checked value="WFO" class="selectgroup-input">
                                        <span class="selectgroup-button">WFO</span>
                                    </label>
                                    @else
                                    <label class="selectgroup-item">
                                        <input type="radio" readonly name="jenis_kerja" checked value="WFH" class="selectgroup-input">
                                        <span class="selectgroup-button">WFH</span>
                                    </label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left" for="keterangan">Keterangan</label>
                            <div class="col-lg-4 col-md-6">
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-center">
                            <button type="submit" class="btn btn-icon icon-right btn-primary">Selesai</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="card-body">
                <p>Anda Sudah Absen Untuk Hari ini</p>
            </div>
            @endif
            @else
            <div class="card-body">
                <div class="row mt-4">
                    <div class="col-12 col-lg-8 offset-lg-2">
                        <div class="wizard-steps">
                            <div class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                    <i class="far fa-calendar-plus"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Data Absen
                                </div>
                            </div>
                            <div class="wizard-step">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Foto
                                </div>
                            </div>
                            <div class="wizard-step">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-map-marked-alt"></i>
                                </div>
                                <div class="wizard-step-label">
                                    Data Lokasi
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="wizard-content mt-2" method="post">

                    {{-- First Form --}}
                    <div class="wizard-pane">
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left" for="date_work">Tanggal</label>
                            <div class="col-lg-4 col-md-6">
                                <input readonly type="date" name="date_work" id="date_work" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-md-4 text-md-right text-left" for="start_work">Jam Masuk</label>
                            <div class="col-lg-4 col-md-6">
                                <input readonly type="time" name="start_work" id="start_work" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 text-md-right text-left mt-2">Jenis Kerja</label>
                            <div class="col-lg-4 col-md-6">
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_kerja" value="WFO" class="selectgroup-input">
                                        <span class="selectgroup-button">WFO</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="jenis_kerja" value="WFH" class="selectgroup-input">
                                        <span class="selectgroup-button">WFH</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4"></div>
                            <div class="col-lg-4 col-md-6 text-right">
                            <button disabled type="button" class="btn btn-icon icon-right btn-primary btn-next-first">Berikutnya <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- Second Form --}}
                    <div class="wizard-pane" style="display:none;">

                        <div class="form-group row align-items-center justify-content-center">
                            <div class="col-lg-6 col-md-6 text-center">
                                <p class="snap_type"></p>
                            </div>
                        </div>
                        <div class="form-group row align-items-center justify-content-center">
                            <div class="col-lg-6 col-md-6 text-center">
                                <video id="webcam" autoplay playsinline width="320" height="240"></video>
                                <canvas id="canvas" class="d-none"></canvas>
                            </div>
                            <div class="col-lg-6 col-md-6 text-center">
                                <img src="" alt="photo" class="img img-responsive img-thumbnail" id="snapshoot" style="display:none;">
                            </div>
                        </div>
                        <div class="form-group row align-items-center option-wfh" style="display:none;">
                            <div class="col-md-4"></div>
                            <div class="col-lg-6 col-md-6">
                                <button class="btn-primary btn" type="button" id="take_snap">Ambil Foto</button>
                                <button class="btn-primary btn" type="button" id="flip_camera">Putar Kamera</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <button type="button" class="btn btn-icon icon-left btn-primary btn-previous-second"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                            </div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <button disabled type="button" class="btn btn-icon icon-right btn-primary btn-next-second">Berikutnya <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- Third Form --}}
                    <div class="wizard-pane" style="display:none;">
                        <div class="form-group row align-items-center justify-content-center">
                            <div class="col-lg-6 col-md-6 text-center">
                                <button type="button" class="btn btn-primary" id="find-me">Ambil Lokasi</button>
                                <div></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <button type="button" class="btn btn-icon icon-left btn-primary btn-previous-third"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                            </div>
                            <div class="col-lg-4 col-md-6 text-right">
                                <button type="button" disabled class="btn btn-icon icon-right btn-primary btn-next-third">Selesai <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
