<x-admin1-layout>
@push('styles')
@endpush
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Staffs</h4>
                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#CreateModal">
                <i class="fa fa-plus"></i> Create </button>
            </div>
            </div>
            <div class="card-body">
            <div id="preloader" style="display:none;">
                <img src="{{asset('web/preloader.gif')}}">
            </div>
            <div class="table-responsive">
                <table id="staff-datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>Sl No</th>
                        <th>Staff Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Branch</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="staff_tbody">
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
              <form id="create_staff_form" class="form" enctype="multipart/form-data">
              @csrf
                <div class="row form-group">
                    <div class="col-6">
                        <label>Name</label>
                        <input type="text"  name="name" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label>Email</label>
                        <input type="email"  name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label>Mobile Number</label>
                        <input type="text"  name="mobile_number" class="form-control" pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
                    </div>
                    <div class="col-6">
                        <label>Profile Image</label>
                        <input type="text"  name="profile_image" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label>Join Date</label>
                        <input type="date"  name="join_date"  id="join_date" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label>User Name</label>
                        <input type="text"  name="user_name" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label>Password</label>
                        <input type="password"  name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label>Confirm Password</label>
                        <input type="password"  name="cpassword" id="confirmPassword" class="form-control" required>
                        <p id="passwordMatch"></p>
                    </div>
                </div>
                <div class="row  form-group">
                    <div class="col-6">
                        <label>Branch</label>
                        <select  name="branch_id" id="addbranch_id" class="form-control" required>
                            <option value="">Select One</option>
                            @foreach($branches as $branch)
                            <option value="{{$branch->id}}">{{$branch->branch}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label>Department</label>
                        <select  name="dept_id" id="adddept_id" class="form-control" required>
                            <option value="">Select One</option>
                            @foreach($departments as $dept)
                            <option value="{{$dept->id}}">{{$dept->department}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-6">
                        <label>Designation</label>
                        <select  name="design_id" id="adddesign_id" class="form-control" required>
                            <option value="">Select One</option>
                            @foreach($designations as $design)
                            <option value="{{$design->id}}">{{$design->designation}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label>Role</label>
                        <select  name="role_id" id="addrole_id" class="form-control" required>
                            <option value="">Select One</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12">
                        <label>Address</label>
                        <textarea  name="address" class="form-control"></textarea>
                    </div>
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
                <form id="update_staff_form" class="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="staff_id" id="staff_id" value="">
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Name</label>
                            <input type="text"  name="name"  id="name" class="form-control" pattern="[a-zA-Z]+" 
                            title="Name can only contain letters." required>
                        </div>
                        <div class="col-6">
                            <label>Email</label>
                            <input type="email"  name="email"  id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Mobile Number</label>
                            <input type="text"  name="mobile_number" id="mobile_number" class="form-control" pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
                        </div>  
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Profile Image</label>
                            <input type="text"  name="profile_image" id="profile_image" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Join Date</label>
                            <input type="date"  name="join_date" id="join_date" class="form-control" required>
                        </div>
                        </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label>User Name</label>
                            <input type="text"  name="user_name" id="user_name" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Branch</label>
                            <select  name="branch_id" id="editbranch_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->branch}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row  form-group">
                        <div class="col-6">
                            <label>Department</label>
                            <select  name="dept_id" id="editdept_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach($departments as $dept)
                                <option value="{{$dept->id}}">{{$dept->department}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Designation</label>
                            <select  name="design_id" id="editdesign_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach($designations as $design)
                                <option value="{{$design->id}}">{{$design->designation}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Role</label>
                            <select  name="role_id" id="editrole_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Address</label>
                            <textarea  name="address" id="address" class="form-control"></textarea>
                        </div>
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
 <div class="modal fade" id="ResetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="ResetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_password_form" class="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="staff_id" id="staff_pwd_id" value="">
                    <div class="row form-group">
                        <div class="col-6">
                            <label>Password</label>
                            <input type="password"  name="password" class="form-control" value="">
                        </div>
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
 @push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        function fetch_staffData()
        {
            $('#staff_tbody').html('');
            $.ajax({ type: "GET",
                    url: "{{route('staff.list')}}",
                    beforeSend: function() 
                    {
                        $('#preloader').show();
                    },
                    success: function(res) 
                    {
                        $('#preloader').hide();
                        $('#staff-datatable').DataTable().destroy();
                        $('#staff_tbody').html(res);
                        $('#staff-datatable').DataTable({
                            "bStateSave": true,
                            "fnStateSave": function (oSettings, oData) {
                                localStorage.setItem('staff-datatable', JSON.stringify(oData));
                            },
                            "fnStateLoad": function (oSettings) {
                                return JSON.parse(localStorage.getItem('staff-datatable'));
                            }
                        });
                    },
                });
        }   
        fetch_staffData();
        $('#create_staff_form').submit(function(event) 
        {
            event.preventDefault();
            var formData = new FormData($(this)[0]); 
            $.ajax({
                url: "{{route('staff.store')}}",
                method: "POST",
                data: formData,
                contentType: false, 
                processData: false,
                success: function(response) {
                    if (response.success) 
                    {
                        $('#CreateModal').modal('hide');
                        $('#create_staff_form')[0].reset();
                        swal("Good job!", "Staff Created successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                        fetch_staffData();
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
        $('#update_staff_form').submit(function(event) 
        {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            formData.append('_token',  $('input[name="_token"]').val());
            formData.append('staff_id', $('#staff_id').val());
            formData.append('name', $('#name').val());
            formData.append('email', $('#email').val());
            formData.append('mobile_number', $('#mobile_number').val());
            formData.append('profile_image', $('#profile_image').val());
            formData.append('join_date', $('#join_date').val());
            formData.append('user_name', $('#user_name').val());
            formData.append('branch_id', $('#editbranch_id').val());
            formData.append('dept_id', $('#editdept_id').val());
            formData.append('design_id', $('#editdesign_id').val());
            formData.append('role_id', $('#editrole_id').val());
            formData.append('address', $('#address').val());
            $.ajax({
                url: "{{route('staff.update')}}",
                method: "POST", 
                data: formData,
                contentType: false, 
                processData: false,
                success: function(response) {
                    if (response.success) 
                    {
                        $('#EditModal').modal('hide');
                        $('#update_staff_form')[0].reset();
                        swal("Good job!", "Staff Updated successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                        fetch_staffData();                   
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
        $('#update_password_form').submit(function(event) 
        {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{route('password_reset')}}",
                method: "POST", 
                data: formData,
                contentType: false, 
                processData: false,
                success: function(response) {
                    if (response.success) 
                    {
                        $('#ResetPasswordModal').modal('hide');
                        $('#update_password_form')[0].reset();
                        swal("Good job!", "Password Updated successfully", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                className: "btn btn-success",
                                },
                            },
                        });
                        fetch_staffData();                   
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
        $(document).on("click", ".delete_staff", function() {
            var staff_id = $(this).data('id');
            if (confirm('Are you sure you want to delete this row?')) 
            {
                $.ajax({
                    url: "{{route('staff.destroy')}}",
                    method: "POST",
                    data:{ "_token": "{{ csrf_token() }}",
                            staff_id: staff_id
                        },
                    success: function(response) {
                        if (response.success) 
                        {
                            swal("Good job!", "Staff Deleted successfully", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                    className: "btn btn-danger",
                                    },
                                },
                            });
                            fetch_staffData();
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
            }
        });
    });
</script>
<script>
$(document).on("click", ".edit_staff", function() {
   var staff_id = $(this).data('id');
   $('#staff_id').val(staff_id);
   $.ajax({ type: "POST",
        url: "{{route('staff.show')}}",
        data: { "_token": "{{ csrf_token() }}",
                 staff_id: staff_id
              },
        success: function(res) 
        {
          $('#name').val(res.user.name);
          $('#email').val(res.user.email);
          $('#mobile_number').val(res.mobile_number);
          $('#join_date').val(res.Join_date);
          $('#user_name').val(res.user.user_name);
          $('#editbranch_id').val(res.branch_id);
          $('#editdept_id').val(res.dept_id);
          $('#editdesign_id').val(res.design_id);
          $('#editrole_id').val(res.user.role_id);
          $('#address').text(res.address);
          $('#profile_image').val(res.profile_image);
        },
    });
});
$(document).on("click", ".reset_password", function() {
   var staff_id = $(this).data('id');
   $('#staff_pwd_id').val(staff_id);
});
</script> 
<script>
$(document).ready(function() {
  $("#confirmPassword").on("input", function() {
    var password = $("#password").val();
    var confirmPassword = $(this).val();

    if (password === confirmPassword) {
      $("#passwordMatch").text("Passwords match!").css("color", "green");
    } else {
      $("#passwordMatch").text("Passwords do not match.").css("color", "red");
    }
  });
});
</script>
<script>
$(document).ready(function() {
  $("#join_date").on("change", function() {
    var joinDate = new Date($(this).val());
    var today = new Date();
    if (joinDate > today) {
      $(this).val(""); 
      alert("Join date cannot be in the future.");
    }
  });
});
</script>
@endpush
</x-admin1-layout>
