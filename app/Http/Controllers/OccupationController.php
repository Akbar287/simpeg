<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\OccupationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OccupationController extends Controller
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
        return view('MasterData/occupation', compact('occupations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    }
}
