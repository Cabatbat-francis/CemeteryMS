<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burial;

class BurialController extends Controller
{
    //API GET /burial
    public function Index(){
        return response(Burial::all());
    }

    //API GET /burial/{id}
    public function GetByID($id){
        $burial = Burial::find($id);
        if(is_null($burial))
            return response($burial);
        return response()->json(['message' => "Not Found!"], 404);
    }

    //WEB GET /burial/avail/{id}
    public function AvailBurial($id){
        $burial = Burial::find($id);
        if(is_null($burial))
            abort(404);
        
        return view("burial.avail", compact("burial"));
    }
}
