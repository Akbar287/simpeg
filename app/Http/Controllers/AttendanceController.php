<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Kehadiran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $title = 'Absensi';
        return view('Employee/Attendance/index', compact( 'employee', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $employee)
    {
        $title = 'Absensi';
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $kehadiran = Kehadiran::all();
        return view('Employee/Attendance/create', compact('employee', 'title', 'admins', 'kehadiran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request, User $employee)
    {
        $attendance = $employee->attendance()->create($this->dataAttendance());
        DB::table('kehadiran_attendance')->insert([
            'attendance_id' => $attendance->attendance_id,
            'kehadiran_id' => request('kehadiran')
        ]);
        return redirect('/pegawai/'. $employee->user_id . '/absensi')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absensi Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee, Attendance $attendance)
    {
        $title = 'Absensi';
        $kehadiran = Kehadiran::all();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Attendance/show', compact('attendance', 'employee', 'title', 'admins', 'kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee, Attendance $attendance)
    {
        $title = 'Absensi';
        $kehadiran = Kehadiran::all();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('Employee/Attendance/edit', compact('attendance', 'employee', 'title', 'admins', 'kehadiran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttendanceRequest $request, User $employee, Attendance $attendance)
    {
        $attendance->update($this->dataAttendance());

        DB::table('kehadiran_attendance')->where('attendance_id', $attendance->attendance_id)->update([
            'kehadiran_id' => request('kehadiran')
        ]);
        return redirect('/pegawai/'. $employee->user_id . '/absensi')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absensi Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee, Attendance $attendance)
    {
        $attendance->delete();
        DB::table('kehadiran_attendance')->where('attendance_id', $attendance->attendance_id)->delete();
        return redirect('/pegawai/'. $employee->user_id . '/absensi')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absensi Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function dataAttendance()
    {
        return [
            'date_work' => request('date_work'),
            'start_work' => request('start_work'),
            'finish_work' => request('finish_work'),
            'jenis_kerja' => request('jenis_kerja'),
            'stamp' => request('stamp'),
            'keterangan' => request('information')
        ];
    }
    public function index_admin(Request $request)
    {
        $status = [ 'Tanpa Keterangan','Hadir', 'Izin', 'Sakit', 'Cuti', 'Perjalanan Dinas'];
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();

        $dynamic_url = explode('?', url()->full());
        $dynamic_url = (count($dynamic_url) > 1) ? end($dynamic_url) : '';

        $date = ($request->date) ? $request->date : date('Y-m');
        $idate = explode('-', $date);
        $start_date = $idate['0'] . '-' . $idate['1'] . '-01';
        $finish_date = date("Y-m-t", strtotime($start_date));

        $statusID = ($request->status) ? $request->status : 9;
        $employeeID = ($request->employee) ? $request->employee : 0;
        $data=[];
        if($employeeID != 0) {
            if($statusID != 9) {
                $data = Attendance::select('users.nip')->addSelect('attendances.attendance_id')->addSelect('attendances.jenis_kerja')->addSelect('users.name')->addSelect('attendances.date_work')->addSelect('kehadiran.kehadiran_id')->addSelect('kehadiran.name as kehadiran_name')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->where('kehadiran.kehadiran_id', $statusID)->where('users.user_id', $employeeID)->get();
            } else {
                $data = Attendance::select('users.nip')->addSelect('attendances.attendance_id')->addSelect('attendances.jenis_kerja')->addSelect('users.name')->addSelect('attendances.date_work')->addSelect('kehadiran.kehadiran_id')->addSelect('kehadiran.name as kehadiran_name')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->where('users.user_id', $employeeID)->get();
            }
        } else {
            if($statusID != 9) {
                $data = Attendance::select('users.nip')->addSelect('attendances.attendance_id')->addSelect('attendances.jenis_kerja')->addSelect('users.name')->addSelect('attendances.date_work')->addSelect('kehadiran.kehadiran_id')->addSelect('kehadiran.name as kehadiran_name')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->where('kehadiran.kehadiran_id', $statusID)->get();
            } else {
                $data = Attendance::select('users.nip')->addSelect('attendances.attendance_id')->addSelect('attendances.jenis_kerja')->addSelect('users.name')->addSelect('attendances.date_work')->addSelect('kehadiran.kehadiran_id')->addSelect('kehadiran.name as kehadiran_name')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->get();
            }
        }

        return view('MasterData/Attendance/index', compact('status', 'date', 'statusID', 'employee', 'employeeID', 'data', 'dynamic_url'));
    }
    public function create_admin()
    {
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $attendances = Kehadiran::all();
        return view('MasterData/Attendance/create', compact('admins', 'employee', 'attendances'));
    }
    public function store_admin(AttendanceRequest $request)
    {
        $employee = User::find($request->employee);
        $attendance = $employee->attendance()->create($this->dataAttendance());

        DB::table('kehadiran_attendance')->insert([
            'attendance_id' => $attendance->attendance_id,
            'kehadiran_id' => request('kehadiran')
        ]);
        return redirect('/absensi')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absensi Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_admin(Attendance $attendance)
    {
        $employee= $attendance->user()->first();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $kehadiran = Kehadiran::all();
        return view('MasterData/Attendance/show', compact('employee', 'kehadiran', 'admins', 'attendance'));
    }
    public function edit_admin(Attendance $attendance)
    {
        $employee = $attendance->user()->first();
        $attendances = Kehadiran::all();
        $admins = User::select('users.user_id')->addSelect('users.name')->addSelect('employment_name')->where('roles.name', 'admin')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Attendance/edit', compact('employee', 'attendance', 'attendances', 'admins'));
    }
    public function update_admin(AttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($this->dataAttendance());

        DB::table('kehadiran_attendance')->where('attendance_id', $attendance->attendance_id)->update([
            'kehadiran_id' => request('kehadiran')
        ]);
        return redirect('/absensi/' . $attendance->attendance_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absensi Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function delete_admin(Attendance $attendance)
    {
        $attendance->delete();
        DB::table('kehadiran_attendance')->where('attendance_id', $attendance->attendance_id)->delete();
        return redirect('/absensi')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absensi Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function print(Request $request)
    {
        $status = [ 'A','H', 'I', 'S', 'C', 'P'];
        $ketStatus = [ 'Tanpa Keterangan','Hadir', 'Izin', 'Sakit', 'Cuti', 'Perjalanan Dinas'];

        $date = ($request->date) ? $request->date : date('Y-m');
        $idate = explode('-', $date);
        $start_date = $idate['0'] . '-' . $idate['1'] . '-01';
        $finish_date = date("Y-m-t", strtotime($start_date));
        $lastDay = explode('-', $finish_date);
        $lastDay = (end($lastDay));
        $statusID = ($request->status) ? $request->status : 9;
        $employeeID = ($request->employee) ? $request->employee : 0;
        $data=[];
        if($employeeID != 0) {
            if($statusID != 9) {
                $data = Attendance::select('users.nip')->addSelect('attendances.jenis_kerja')->addSelect(DB::raw('EXTRACT(DAY FROM attendances.date_work) as date_work'))->addSelect('kehadiran.kehadiran_id')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->where('kehadiran.kehadiran_id', $statusID)->where('users.user_id', $employeeID)->get();
            } else {
                $data = Attendance::select('users.nip')->addSelect('attendances.jenis_kerja')->addSelect(DB::raw('EXTRACT(DAY FROM attendances.date_work) as date_work'))->addSelect('kehadiran.kehadiran_id')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->where('users.user_id', $employeeID)->get();
            }
        } else {
            if($statusID != 9) {
                $data = Attendance::select('users.nip')->addSelect('attendances.jenis_kerja')->addSelect(DB::raw('EXTRACT(DAY FROM attendances.date_work) as date_work'))->addSelect('kehadiran.kehadiran_id')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->where('kehadiran.kehadiran_id', $statusID)->get();
            } else {
                $data = Attendance::select('users.nip')->addSelect('attendances.jenis_kerja')->addSelect(DB::raw('EXTRACT(DAY FROM attendances.date_work) as date_work'))->addSelect('kehadiran.kehadiran_id')->join('kehadiran_attendance', 'kehadiran_attendance.attendance_id', 'attendances.attendance_id')->join('kehadiran', 'kehadiran.kehadiran_id', 'kehadiran_attendance.kehadiran_id')->join('users', 'users.user_id', 'attendances.user_id')->whereBetween('attendances.date_work', [$start_date, $finish_date . ' 23:59:59'])->orderBy('attendances.date_work', 'desc')->get();
            }
        }
        $employees = User::select('nip')->addSelect('name')->orderBy('name', 'asc')->get();

        return Helper::printAttendance($data, $status, $date, $lastDay, $employees, $ketStatus);
    }
}
