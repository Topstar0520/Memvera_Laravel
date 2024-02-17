@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Email Histories
                </div>

                <div class="card-body">
                    <table id="emails_tbl" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Member Name</th>
                            <th scope="col">Member Email</th>
                            <th scope="col">Campaign Name</th>
                            <th scope="col">Send Date</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach($emails as $email)
                                <tr>
                                    <th scope="row">{{$index++}}</th>
                                    <td>{{ $email->member->name }}</td>
                                    <td>{{ $email->member->email }}</td>
                                    <td>{{ $email->campaign->name }}</td>
                                    <td>{{ $email->send_time }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary showBtn" data-toggle="modal" data-id="{{$email->id}}"
                                            data-member_info="{{$email->member->name}} ({{$email->member->email}})"   
                                            data-campaign_name="{{$email->campaign->name}}" 
                                            data-campaign_subject="{{$email->campaign->subject}}" 
                                            data-campaign_content="{{$email->campaign->content}}" 
                                            data-send_time="{{$email->send_time}}"                                             
                                            data-target="#showModal">View</a>
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
<div class="modal fade bd-example-modal-lg" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showModalLabel">To : <b id="member_info"></b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">           

            <div class="row mb-3">
                <label for="edit_name" class="col-md-3 col-form-label text-md-end">{{ __('Name') }}</label>

                <div class="col-md-8">
                    <input id="edit_name" type="text" class="form-control" name="name" value="" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="edit_subject" class="col-md-3 col-form-label text-md-end">{{ __('Subject') }}</label>

                <div class="col-md-8">
                    <input id="edit_subject" type="text" class="form-control" name="subject" value="" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="edit_content" class="col-md-3 col-form-label text-md-end">{{ __('Content') }}</label>

                <div class="col-md-8">
                    <textarea id="edit_content" class="form-control"  name="content" aria-label="With textarea" rows="10" cols="50" disabled></textarea>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <h5 class="modal-title" id="showModalLabel">Time : <b id="send_time"></b></h5>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script>
    $(document).ready(function () {
        $('#emails_tbl').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    $(".showBtn").click(function(){
        $("#member_info").html($(this).data("member_info"));
        $("#edit_name").val($(this).data("campaign_name"));
        $("#edit_subject").val($(this).data("campaign_subject"));
        $("#edit_content").val($(this).data("campaign_content"));
        $("#send_time").html($(this).data("send_time"));
    });
    

</script>
@endsection
