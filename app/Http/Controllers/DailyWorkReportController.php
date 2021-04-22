<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Requests\DailyWordReportRequest;
use App\Models\DailyWorkActivity;
use App\Models\DailyWorkReport;
use App\Models\User;
use Illuminate\Http\Request;

class DailyWorkReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $date = ($request->date) ? $request->date : date('Y') . '-' . date('m') . '-'. date('d');
        $employeeID = ($request->employee) ? $request->employee : 0;
        $data = ($employeeID == 0) ?  DailyWorkReport::select('users.nip')->addSelect('users.name')->addSelect('daily_work_reports.date_work')->addSelect('daily_work_reports.daily_work_report_id')->join('user_daily_work_report', 'user_daily_work_report.daily_work_report_id', 'daily_work_reports.daily_work_report_id')->join('users', 'users.user_id', 'user_daily_work_report.user_id')->where('daily_work_reports.date_work', $date)->orderBy('daily_work_reports.created_at', 'desc')->get() : DailyWorkReport::select('users.nip')->addSelect('users.name')->addSelect('daily_work_reports.date_work')->addSelect('daily_work_reports.daily_work_report_id')->join('user_daily_work_report', 'user_daily_work_report.daily_work_report_id', 'daily_work_reports.daily_work_report_id')->join('users', 'users.user_id', 'user_daily_work_report.user_id')->where('daily_work_reports.date_work', $date)->where('users.user_id', $employeeID)->orderBy('daily_work_reports.created_at', 'desc')->get();

        return view('MasterData/DailyWorkReport/index', compact('employee', 'date', 'employeeID', 'data'));
    }

    public function create()
    {
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $date = date('Y') . '-' . date('m') . '-'. date('d');
        return view('MasterData/DailyWorkReport/create', compact('employee', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyWordReportRequest $request)
    {
        $employee = User::find($request->employee);

        $dwr = $employee->daily_work_report()->create([
            'date_work' => $request->date,
            'keterangan' => $request->keterangan
        ]);

        if(!is_null($request->activities) && !empty($request->activities)) {
            for($i = 0; $i < count($request->activities); $i++) {
                $dwr->activity()->create([
                    'activity' => $request->activities[$i],
                    'result' => $request->result[$i],
                    'volume' => $request->volume[$i]
                ]);
            }
        }

        return redirect('/laporankerja')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Laporan Kerja Pegawai Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DailyWorkReport $dailyWorkReport)
    {
        $employee = $dailyWorkReport->user()->first();

        return view('MasterData/DailyWorkReport/show', compact('employee', 'dailyWorkReport'));
    }

    public function edit(DailyWorkReport $dailyWorkReport)
    {
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        $employID = $dailyWorkReport->user()->first();

        return view('MasterData/DailyWorkReport/edit', compact('employee', 'employID', 'dailyWorkReport'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DailyWordReportRequest $request, DailyWorkReport $dailyWorkReport)
    {
        $dwr = $dailyWorkReport->update([
            'date_work' => $request->date,
            'keterangan' => $request->keterangan
        ]);

        if(!is_null($request->activities) && !empty($request->activities)) {
            DailyWorkActivity::join('work_activity', 'work_activity.activity_id', 'daily_work_activity.daily_work_activity_id')->where('report_id', $dailyWorkReport->daily_work_report_id)->delete();

            for($i = 0; $i < count($request->activities); $i++) {
                $dailyWorkReport->activity()->create([
                    'activity' => $request->activities[$i],
                    'result' => $request->result[$i],
                    'volume' => $request->volume[$i]
                ]);
            }
        }
        return redirect('/laporankerja/' . $dailyWorkReport->daily_work_report_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Laporan Kerja Pegawai Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyWorkReport $dailyWorkReport)
    {
        DailyWorkActivity::join('work_activity', 'work_activity.activity_id', 'daily_work_activity.daily_work_activity_id')->where('report_id', $dailyWorkReport->daily_work_report_id)->delete();
        $dailyWorkReport->delete();

        return redirect('/laporankerja')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Laporan Kerja Pegawai Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function print(DailyWorkReport $dailyWorkReport)
    {
        return Helper::printDailyWorkReport($dailyWorkReport);
    }
}
