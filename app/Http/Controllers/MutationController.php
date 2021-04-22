<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Requests\MutationRequest;
use App\Models\Mutation;
use App\Models\TypeMutation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $title = 'Mutasi';
        $mutations = $employee->mutation()->get();
        return view('Employee/Mutation/index', compact('mutations', 'employee', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $employee)
    {
        $title = 'Mutasi';
        $type_mutations = TypeMutation::all();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Mutation/create', compact('employee', 'type_mutations', 'title', 'admins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MutationRequest $request, User $employee)
    {
        $mutation = $employee->mutation()->create([
            'new_work_unit' => $request->work_unit,
            'region_work' => $request->region_work_unit,
            'address' => $request->address,
            'status' => 3,
            'date_mutation' => $request->sk_date_start
        ]);
        $mutation->decree()->create([
            'title' => 'mutasi',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);
        DB::table('mutation_type')->insert(['type_mutation_id' => $request->type_mutation, 'mutation_id' => $mutation->mutation_id]);
        return redirect('/pegawai/'. $employee->user_id . '/mutation/'. $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function print(User $employee = null, Mutation $mutation)
    {
        $employee = ($employee == null) ? User::find(Auth::user()->user_id) : $employee;
        $mutation->update(['status' => 4]);
        return Helper::print_mutation($employee, $mutation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee, Mutation $mutation)
    {
        $title = 'Mutasi';
        $admins = ($mutation->status == 3 || $mutation->status == 4) ? User::find($mutation->decree()->first()->signature) : User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Mutation/show', compact('mutation', 'employee', 'title', 'admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee, Mutation $mutation)
    {
        $title = 'Mutasi';
        $type_mutations = TypeMutation::all();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Mutation/edit', compact('employee', 'type_mutations', 'mutation', 'title', 'admins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MutationRequest $request, User $employee, Mutation $mutation)
    {
        $mutation->update([
            'new_work_unit' => $request->work_unit,
            'region_work' => $request->region_work_unit,
            'address' => $request->address,
            'status' => 3,
            'date_mutation' => $request->sk_date_start
        ]);
        $mutation->decree()->create([
            'title' => 'mutasi',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);
        return redirect('/pegawai/'. $employee->user_id . '/mutation/'  . $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Disetujui & Terbit SK.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
    public function decline(User $employee, Mutation $mutation)
    {
        $mutation->update(['status' => 5]);
        return redirect('/pegawai/'. $employee->user_id . '/mutation')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Ditolak.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function getSKNumber()
    {
        return response()->json(['status' => 'success', 'data' => Helper::getSkNumberMutation()], 200);
    }
    public function checkSKMutation(Request $request)
    {
        return response()->json(['status' => 'success', 'data' => Helper::getCheckSKMutation($request->data)], 200);
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
        $data = ($statusID == 9) ? Mutation::select('users.nip')->addSelect('mutations.mutation_id')->addSelect('mutations.new_work_unit')->addSelect('users.name')->addSelect('mutations.date_mutation')->addSelect('mutations.status')->join('user_mutation', 'mutations.mutation_id', 'user_mutation.mutation_id')->join('users', 'users.user_id', 'user_mutation.user_id')->whereBetween('mutations.created_at', [$fromDate, $toDate . ' 23:59:59'])->orderBy('mutations.created_at', 'desc')->get() : Mutation::select('users.nip')->addSelect('users.name')->addSelect('mutations.start_date')->addSelect('mutations.finish_date')->addSelect('furloughs.status')->join('user_furloughs', 'furloughs.furlough_id', 'user_furloughs.furlough_id')->join('users', 'users.user_id', 'user_furloughs.user_id')->whereBetween('mutations.created_at', [$fromDate, $toDate . ' 23:59:59'])->orderBy('mutations.created_at', 'desc')->where('mutations.status', $statusID)->get();
        return view('MasterData/Mutation/index', compact('status', 'fromDate', 'toDate', 'statusID', 'data'));
    }
    public function create_admin()
    {
        $type_mutations = TypeMutation::all();
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Mutation/create', compact('admins', 'employee', 'type_mutations'));
    }
    public function store_admin(MutationRequest $request)
    {
        $employee = User::find($request->employee);
        $mutation = $employee->mutation()->create([
            'new_work_unit' => $request->work_unit,
            'region_work' => $request->region_work_unit,
            'address' => $request->address,
            'status' => 3,
            'date_mutation' => $request->sk_date_start
        ]);
        $mutation->decree()->create([
            'title' => 'mutasi',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);
        DB::table('mutation_type')->insert(['type_mutation_id' => $request->type_mutation, 'mutation_id' => $mutation->mutation_id]);
        return redirect('/mutation/' . $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_admin(Mutation $mutation)
    {
        $employee = $mutation->user()->first();
        $admins = ($mutation->status == 3 || $mutation->status == 4) ? User::find($mutation->decree()->first()->signature) : User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Mutation/show', compact('employee', 'mutation', 'admins'));
    }
    public function edit_admin(Mutation $mutation)
    {
        $employee = $mutation->user()->first();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $type_mutations = TypeMutation::all();
        return view('MasterData/Mutation/edit', compact('employee', 'mutation', 'type_mutations', 'admins'));
    }
    public function update_admin(MutationRequest $request, Mutation $mutation)
    {
        $mutation->update([
            'new_work_unit' => $request->work_unit,
            'region_work' => $request->region_work_unit,
            'address' => $request->address,
            'status' => 3,
            'date_mutation' => $request->sk_date_start
        ]);
        $mutation->decree()->create([
            'title' => 'mutasi',
            'sk_number' => $request->sk_number,
            'sk_date_start' => $request->sk_date_start,
            'sk_date_finish' => null,
            'sk_file' => null,
            'signature' => $request->stamp,
            'status' => 1,
            'information' => $request->information
        ]);
        return redirect('/mutation/' . $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Disetujui & Terbit SK.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function delete_admin(Mutation $furlough)
    {
        $furlough->update(['status' => 5]);
        return redirect('/cuti/'. $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Ditolak.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
}
