@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Jabatan</h4>
                <div class="card-header-action">
                    <button class="btn btn-primary add-emp">+</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-stripped">
                        <thead>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Pegawai</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($employments as $employment)
                                <tr>
                                    <td class="no" data-no="{{$loop->iteration  }}">{{$loop->iteration  }}</td>
                                    <td class="name">{{ $employment->employment_name }}</td>
                                    <td class="employee">{{ $employment->user }}</td>
                                    <td class="action"><button class="btn btn-danger btn-sm rounded del-emp" title="Hapus"><i class="fas fa-minus"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<form class="modal-part" id="modal-create-emp"><div class="form-group"><label>Nama Jabatan</label><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="fas fa-sitemap"></i></div></div><input type="text" class="form-control input-create-emp" autocomplete="off" placeholder="Nama Jabatan" name="text"></div></div></form>
@endsection
