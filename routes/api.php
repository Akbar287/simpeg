<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/home', 'HomeController@DataHome');

Route::middleware(['auth'])->group(function ($route) {

    $route->put('signature', 'HomeController@setSignature')->name('signature');

    $route->middleware(['isEmployee'])->group(function($route) {
        $route->get('qrcode', 'PersonalController@getQrCode')->name('QRCODE');
        $route->post('pribadi', 'PersonalController@change')->name('password');
        $route->post('absen', 'PersonalController@store_attendance')->name('absensi');
        $route->post('signature/employee', 'PersonalController@getSignature')->name('signature');
    });

    $route->middleware(['isAdmin'])->group(function($route) {
        $route->post('signature', 'HomeController@getSignature')->name('signature');
        $route->post('reset', 'HomeController@reset_password')->name('reset');


        $route->prefix('admin')->group(function($route){
            $route->post('create', 'AdminController@role')->name('role');
            $route->post('{admin}', 'AdminController@change')->name('password');
        });

        $route->prefix('jadwalkerja')->group(function($route) {
            $route->post('/', 'ScheduleController@store')->name('create');
            $route->post('cek', 'ScheduleController@cek')->name('cek');
            $route->post('/delete', 'ScheduleController@destroy')->name('delete');
        });

        $route->prefix('/mutation')->group(function($route) {
            $route->get('/', 'MutationController@getSKNumber')->name('mutation');
            $route->post('/check', 'MutationController@checkSKMutation')->name('mutation');
        });
        $route->prefix('/cuti')->group(function($route) {
            $route->get('/', 'FurloughController@getSKNumber')->name('cuti');
            $route->post('/check', 'FurloughController@checkSKFurlough')->name('cuti');
        });
        $route->prefix('golongan')->name('Golongan')->group(function($route) {
            $route->get('/', 'OccupationGroupController@getData')->name('index');
            $route->post('/', 'OccupationGroupController@store')->name('create');
            $route->delete('/', 'OccupationGroupController@destroy')->name('delete');
        });
        $route->prefix('jabatan')->name('Jabatan')->group(function($route) {
            $route->get('/', 'EmploymentController@getData')->name('index');
            $route->post('/', 'EmploymentController@store')->name('create');
            $route->delete('/', 'EmploymentController@destroy')->name('delete');
        });

        $route->prefix('unitkerja')->name('Unit Kerja')->group(function($route) {
            $route->get('/', 'WorkUnitController@getData')->name('index');
            $route->post('/', 'WorkUnitController@store')->name('create');
            $route->delete('/', 'WorkUnitController@destroy')->name('delete');
        });
    });
});

