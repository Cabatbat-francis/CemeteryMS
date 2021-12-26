<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Person extends Eloquent
{
    protected $table = "persons";
    use HasFactory;
    protected $connection = "mongodb";

    protected $fillable = [
        "firstname",
        "middlename",
        "lastname",
        "contact_no",
        "isMale",
        "birthdate",
        "deathdate",
        "user_id",
        "father_id",
        "mother_id"
    ];

    public function User(){
        return $this->belongsTo('App\Models\User', "user_id", "_id");
    }

    public function Father(){
        return $this->belongsTo('App\Models\Person', "father_id", "_id");
    }

    public function Mother(){
        return $this->belongsTo('App\Models\Person', "mother_id", "_id");
    }
    public function Children(){
        if($this->isMale)
            return $this->hasMany('App\Models\Person', "father_id", "_id");
        else
            return $this->hasMany('App\Models\Person', "mother_id", "_id");
    }

    public function Corpse(){
        return $this->hasOne('App\Models\Corpse', "person_id", "_id");
    }


}
