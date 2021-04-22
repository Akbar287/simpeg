<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DailyWorkReport;
use App\Models\Employments;
use App\Models\Furlough;
use App\Models\Kehadiran;
use App\Models\Mutation;
use App\Models\OccupationGroup;
use App\Models\Schedule;
use App\Models\Signature;
use App\Models\TypeMutation;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PersonalController extends Controller
{
    public function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pegawai';
        $employee = Auth::user();
        return view('EmployeePage/Employee/index', compact('title', 'employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ttd()
    {
        $title = 'Pegawai';
        $employee = Auth::user();
        return view('EmployeePage/Employee/ttd', compact('title', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $title = 'Pegawai';
        $employee = Auth::user();
        $work_units = WorkUnit::all();
        $occupations = OccupationGroup::get()->toArray();
        $employments = Employments::all();
        return view('EmployeePage/Employee/edit', compact('title', 'employee', 'employments', 'occupations', 'work_units'));
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
    public function change(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'max:12']
        ]);

        $user = User::find(Auth::user()->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Change Password has been successfully'
        ], 200);
    }

    public function getSignature()
    {
        $sig = Signature::where('user_id', Auth::user()->user_id)->first();
        return response()->json(['sig' => (!is_null($sig)) ? $sig->signature : '', 'status' => (!is_null($sig))?'success':'error'], 200);
    }
    public function index_mutasi() {
        $title = 'Mutasi';
        return view('EmployeePage/Mutasi/index', compact('title'));
    }
    public function create_mutasi() {
        $title = 'Mutasi';
        $type_mutations = TypeMutation::all();
        return view('EmployeePage/Mutasi/create', compact('title', 'type_mutations'));
    }
    public function store_mutasi(Request $request) {
        $request->validate([
            'work_unit' => ['required', 'min:0', 'max:64'],
            'region_work_unit' => ['required', 'min:0', 'max:64'],
            'address' => ['required'],
            'type_mutation' => ['required']
            ]);

        $user = User::find(Auth::user()->user_id);
        $mutation = $user->mutation()->create([
            'new_work_unit' => request('work_unit'),
            'region_work' => request('region_work_unit'),
            'address' => request('address'),
            'status' => 1,
            'date_mutation' => date('Y-m-d')
        ]);
        DB::table('mutation_type')->insert(['type_mutation_id' => $request->type_mutation, 'mutation_id' => $mutation->mutation_id]);
        return redirect('/izinmutasi/' . $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Diajukan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_mutasi(Mutation $mutation) {
        $title = 'Mutasi';
        $type_mutations = TypeMutation::all();
        return view('EmployeePage/Mutasi/show', compact('title', 'type_mutations', 'mutation'));
    }
    public function edit_mutasi(Mutation $mutation) {
        $title = 'Mutasi';
        $type_mutations = TypeMutation::all();
        return view('EmployeePage/Mutasi/edit', compact('title', 'mutation', 'type_mutations', 'mutation'));
    }
    public function update_mutasi(Request $request, Mutation $mutation) {
        $request->validate([
            'work_unit' => ['required', 'min:0', 'max:64'],
            'region_work_unit' => ['required', 'min:0', 'max:64'],
            'address' => ['required'],
            'type_mutation' => ['required']
        ]);

        $mutation->update([
            'new_work_unit' => request('work_unit'),
            'region_work' => request('region_work_unit'),
            'address' => request('address'),
            'status' => 1,
            'date_mutation' => date('Y-m-d')
        ]);
        DB::table('mutation_type')->where('mutation_id', $mutation->mutation_id)->update(['type_mutation_id' => $request->type_mutation]);
        return redirect('/izinmutasi/' . $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function destroy_mutasi(Mutation $mutation) {
        $mutation->update([
            'status' => 0
        ]);

        return redirect('/izinmutasi/' . $mutation->mutation_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Mutasi Sudah Dibatalkan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function index_cuti() {
        $title = 'Cuti';
        return view('EmployeePage/Cuti/index', compact('title'));
    }
    public function create_cuti() {
        $title = 'Cuti';
        return view('EmployeePage/Cuti/create', compact('title'));
    }
    public function store_cuti(Request $request) {
        $request->validate([
            'type_furlough' => ['required', 'min:0', 'max:32'],
            'long_furlough' => ['required'],
            'in_number' => ['required', 'min:0', 'max:32'],
            'time_format' => ['required', 'min:0', 'max:8'],
            'start_date' => ['required'],
            'finish_date' => ['required']
        ]);
        $employee = User::find(Auth::user()->user_id);

        $furlough = $employee->furlough()->create([
            'type_furlough' => $request->type_furlough,
            'long_furlough' => $request->long_furlough,
            'in_number' => $request->in_number,
            'time_format' => $request->time_format,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'status' => 1
        ]);

        return redirect('/izincuti/' . $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_cuti(Furlough $furlough) {
        $title = 'Cuti';
        return view('EmployeePage/Cuti/show', compact('title', 'furlough'));
    }
    public function edit_cuti(Furlough $furlough) {
        $title = 'Cuti';
        return view('EmployeePage/Cuti/edit', compact('title', 'furlough'));
    }
    public function update_cuti(Request $request, Furlough $furlough) {
        $request->validate([
            'type_furlough' => ['required', 'min:0', 'max:32'],
            'long_furlough' => ['required'],
            'in_number' => ['required', 'min:0', 'max:32'],
            'time_format' => ['required', 'min:0', 'max:8'],
            'start_date' => ['required'],
            'finish_date' => ['required']
        ]);

        $furlough->update([
            'type_furlough' => $request->type_furlough,
            'long_furlough' => $request->long_furlough,
            'in_number' => $request->in_number,
            'time_format' => $request->time_format,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'status' => 1
        ]);

        return redirect('/izincuti/' . $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function destroy_cuti(Furlough $furlough) {
        $furlough->update(['status' => 0]);
        return redirect('/izincuti/'. $furlough->furlough_id)->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Cuti Sudah Dibatalkan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function index_attendance() {
        $title = 'Absensi';
        $checkNow = Attendance::where('date_work', date('Y-m-d'))->where('user_id', Auth::user()->user_id)->first();
        $schedule = Schedule::where('hari_kerja', date('Y-m-d'))->where('user_id', Auth::user()->user_id)->first();
        $attendances = Attendance::whereBetween('date_work' ,[date('Y-m') . '-01', date('Y-m-d')])->where('user_id', Auth::user()->user_id)->get();
        return view('EmployeePage/Absensi/index', compact('title', 'schedule', 'attendances', 'checkNow'));
    }
    public function create_attendance() {
        $schedule = Schedule::where('hari_kerja', date('Y-m-d'))->where('user_id', Auth::user()->user_id)->first();
        $checkNow = Attendance::where('date_work', date('Y-m-d'))->where('user_id', Auth::user()->user_id)->first();
        $attendance = Attendance::where('date_work' ,date('Y-m-d'))->where('user_id', Auth::user()->user_id)->get();
        $title = 'Absensi';
        return view('EmployeePage/Absensi/create', compact('title', 'attendance', 'schedule', 'checkNow'));
    }
    public function kehadiran_attendance() {
        $Kehadiran = Kehadiran::get();
        $title = 'Absensi';
        return view('EmployeePage/Absensi/kehadiran', compact('title', 'Kehadiran'));
    }
    public function post_kehadiran_attendance(Request $request) {
        $request->validate([
            'kehadiran' => ['required'],
            'keterangan' => ['required']
        ]);
        $file = $request->file('image');
        if($file) {
            $imageName = "post-".time().".".$file->getClientOriginalName();
            Storage::disk('local')->put($imageName, $file);
        }
        $user = User::find(Auth::user()->user_id);
        $attendance = $user->attendance()->create([
            'date_work' => date('Y-m-d'),
            'keterangan' => $request->keterangan,
            'jenis_kerja' => 'WFO',
        ]);

        DB::table('kehadiran_attendance')->insert([
            'attendance_id' => $attendance->attendance_id,
            'kehadiran_id' => $request->kehadiran
        ]);

        return redirect('/absen')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absen Sudah Disimpan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function store_attendance(Request $request) {
        $request->validate([
            'start_work' => ['required'],
            'date_work' => ['required'],
            'type_work' =>  ['required'],
            'picture' =>  ['required'],
            'loc' => ['required']
        ]);

        $user = User::find(Auth::user()->user_id);
        $imageDB = '';
        if($request->type_work == 'WFH') {
            $image = $request->picture;
            $imageInfo = explode(";base64,", $image);
            $imgExt = str_replace('data:image/', '', $imageInfo[0]);
            $image = str_replace(' ', '+', $imageInfo[1]);
            $imageDB = "post-".time().".".$imgExt;
            Storage::disk('local')->put($imageDB, base64_decode($image));
        } else {
            $imageDB = $request->picture;
        }

        $attendance = $user->attendance()->create([
            'date_work' => date('Y-m-d'),
            'start_work' => $request->start_work,
            'finish_work' => null,
            'stamp' => null,
            'jenis_kerja' => $request->type_work,
            'image' => $imageDB,
            'location' => $request->loc['coords']['latitude'] . ' | ' . $request->loc['coords']['longitude']
        ]);

        DB::table('kehadiran_attendance')->insert([
            'attendance_id' => $attendance->attendance_id,
            'kehadiran_id' => 2
        ]);

        return response()->json([
            'data' => $attendance,
            'status' => 'success',
            'message' => 'Data absen telah di rekam'
        ], 200);
    }
    public function store_finish_attendance(Request $request)
    {
        $request->validate([
            'finish_work' => ['required']
        ]);

        $user = User::find(Auth::user()->user_id);
        $attendance = Attendance::where('date_work', date('Y-m-d'))->where('user_id', $user->user_id)->first();
        $attendance->finish_work = $request->finish_work;
        $attendance->keterangan = $request->keterangan;
        $attendance->save();

        return redirect('/absen')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Absen Sudah Dicatat.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function index_dailyWork() {
        $title = 'Laporan Kerja Harian';
        $checkNow = DailyWorkReport::join('user_daily_work_report', 'user_daily_work_report.daily_work_report_id', 'daily_work_reports.daily_work_report_id')->where('date_work', date('Y-m-d'))->where('user_daily_work_report.user_id', Auth::user()->user_id)->first();
        $reports = DailyWorkReport::join('user_daily_work_report', 'user_daily_work_report.daily_work_report_id', 'daily_work_reports.daily_work_report_id')->where('user_daily_work_report.user_id', Auth::user()->user_id)->whereBetween('date_work' ,[date('Y-m') . '-01', date('Y-m-d')])->get();
        return view('EmployeePage/LaporanKerjaHarian/index', compact('title', 'reports', 'checkNow'));
    }
    public function create_dailyWork() {
        $title = 'Laporan Kerja Harian';
        return view('EmployeePage/LaporanKerjaHarian/create', compact('title'));
    }
    public function store_dailyWork(Request $request) {
        $request->validate([
            'volume' => ['required'],
            'result' => ['required'],
            'activities' => ['required'],
        ]);
        if(!is_array($request->activities)) return null;

        $user = User::find(Auth::user()->user_id);
        $report = $user->daily_work_report()->create([
            'date_work' => date('Y-m-d'),
            'keterangan' => ($request->keterangan) ? $request->keterangan : null
        ]);

        for($i=0;$i < count($request->activities); $i++) {
            $report->activity()->create([
                'activity' => $request->activities[$i],
                'result' => $request->result[$i],
                'volume' => $request->volume[$i]
            ]);
        }

        return redirect('/laporan/' .$report->daily_work_report_id )->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Laporan Kerja Harian Sudah Dicatat.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function show_dailyWork(DailyWorkReport $laporan) {
        $title = 'Laporan Kerja Harian';
        return view('EmployeePage/LaporanKerjaHarian/show', compact('title', 'laporan'));
    }
    public function edit_dailyWork(DailyWorkReport $laporan) {
        $title = 'Laporan Kerja Harian';
        return view('EmployeePage/LaporanKerjaHarian/edit', compact('title', 'laporan'));
    }
    public function update_dailyWork(DailyWorkReport $laporan, Request $request) {
        $request->validate([
            'volume' => ['required'],
            'result' => ['required'],
            'activities' => ['required'],
        ]);
        if(!is_array($request->activities)) return null;

        $laporan->update([
            'keterangan' => ($request->keterangan) ? $request->keterangan : null
        ]);

        $laporan->activity()->delete();

        for($i=0;$i < count($request->activities); $i++) {
            $laporan->activity()->create([
                'activity' => $request->activities[$i],
                'result' => $request->result[$i],
                'volume' => $request->volume[$i]
            ]);
        }

        return redirect('/laporan/' .$laporan->daily_work_report_id )->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Laporan Kerja Harian Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    public function index_schedule()
    {
        $user = User::find(Auth::user()->user_id);
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-t',strtotime($start_date));
        $schedules = Schedule::whereBetween('hari_kerja' ,[$start_date, $end_date])->where('user_id', Auth::user()->user_id)->orderBy('hari_kerja', 'asc')->get();
        $title = 'Jadwal';
        return view('EmployeePage/Jadwal/index', compact('title', 'user', 'schedules'));
    }
    public function getQrCode()
    {
        $qrcode = Schedule::where('user_id', Auth::user()->user_id)->where('hari_kerja', date('Y-m-d'))->first();

        if($qrcode) return response()->json([
            'data' => $qrcode->random_string_barcode,
            'status' => 'success',
            'message' => 'Data absen telah di rekam'
        ], 200);

        return response()->json([
            'data' => '',
            'status' => 'failed',
            'message' => 'Not Found Scheduled QR Code'
        ], 200);
    }
    public function photo()
    {
        $title = 'Pegawai';
        $employee = User::find(Auth::user()->user_id);
        return view('EmployeePage/Employee/photo', compact('title', 'employee'));
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

            return redirect('/pribadi' )->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Foto Profile sudah diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            return redirect('/pribadi' )->with('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal!</strong> Foto Profile gagal diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }
}
