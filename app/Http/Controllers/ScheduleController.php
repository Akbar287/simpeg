<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = User::select('users.user_id')->addSelect('users.name')->addSelect('users.nip')->addSelect('users.profile_photo')->addSelect('employment_name')->join('user_role', 'users.user_id', 'user_role.user_id')->join('roles', 'roles.id', 'user_role.id')->join('occupations', 'occupations.user_id', 'users.user_id')->join('employments', 'employments.employment_id', 'occupations.employment_id')->get();
        return view('MasterData/Schedule/Schedule', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required'],
            'user_id' => ['required'],
            'jenis_kerja' => ['required']
        ]);

        $employee = User::find($request->user_id);

        $date = explode(',', str_replace(" ", "", $request->date));

        if(count($date) > 1) {
            foreach($date as $d)
            {
                $employee->schedule()->create([
                    'jenis_kerja' => $request->jenis_kerja,
                    'hari_kerja' => date('Y-m') .  '-' . $d,
                    'random_string_barcode' => $this->generateRandomString(255),
                ]);
            }
        } else {
            $employee->schedule()->create([
                'jenis_kerja' => $request->jenis_kerja,
                'hari_kerja' => date('Y-m') .  '-' . $request->date,
                'random_string_barcode' => $this->generateRandomString(255),
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Employee has been scheduled',
            'schedule' => $this->getSchedule($request->user_id)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'date' => ['required'],
            'title' => ['required'],
        ]);
        $date = explode('T', $request->date, -1)['0'];
        $schedule = Schedule::where('jenis_kerja', $request->title)->where('hari_kerja', $date)->where('user_id', $request->user_id)->first();
        $schedule->delete();

        return response()->json([
            'status' => true,
            'message' => 'Employee has been scheduled',
            'schedule' => $this->getSchedule($request->user_id)
        ], 200);
    }

    public function cek(Request $request)
    {
        $request->validate(['user' => ['required', 'numeric']]);

        $user = User::find($request->user);
        if(is_null($user)) return response()->json(['status' => false, 'message' => 'No Employee Found'], 404);

        $data = $this->getSchedule($request->user);
        // $temp = json_encode($temp);
        return response()->json([
            'status' => true,
            'message' => 'Schedule for '. $user->name .' is show',
            'schedule' => $data
        ], 200);
    }
    public function getSchedule($user)
    {
        $date = ['start' => date('Y-m') . '-01', 'end' => date('Y-m-t')];
        $data = Schedule::select('jenis_kerja as title')->addSelect('hari_kerja')->whereBetween('hari_kerja', [$date['start'], $date['end']])->where('user_id', $user)->get()->toArray();
        $temp = [];
        foreach($data as $schedule) {
            $temp[] = [
                'title' => $schedule['title'],
                'start' => $schedule['hari_kerja'] . 'T08:00:00.008',
                'end' => $schedule['hari_kerja'] . 'T16:00:00.008',
            ];
        }

        return $temp;
    }
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $cekDB = true;
        do {
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $cekDB = (Schedule::where('random_string_barcode', $randomString)->count() == 0) ? false : true;
        }while($cekDB);
        return $randomString;
    }
    public function indexqr(Request $request)
    {
        $employee = User::select('nip')->addSelect('user_id')->addSelect('name')->get();
        $date = ($request->date) ? $request->date : date('Y-m-d');
        $statusID = ($request->status) ? $request->status : 0;$data = '';

        $data = ($statusID == 0) ? Schedule::where('hari_kerja', $date)->where('jenis_kerja', 'WFO')->orderBy('user_id', 'asc')->get() : Schedule::where('hari_kerja', $date)->where('user_id', $statusID)->where('jenis_kerja', 'WFO')->orderBy('user_id', 'asc')->get();

        return view('MasterData/Schedule/index-qr', compact('statusID', 'date', 'employee', 'data'));
    }
}
