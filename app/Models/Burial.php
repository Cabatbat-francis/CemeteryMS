<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Burial extends Eloquent
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $fillable = ['name','description','price','months'];
}
