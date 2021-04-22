@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-4">
        <div class="card" style="min-height: 850px!important;overflow-x:hidden;overflow-y:scroll;">
            <div class="card-header">
              <h4>Pegawai</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border  list-employee-schedule">
                    @foreach($employee as $user)
                    <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="{{ asset('images/profile/employee/' . $user->profile_photo) }}">
                        <div class="media-body">
                            <div class="mt-0 mb-1 font-weight-bold"><a href="javascript:void(0)" data-user="{{ $user->user_id }}" data-name="{{ $user->name }}" class="jadwal-kerja-href">{{ $user->name }}</a></div>
                            <div class="text-secondary text-small font-600-bold"><i class="fas fa-circle"></i> {{ ($user->employment()->first() ? $user->employment()->first()->toArray()['employment_name'] : '-') }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-8">
        <div class="card card-calendar" style="display:none;">
            <div class="card-header">
                <h4 id="title-calendar">Jadwal Kerja Pegawai</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary btn-sm" data-user="" data-name="" id="add-schedule">Jadwalkan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="fc-overflow">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <form class="modal-part" id="modal-create-schedule">
        <div class="form-group">
            <label>Nama Pegawai</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="hidden" readonly class="form-control input-employee-sch-id" autocomplete="off" readonly value="" name="text" />
                <input type="text" readonly class="form-control input-employee-sch-name" autocomplete="off" readonly value="" name="text" />
            </div>
        </div>
        <div class="form-group">
            <label>Jenis Kerja</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-sitemap"></i></div>
                </div>
                <select name="jenis_kerja" class="custom-select input-jenis_kerja-sch">
                    <option value="WFO">WFO</option>
                    <option value="WFH">WFH</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Tanggal Kerja</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                </div>
                <input type="text" class="form-control input-date-sch" autocomplete="off" placeholder="Isi Tanggal ex: 1,4,9 | 3">
            </div>
        </div>
    </form>
</div>
@endsection
