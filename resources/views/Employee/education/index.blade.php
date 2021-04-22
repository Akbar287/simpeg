@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Pendidikan</h4>
                <div class="card-header-action">
                    <a href="{{ url('/pegawai/'. $employee->user_id .'/education/create') }}" class="btn btn-primary add-wu">Tambah Data</a>
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
                                        <th>Tingkat</th>
                                        <th>Nama Sekolah</th>
                                        <th>Lokasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->education()->get() as $education)
                                        <tr>
                                            <td>{{ $education->grade }}</td>
                                            <td>{{ $education->school_name }}</td>
                                            <td>{{ $education->location }}</td>
                                            <td><a href="{{ url('/pegawai/'.$employee->user_id . '/education/' . $education->education_id) }}" class="btn btn-sm btn-primary" title="Detail">Detail</a></td>
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
