<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Employments;
use App\Models\OccupationGroup;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pegawai';
        $employees = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'pegawai')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->get();
        return view('Employee/employee', compact('employees', 'title'));
    }

    public function create()
    {
        $title = 'Pegawai';
        $work_units = WorkUnit::all();
        $occupations = OccupationGroup::get()->toArray();
        $employments = Employments::all();
        return view('Employee/create', compact('title', 'work_units', 'occupations', 'employments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->nip = $request->nip;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->religion = $request->religion;
        $user->gender = $request->gender;
        $user->blood_type = $request->blood_type;
        $user->profile_photo = 'nophoto.png';
        $user->place_born = $request->place_born;
        $user->date_born = $request->date_born;
        $user->marital_status = $request->marital_status;
        $user->address = $request->address;
        $user->telephone_number = $request->telephone_number;
        $user->password = Hash::make('123');
        $user->save();

        DB::table('user_role')->insert([
            'user_id' => $user->user_id,
            'id' => 2
        ]);
        DB::table('user_work_unit')->insert([
            'user_id' => $user->user_id,
            'work_unit_id' => $request->work_unit
        ]);

        DB::table('occupations')->insert([
            'user_id' => $user->user_id,
            'occupation_group_id' => $request->occupation,
            'employment_id' => $request->employment,
            'status' => 1
        ]);

        return redirect('/pegawai/'. $user->user_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Pegawai Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(User $employee)
    {
        $title = 'Pegawai';
        return view('Employee/detail', compact('employee', 'title'));
    }

    public function edit(User $employee)
    {
        $title = 'Pegawai';
        $work_units = WorkUnit::get()->toArray();
        $occupations = OccupationGroup::get()->toArray();
        $employments = Employments::all();
        $roles = DB::table('roles')->select('id', 'name')->get();
        return view('Employee/edit', compact('employee', 'work_units', 'occupations', 'employments', 'title', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $employee)
    {
        $request->validate([
            'email' => ['required', 'min:0', 'max:255', 'email'],
            'religion' => ['required', 'min:0', 'max:16'],
            'gender' => ['required', 'min:0', 'max:8'],
            'blood_type' => ['required', 'min:0', 'max:2'],
            'place_born' => ['required', 'min:0', 'max:32'],
            'date_born' => ['required'],
            'marital_status' => ['required', 'min:0', 'max:16'],
            'address' => ['required', 'min:0', 'max:255'],
            'telephone_number' => ['required', 'min:0', 'max:24']
        ]);
        $employee->update([
            'email' => $request->email,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'blood_type' => $request->blood_type,
            'place_born' => $request->place_born,
            'date_born' => $request->date_born,
            'marital_status' => $request->marital_status,
            'address' => $request->address,
            'telephone_number' => $request->telephone_number
        ]);

        DB::table('user_work_unit')->where('user_id', $employee->user_id)->update([
            'work_unit_id' => $request->work_unit
        ]);

        DB::table('occupations')->where('user_id', $employee->user_id)->update([
            'occupation_group_id' => $request->occupation,
            'employment_id' => $request->employment,
            'status' => 1
        ]);

        return redirect('/pegawai/'. $employee->user_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Pegawai Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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
}
