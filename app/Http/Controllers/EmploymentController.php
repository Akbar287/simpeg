<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmploymentRequest;
use App\Models\Employments;
use App\Models\Occupation;
use Illuminate\Support\Facades\DB;

class EmploymentController extends Controller
{
    public function getData()
    {
        return DB::select("SELECT employments.employment_name, COUNT(occupations.user_id) user FROM employments LEFT JOIN occupations ON occupations.employment_id = employments.employment_id GROUP BY employments.employment_name");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employments = $this->getData();
        return view('MasterData/employment', compact('employments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmploymentRequest $request)
    {
        $employment = new Employments();
        $employment->employment_name = $request->employment_name;
        $employment->save();

        return response()->json(['message' => 'Employment Name has been created', 'status' => 'success', 'result' => 'Employment Name created!', 'data' => $employment]);
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
    public function update(EmploymentRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmploymentRequest $request)
    {
        $data = (Employments::where('employment_name', $request->employment_name)->first());
        if (Occupation::where('employment_id', $data->employment_id)->count() > 0) {
            return response()->json(['message' => 'Employment has employee', 'status' => 'error', 'result' => 'Employment not delete!']);
        } else {
            $data->delete();
            return response()->json(['message' => 'Employment has successfully deleted', 'status' => 'success', 'result' => 'Employment delete!']);
        }
    }
}
