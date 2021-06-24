<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaster extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    public function departments() // relation with Department many to many
    {
        return $this->belongsToMany('App\Models\Department','coursemaster_departments')->withPivot(['state']);
    }

}
