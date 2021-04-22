<?php

namespace App\Http\Controllers;

use App\Models\Employments;
use App\Models\OccupationGroup;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Admin';
        $admins = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->get();
        return view('Admin/index', compact('admins', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Admin';
        $admins = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->get();
        $employees = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'pegawai')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->get();
        return view('Admin/create', compact('employees', 'admins', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        $title = 'Admin';
        return view('Admin/show', compact('admin', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $title = 'Admin';
        $work_units = WorkUnit::get()->toArray();
        $occupations = OccupationGroup::get()->toArray();
        $employments = Employments::all();
        $roles = DB::table('roles')->select('id', 'name')->get();
        return view('Admin/edit', compact('admin', 'roles', 'employments', 'occupations', 'work_units', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
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
        $admin->update([
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

        DB::table('user_work_unit')->where('user_id', $admin->user_id)->update([
            'work_unit_id' => $request->work_unit
        ]);

        DB::table('occupations')->where('user_id', $admin->user_id)->update([
            'occupation_group_id' => $request->occupation,
            'employment_id' => $request->employment,
            'status' => 1
        ]);

        return redirect('/pegawai/'. $admin->user_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Pegawai Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
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

    public function role(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric']
        ]);

        $admin = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->count();

        $employee = User::find($request->user_id);

        $role = $employee->role()->first();
        if($employee->user_id == Auth::user()->user_id) return response()->json([
            'status' => false,
            'message' => 'Employee failed to change role'
        ], 401);



        if($role->name == 'admin') {

            if($admin == 1) return response()->json([
                'status' => false,
                'message' => 'Admin must have one or more in this system'
            ], 401);

            DB::table('user_role')->where('user_id', $employee->user_id)->update([
                'id' => 2
            ]);
        } else {
            DB::table('user_role')->where('user_id', $employee->user_id)->update([
                'id' => 1
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Employee has been change role'
        ], 200);
    }
    public function change(Request $request, User $admin)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'max:12']
        ]);

        $admin->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Change Password has been successfully'
        ], 200);
    }
}