<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Requests\FurloughRequest;
use App\Models\Employments;
use App\Models\Furlough;
use App\Models\OccupationGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FurloughController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $title = 'Cuti';
        return view('Employee/Furlough/index', compact( 'employee', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $employee)
    {
        $title = 'Cuti';
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Furlough/create', compact('employee', 'title', 'admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FurloughRequest $request, User $employee)
    {
        $furlough = $employee->furlough()->create([
            'type_furlough' => $request->type_furlough,
            'long_furlough' => $request->long_furlough,
            'in_number' => $request->in_number,
            'time_format' => $request->time_format,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'status' => 3
        ]);

        if(!is_null($request->ketentuan) && is_array($request->ketentuan)) {
            foreach($request->ketentuan as $ket) {
                if($ket != '') {
                    $furlough->provision()->create(['provision_name' => $ket]);
                }
            }
        }

        $furlough->decree()->create([
            'title' => 'cuti',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);

        return redirect('/pegawai/'. $employee->user_id . '/cuti/' . $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function print(User $employee = null, Furlough $furlough)
    {
        $furlough->update(['status' => 4]);
        $employee = ($employee == null) ? User::find(Auth::user()->user_id) : $employee;
        return Helper::print_furlough($employee, $furlough);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee, Furlough $furlough)
    {
        $title = 'Cuti';
        $admins = ($furlough->status == 3 || $furlough->status == 4) ? User::find($furlough->decree()->first()->signature) : User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Furlough/show', compact('furlough', 'employee', 'title', 'admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee, Furlough $furlough)
    {
        $title = 'Cuti';
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Furlough/edit', compact('employee', 'furlough', 'title', 'admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FurloughRequest $request, User $employee, Furlough $furlough)
    {
        $furlough->update([
            'type_furlough' => $request->type_furlough,
            'long_furlough' => $request->long_furlough,
            'in_number' => $request->in_number,
            'time_format' => $request->time_format,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'status' => 3
        ]);

        $furlough->provision()->delete();

        if(!is_null($request->ketentuan) && is_array($request->ketentuan)) {
            foreach($request->ketentuan as $ket) {
                if($ket != '') {
                    $furlough->provision()->create(['provision_name' => $ket]);
                }
            }
        }

        $furlough->decree()->create([
            'title' => 'cuti',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);
        return redirect('/pegawai/'. $employee->user_id . '/cuti/' . $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Disetujui & Terbit SK.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function decline(User $employee, Furlough $furlough)
    {
        $furlough->update(['status' => 5]);
        return redirect('/pegawai/'. $employee->user_id . '/cuti')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Ditolak.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function getSKNumber()
    {
        return response()->json(['status' => 'success', 'data' => Helper::getSkNumberFurlough()], 200);
    }
    public function checkSKFurlough(Request $request)
    {
        return response()->json(['status' => 'success', 'data' => Helper::getCheckSKFurlough($request->data)], 200);
    }
    public function index_admin(Request $request)
    {
        $status = ['Dibatalkan', 'Dibuat', 'Disetujui', 'Terbit SK', 'Selesai', 'Ditolak'];
        if(!is_null($request->fromDate) && !is_null($request->toDate)) {
            $fromDate = $request->fromDate;
            $toDate = $request->toDate;
            if(strtotime($fromDate) > strtotime($toDate)) {
                $temp = $fromDate;
                $fromDate = $toDate;
                $toDate = $temp;
            }
        }
        $fromDate = ($request->fromDate) ? $request->fromDate : date('Y') . '-' . date('m') . '-01';
        $toDate = ($request->toDate) ? $request->toDate : date('Y') . '-' . date('m') . '-'. date('d');
        $statusID = ($request->status) ? $request->status : '9';$data = '';
        $data = ($statusID == 9) ? Furlough::select('users.nip')->addSelect('furloughs.furlough_id')->addSelect('users.name')->addSelect('furloughs.start_date')->addSelect('furloughs.finish_date')->addSelect('furloughs.status')->join('user_furloughs', 'furloughs.furlough_id', 'user_furloughs.furlough_id')->join('users', 'users.user_id', 'user_furloughs.user_id')->whereBetween('furloughs.created_at', [$fromDate, $toDate . ' 23:59:59'])->orderBy('furloughs.created_at', 'desc')->get() : Furlough::select('users.nip')->addSelect('furloughs.furlough_id')->addSelect('users.name')->addSelect('furloughs.start_date')->addSelect('furloughs.finish_date')->addSelect('furloughs.status')->join('user_furloughs', 'furloughs.furlough_id', 'user_furloughs.furlough_id')->join('users', 'users.user_id', 'user_furloughs.user_id')->whereBetween('furloughs.created_at', [$fromDate, $toDate . ' 23:59:59'])->orderBy('furloughs.created_at', 'desc')->where('furloughs.status', $statusID)->get();
        return view('MasterData/Furlough/Furlough', compact('status', 'fromDate', 'toDate', 'statusID', 'data'));
    }
    public function create_admin()
    {
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Furlough/create', compact('admins', 'employee'));
    }
    public function store_admin(FurloughRequest $request)
    {
        $employee = User::find($request->employee);
        $furlough = $employee->furlough()->create([
            'type_furlough' => $request->type_furlough,
            'long_furlough' => $request->long_furlough,
            'in_number' => $request->in_number,
            'time_format' => $request->time_format,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'status' => 3
        ]);

        if(!is_null($request->ketentuan) && is_array($request->ketentuan)) {
            foreach($request->ketentuan as $ket) {
                if($ket != '') {
                    $furlough->provision()->create(['provision_name' => $ket]);
                }
            }
        }

        $furlough->decree()->create([
            'title' => 'cuti',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);

        return redirect('/cuti/' . $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_admin(Furlough $furlough)
    {
        $employee = $furlough->user()->first();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Furlough/detailFurlough', compact('employee', 'furlough', 'admins'));
    }
    public function edit_admin(Furlough $furlough)
    {
        $employee = $furlough->user()->first();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Furlough/edit', compact('employee', 'furlough', 'admins'));
    }
    public function update_admin(FurloughRequest $request, Furlough $furlough)
    {
        $furlough->update([
            'type_furlough' => $request->type_furlough,
            'long_furlough' => $request->long_furlough,
            'in_number' => $request->in_number,
            'time_format' => $request->time_format,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'status' => 3
        ]);

        $furlough->provision()->delete();

        if(!is_null($request->ketentuan) && is_array($request->ketentuan)) {
            foreach($request->ketentuan as $ket) {
                if($ket != '') {
                    $furlough->provision()->create(['provision_name' => $ket]);
                }
            }
        }

        $furlough->decree()->create([
            'title' => 'cuti',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);
        return redirect('cuti/' . $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Disetujui & Terbit SK.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function delete_admin(Furlough $furlough)
    {
        $furlough->update(['status' => 5]);
        return redirect('/cuti/'. $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Ditolak.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
}
