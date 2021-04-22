<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Requests\EducationRequest;
use App\Models\Education;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $employee)
    {
        $title = 'Pendidikan';
        $education = $employee->family()->get();
        return view('Employee/education/index', compact('education', 'employee', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $employee)
    {
        $title = 'Pendidikan';
        return view('Employee/education/create', compact('employee', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $employee, EducationRequest $request)
    {
        if(!is_null($request->file('diploma_file'))){
            $filename = Helper::imgRandom($request->file('diploma_file')->getClientOriginalName());
            $request->file('diploma_file')->storeAs('diploma/', $filename);
        }
        $employee->education()->create($this->educationData($filename));

        return redirect('/pegawai/'. $employee->user_id . '/education')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Pendidikan Sudah Ditambah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee, Education $education)
    {
        $title = 'Pendidikan';
        return view('Employee/education/show', compact('education', 'employee', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee, Education $education)
    {
        $title = 'Pendidikan';
        return view('Employee/education/edit', compact('education', 'employee', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EducationRequest $request, Education $education, User $employee)
    {
        $filename = $education->diploma_file;
        if(!is_null($request->file('diploma_file'))){
            Storage::delete('diploma/' . $education->diploma_file);
            $filename = Helper::imgRandom($request->file('diploma_file')->getClientOriginalName());
            $request->file('diploma_file')->storeAs('diploma/', $filename);
        }
        $education->update($this->educationData($filename));
        return redirect('/pegawai/'. $employee->user_id . '/education')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Pendidikan Sudah Diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee, Education $education)
    {
        Storage::delete('diploma/' . $education->diploma_file);
        $education->delete();
        return redirect('/pegawai/'. $employee->user_id . '/education')->with('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Sukses!</strong> Data Pendidikan Sudah Dihapus.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

    }

    public function educationData($filename)
    {
        return [
            'principal' => request('principal'),
            'grade' => request('grade'),
            'final_grade' => request('final_grade'),
            'school_name' => request('school_name'),
            'location' => request('location'),
            'major' => request('major'),
            'diploma_number' => request('diploma_number'),
            'diploma_date' => request('diploma_date'),
            'diploma_file' => $filename
        ];
    }
}
