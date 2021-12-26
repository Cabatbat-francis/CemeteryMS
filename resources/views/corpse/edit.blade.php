@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">
        Update Plan
    </h1>
    <form action="/corpse/{{ $corpse->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <select name="burial_id" id="burial_id" class="p-1 rounded">
            <option value="" disabled>
                Select burial plan
            </option>
            @foreach ($burials as $burial)
                <option value="{{ $burial->id }}" @if($burial->id === $corpse->Burial->id) selected @endif>
                    {{ $burial->name }}
                </option>
            @endforeach
        </select>
        <div class="row mt-5">
            <div class="form col-xl-4">
                <h3>Deceased's Information</h3>
                <div class="form-group mt-3">
                    <label for="firstname">First name: <small class="text-danger">*</small></label>
                    <input class="form-control" type="text" name="firstname" id="firstname" value="@if(!is_null(old('firstname'))){{ old('firstname') }}@else{{ $corpse->Person->firstname }}@endif" required>
                    @error('firstname')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="middlename">Middle name:</label>
                    <input class="form-control" type="text" name="middlename" id="middlename" value="@if(!is_null(old('middlename'))){{ old('middlename') }}@else{{ $corpse->Person->middlename }}@endif">
                    @error('middlename')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastname">Last name: <small class="text-danger">*</small></label>
                    <input class="form-control" type="text" name="lastname" id="lastname" value="@if(!is_null(old('lastname'))){{ old('lastname') }}@else{{ $corpse->Person->lastname }}@endif" required>
                    @error('lastname')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="isMale" class="">{{ __('Gender') }} <small class="text-danger">*</small></label>
                    <select name="isMale" id="isMale" class="form-control" required>
                        <option value="" disabled>Select Gender</option>
                        <option value="1" @if(old('isMale') === 1) selected @elseif($corpse->Person->isMale === 1) selected @endif >Male</option>
                        <option value="0" @if(old('isMale') === 0) selected @elseif($corpse->Person->isFemale === 0) selected @endif >Female</option>
                    </select>
                    @error('isMale')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="birthdate">Birth Date <small class="text-danger">*</small></label>
                        <input class="form-control" type="date" name="birthdate" id="birthdate" value="@if(!is_null(old('birthdate'))){{ old('birthdate') }}@else{{ $corpse->Person->birthdate }}@endif" required>
                        @error('birthdate')
                            <small class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="deathdate">Death Date <small class="text-danger">*</small></label>
                        <input class="form-control" type="date" name="deathdate" id="deathdate" value="@if(!is_null(old('deathdate'))){{ old('deathdate') }}@else{{ $corpse->Person->deathdate }}@endif" required>
                        @error('deathdate')
                            <small class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <label for="birthcert">Birth Certificate <small class="text-danger">*</small></label>
                        <input type="file" name="birthcert" id="birthcert" accept="image/*" value="{{ old("birthcert") }}" required>
                        @error('birthcert')
                            <small class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="deathcert">Death Certificate <small class="text-danger">*</small></label>
                        <input type="file" name="deathcert" id="deathcert" accept="image/*"  value="{{ old("deathcert") }}" required>
                        @error('deathcert')
                            <small class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form col-xl-4">
                <h3>Father's Information</h3>
                <div class="form-group mt-3">
                    <label for="fatherFirstname">Father's Firstname: <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="fatherFirstname" id="fatherFirstname" value="@if(!is_null(old('fatherFirstname'))){{ old('fatherFirstname') }}@else{{ $corpse->Person->Father->firstname }}@endif" required>
                    @error('fatherFirstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fatherMiddlename">Father's Middlename:</label>
                    <input type="text" class="form-control" name="fatherMiddlename" id="fatherMiddlename"  value="@if(!is_null(old('fatherMiddlename'))){{ old('fatherMiddlename') }}@else{{ $corpse->Person->Father->middlename }}@endif" >
                    @error('fatherMiddlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fatherLastname">Father's Lastname: <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="fatherLastname" id="fatherLastname" value="@if(!is_null(old('fatherLastname'))){{ old('fatherLastname') }}@else{{ $corpse->Person->Father->lastname }}@endif" required>
                    @error('fatherLastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form col-xl-4">
                <h3>Mother's Information</h3>
                <div class="form-group mt-3">
                    <label for="motherFirstname">Mother's Firstname: <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="motherFirstname" id="motherFirstname" value="@if(!is_null(old('motherFirstname'))){{ old('motherFirstname') }}@else{{ $corpse->Person->Mother->firstname }}@endif" required>
                    @error('motherFirstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="motherMiddlename">Mother's Middlename:</label>
                    <input type="text" class="form-control" name="motherMiddlename" id="motherMiddlename" value="@if(!is_null(old('motherMiddlename'))){{ old('motherMiddlename') }}@else{{ $corpse->Person->Mother->middlename }}@endif">
                    @error('motherMiddlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="motherLastname">Mother's Lastname: <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="motherLastname" id="motherLastname" value="@if(!is_null(old('motherLastname'))){{ old('motherLastname') }}@else{{ $corpse->Person->Mother->lastname }}@endif" required>
                    @error('motherLastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="text-right mt-5">

            <div class="">
                <button class="btn btn-success">
                    Checkout
                </button>
            </div>
        </div>
    </form>
</div>
@endsection