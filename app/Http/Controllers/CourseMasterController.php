<?php

namespace App\Http\Controllers;

use App\Models\CourseMaster;
use Illuminate\Http\Request;

class CourseMasterController extends Controller
{
    public function index()
    {
        return CourseMaster::all();
    }


    public function store()
    {
        //return request();
        request()->validate([
            'name'=>'required',
            'place'=>'required',
            'status'=>'required',
            'type'=>'required|numeric'
        ]);

        $coursemaster= CourseMaster::create(request()->only('name','place','notes','status','importid' ,'type'));

        $coursemaster->departments()->syncWithoutDetaching(request()->only('ids'));
        return $coursemaster->load('departments');

    }


    public function show(CourseMaster $coursemaster)
{
    return $coursemaster;
}
// update
    public function update(CourseMaster $coursemaster)
    {
        $coursemaster->update([
            'name'     =>request()->name,
            'place'    =>request()->place,
            'notes'    =>request()->notes,
            'status'   =>request()->status,
            'importid' =>request()->importid,
            'type'     =>request()->type

        ]);
        $coursemaster->departments()->syncWithoutDetaching(request()->only('ids'));
        return $coursemaster;
    }

    public function destroy($id)
    {
        //return request();
        $post = CourseMaster::find($id);
        $post->delete();
    }


}
