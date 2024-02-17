@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Members                    
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
                        Add
                    </button>
                </div>

                <div class="card-body">
                    <table  id="members_tbl" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach($members as $member)
                                <tr>
                                    <th scope="row">{{$index++}}</th>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->birthday }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary editBtn" data-toggle="modal" data-id="{{$member->id}}" data-name="{{$member->name}}" data-email="{{$member->email}}" data-birthday="{{$member->birthday}}" data-target="#updateModal">Edit</a>
                                        <a href="#" class="btn btn-danger deleteBtn" data-toggle="modal" data-id="{{$member->id}}" data-name="{{$member->name}}" data-target="#deleteModal">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="addMember" action="{{ route('member.create') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">           

                <div class="row mb-3">
                    <label for="add_name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-8">
                        <input id="add_name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="add_email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-8">
                        <input id="add_email" type="email" class="form-control" name="email" value="" required autocomplete="email">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="add_birthday" class="col-md-3 col-form-label text-md-end">{{ __('Birthday') }}</label>

                    <div class="col-md-8">
                        <input id="add_birthday" type="date" class="form-control" name="birthday" value="{{ date("Y-m-d")}}" required autocomplete="birthday">
                    </div>
                </div>
                <div id="create-errors-list"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="submit" >Add</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <form method="POST" id="editMember" action="{{ route('member.update') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Edit Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">           

                <input id="edit_id" type="hidden" class="form-control" name="member_id" >
                <div class="row mb-3">
                    <label for="edit_name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-8">
                        <input id="edit_name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="edit_email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-8">
                        <input id="edit_email" type="email" class="form-control" name="email" value="" required autocomplete="email">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="edit_birthday" class="col-md-3 col-form-label text-md-end">{{ __('Birthday') }}</label>

                    <div class="col-md-8">
                        <input id="edit_birthday" type="date" class="form-control" name="birthday" required autocomplete="birthday">
                    </div>
                </div>
                <div id="update-errors-list"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="submit" >Update</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form  class="modal-content" method="POST" action="{{ route('member.delete') }}">
        @csrf
        <input type="hidden" name="member_id" id="delete_id" value="0"/>
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete <b><span id="delete_name">Name</span> </b>           
          </h5>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form >
    </div>
  </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#members_tbl').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    $(document).on("submit", "#addMember", function() {
        var e = this;
        // change register button text before ajax

        $.post($(this).attr('action'), $(this).serialize(), function(data) {
            if (data.status) {
                window.location = data.redirect_location;
                $("#add_name").val("");
                $("#add_email").val("");
                $("#add_birthday").val("{{ date("Y-m-d")}}");
            }
        }).fail(function(response) {
            $("#create-errors-list").html("");
            // handle error and show in html
            var erroJson = JSON.parse(response.responseText);
            for (var err in erroJson) {
                // alert(err);
                if (err == "name") {
                    $("#add_name").addClass("border-red");
                } else if (err == "email") {
                    $("#add_email").addClass("border-red");
                } else if (err == "birthday") {
                    $("#add_birthday").addClass("border-red");
                } else {
                    $("#add_name").addClass("border-red");
                    $("#add_email").addClass("border-red");
                    $("#add_birthday").addClass("border-red");
                }
                var alert = '';
                for (var errstr of erroJson[err]) alert += errstr;
                $("#create-errors-list").append("<div class='alert alert-danger'>" +
                    alert +
                    "</div>");
            }

        });
        return false;
    });
    
    $(document).on("submit", "#editMember", function() {
        var e = this;
        $.post($(this).attr('action'), $(this).serialize(), function(data) {
            if (data.status) {
                window.location = data.redirect_location;
                $("#edit_name").removeClass("border-red");
                $("#edit_email").removeClass("border-red");
                $("#edit_birthday").removeClass("border-red");
            }
        }).fail(function(response) {
            $("#update-errors-list").html("");
            // handle error and show in html
            var erroJson = JSON.parse(response.responseText);
            for (var err in erroJson) {
                // alert(err);
                if (err == "name") {
                    $("#edit_name").addClass("border-red");
                } else if (err == "email") {
                    $("#edit_email").addClass("border-red");
                } else if (err == "birthday") {
                    $("#edit_birthday").addClass("border-red");
                } else {
                    $("#edit_email").addClass("border-red");
                }
                var alert = '';
                for (var errstr of erroJson[err]) alert += errstr;
                $("#update-errors-list").append("<div class='alert alert-danger'>" +
                    alert +
                    "</div>");
            }

        });
        return false;
    });
    $(".deleteBtn").click(function(){
        $("#delete_id").val($(this).data("id"));
        $("#delete_name").html($(this).data("name"));
    });
    $(".editBtn").click(function(){
        $("#edit_id").val($(this).data("id"));
        $("#edit_name").val($(this).data("name"));
        $("#edit_email").val($(this).data("email"));
        $("#edit_birthday").val($(this).data("birthday"));
    });
    

</script>
<style>
    .alert {
        margin-bottom: 10px;
        color: red;
    }

    .border-red {
        border: 1px solid red !important;
    }
</style>
@endsection
