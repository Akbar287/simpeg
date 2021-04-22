@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Unit Kerja</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary add-wu">+</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                        <thead>
                            <th>No</th>
                            <th>Nama Unit Kerja</th>
                            <th>Pegawai</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($work_units as $work_unit)
                                <tr>
                                    <td class="no" data-no="{{$loop->iteration  }}">{{$loop->iteration  }}</td>
                                    <td class="name">{{ $work_unit->work_unit_name }}</td>
                                    <td class="employee">{{ $work_unit->user }}</td>
                                    <td class="action"><button class="btn btn-danger btn-sm rounded del-wu" title="Hapus"><i class="fas fa-minus"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form class="modal-part" id="modal-create-wu"><div class="form-group"><label>Nama Unit Kerja</label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-building"></i></div></div><input type="text" class="form-control input-create-wu" autocomplete="off" placeholder="Nama Unit Kerja" name="text"></div></div></form>
@endsection
