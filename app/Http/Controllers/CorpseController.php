<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Person;
use App\Models\Corpse;
use App\Models\Burial;

class CorpseController extends Controller
{
    //
     /**
     * Class constructor.
     */
    public function __construct()
    {
    }

    //API DELETE /corpse/{id}?_method=DELETE
    public function delete($id){
        $corpse = Corpse::find($id);
        if(is_null($corpse))
            return response()->json(["message" => "Not Found!"], 404);
        $corpse->Person->Father()->delete();
        $corpse->Person->Mother()->delete();
        $corpse->Person->delete();
        $corpse->delete();
        return response(["message" => "Corpse has been deleted."]);
    }

    //WEB GET /corpse
    public function index(){
        if(auth()->user()->role == 1 || auth()->user()->role == 2){
            $corpses = Corpse::all();
            return view("corpse.index", compact("corpses"));
        }
        else{
            abort(401);
        }
    }

    //WEB POST /corpse
    public function create(Request $request){
        $this->validateRequest($request->all())->validate();
        $father_id = Person::create([
            "firstname" => $request->fatherFirstname,
            "middlename" => $request->fatherMiddlename,
            "lastname" => $request->fatherLastname,
            "isMale" => 1,
        ])->id;
        $mother_id = Person::create([
            "firstname" => $request->motherFirstname,
            "middlename" => $request->motherMiddlename,
            "lastname" => $request->motherLastname,
            "isMale" => 0,
        ])->id;
        $person_id = Person::create([
            "firstname" => $request->firstname,
            "middlename" => $request->middlename,
            "lastname" => $request->lastname,
            "isMale" => $request->isMale,
            "birthdate" => $request->birthdate,
            "deathdate" => $request->deathdate,
            "father_id" => $father_id,
            "mother_id" => $mother_id,
        ])->id;
        $birthcert = $request->file("birthcert")->getClientOriginalExtension();
        $deathcert = $request->file("deathcert")->getClientOriginalExtension();
        auth()->user()->Corpses()->create([
            "burial_id" => $request->burial_id,
            "person_id" => $person_id,
            "birthcert" => $birthcert,
            "deathcert" => $deathcert,
            "status" => 1,
        ]);

        return redirect("/");


    }

    //WEB PATCH /validate
    public function validateCorpse(Request $request){
        if(auth()->user()->role == 1 || auth()->user()->role == 2){
            $corpse = Corpse::find($request->id);
            if($corpse->Burial->months > 0)
                $corpse->rented_until = date_format(now()->addMonths($corpse->Burial->months), "Y-m-d");
            $corpse->status = 2;
            $corpse->location = $request->location;
            $corpse->save();
            return redirect("/corpse");
        }
        else{
            //Unauthorized
            abort(401);
        }
    }

    //WEB PATCH /move
    public function moveCorpse(Request $request){
        if(auth()->user()->role == 1 || auth()->user()->role == 2){
            $corpse = Corpse::find($request->id);
            $corpse->location = $request->location;
            $corpse->save();
            return redirect("/corpse");
        }
    }

    //WEB GET /corpse/{id}
    public function edit($id){
        $corpse = Corpse::find($id);
        if(is_null($corpse))
            abort(404);
        $burials = Burial::all();
        return view("corpse.edit", compact("burials", "corpse"));
    }

    //WEB PATCH /corpse/{id}
    public function patch(Request $request, $id){
        $corpse = Corpse::find($id);
        if(is_null($corpse))
            abort(404);
        $this->validateRequest($request->all())->validate();
        $corpse->burial_id = $request->burial_id;
        $corpse->Person->firstname = $request->firstname;
        $corpse->Person->middlename = $request->middlename;
        $corpse->Person->lastname = $request->lastname;
        $corpse->Person->isMale = $request->isMale;
        $corpse->Person->birthdate = $request->birthdate;
        $corpse->Person->deathdate = $request->deathdate;
        $corpse->birthcert = $request->file("birthcert")->getClientOriginalExtension();
        $corpse->deathcert = $request->file("deathcert")->getClientOriginalExtension();
        $corpse->Person->Father->firstname = $request->fatherFirstname;
        $corpse->Person->Father->middlename = $request->fatherMiddlename;
        $corpse->Person->Father->lastname = $request->fatherLastname;
        $corpse->Person->Mother->firstname = $request->motherFirstname;
        $corpse->Person->Mother->middlename = $request->motherMiddlename;
        $corpse->Person->Mother->lastname = $request->motherLastname;
        $corpse->Person->Father->save();
        $corpse->Person->Mother->save();
        $corpse->Person->save();
        $corpse->save();
        return redirect("/");
    }

    private function validateRequest($request){
        return Validator::make($request,[
            'burial_id' => 'required|exists:App\Models\Burial,_id',
            'firstname' => 'required|string|max:64',
            'middlename' => 'nullable|string|max:64',
            'lastname' => 'required|string|max:64',
            'isMale' => 'required|boolean',
            'birthdate' => 'required|date|before:tomorrow|after:1900-01-01',
            'deathdate' => 'required|date|before:tomorrow|after_or_equal:birthdate',
            'birthcert' => 'required|image',
            'deathcert' => 'required|image',
            'fatherFirstname' => 'required|string|max:64',
            'fatherMiddlename' => 'nullable|string|max:64',
            'fatherLastname' => 'required|string|max:64',
            'motherFirstname' => 'required|string|max:64',
            'motherMiddlename' => 'nullable|string|max:64',
            'motherLastname' => 'required|string|max:64',
        ]);
    }
}
