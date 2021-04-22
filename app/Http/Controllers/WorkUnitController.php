<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkUnitRequest;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkUnitController extends Controller
{
    public function getData()
    {
        return DB::select("SELECT work_units.work_unit_name, COUNT(user_work_unit.user_id) user FROM work_units LEFT JOIN user_work_unit ON user_work_unit.work_unit_id = work_units.work_unit_id GROUP BY  work_units.work_unit_name");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work_units = $this->getData();
        return view('MasterData/work_unit', compact('work_units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkUnitRequest $request)
    {
        $work_unit = new WorkUnit();
        $work_unit->work_unit_name = $request->work_unit_name;
        $work_unit->save();

        return response()->json(['message' => 'Work Unit Name has been created', 'status' => 'success', 'result' => 'Work Unit Name created!', 'data' => $work_unit]);
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
    public function update(WorkUnitRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkUnitRequest $request)
    {
        $data = (WorkUnit::where('work_unit_name', $request->work_unit_name)->first());
        if (WorkUnit::select('user_id')->join('user_work_unit', 'work_units.work_unit_id', 'user_work_unit.work_unit_id')->where('work_units.work_unit_id', $data->employment_id)->count() > 0) {
            return response()->json(['message' => 'Work Unit has employee', 'status' => 'error', 'result' => 'Work Unit not delete!']);
        } else {
            $data->delete();
            return response()->json(['message' => 'Work Unit has successfully deleted', 'status' => 'success', 'result' => 'Work Unit delete!']);
        }
    }
}
