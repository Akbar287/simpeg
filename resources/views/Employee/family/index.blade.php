@extends('Employee.detailEmployee')

@section('subcontent')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Keluarga</h4>
                <div class="card-header-action">
                    <a href="{{ url('/pegawai/'. $employee->user_id .'/family/create') }}" class="btn btn-primary add-wu">Tambah Data</a>
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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Hubungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($families as $family)
                                        <tr>
                                            <td>{{ $family->nik }}</td>
                                            <td>{{ $family->name }}</td>
                                            <td>{{ $family->relationship }}</td>
                                            <td><a href="{{ url('/pegawai/'.$employee->user_id . '/family/' . $family->family_id) }}" class="btn btn-primary btn-sm">Detail</a></td>
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
