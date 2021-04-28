<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Requests\EmployeeWorkObjectiveRequest;
use App\Models\EmployeeWorkObjective;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeWorkObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $title = 'SKP';
        return view('Employee/SKP/index', compact( 'employee', 'title'));
    }
    public function create(User $employee)
    {
        $title = 'SKP';
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/SKP/create', compact('employee', 'title', 'admins'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeWorkObjectiveRequest $request, User $employee)
    {
        $employee->employee_work_objective()->create($this->dataSKP());
        return redirect('/pegawai/'. $employee->user_id . '/skp')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data SKP Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee, EmployeeWorkObjective $employeeWorkObjective)
    {
        $title = 'SKP';
        return view('Employee/SKP/show', compact('employeeWorkObjective', 'employee', 'title'));
    }
    public function edit(User $employee, EmployeeWorkObjective $employeeWorkObjective)
    {
        $title = 'SKP';
        return view('Employee/SKP/edit', compact('employeeWorkObjective', 'employee', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeWorkObjectiveRequest $request, User $employee, EmployeeWorkObjective $employeeWorkObjective)
    {
        $employeeWorkObjective->update($this->dataSKP());
        return redirect('/pegawai/'. $employee->user_id . '/skp')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data SKP Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee, EmployeeWorkObjective $employeeWorkObjective)
    {
        $employeeWorkObjective->delete();
        return redirect('/pegawai/'. $employee->user_id . '/skp')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data SKP Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function dataSKP()
    {
        return [
            'assessor_officials' => request('assessor_officials'),
            'appraisal_official_superior' => request('appraisal_official_superior'),
            'start_date' => request('start_date'),
            'finish_date' => request('finish_date'),
            'service_orientation_value' => request('service_orientation_value'),
            'integrity_value' => request('integrity_value'),
            'commitment_value' => request('commitment_value'),
            'discipline_value' => request('discipline_value'),
            'teamwork_value' => request('teamwork_value'),
            'leader_value' => request('leader_value'),
            'rating_result' => request('rating_result')
        ];
    }
    public function index_admin(Request $request)
    {
        $title = 'Sasaran Kinerja Pegawai';
        $employee = User::select('user_id')->addSelect('nip')->addSelect('name')->get();

        $date = ($request->date) ? $request->date : date('Y-m');
        $sDate = $date . '-01';
        $fDate = $date . '-' . date('d');
        $employeeID = ($request->employee) ? $request->employee : "0";$data = '';
        $data = ($employeeID == 0) ? EmployeeWorkObjective::where('start_date', [$sDate, $fDate])->get() : EmployeeWorkObjective::where('user_id', $employeeID)->where('start_date', [$sDate, $fDate])->get();
        return view('MasterData/SKP/index', compact('title', 'employee', 'employeeID', 'date', 'data'));
    }
    public function create_admin()
    {
        $title = 'Sasaran Kinerja Pegawai';
        $employee = User::select('user_id')->addSelect('nip')->addSelect('name')->get();
        return view('MasterData/SKP/create', compact('title', 'employee'));
    }
    public function store_admin(EmployeeWorkObjectiveRequest $request)
    {
        $employee = User::find($request->employee);
        $employeeWorkObjective = $employee->employee_work_objective()->create($this->dataSKP());
        return redirect('skp/' . $employeeWorkObjective->employee_work_objective_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data SKP Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_admin(EmployeeWorkObjective $employeeWorkObjective)
    {
        $title = 'Sasaran Kinerja Pegawai';
        return view('MasterData/SKP/show', compact('title', 'employeeWorkObjective'));
    }
    public function edit_admin(EmployeeWorkObjective $employeeWorkObjective)
    {
        $title = 'Sasaran Kinerja Pegawai';
        return view('MasterData/SKP/edit', compact('title', 'employeeWorkObjective'));
    }
    public function update_admin(EmployeeWorkObjectiveRequest $request, EmployeeWorkObjective $employeeWorkObjective)
    {
        $employeeWorkObjective->update($this->dataSKP());
        return redirect('skp/' . $employeeWorkObjective->employee_work_objective_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data SKP Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function delete_admin(EmployeeWorkObjective $employeeWorkObjective)
    {
        $employeeWorkObjective->delete();
        return redirect('/skp')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data SKP Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function print_admin(EmployeeWorkObjective $employeeWorkObjective)
    {
        return Helper::printEmployeeWorkObj($employeeWorkObjective);
    }
}
