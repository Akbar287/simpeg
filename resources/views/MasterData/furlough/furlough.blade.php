@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Cuti</h4>
                <div class="card-header-action">
                    <a href="{{ url('/cuti/create') }}" class="btn btn-primary add-wu">+</a>
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
                                <option value="{{ Helper::statusFurloughArray($statu) }}" {{ (Helper::statusFurloughArray($statu) == $statusID) ? 'selected': '' }}>{{ $statu }}</option>
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
                <div class="table-responsive">
                    <table class="table table-hover table-stripped table-data">
                        <thead>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Mulai Cuti</th>
                            <th>Selesai Cuti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->nip }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ Helper::time($d->start_date) }}</td>
                                <td>{{ Helper::time($d->finish_date) }}</td>
                                <td>{{ Helper::statusFurlough($d->status) }}</td>
                                <td><a href="{{ url('/cuti/' . $d->furlough_id) }}" class="btn btn-primary btn-sm">Detail</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
