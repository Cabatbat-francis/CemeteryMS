@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">
        {{ $burial->name }}
    </h1>
    <form action="/corpse" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="burial_id" value="{{ $burial->id }}">
        <div class="row mt-5">
            <div class="form col-xl-4">
                <h3>Deceased's Information</h3>
                <div class="form-group mt-3">
                    <label for="firstname">First name: <small class="text-danger">*</small></label>
                    <input class="form-control" type="text" name="firstname" id="firstname" value="{{ old("firstname") }}" required>
                    @error('firstname')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="middlename">Middle name:</label>
                    <input class="form-control" type="text" name="middlename" id="middlename" value="{{ old("middlename") }}">
                    @error('middlename')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastname">Last name: <small class="text-danger">*</small></label>
                    <input class="form-control" type="text" name="lastname" id="lastname" value="{{ old("lastname") }}" required>
                    @error('lastname')
                        <small class="alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="isMale" class="">{{ __('Gender') }} <small class="text-danger">*</small></label>
                    <select name="isMale" id="isMale" class="form-control" required>
                        <option value="" disabled @if(is_null(old('isMale'))) selected @endif>Select Gender</option>
                        <option value="1" @if(old('isMale') === 1) selected @endif >Male</option>
                        <option value="0" @if(old('isMale') === 0) selected @endif>Female</option>
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
                        <input class="form-control" type="date" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required>
                        @error('birthdate')
                            <small class="alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="deathdate">Death Date <small class="text-danger">*</small></label>
                        <input class="form-control" type="date" name="deathdate" id="deathdate" value="{{ old('deathdate') }}" required>
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
                    <input type="text" class="form-control" name="fatherFirstname" id="fatherFirstname" value="{{ old('fatherFirstname') }}" required>
                    @error('fatherFirstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fatherMiddlename">Father's Middlename:</label>
                    <input type="text" class="form-control" name="fatherMiddlename" id="fatherMiddlename"  value="{{ old('fatherMiddlename') }}" >
                    @error('fatherMiddlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fatherLastname">Father's Lastname: <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="fatherLastname" id="fatherLastname" value="{{ old('fatherLastname') }}" required>
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
                    <input type="text" class="form-control" name="motherFirstname" id="motherFirstname" value="{{ old('motherFirstname') }}" required>
                    @error('motherFirstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="motherMiddlename">Mother's Middlename:</label>
                    <input type="text" class="form-control" name="motherMiddlename" id="motherMiddlename" value="{{ old('motherMiddlename') }}">
                    @error('motherMiddlename')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="motherLastname">Mother's Lastname: <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="motherLastname" id="motherLastname" value="{{ old('motherLastname') }}" required>
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
                <div class="text-bold">
                    Price: ₱{{ number_format($burial->price, 2) }}
                </div>
                <button class="btn btn-success">
                    Checkout
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
