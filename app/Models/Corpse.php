<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Corpse extends Eloquent
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $fillable = [
        "person_id",
        "user_id",
        "burial_id",
        "location",
        "birthcert",
        "deathcert",
        "rented_until",
        "status"
    ];

    public function User(){
        return $this->belongsTo('App\Models\User', "user_id", "_id");
    }

    public function Burial(){
        return $this->belongsTo('App\Models\Burial', "burial_id", "_id");
    }

    public function Person(){
        return $this->belongsTo('App\Models\Person', "person_id", "_id");
    }
}
