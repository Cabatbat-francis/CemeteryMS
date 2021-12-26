@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Corpse List</h3>
    <table id="corpseTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Corpse Fullname</th>
                <th>Status</th>
                <th>Expiration</th>
                <th>Location</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($corpses as $corpse)
            <tr>
                <td>{{ $corpse->id }}</td>
                <td>{{ $corpse->Person->firstname }} {{ $corpse->Person->middlename }} {{ $corpse->Person->lastname }}</td>
                <td>
                    @if($corpse->status == 1)
                        <span class="text-danger">Waiting for verification</span>
                    @elseif($corpse->status == 2)
                    <span class="text-success">
                        Verified
                    </span>
                    @endif
                </td>
                <td>
                    {{ $corpse->rented_until }}
                </td>
                <td>
                    {{ $corpse->location? $corpse->location : "No Location" }}
                </td>
                <td><a href="/corpse/{{ $corpse->id }}"><button class="btn btn-success">Edit</button></a></td>
                <td>
                    <button class="btn btn-danger" title="Delete" onclick="deleteCorpse('{{ $corpse->id }}')" style="right: 5px">
                        Delete
                    </button>
                </td>
                <td>
                    @if($corpse->status == 1)
                    <button onclick="validateCorpseClick('{{ $corpse->id }}')" class="btn btn-warning" data-toggle="modal" data-target="#ValidateCorpse"> Validate </button>
                    @else
                    <button onclick="moveCorpse('{{ $corpse->id }}', '{{ $corpse->location }}')" class="btn btn-info text-white" data-toggle="modal" data-target="#ValidateCorpse"> Move </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="ValidateCorpse" tabindex="-1" role="dialog" aria-labelledby="validateCorpseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="validateCorpseLabel">Validate Corpse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="validateCorpseForm" method="POST" action="/validate">
                @csrf
                @method("PATCH")
                <input type="hidden" name="id" id="corpseHiddenID">
                <input id="corpseLocation" class="form-control" type="text" name="location" placeholder="Enter corpse location." required>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="corpseValidateSubmit()" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    
    <script>
        $(document).ready( function () {
            $('#corpseTable').DataTable();
        } );
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

        let validateCorpseClick = (id) => {
            $("#corpseHiddenID").val(id);
            $("#validateCorpseForm").attr("action", "/validate");
        };

        let corpseValidateSubmit = () => {
            if($("#corpseLocation").val() != "")
                $("#validateCorpseForm").submit();
            else{
                alert("Location should not be empty.");
            }
        }

        let moveCorpse = (id, location) => {
            $("#validateCorpseForm").attr("action", "/move");
            $("#corpseHiddenID").val(id);
            $("#corpseLocation").val(location);
        }
    </script>
@endsection