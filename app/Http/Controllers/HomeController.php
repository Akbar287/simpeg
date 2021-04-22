<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'admin' => DB::table('user_role')->where('id', 1)->count(),
            'employee' => DB::table('user_role')->where('id', 2)->count(),
            'pensiun' => DB::table('mutations')->join('mutation_type', 'mutation_type.mutation_id', 'mutations.mutation_id')->join('type_mutations', 'type_mutations.type_mutation_id', 'mutation_type.type_mutation_id')->where('type_mutations.type_mutation_name', 'Pensiun')->count(),
            'furlough' => DB::table('furloughs')->where('status', 1)->count(),
        ];
        return view('home', $data);
    }
    public function DataHome()
    {
        $user = User::find(Auth::user()->user_id);
        if($user->role()->first()->name == 'admin')
        {
            return response()->json([
                'chart' => [
                    'occupation' => DB::select("SELECT occupation_groups.occupation_group_name, COUNT(occupations.user_id) user FROM occupation_groups LEFT JOIN occupations ON occupations.occupation_group_id = occupation_groups.occupation_group_id GROUP BY occupation_groups.occupation_group_name"),
                    'employment' => DB::select("SELECT employments.employment_name, COUNT(occupations.user_id) user FROM employments LEFT JOIN occupations ON occupations.employment_id = employments.employment_id GROUP BY employments.employment_name"),
                    'work_unit' => DB::select("SELECT work_units.work_unit_name, COUNT(user_work_unit.user_id) user FROM work_units LEFT JOIN user_work_unit ON user_work_unit.work_unit_id = work_units.work_unit_id GROUP BY  work_units.work_unit_name"),
                    'education' => DB::select("SELECT educations.grade, COUNT(user_education.user_id) user FROM educations LEFT JOIN user_education ON user_education.education_id = educations.education_id WHERE educations.final_grade = 1 GROUP BY  educations.grade"),
                ],
                'status' => 'admin'
            ]);
        } elseif ($user->role()->first()->name == 'pegawai'){
            return response()->json([
                'chart' => [],
                'status' => 'pegawai'
            ]);
        } else {
            return null;
        }
    }
    public function getSignature(Request $request)
    {
        $request->validate([
            'employee' => ['required', 'numeric']
        ]);
        $sig = Signature::where('user_id', $request->employee)->first();
        return response()->json(['sig' => (!is_null($sig)) ? $sig->signature : '', 'status' => (!is_null($sig))?'success':'error'], 200);
    }
    public function setSignature(Request $request)
    {
        $request->validate([
            'sig' => ['required'],
            'sig_svg' => ['required'],
            'user_id' => ['required', 'numeric']
        ]);

        $user = User::find($request->user_id);
        $sig = str_replace('width="15cm" height="15cm"', 'width="5cm" height="5cm"', $request->sig_svg);

        if($user->signature()->first()) {
            $user->signature()->update(['signature' => $request->sig, 'sig_svg' => $sig]);
        } else {
            $user->signature()->create(['signature' => $request->sig, 'sig_svg' => $sig]);
        }

        return response()->json(['message' => 'Signature has been reset', 'status' => 'success'], 200);
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            'employee' => ['required', 'numeric']
        ]);

        $employee = User::find($request->employee);
        $employee->update(['password' => Hash::make('123')]);
        return response()->json(['message' => 'password has been reset', 'status' => 'success'], 200);
    }
}
