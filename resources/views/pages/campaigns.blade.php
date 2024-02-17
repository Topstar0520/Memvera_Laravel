@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Campaigns                    
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal">
                        Add
                    </button>
                </div>

                <div class="card-body">
                    <table id="campaigns_tbl" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Content</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach($campaigns as $campaign)
                                <tr>
                                    <th scope="row">{{$index++}}</th>
                                    <td>{{ $campaign->name }}</td>
                                    <td>{{ $campaign->subject }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($campaign->content, $limit = 16, $end = '...') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary editBtn" data-toggle="modal" data-id="{{$campaign->id}}" data-name="{{$campaign->name}}" data-subject="{{$campaign->subject}}" data-content="{{$campaign->content}}" data-target="#updateModal">Edit</a>
                                        <a href="#" class="btn btn-danger deleteBtn" data-toggle="modal" data-id="{{$campaign->id}}" data-name="{{$campaign->name}}" data-target="#deleteModal">Delete</a>
                                        <a href="#" class="btn btn-success sendBtn" data-toggle="modal" data-id="{{$campaign->id}}" data-name="{{$campaign->name}}" data-target="#sendModal">Send Email</a>
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
        <form method="POST" id="addcampaign" action="{{ route('campaign.create') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add campaign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">           

            <div class="row mb-3">
                <label for="add_name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                <div class="col-md-8">
                    <input id="add_name" type="text" class="form-control" name="name" value="" required autocomplete="name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="add_subject" class="col-md-3 col-form-label text-md-end">{{ __('Subject') }}</label>

                <div class="col-md-8">
                    <input id="add_subject" type="text" class="form-control" name="subject" value="" required autocomplete="subject">
                </div>
            </div>
            <div class="row mb-3">
                <label for="add_content" class="col-md-3 col-form-label text-md-end">{{ __('Content') }}</label>

                <div class="col-md-8">
                    <textarea id="add_content" class="form-control"  name="content" aria-label="With textarea" rows="10" cols="50" required></textarea>
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
    <form method="POST" id="editcampaign" action="{{ route('campaign.update') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Edit campaign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">           

                <input id="edit_id" type="hidden" class="form-control" name="campaign_id" >
                <div class="row mb-3">
                    <label for="edit_name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-8">
                        <input id="edit_name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edit_subject" class="col-md-3 col-form-label text-md-end">{{ __('Subject') }}</label>
    
                    <div class="col-md-8">
                        <input id="edit_subject" type="text" class="form-control" name="subject" value="" required autocomplete="subject">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edit_content" class="col-md-3 col-form-label text-md-end">{{ __('Content') }}</label>
    
                    <div class="col-md-8">
                        <textarea id="edit_content" class="form-control"  name="content" aria-label="With textarea" rows="10" cols="50" required></textarea>
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
      <form  class="modal-content" method="POST" action="{{ route('campaign.delete') }}">
        @csrf
        <input type="hidden" name="campaign_id" id="delete_id" value="0"/>
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

  
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="sendcampaign" action="{{ route('campaign.send') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="campaign_id" id="send_id" />
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendModalLabel"></h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
          
        <div class="form-check float-right">
            <input class="form-check-input" type="checkbox" value="" id="selectAll">
            <label class="form-check-label" for="selectAll">
              All Select
            </label>
        </div>

        </div>
        <div class="modal-body">    
        <ul class="list-group" id="member_list">
            @foreach($members as $member)
            <label for="check_{{$member->id}}">
                <li class="list-group-item" > 
                    <label >{{$member->name}}</label>
                    <input class="member-check float-right" type="checkbox" name="members[{{$member->id}}]" id="check_{{$member->id}}">
                </li></label>
            @endforeach
          </ul>
                <div id="send-errors-list"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="sendEmail" name="submit" >Send Email</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#campaigns_tbl').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    $(document).on("submit", "#addcampaign", function() {
        var e = this;

        $.post($(this).attr('action'), $(this).serialize(), function(data) {
            $(this).find("[type='submit']").html("Send Email");
            $(this).find("[type='submit']").attr("disabled", false);
            if (data.status) {
                window.location = data.redirect_location;
                $("#add_name").val("");
                $("#add_subject").val("");
                $("#add_content").val("");
            }
        }).fail(function(response) {
            $("#create-errors-list").html("");
            // handle error and show in html
            var erroJson = JSON.parse(response.responseText);
            for (var err in erroJson) {
                if (err == "name") {
                    $("#add_name").addClass("border-red");
                } else if (err == "subject") {
                    $("#add_subject").addClass("border-red");
                } else if (err == "content") {
                    $("#add_content").addClass("border-red");
                } else {
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
    
    $(document).on("submit", "#editcampaign", function() {
        var e = this;
        // change register button text before ajax
        $(this).find("[type='submit']").html("Update...");

        $.post($(this).attr('action'), $(this).serialize(), function(data) {
            if (data.status) {
                window.location = data.redirect_location;
                $("#edit_name").removeClass("border-red");
                $("#edit_subject").removeClass("border-red");
                $("#edit_content").removeClass("border-red");
            }
        }).fail(function(response) {
            $(this).find("[type='submit']").html("Update");
            $("#update-errors-list").html("");
            // handle error and show in html
            var erroJson = JSON.parse(response.responseText);
            for (var err in erroJson) {
                if (err == "name") {
                    $("#edit_name").addClass("border-red");
                } else if (err == "subject") {
                    $("#edit_subject").addClass("border-red");
                } else if (err == "content") {
                    $("#edit_content").addClass("border-red");
                } else {
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
        $("#edit_subject").val($(this).data("subject"));
        $("#edit_content").val($(this).data("content"));
    });
    $(".sendBtn").click(function(){
        $("#send_id").val($(this).data("id"));
        $("#sendModalLabel").html($(this).data("name"));
    });
    $("#selectAll").click(function(){
        const allCheckboxesVanillaJS = document.querySelectorAll("#member_list input[type='checkbox']");
            allCheckboxesVanillaJS.forEach(
                (checkbox) => (checkbox.checked = $(this).is(':checked'))
            );
    })
    

    $(document).on("submit", "#sendcampaign", function() {
        $("#send-errors-list").html("");
        $("#sendEmail").html("Sending...");
        $("#sendEmail").attr("disabled", true);

        $.post($(this).attr('action'), $(this).serialize(), function(data) {
            $("#sendEmail").html("Send Email");
            $("#sendEmail").attr("disabled", false);
            if (data.status) {
                $("#send-errors-list").append("<div class='alert alert-success' style='color: green;'>" +
                    data.msg +
                    "</div>");
            }
        }).fail(function(response) {
            $("#sendEmail").html("Send Email");
            $("#sendEmail").attr("disabled", false);
            $("#send-errors-list").html("");
            // handle error and show in html
            var erroJson = JSON.parse(response.responseText);
            for (var err in erroJson) {
                var alert = '';
                for (var errstr of erroJson[err]) alert += errstr;
                $("#send-errors-list").append("<div class='alert alert-danger'>" +
                    alert +
                    "</div>");
            }

        });
        return false;
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
