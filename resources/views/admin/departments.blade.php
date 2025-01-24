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
                    <table id="department-datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Sl No</th>
                          <th>Department</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach($departments as $department)
                        <tr id="row{{$department->id}}">
                            <td>{{$i}}</td>
                            <td>{{$department->department}}</td>
                            <td>
                                <i class="fa fa-edit edit_department" data-id="{{$department->id}}" data-bs-toggle="modal" data-bs-target="#EditModal"></i>
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
              <form id="create_department_form" class="form" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label>Department</label>
                    <input type="text"  name="department" class="form-control">
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
            <form id="update_department_form" class="form" enctype="multipart/form-data">
              @csrf
               <input type="hidden" name="department_id" id="department_id" value="">
                <div class="form-group">
                    <label>Department</label>
                    <input type="text"  name="department" id="department" class="form-control">
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
        $('#department-datatable').DataTable();
    } );
</script>
<script>
$(document).ready(function() {
    $('#create_department_form').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]); 
        $.ajax({
            url: "{{route('department.store')}}",
            method: "POST",
            data: formData,
            contentType: false, 
            processData: false,
            success: function(response) {
                if (response.success) 
                {
                    $('#CreateModal').modal('hide');
                    $('#create_department_form')[0].reset();
                    swal("Good job!", "Department Added successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                    var text = $('#department-datatable tbody tr:last td:first').text();
                    var row = '<tr id="row"'+ response.data['id'] +'><td>' + response.data['id'] + '</td><td>' + response.data['department'] + '</td><td><i class="fa fa-edit edit_department" data-id="'+response.data['id']+'" data-bs-toggle="modal" data-bs-target="#EditModal"></i></td></tr>';
                    $('#department-datatable tbody').prepend(row);
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
$(document).on("click", ".edit_department", function() {
   var department_id = $(this).data('id');
   $('#department_id').val(department_id);
   $.ajax({ type: "POST",
        url: "{{route('department.show')}}",
        data: { "_token": "{{ csrf_token() }}",
                department_id: department_id
              },
        success: function(res) 
        {
          $('#department').val(res.department);
        },
    });
});
</script> 
<script>
  $(document).ready(function() {
    $('#update_department_form').submit(function(event) {
        event.preventDefault();
        var department_id = $('#department_id').val();
        var department=$('#department').val();
        $.ajax({
            url: "{{route('department.update')}}",
            method: "PATCH", 
            data: {
              "_token": "{{ csrf_token() }}",
              department_id: department_id,
              department:department
            },
            success: function(response) {
                if (response.success) 
                {
                    $('#EditModal').modal('hide');
                    $('#update_department_form')[0].reset();
                    swal("Good job!", "Department Updated successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                    $('"#row"'+response.data['id']).html('');
                    var row = '<td>' + response.data['id'] + '</td><td>' + response.data['department'] + '</td><td><i class="fa fa-edit edit_department" data-id="'+response.data['id']+'" data-bs-toggle="modal" data-bs-target="#EditModal"></i></td>';
                    $('"#row"'+response.data['id']).html(row );
                    
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
</x-admin-layout>
