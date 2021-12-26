@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account Information') }}</div>

                <div class="card-body">
                    <form method="POST" @if(!is_null($auth->Person)) action="{{ route('web-person-update-self') }}" @else action="{{ route('web-person-create-self') }}" @endif>
                        @csrf
                        @if(!is_null($auth->Person))
                            @method("PATCH")
                        @endif
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" @if(is_null($auth->Person)) value="{{ old('firstname') }}" @else value="{{ $auth->Person->firstname }}" @endif required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle name') }}</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" @if(is_null($auth->Person)) value="{{ old('middlename') }}" @else value="{{ $auth->Person->middlename }}" @endif autocomplete="middlename" autofocus>

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" @if(is_null($auth->Person)) value="{{ old('lastname') }}" @else value="{{ $auth->Person->lastname }}" @endif required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" @if(is_null($auth->Person)) value="{{ old('birthdate') }}" @else value="{{ $auth->Person->birthdate }}" @endif required autocomplete="birthdate" autofocus>

                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="isMale" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="isMale" type="text" class="form-control @error('isMale') is-invalid @enderror" name="isMale" @if(is_null($auth->Person)) value="{{ old('isMale') }}" @else value="{{ $auth->Person->isMale }}" @endif required autocomplete="isMale" autofocus> --}}
                                <select name="isMale" id="isMale" class="form-control">
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="1" @if(is_null($auth->Person) && old('isMale') === 1) selected @elseif(!is_null($auth->Person) && $auth->Person->isMale) selected @endif >Male</option>
                                    <option value="0" @if(is_null($auth->Person) && old('isMale') === 0) selected @elseif(!is_null($auth->Person) && !$auth->Person->isMale) selected @endif>Female</option>
                                </select>
                                @error('isMale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_no" class="col-md-4 col-form-label text-md-right">{{ __('Contact #') }}</label>

                            <div class="col-md-6">
                                <input id="contact_no" type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" @if(is_null($auth->Person)) value="{{ old('contact_no') }}" @else value="{{ $auth->Person->contact_no }}" @endif required autocomplete="contact_no" autofocus>

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" name="email" value="{{ $auth->email }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark text-white">
                                    {{ __('Update') }}
                                </button>
                                <button onclick="event.preventDefault(); document.getElementById('formDestroy').submit();" type="button" class="btn btn-danger">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" id="formDestroy" action="{{ route('web-person-delete-self') }}">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
