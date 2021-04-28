<?php

namespace App\Http\Helper;

use App\Models\Decree;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class Helper{
    public static function statusMutation($status)
    {
        $data = ['Dibatalkan', 'Dibuat', 'Disetujui', 'Terbit SK', 'Selesai', 'Ditolak'];
        return $data[$status];
    }
    public static function convertMonthAttendance($time = null) {
        if($time == null) return null;
        $time = explode('-', $time);
        return self::MonthLocaleID($time['1']) . ' ' . $time['0'];
    }
    public static function convertDate($date)
    {
        if($date == 'Sunday') return 'Minggu';
        if($date == 'Monday') return 'Senin';
        if($date == 'Tuesday') return 'Selasa';
        if($date == 'Wednesday') return 'Rabu';
        if($date == 'Thursday') return 'Kamis';
        if($date == 'Friday') return 'Jumat';
        if($date == 'Saturday') return 'Sabtu';

        return null;
    }

    public static function statusFurlough($status)
    {
        $data = ['Dibatalkan', 'Dibuat', 'Disetujui', 'Terbit SK', 'Selesai', 'Ditolak'];
        return $data[$status];
    }
    public static function statusFurloughArray($status)
    {
        $data = ['Dibatalkan' => 0, 'Dibuat' => 1, 'Disetujui' => 2, 'Terbit SK' => 3, 'Selesai' => 4, 'Ditolak' => 5];
        return $data[$status];
    }
    public static function statusMutationArray($status)
    {
        $data = ['Dibatalkan' => 0, 'Dibuat' => 1, 'Disetujui' => 2, 'Terbit SK' => 3, 'Selesai' => 4, 'Ditolak' => 5];
        return $data[$status];
    }
    public static function time($time)
    {
        $time = explode('-', $time);
        return $time['2'] . ' ' . self::MonthLocaleID($time['1']) . ' ' . $time['0'];
    }
    public static function timeAttendance($time)
    {
        $time = explode(' ', $time, -1);
        $time = explode('-', $time['0']);
        return $time['2'] . ' ' . self::MonthLocaleID($time['1']) . ' ' . $time['0'];
    }
    public static function MonthLocaleID($month)
    {
        $data = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $data[intval($month)];
    }
    public static function age($time)
    {
        date_default_timezone_set('Asia/Jakarta');
        return \Carbon\Carbon::parse($time)->diff(\Carbon\Carbon::now())->format('%y Tahun %m Bulan %d Hari');
    }
    public static function imgRandom($img)
    {
        $img = (explode('.', $img));
        $ekstensi = $img[count($img) - 1];
        unset($img[count($img) - 1]);
        $img = implode('.', $img) . '.' . time() . '.' . $ekstensi;
        return $img;
    }
    public static function getSkNumberMutation()
    {
        $sk_number = Decree::select('sk_number')->where('title', 'mutasi')->get()->last();
        if(!is_null($sk_number)) {
            $sk_number = explode('/', $sk_number->sk_number);
            $number = (intval($sk_number['1'])) + 1;
            $sk_number = $sk_number['0'] . '/' . $number;
            return $sk_number;
        } else {
            return "SM/1";
        }
    }
    public static function getCheckSKMutation($number) {
        return (Decree::where('sk_number', $number)->count() > 0) ? 1 : 0;
    }

    public static function print_mutation($employee, $mutation)
    {
        $admin = User::find($mutation->decree()->first()->signature)->first();
        $logo = public_path() . '/images/logo.png';
        $sig = '<img src="data:image/svg+xml;base64,' .base64_encode($admin->signature()->first()->sig_svg). '" width="150" height="100" style="width: 150!important; height:60!important;" />';
        if($mutation->decree()->first()->title == 'mutasi') {
            $type_mutation = $mutation->type_mutation()->first()->type_mutation_name;
            $pdf = PDF::loadview('Employee/Mutation/print', compact('employee', 'admin', 'logo', 'mutation', 'type_mutation', 'sig'));
            return $pdf->stream('NICT.' . $mutation->decree()->first()->sk_number . '.pdf');
        }

    }
    public static function getSkNumberFurlough()
    {
        $sk_number = Decree::select('sk_number')->where('title', 'cuti')->get()->last();
        if(!is_null($sk_number)) {
            $sk_number = explode('/', $sk_number->sk_number);
            $number = (intval($sk_number['1'])) + 1;
            $sk_number = $sk_number['0'] . '/' . $number;
            return $sk_number;
        } else {
            return "SC/1";
        }
    }
    public static function getCheckSKFurlough($number) {
        return (Decree::where('sk_number', $number)->count() > 0) ? 1 : 0;
    }

    public static function print_furlough($employee, $furlough)
    {
        $admin = User::find($furlough->decree()->first()->signature)->first();
        $logo = public_path() . '/images/logo.png';
        $sig = '<img src="data:image/svg+xml;base64,' .base64_encode($admin->signature()->first()->sig_svg). '" width="150" height="100" style="width: 150!important; height:60!important;" />';
        $pdf = PDF::loadview('Employee/Furlough/print', compact('employee', 'admin', 'logo', 'furlough', 'sig'));
        return $pdf->stream('NICT.' . $furlough->decree()->first()->sk_number . '.pdf');
    }

    public static function printAttendance($data, $status, $date, $lastDay, $employees, $ketStatus)
    {
        $logo = public_path() . '/images/logo.png';
        $pdf = PDF::loadview('MasterData/Attendance/print', compact('data', 'status', 'date', 'lastDay', 'employees', 'ketStatus', 'logo'));
        return $pdf->stream('NICT-Absensi-' . $date . '.pdf');
    }

    public static function statusAttendance($status = null)
    {
        if($status == null) return [ 'Tanpa Keterangan','Hadir', 'Izin', 'Sakit', 'Cuti', 'Perjalanan Dinas'];
        $stats = [ 'Tanpa Keterangan','Hadir', 'Izin', 'Sakit', 'Cuti', 'Perjalanan Dinas'];

        return $stats[$status];
    }
    public static function statusAttendanceArray($status = null)
    {
        if($status == null) return [ 'Tanpa Keterangan','Hadir', 'Izin', 'Sakit', 'Cuti', 'Perjalanan Dinas'];
        $stats = [ 'Tanpa Keterangan' => 0,'Hadir' => 1, 'Izin' => 2, 'Sakit' => 3, 'Cuti' => 4, 'Perjalanan Dinas' => 5];

        return $stats[$status];
    }
    public static function printDailyWorkReport($dailyWorkReport)
    {
        $employee = $dailyWorkReport->user()->first();
        $logo = public_path() . '/images/logo.png';
        $pdf = PDF::loadview('MasterData/DailyWorkReport/print', compact('employee', 'dailyWorkReport', 'logo'));
        return $pdf->stream('NICT.laporankerjaharian-' . $dailyWorkReport->daily_work_report_id . '.pdf');
    }
    public static function printEmployeeWorkObj($employeeWorkObjective)
    {
        $employee = $employeeWorkObjective->user()->first();
        $logo = public_path() . '/images/logo.png';
        $sig = '<img src="data:image/svg+xml;base64,' .base64_encode($employee->signature()->first()->sig_svg). '" width="150" height="100" style="width: 150!important; height:60!important;" />';
        $pdf = PDF::loadview('EmployeePage/SKP/print', compact('employee', 'employeeWorkObjective', 'logo', 'sig'));
        return $pdf->stream('NICT.skp-' . $employeeWorkObjective->employee_work_objective_id . '.pdf');
    }
}
