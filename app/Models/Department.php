<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function coursemaster_department() // relation with CourseMaster many to many
    {
        return $this->belongsToMany('App\Models\CourseMaster','coursemaster_departments')->withPivot(['state']);
    }

}
