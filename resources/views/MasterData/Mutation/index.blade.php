@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        @if(session('status')) {!! session('status') !!} @endif
        <div class="card">
            <div class="card-header">
                <h4>Mutasi</h4>
                <div class="card-header-action">
                    <a href="{{ url('/mutation/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                @if(session('msg')){!! session('msg')  !!} @endif
                <form action="{{ url('/cuti') }}" method="get">@csrf
                    <div class="form-group row justify-content-center">
                        <div class="col-12 col-sm-12 py-2 col-md-3">
                            <select name="status" id="status" class="custom-select">
                                <option value="9" {{ ("9" == $statusID) ? 'selected': '' }}>Semua status</option>
                                @if(!is_null($status) && !empty($status)) @foreach($status as $statu)
                                <option value="{{ Helper::statusMutationArray($statu) }}" {{ (Helper::statusMutationArray($statu) == $statusID) ? 'selected': '' }}>{{ $statu }}</option>
                                @endforeach @endif
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 py-2 col-md-6">
                            <div class="input-group input-daterange">
                                <input class="form-control" type="date" value="{{ $fromDate }}" name="fromDate" id="fromDate">
                                <div class="input-group-addon px-2">S/d</div>
                                <input class="form-control" type="date" value="{{ $toDate }}" name="toDate" id="toDate">
                                <button class="btn btn-primary btn-sm mx-2" type="submit"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table table-hover table-data">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Unit Kerja</th>
                                        <th>Waktu Dibuat</th>
                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $mutation)
                                    <tr>
                                        <td>{{ $mutation->mutation_id }}</td>
                                        <td>{{ $mutation->name }}</td>
                                        <td>{{ $mutation->new_work_unit }}</td>
                                        <td>{{ Helper::time($mutation->date_mutation) }}</td>
                                        <td>{{ Helper::statusMutation($mutation->status) }}</td>
                                        <td><a href="{{ url('mutation/'.$mutation->mutation_id) }}" class="btn btn-sm btn-primary btn-sm" title="Detail">Detail</a></td>
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
