<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return Department::all();
    }


    public function store()
    {
        //return request();
        return Department::create(request()->only('name'));
    }

    public function show(Department $department)
{
    return $department;
}

public function update(Department $department)
    {
        $department->update([
            'name'      =>request()->name

        ]);
        return $department;
    }

    public function destroy($id)
    {
        //return request();
        $department = Department::find($id);
        $department->delete();
    }

}
