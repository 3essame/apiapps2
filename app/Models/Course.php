<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function master() // relation with master one to many
    {
        return $this->belongsTo('App\Models\CourseMaster');
    }

    public function users() // relation with users many to many
    {
        return $this->belongsToMany('App\Models\User','cources_users')->withPivot(['state']);
    }

    public function accepted_users() // relation bettwen  cources_users  and
    {
        return $this->belongsToMany('App\Models\User','cources_users')->wherePivot('state','yes')->withPivot(['state']);
    }

    public function rejected_users()
    {
        return $this->belongsToMany('App\Models\User','cources_users')->wherePivot('state','no')->withPivot(['state']);
    }

}
