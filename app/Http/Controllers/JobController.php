<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return Job::all();
    }


    public function store()
    {
        //return request();
        return Job::create(request()->only('name'));
    }

    public function show(Job $job)
{
    return $job;
}

    public function update(Job $job)
    {
        $job->update([
            'name'      =>request()->name,
            'jobmaster' =>request()->jobmaster
        ]);
        return $job;
    }

    public function destroy($id)
    {
        //return request();
        $job = Job::find($id);
        $job->delete();
    }
}
