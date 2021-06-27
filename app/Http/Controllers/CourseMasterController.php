<?php

namespace App\Http\Controllers;

use App\Models\CourseMaster;
use Illuminate\Http\Request;

class CourseMasterController extends Controller
{
    public function index()
    {
        return CourseMaster::withCount(['departments', 'courses'])->get();
    }


    public function store()
    {
        //return request();
        request()->validate([
            'name' => 'required',
            'place' => 'required',
            // 'state' => 'required',
            'type' => 'required|numeric'
        ]);

        $coursemaster = CourseMaster::create(request()->only('name', 'place', 'description', 'state',  'type'));
        $coursemaster->departments()->attach(request()->department_ids);
        $coursemaster->courses()->createMany(request()->courses);
        return $coursemaster->loadCount('departments', 'courses');
    }


    public function show(CourseMaster $course_master)
    {
        return $course_master->load('courses', 'departments');
    }
    // update
    public function update(CourseMaster $course_master)
    {
        $course_master->update([
            'name'     => request()->name,
            'place'    => request()->place,
            'description'    => request()->notes,
            //'state'   => request()->state,
            'type'     => request()->type

        ]);
        $course_master->departments()->sync(request()->department_ids);
        $course_master->courses()->delete();
        $course_master->courses()->createMany(request()->courses);

        return $course_master->loadCount('departments', 'courses');
    }

    public function destroy(CourseMaster $course_master)
    {
        //return request();
        $course_master->delete();
    }
}
