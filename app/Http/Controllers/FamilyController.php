<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyRequest;
use App\Models\Family;
use App\Models\User;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $title = 'Keluarga';
        $families = $employee->family()->get();
        return view('Employee/family/index', compact('families', 'employee', 'title'));
    }

    public function create(User $employee)
    {
        $title = 'Keluarga';
        return view('Employee/family/create', compact('employee', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyRequest $request, User $employee)
    {
        $family = $employee->family()->create($this->familyData());
        return redirect('/pegawai/'. $employee->user_id . '/family')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Keluarga Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee, Family $family)
    {
        $title = 'Keluarga';
        return view('Employee/family/show', compact('family', 'employee', 'title'));
    }

    public function edit(User $employee, Family $family)
    {
        $title = 'Keluarga';
        return view('Employee/family/edit', compact('family', 'employee', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FamilyRequest $request, family $family, User $employee)
    {
        $family->update($this->familyData());
        return redirect('/pegawai/'. $employee->user_id . '/family')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Keluarga Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee, Family $family)
    {
        $family->delete();
        return redirect('/pegawai/'. $employee->user_id . '/family')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Keluarga Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    public function familyData()
    {
        return [
            'nik' => request('nik'),
            'name' => request('name'),
            'place_born' => request('place_born'),
            'date_born' => request('date_born'),
            'education' => request('education'),
            'work' => request('work'),
            'relationship' => request('relationship')
        ];
    }
}
