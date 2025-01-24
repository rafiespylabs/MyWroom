<x-admin1-layout>
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#CreateModal">
                        <i class="fa fa-plus"></i> Create</button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="preloader" style="display:none;">
                        <img src="{{asset('web/preloader.gif')}}">
                    </div>
                    <div class="table-responsive">
                      <table id="branch-datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Sl No</th>
                            <th>Branch</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php
                              $i=1;
                          @endphp
                          @foreach($branches as $branch)
                          <tr id="row{{$branch->id}}">
                              <td>{{$i}}</td>
                              <td>{{$branch->branch}}</td>
                              <td>
                                  <i class="fa fa-edit edit_branch" data-id="{{$branch->id}}" data-bs-toggle="modal" data-bs-target="#EditModal"></i>
                              </td>
                          </tr>
                          @php
                              $i++;
                          @endphp
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Create Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="create_branch_form" class="form" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label>Branch</label>
                    <input type="text"  name="branch" class="form-control">
                </div>
                <div class="form-actions form-group">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
 <!-- Create Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="update_branch_form" class="form" enctype="multipart/form-data">
              @csrf
               <input type="hidden" name="branch_id" id="branch_id" value="">
                <div class="form-group">
                    <label>Branch</label>
                    <input type="text"  name="branch" id="branch" class="form-control">
                </div>
                <div class="form-actions form-group">
                  <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
 <!-- Edit Modal -->
 @push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#branch-datatable').DataTable();
    } );
</script>
<script>
$(document).ready(function() {
    $('#create_branch_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]); 
        $.ajax({
            url: "{{route('branch.store')}}",
            method: "POST",
            data: formData,
            contentType: false, 
            processData: false,
            success: function(response) {
                if (response.success) 
                {
                    $('#CreateModal').modal('hide');
                    $('#create_branch_form')[0].reset();
                    swal("Good job!", "Branch Added successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                    var text = $('#branch-datatable tbody tr:last td:first').text();
                    var row = '<tr id="row"'+ response.data['id'] +'><td>' + response.data['id'] + '</td><td>' + response.data['branch'] + '</td><td><i class="fa fa-edit edit_branch" data-id="'+response.data['id']+'" data-bs-toggle="modal" data-bs-target="#EditModal"></i></td></tr>';
                    $('#branch-datatable tbody').prepend(row);
                } 
                else 
                {
                    alert( response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
  });
</script>
<script>
$(document).on("click", ".edit_branch", function() {
   var branch_id = $(this).data('id');
   $('#branch_id').val(branch_id);
   $.ajax({ type: "POST",
        url: "{{route('branch.show')}}",
        data: { "_token": "{{ csrf_token() }}",
                branch_id: branch_id
              },
        success: function(res) 
        {
          $('#branch').val(res.branch);
        },
    });
});
</script> 
<script>
  $(document).ready(function() {
    $('#update_branch_form').submit(function(event) {
        event.preventDefault();
        var branch_id = $('#branch_id').val();
        var branch=$('#branch').val();
        $.ajax({
            url: "{{route('branch.update')}}",
            method: "PATCH", 
            data: {
              "_token": "{{ csrf_token() }}",
              branch_id: branch_id,
              branch:branch
            },
            success: function(response) {
                if (response.success) 
                {
                    $('#EditModal').modal('hide');
                    $('#update_branch_form')[0].reset();
                    swal("Good job!", "Branch Updated successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                    $('#row'+response.data['id']).html('');
                    var row = '<td>' + response.data['id'] + '</td><td>' + response.data['branch'] + '</td><td><i class="fa fa-edit edit_branch" data-id="'+response.data['id']+'" data-bs-toggle="modal" data-bs-target="#EditModal"></i></td>';
                    $('#row'+response.data['id']).html(row );
                    
                } 
                else 
                {
                    alert('Error updating data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    });
  });
</script>
@endpush
</x-admin1-layout>
