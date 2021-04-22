@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Sasaran Kinerja Pegawai</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/pegawai/' . $employee->user_id . '/skp/'. $employeeWorkObjective->employee_work_objective_id) }}" method="post">@csrf @method('put')
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai Periode</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ $employeeWorkObjective->start_date }}" autocomplete="off" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date">
                                    <div class="invalid-feedback">
                                        @error('start_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="finish_date">Tanggal Selesai Periode</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                    <input type="date" value="{{ $employeeWorkObjective->finish_date }}" autocomplete="off" class="form-control @error('finish_date') is-invalid @enderror" name="finish_date" id="finish_date">
                                    <div class="invalid-feedback">
                                        @error('finish_date') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="assessor_officials">Nama Pejabat Penilai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
                                    </div>
                                    <input type="text" value="{{ $employeeWorkObjective->assessor_officials }}" autocomplete="off" class="form-control @error('assessor_officials') is-invalid @enderror" name="assessor_officials" id="assessor_officials">
                                    <div class="invalid-feedback">
                                        @error('assessor_officials') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="appraisal_official_superior">Nama Atasan Pejabat Penilai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input type="text" value="{{ $employeeWorkObjective->appraisal_official_superior }}" autocomplete="off" class="form-control @error('appraisal_official_superior') is-invalid @enderror" name="appraisal_official_superior" id="appraisal_official_superior">
                                    <div class="invalid-feedback">
                                        @error('appraisal_official_superior') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="service_orientation_value">Nilai Orientasi Pelayanan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-check"></i></div>
                                    </div>
                                    <input type="number" value="{{ $employeeWorkObjective->service_orientation_value }}" min="0" max="100" class="form-control @error('service_orientation_value') is-invalid @enderror " name="service_orientation_value" id="service_orientation_value"/>
                                    <div class="invalid-feedback">
                                        @error('service_orientation_value') {{ $message }} @enderror
                                    </div>
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Diisi dengan Angka 0 - 100 (Bilangan bulat)
                                </small>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="integrity_value">Nilai Integritas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-shield"></i></div>
                                    </div>
                                    <input type="number" value="{{ $employeeWorkObjective->integrity_value }}" min="0" max="100" class="form-control @error('integrity_value') is-invalid @enderror " name="integrity_value" id="integrity_value"/>
                                    <div class="invalid-feedback">
                                        @error('integrity_value') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="commitment_value">Nilai Komitmen</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-lock"></i></div>
                                    </div>
                                    <input type="number" value="{{ $employeeWorkObjective->commitment_value }}" min="0" max="100" class="form-control @error('commitment_value') is-invalid @enderror " name="commitment_value" id="commitment_value"/>
                                    <div class="invalid-feedback">
                                        @error('commitment_value') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="discipline_value">Nilai Disiplin</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-clock"></i></div>
                                    </div>
                                    <input type="number" value="{{ $employeeWorkObjective->discipline_value }}" min="0" max="100" class="form-control @error('discipline_value') is-invalid @enderror " name="discipline_value" id="discipline_value"/>
                                    <div class="invalid-feedback">
                                        @error('discipline_value') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="teamwork_value">Nilai Kerjasama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-people-carry"></i></div>
                                    </div>
                                    <input type="number" value="{{ $employeeWorkObjective->teamwork_value }}" min="0" max="100" class="form-control @error('teamwork_value') is-invalid @enderror " name="teamwork_value" id="teamwork_value"/>
                                    <div class="invalid-feedback">
                                        @error('teamwork_value') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="leader_value">Nilai Kepemimpinan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user-friends"></i></div>
                                    </div>
                                    <input type="number" value="{{ $employeeWorkObjective->leader_value }}" min="0" max="100" class="form-control @error('leader_value') is-invalid @enderror " name="leader_value" id="leader_value"/>
                                    <div class="invalid-feedback">
                                        @error('leader_value') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="rating_result">Hasil Penilaian</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-users-cog"></i></div>
                                    </div>
                                    <select class="form-control @error('rating_result') is-invalid @enderror" name="rating_result" id="rating_result">
                                        <option {{ $employeeWorkObjective->rating_result == 'Kurang Baik' ? 'selected' : '' }} value="Kurang Baik">Kurang Baik</option>
                                        <option {{ $employeeWorkObjective->rating_result == 'Baik' ? 'selected' : '' }} value="Baik">Baik</option>
                                        <option {{ $employeeWorkObjective->rating_result == 'Cukup Baik' ? 'selected' : '' }} value="Cukup Baik">Cukup Baik</option>
                                        <option {{ $employeeWorkObjective->rating_result == 'Sangat Baik' ? 'selected' : '' }} value="Sangat Baik">Sangat Baik</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('rating_result') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <a href="{{ url('pegawai/' . $employee->user_id . '/skp/' . $employeeWorkObjective->employee_work_objective_id) }}" title="Kembali" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-success" title="Simpan">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
