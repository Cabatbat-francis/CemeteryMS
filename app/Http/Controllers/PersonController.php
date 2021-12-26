<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //API GET: api/Person
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //API POST: api/Person
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    
    //API GET: api/Person/{$id}
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    
    //API PATCH: api/Person/{$id}
    public function update($id, Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    
    //API DELETE: api/Person/{$id}
    public function destroy($id)
    {
        //
    }


    //WEB GET: /person
    public function getSelf(){
        $auth = auth()->user();
        return view("person.index", ["auth" => $auth]);
    }

    //WEB POST: /person
    public function createSelf(Request $request){
        $this->validateRequest($request->all())->validate();
        auth()->user()->Person()->create($request->all());
        return redirect("/person");
    }

    //WEB PATCH: /person
    public function updateSelf(Request $request){
        $this->validateRequest($request->all())->validate();
        auth()->user()->Person()->update($request->all());
        return redirect("/person");
    }
    //WEB DELETE: /person
    public function deleteSelf(){
        auth()->user()->Person()->delete();
        auth()->user()->delete();
        return redirect("/login");
    }

    private function validateRequest($request){
        return Validator::make($request,[
            'user_id' => 'nullable|unique:persons|exists:App\Models\User,_id',
            'firstname' => 'required|string|max:64',
            'middlename' => 'nullable|string|max:64',
            'lastname' => 'required|string|max:64',
            'birthdate' => 'required|date|before:tomorrow|after:1900-01-01',
            'contact_no' => 'string|max:20',
            'isMale' => 'required|boolean'
        ]);
    }

}
