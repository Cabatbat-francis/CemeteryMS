@extends('layouts.app')

@section('content')
<div class="container">
    @auth
        @if(count($corpses) > 0)
        <h1 class="text-center">Plans availed.</h1>
        <div class="row mt-5">
            @foreach($corpses as $corpse)
                <div class="col-md-4 mt-3">
                    <div class="card text-center card-burial-{{ strtolower($corpse->Burial->name) }} font-20">
                        <h5 class="card-header card-header-burial-{{ strtolower($corpse->Burial->name) }} text-bold font-30 position-relative">
                            {{ $corpse->Burial->name }}
                            @if($corpse->status <= 1)
                            <button class="btn btn-success position-absolute" title="Edit" onclick="editCorpse('{{ $corpse->id }}')" style="right: 50px">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger position-absolute" title="Delete" onclick="deleteCorpse('{{ $corpse->id }}')" style="right: 5px">
                                <i class="fas fa-times"></i>
                            </button>
                            @endif
                        </h5>
                        <div class="">
                            {{ $corpse->Person->firstname }} {{ $corpse->Person->lastname }}
                        </div>
                        <div>
                            {{ date_format(date_create($corpse->Person->birthdate), "M d, Y") }} - {{ date_format(date_create($corpse->Person->deathdate), "M d, Y") }}
                        </div>
                        <div>
                            {{ $corpse->location ? $corpse->location : "No Location Yet" }}
                        </div>
                        <div class="card-footer text-muted">
                            @if($corpse->status > 1)
                                @if(is_null($corpse->rented_until))
                                    {{ "No expiration" }}
                                @else
                                    Expiration: {{ date_format(date_create($corpse->rented_until), "M d, Y") }}

                                @endif
                            @else
                                Waiting for staff's confirmation
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    @endauth
    <h1 class="text-center mt-5">
        Avail a burial plan now.
    </h1>
    <div class="row mt-5">
        @foreach ($burials as $burial)
            <div class="col-md-4 p-3 text-center">
                <div class="border-lightgrey rounded p-2">
                    <h3 class="text-success">
                        {{ $burial->name }}
                    </h3>
                    <div class="price text-bold font-30">
                        ₱{{ number_format($burial->price, 2) }}
                    </div>
                    <div class="duration text-dark text-bold font-20">
                        @if($burial->months >= 0)
                            {{ $burial->months/12 }} years
                        @else
                            Lifetime
                        @endif
                    </div>
                    <p class="" style="min-height: 150px">
                        {{ $burial->description }}
                    </p>
                    <div class="">
                        <a href="/burial/avail/{{ $burial->id }}">
                            <button class="btn btn-dark text-warning px-5">
                                Purchase
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
    <script>
        let deleteCorpse = (id) => {
            const r = confirm("Are you sure?");
            if(r)
            $.ajax({
                url:"/api/corpse/" + id + "?_method=DELETE",
                type:"POST",
                success: function(data){
                    window.location.href = "/";
                },
                error: function(data){

                }
            });
        };

        let editCorpse = (id) => {
            window.location.href = "/corpse/" + id;
        }


    </script>
@endsection