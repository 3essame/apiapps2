<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{


    public function store()
    {
        //return request();

        $course=Course::create(request()->only('name'));
        $course->users()->syncWithoutDetaching(request()->only('ids'));
        return $course->load('users');
    }

    public function show(Course $course)
    {
        return $course;
    }

    public function update(Course $course)
    {
        $course->update([
            'name'      =>request()->name,
            'masterid'  => request()->masterid,
            'type'      => request()->type,
            'datefrom'  =>  date('Y-m-d H:i:s' , strtotime(request()->datefrom)),
	        'dateto'    =>  date('Y-m-d H:i:s' , strtotime(request()->dateto)),
	        'notes'     => request()->notes,
	        'stutes'    => request()->stutes,
	        'countemp'  => request()->countemp,
	        'countdays' => request()->countdays,
        ]);
        $course->users()->syncWithoutDetaching(request()->only('ids'));



        //$course->users()->sync([1,2,3]);               // delete all and create added ids
    // $user_id_id_array[$course->id] = ['type' => 2];   // add if not found

       //$course->users()->attach([1,2]); // add ids once again

        return $course->loadCount('rejected_users','accepted_users')->load('rejected_users');
    }

    public function destroy($id)
    {
        //return request();
        $post = Course::find($id);
        $post->delete();
    }

}
