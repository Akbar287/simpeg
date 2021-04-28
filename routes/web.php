<?php

use App\Models\Furlough;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false, 'reset' => false]);

Route::middleware(['cekLogin'])->group(function($route) {
    $route->get('/', function () { return view('welcome'); });
});

Route::middleware(['auth'])->group(function ($route) {
    $route->get('/home', 'HomeController@index')->name('Dashboard');

    $route->middleware(['isEmployee'])->group(function ($route) {

        $route->prefix('pribadi')->name('Pegawai')->group(function($route) {
            $route->get('/', 'PersonalController@index');
            $route->get('/ttd', 'PersonalController@ttd');
            $route->get('/photo', 'PersonalController@photo');
            $route->post('/photo', 'PersonalController@setPhoto');
        });

        $route->prefix('izinmutasi')->name('Mutasi')->group(function($route) {
            $route->get('/', 'PersonalController@index_mutasi');
            $route->get('/create', 'PersonalController@create_mutasi');
            $route->get('/{mutation}/print', 'MutationController@print');
            $route->post('/', 'PersonalController@store_mutasi');
            $route->get('/{mutation}', 'PersonalController@show_mutasi');
            $route->get('/{mutation}/edit', 'PersonalController@edit_mutasi');
            $route->put('/{mutation}', 'PersonalController@update_mutasi');
            $route->delete('/{mutation}', 'PersonalController@destroy_mutasi');
        });

        $route->prefix('izincuti')->name('Cuti')->group(function($route) {
            $route->get('/', 'PersonalController@index_cuti');
            $route->get('/create', 'PersonalController@create_cuti');
            $route->get('/{furlough}/print', 'FurloughController@print');
            $route->post('/', 'PersonalController@store_cuti');
            $route->get('/{furlough}', 'PersonalController@show_cuti');
            $route->get('/{furlough}/edit', 'PersonalController@edit_cuti');
            $route->put('/{furlough}', 'PersonalController@update_cuti');
            $route->delete('/{furlough}', 'PersonalController@destroy_cuti');
        });

        $route->prefix('laporan')->name('Laporan Kerja Harian')->group(function($route) {
            $route->get('/', 'PersonalController@index_dailyWork');
            $route->get('/create', 'PersonalController@create_dailyWork');
            $route->post('/', 'PersonalController@store_dailyWork');
            $route->get('/{laporan}', 'PersonalController@show_dailyWork');
            $route->get('/{laporan}/edit', 'PersonalController@edit_dailyWork');
            $route->put('/{laporan}', 'PersonalController@update_dailyWork');
        });

        $route->prefix('kinerja')->name('Sasaran Kinerja Pegawai')->group(function($route) {
            $route->get('/', 'PersonalController@index_skp');
            $route->get('/{employeeWorkObjective}', 'PersonalController@show_skp');
            $route->get('/{employeeWorkObjective}/print', 'PersonalController@cetak_skp');
        });

        $route->prefix('absen')->name('Absensi')->group(function($route) {
            $route->get('/', 'PersonalController@index_attendance');
            $route->get('/create', 'PersonalController@create_attendance');
            $route->get('/kehadiran', 'PersonalController@kehadiran_attendance');
            $route->post('/', 'PersonalController@store_finish_attendance');
            $route->post('/kehadiran', 'PersonalController@post_kehadiran_attendance');
        });

        $route->prefix('jadwal')->name('Jadwal')->group(function($route) {
            $route->get('/', 'PersonalController@index_schedule');
        });

    });

    $route->middleware(['isAdmin'])->group(function ($route) {

        $route->get('/golongan', 'OccupationGroupController@index')->name('Golongan');
        $route->get('/jabatan', 'EmploymentController@index')->name('Jabatan');
        $route->get('/unitkerja', 'WorkUnitController@index')->name('Unit Kerja');

        $route->name('Pegawai')->prefix('pegawai')->group(function($route) {
            $route->get('/', 'EmployeeController@index');
            $route->get('/create', 'EmployeeController@create');
            $route->post('/', 'EmployeeController@store');
            $route->get('/{employee}', 'EmployeeController@show');
            $route->get('/{employee}/edit', 'EmployeeController@edit');
            $route->put('/{employee}', 'EmployeeController@update');
        });

        $route->name('Admin')->prefix('admin')->group(function($route) {
            $route->get('/', 'AdminController@index');
            $route->get('/create', 'AdminController@create');
            $route->get('/photo', 'AdminController@photo');
            $route->get('/ttd', 'AdminController@ttd');
            $route->post('/photo', 'AdminController@setPhoto');
            $route->post('/', 'AdminController@store');
            $route->get('/{admin}', 'AdminController@show');
            $route->get('/{admin}/edit', 'AdminController@edit');
            $route->put('/{admin}', 'AdminController@update');
        });

        $route->name('Pegawai')->prefix('pegawai/{employee}')->group(function($route) {

            $route->prefix('family')->group(function($route) {
                $route->get('/', 'FamilyController@index');
                $route->get('/create', 'FamilyController@create');
                $route->post('/', 'FamilyController@store');
                $route->get('/{family}', 'FamilyController@show');
                $route->get('/{family}/edit', 'FamilyController@edit');
                $route->put('/{family}', 'FamilyController@update');
                $route->delete('/{family}', 'FamilyController@destroy');
            });

            $route->prefix('education')->group(function($route) {
                $route->get('/', 'EducationController@index');
                $route->get('/create', 'EducationController@create');
                $route->post('/', 'EducationController@store');
                $route->get('/{education}', 'EducationController@show');
                $route->get('/{education}/edit', 'EducationController@edit');
                $route->put('/{education}', 'EducationController@update');
                $route->delete('/{education}', 'EducationController@destroy');
            });

            $route->prefix('mutation')->group(function($route) {
                $route->get('/', 'MutationController@index');
                $route->get('/create', 'MutationController@create');
                $route->post('/', 'MutationController@store');
                $route->put('/{mutation}', 'MutationController@update');
                $route->get('/{mutation}', 'MutationController@show');
                $route->get('/{mutation}/edit', 'MutationController@edit');
                $route->post('/{mutation}/decline', 'MutationController@decline');
                $route->get('/{mutation}/print', 'MutationController@print');
                $route->delete('/{mutation}', 'MutationController@destroy');
            });

            $route->prefix('cuti')->group(function($route) {
                $route->get('/', 'FurloughController@index');
                $route->get('/create', 'FurloughController@create');
                $route->post('/', 'FurloughController@store');
                $route->put('/{furlough}', 'FurloughController@update');
                $route->get('/{furlough}', 'FurloughController@show');
                $route->get('/{furlough}/edit', 'FurloughController@edit');
                $route->post('/{furlough}/decline', 'FurloughController@decline');
                $route->get('/{furlough}/print', 'FurloughController@print');
                $route->delete('/{furlough}', 'FurloughController@destroy');
            });

            $route->prefix('absensi')->group(function($route) {
                $route->get('/', 'AttendanceController@index');
                $route->get('/create', 'AttendanceController@create');
                $route->post('/', 'AttendanceController@store');
                $route->put('/{attendance}', 'AttendanceController@update');
                $route->get('/{attendance}', 'AttendanceController@show');
                $route->get('/{attendance}/edit', 'AttendanceController@edit');
                $route->post('/{attendance}/decline', 'AttendanceController@decline');
                $route->get('/{attendance}/print', 'AttendanceController@print');
                $route->delete('/{attendance}', 'AttendanceController@destroy');
            });

            $route->prefix('skp')->group(function($route) {
                $route->get('/', 'EmployeeWorkObjectiveController@index');
                $route->get('/create', 'EmployeeWorkObjectiveController@create');
                $route->post('/', 'EmployeeWorkObjectiveController@store');
                $route->get('/{employeeWorkObjective}', 'EmployeeWorkObjectiveController@show');
                $route->get('/{employeeWorkObjective}/edit', 'EmployeeWorkObjectiveController@edit');
                $route->put('/{employeeWorkObjective}', 'EmployeeWorkObjectiveController@update');
                $route->delete('/{employeeWorkObjective}', 'EmployeeWorkObjectiveController@destroy');
            });
        });

        $route->name('Cuti')->prefix('cuti')->group(function($route) {
            $route->get('/', 'FurloughController@index_admin');
            $route->post('/', 'FurloughController@store_admin');
            $route->get('/create', 'FurloughController@create_admin');
            $route->get('/{furlough}', 'FurloughController@show_admin');
            $route->get('/{furlough}/edit', 'FurloughController@edit_admin');
            $route->put('/{furlough}', 'FurloughController@update_admin');
            $route->delete('/{furlough}', 'FurloughController@delete_admin');
        });

        $route->name('Sasaran Kinerja Pegawai')->prefix('skp')->group(function($route) {
            $route->get('/', 'EmployeeWorkObjectiveController@index_admin');
            $route->post('/', 'EmployeeWorkObjectiveController@store_admin');
            $route->get('/create', 'EmployeeWorkObjectiveController@create_admin');
            $route->get('/{employeeWorkObjective}', 'EmployeeWorkObjectiveController@show_admin');
            $route->get('/{employeeWorkObjective}/edit', 'EmployeeWorkObjectiveController@edit_admin');
            $route->get('/{employeeWorkObjective}/print', 'EmployeeWorkObjectiveController@print_admin');
            $route->put('/{employeeWorkObjective}', 'EmployeeWorkObjectiveController@update_admin');
            $route->delete('/{employeeWorkObjective}', 'EmployeeWorkObjectiveController@delete_admin');
        });

        $route->name('Mutasi')->prefix('mutation')->group(function($route) {
            $route->get('/', 'MutationController@index_admin');
            $route->post('/', 'MutationController@store_admin');
            $route->get('/create', 'MutationController@create_admin');
            $route->get('/{mutation}', 'MutationController@show_admin');
            $route->get('/{mutation}/edit', 'MutationController@edit_admin');
            $route->put('/{mutation}', 'MutationController@update_admin');
            $route->delete('/{mutation}', 'MutationController@delete_admin');
        });

        $route->name('Laporan Kerja Harian')->prefix('laporankerja')->group(function($route) {
            $route->get('/', 'DailyWorkReportController@index');
            $route->get('/create', 'DailyWorkReportController@create');
            $route->post('/', 'DailyWorkReportController@store');
            $route->get('/{dailyWorkReport}', 'DailyWorkReportController@show');
            $route->get('/{dailyWorkReport}/print', 'DailyWorkReportController@print');
            $route->get('/{dailyWorkReport}/edit', 'DailyWorkReportController@edit');
            $route->put('/{dailyWorkReport}', 'DailyWorkReportController@update');
            $route->delete('/{dailyWorkReport}', 'DailyWorkReportController@destroy');
        });

        $route->name('Absensi')->prefix('absensi')->group(function($route) {
            $route->get('/', 'AttendanceController@index_admin');
            $route->get('/create', 'AttendanceController@create_admin');
            $route->post('/', 'AttendanceController@store_admin');
            $route->get('/print', 'AttendanceController@print');
            $route->get('/{attendance}', 'AttendanceController@show_admin');
            $route->get('/{attendance}/edit', 'AttendanceController@edit_admin');
            $route->put('/{attendance}', 'AttendanceController@update_admin');
            $route->delete('/{attendance}', 'AttendanceController@destroy_admin');
        });

        $route->name('Jadwal')->prefix('jadwalkerja')->group(function($route) {
            $route->get('/', 'ScheduleController@index');
            $route->get('/qr', 'ScheduleController@indexqr');
            $route->get('/qr/{schedule}', 'ScheduleController@showqr');
        });
    });
});
