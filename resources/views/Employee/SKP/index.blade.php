@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Sasaran Kinerja Pegawai</h4>
                <div class="card-header-action">
                    <a href="{{ url('/pegawai/'. $employee->user_id .'/skp/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('msg')){!! session('msg')  !!} @endif
                        <div class="table-responsive">
                            <table class="table table-hover table-data">
                                <thead>
                                    <tr>
                                        <th rowspan=2>
                                            <p>No</p>
                                        </th>
                                        <th colspan=2 class="text-center">
                                            <p>Periode Penilaian</p>
                                        </th>
                                        <th colspan=2 class="text-center">
                                            <p>Penilai</p>
                                        </th>
                                        <th rowspan=2>
                                            <p>N total</p>
                                        </th>
                                        <th rowspan=2>
                                            <p>Rata<sup>2</sup></p>
                                        </th>
                                        <th rowspan=2>
                                            <p>Mutu</p>
                                        </th>
                                        <th rowspan=2>
                                            <p>Aksi</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>Awal</p>
                                        </th>
                                        <th>
                                            <p>Akhir</p>
                                        </th>
                                        <th>
                                            <p>Pejabat</p>
                                        </th>
                                        <th>
                                            <p>Atasan Pejabat</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->employee_work_objective()->get() as $employee_work_objective)
                                    <tr>
                                        <td>
                                            <p>{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p>{{ Helper::time($employee_work_objective->start_date) }}</p>
                                        </td>
                                        <td>
                                            <p>{{ Helper::time($employee_work_objective->finish_date) }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $employee_work_objective->assessor_officials }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $employee_work_objective->appraisal_official_superior }}</p>
                                        </td>
                                        <td>
                                            <p>{{ round(array_sum([$employee_work_objective->service_orientation_value, $employee_work_objective->integrity_value, $employee_work_objective->commitment_value, $employee_work_objective->discipline_value, $employee_work_objective->teamwork_value, $employee_work_objective->leader_value])) }}</p>
                                        </td>
                                        <td>
                                            <p>{{ round(array_sum([$employee_work_objective->service_orientation_value, $employee_work_objective->integrity_value, $employee_work_objective->commitment_value, $employee_work_objective->discipline_value, $employee_work_objective->teamwork_value, $employee_work_objective->leader_value]) / 6) }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $employee_work_objective->rating_result }}</p>
                                        </td>
                                        <td><a href="{{ url('/pegawai/' . $employee->user_id . '/skp/' . $employee_work_objective->employee_work_objective_id) }}" class="btn btn-primary btn-sm" title="Ubah Data"><i class="fa fa-pen"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
