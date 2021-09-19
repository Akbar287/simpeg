<?php

namespace App\Http\Controllers;

use App\Models\Employments;
use App\Models\OccupationGroup;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        $leaders = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'pimpinan')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->get();
        $roles = Role::get();
        return view('Admin/create', compact('employees', 'admins', 'leaders', 'title', 'roles'));
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
            'user_id' => ['required', 'numeric'],
            'role_id' => ['required', 'numeric'],
        ]);

        $admin = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->count();
        $employee = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'pegawai')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->count();
        $leader = User::select('users.user_id', 'users.name', 'users.nip', 'users.profile_photo')->where('roles.name', 'pimpinan')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->count();
        $myRole = Role::select('id')->get();
        foreach($myRole as $role) {
            $roles[] = $role->id;
        }
        $user = User::find($request->user_id);
        $from = $user->role()->first()->id;
        $to = $request->role_id;
        if($from == $to) return response()->json([
            'status' => false,
            'message' => 'Failed to change Role!. Must be different role.'
        ], 302);
        if(!in_array($to, $roles)) return response()->json([
            'status' => false,
            'message' => 'No Role Found!'
        ], 302);
        if($user->user_id == Auth::user()->user_id) return response()->json([
            'status' => false,
            'message' => 'failed to change role! you cant change your role!'
        ], 302);

        if($from == 1) {
            if($admin == 1) return response()->json([
                'status' => false,
                'message' => 'Admin must have one or more in this system'
            ], 302);
            else {
                DB::table('user_role')->where('user_id', $user->user_id)->update([
                    'id' => $to
                ]);
            }
        } else if($from == 2) {
            if($employee == 1) return response()->json([
                'status' => false,
                'message' => 'Employee must have one or more in this system'
            ], 302);
            else {
                DB::table('user_role')->where('user_id', $user->user_id)->update([
                    'id' => $to
                ]);
            }
        } else if($from == 3) {
            if($leader == 1) return response()->json([
                'status' => false,
                'message' => 'Leader must have one or more in this system'
            ], 302);
            else {
                DB::table('user_role')->where('user_id', $user->user_id)->update([
                    'id' => $to
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Role Found!'
            ], 302);
        }
        return response()->json([
            'status' => true,
            'message' => 'Success to change role'
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
    public function photo()
    {
        $title = 'Admin';
        return view('Admin/photo', compact('title'));
    }
    public function setPhoto(Request $request)
    {
        $user = User::find(Auth::user()->user_id);
        if($request->file('image')) {
            $image = $request->file('image');
            if ($user->profile_photo != 'nophoto.png') {
                File::delete(public_path() . '/images/profile/employee/' . $user->profile_photo);
            }
            $imageDB = "profile-".time()."." . $user->nip . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() .'/images/profile/employee/', $imageDB);

            $user->profile_photo = $imageDB;
            $user->save();

            return redirect('/admin/'.Auth::user()->user_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Foto Profile sudah diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect('/admin/'.Auth::user()->user_id)->with('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal!</strong> Foto Profile gagal diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }
    public function ttd()
    {
        $title = 'Admin';
        return view('Admin/ttd', compact('title'));
    }
}
