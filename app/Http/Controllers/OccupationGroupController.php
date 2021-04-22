<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccupationGroupRequest;
use App\Models\Occupation;
use App\Models\OccupationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OccupationGroupController extends Controller
{
    public function getData()
    {
        return DB::select("SELECT occupation_groups.occupation_group_name, COUNT(occupations.user_id) user FROM occupation_groups LEFT JOIN occupations ON occupations.occupation_group_id = occupation_groups.occupation_group_id GROUP BY occupation_groups.occupation_group_name");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $occupations = $this->getData();
        return view('MasterData/occupationgroup', compact('occupations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OccupationGroupRequest $request)
    {
        $occ = new OccupationGroup();
        $occ->occupation_group_name = $request->occupation_group_name;
        $occ->save();

        return response()->json(['message' => 'occupation Name has been created', 'status' => 'success', 'result' => 'Occupation Name created!', 'data' => $occ]);
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
    public function update(OccupationGroupRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OccupationGroupRequest $request)
    {
        $data = (OccupationGroup::where('occupation_group_name', $request->occupation_group_name)->first());
        if (Occupation::where('occupation_group_id', $data->occupation_group_id)->count() > 0) {
            return response()->json(['message' => 'occupation has employee', 'status' => 'error', 'result' => 'Occupation not delete!']);
        } else {
            $data->delete();
            return response()->json(['message' => 'occupation has successfully deleted', 'status' => 'success', 'result' => 'Occupation delete!']);
        }
    }
}
