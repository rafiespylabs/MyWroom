<x-admin1-layout>
    <div class="page-inner">
        <div class="page-header"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#CreateModal">
                                <i class="fa fa-plus"></i> Membership Registration
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="preloader" style="display:none;">
                            <img src="{{ asset('web/preloader.gif') }}">
                        </div>
                        <div class="table-responsive">
                            <table id="memberships-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>First Name</th>                                    
                                        <th>Middle Name</th>                                    
                                        <th>Last Name</th>                                    
                                        <th>Email</th>                                    
                                        <th>Phone Number</th>                                    
                                        <th>Address</th>                                    
                                        <th>Business Category</th>                                    
                                        <th>Firm Name</th>                                    
                                        <th>City</th>                                    
                                        <th>Chapter</th>                                    
                                        <th>Membership Type</th>                                    
                                        <th>Join Date</th>   
                                        <th>GSTIN</th>                                 
                                        <th>Added By</th>                                    
                                        <th>Added Date</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>                               

                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($memberships as $member)
                                    @php $added_by = $member->user->name ?? ''; @endphp
                                        <tr id="row{{ $member->id }}">
                                            <td>{{ $i }}</td>                                           
                                            <td>{{ $member->first_name }}</td>
                                            <td>{{ $member->middle_name}}</td>
                                            <td>{{ $member->last_name}}</td>
                                            <td>{{ $member->email}}</td>
                                            <td>{{ $member->phone_number}}</td>
                                            <td>{{ $member->address}}</td>
                                            <td>{{ $member->business_category->business_category_name ?? 'N/A'}}</td>
                                            <td>{{ $member->firm_name}}</td>
                                            <td>{{ $member->city->city_name ?? 'N/A'}}</td>
                                            <td>{{ $member->chapter->chapter_name ?? 'N/A'}}</td>
                                            <td>{{ $member->membership_type->membership_type ?? 'N/A'}}</td>
                                            <td>{{ $member->join_date}}</td>   
                                            <td>{{ $member->gst_in}}</td>                                          
                                            <td>{{ $added_by}}</td>                                            
                                            <td>{{ \Carbon\Carbon::parse($member->added_date)->format('d/m/Y') }}</td> 
                                            <td>
                                                <i class="fa fa-edit edit_memberships"
                                                    data-id="{{ $member->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>

                                                    <i class="fa fa-trash delete_memberships"
                                                    data-id="{{ $member->id }}"></i>    
                                            </td>                                           
                                        </tr>                                      
                                        @php $i++; @endphp                                      
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Membership Registration</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_memberships_form" class="form">
                        @csrf
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" name="phone_number" id="phone_number" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" >
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="business_category">Business Category</label>
                                <select name="business_category_id" id="business_category_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($business_category as $business)
                                        <option value="{{ $business->id }}">{{ $business->business_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-4">
                                <label for="firm_name">Firm Name</label>
                                <input type="text" name="firm_name" id="firm_name" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="city">City</label>
                                <select name="city_id" id="city_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($city as $cit)
                                        <option value="{{ $cit->id }}">{{ $cit->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>  
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="chapter">Chapter</label>
                                <select name="chapter_id" id="chapter_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($chapter as $chap)
                                        <option value="{{ $chap->id }}">{{ $chap->chapter_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-4">
                                <label for="membership_type">Membership Type</label>
                                <select name="membership_type_id" id="membership_type_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($membership_type as $membership_t)
                                        <option value="{{ $membership_t->id }}">{{ $membership_t->membership_type }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-4">
                                <label for="join_date">Join Date</label>
                                <input type="date" name="join_date" id="join_date" class="form-control" required>
                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="join_date">GSTIN</label>
                                <input type="text" name="gst_in" id="gst_in" class="form-control">
                            </div>
                        </div>  
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Membership Registration</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_memberships_form" class="form">
                        @csrf
                            <input type="hidden" name="rowid" id="row_id">
                            <input type="hidden" name="id" id="memberships_id">
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="edit_first_name" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" name="middle_name" id="edit_middle_name" class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="edit_last_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" name="phone_number" id="edit_phone_number" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="edit_address" class="form-control" >
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="business_category">Business Category</label>
                                <select name="business_category_id" id="edit_business_category_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($business_category as $business)
                                        <option value="{{ $business->id }}">{{ $business->business_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-4">
                                <label for="firm_name">Firm Name</label>
                                <input type="text" name="firm_name" id="edit_firm_name" class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="city">City</label>
                                <select name="city_id" id="edit_city_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($city as $cit)
                                        <option value="{{ $cit->id }}">{{ $cit->city_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="chapter">Chapter</label>
                                <select name="chapter_id" id="edit_chapter_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($chapter as $chap)
                                        <option value="{{ $chap->id }}">{{ $chap->chapter_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-4">
                                <label for="membership_type">Membership Type</label>
                                <select name="membership_type_id" id="edit_membership_type_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($membership_type as $membership_t)
                                        <option value="{{ $membership_t->id }}">{{ $membership_t->membership_type }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="col-4">
                                <label for="join_date">Join Date</label>
                                <input type="date" name="join_date" id="edit_join_date" class="form-control" required>
                            </div>     
                        </div>   
                        <div class="row form-group">
                            <div class="col-4">
                                <label for="join_date">GSTIN</label>
                                <input type="text" name="gst_in" id="edit_gst_in" class="form-control">
                            </div>
                        </div>                     
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#memberships-datatable').DataTable();
                $('#create_memberships_form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData($(this)[0]);  
                    $.ajax({
                        url: "{{ route('memberships.store') }}", 
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#CreateModal').modal('hide');  
                                $('#create_memberships_form')[0].reset(); 
                                swal("Success!", "Membership added successfully!", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#memberships-datatable').DataTable();
                                var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 0;
                                var newRow = table.row.add([
                                    lastRowNumber,
                                    response.data.first_name,
                                    response.data.middle_name,
                                    response.data.last_name,
                                    response.data.email,
                                    response.data.phone_number,
                                    response.data.address,
                                    response.data.business_category_name,
                                    response.data.firm_name,
                                    response.data.city_name,
                                    response.data.chapter_name,
                                    response.data.membership_type,
                                    response.data.join_date,
                                    response.data.gst_in,
                                    response.data.added_user,
                                    response.data.added_date,
                                    '<i class="fa fa-edit edit_memberships" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>'+
                                    '<i class="fa fa-trash delete_memberships" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '"></i>'
                                ]).draw(false);
                                table.page('last').draw(false); 
                                $(newRow.node()).attr('id', 'row' + response.data.id);  
                            } else {
                                swal("Error", response.message, {
                                    icon: "error",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-danger",
                                        },
                                    },
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                            swal("Error", "An unexpected error occurred. Please try again.", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-danger",
                                    },
                                },
                            });
                        }
                    });
                });

                $(document).on("click", ".edit_memberships", function() {
                    var memberships_id = $(this).data('id') || $(this).attr('data-id');
                    var row_id = $(this).data('rowid');
                    var business_category_id = $(this).data('business_category_id');
                    var city_id = $(this).data('city_id');
                    var chapter_id = $(this).data('chapter_id');
                    var membership_type_id = $(this).data('membership_type_id');

                    $('#memberships_id').val(memberships_id);
                    $('#row_id').val(row_id);
                    $('#business_category_id').val(business_category_id);
                    $('#city_id').val(city_id);
                    $('#chapter_id').val(chapter_id);
                    $('#membership_type_id').val(membership_type_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('memberships.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": memberships_id
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#edit_first_name').val(response.data.first_name);
                                $('#edit_middle_name').val(response.data.middle_name);                                              
                                $('#edit_last_name').val(response.data.last_name);                                              
                                $('#edit_email').val(response.data.email);                                              
                                $('#edit_phone_number').val(response.data.phone_number);                                              
                                $('#edit_address').val(response.data.address);                                              
                                $('#edit_business_category_id').val(response.data.business_category_id);                                              
                                $('#edit_firm_name').val(response.data.firm_name);                                              
                                $('#edit_city_id').val(response.data.city_id);                                              
                                $('#edit_chapter_id').val(response.data.chapter_id);                                              
                                $('#edit_membership_type_id').val(response.data.membership_type_id);                                              
                                $('#edit_join_date').val(response.data.join_date); 
                                $('#edit_gst_in').val(response.data.gst_in);                                                                                           
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });

                $('#edit_memberships_form').submit(function(event) {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 

                    $.ajax({
                        url: "{{ route('memberships.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#EditModal').modal('hide');
                                $('#edit_memberships_form')[0].reset();
                                swal("Success!", "Membership updated successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#memberships-datatable').DataTable();
                                var row = table.row('#row' + response.data.id); 
                                row.data([
                                    rowId, 
                                    response.data.first_name,
                                    response.data.middle_name,
                                    response.data.last_name,
                                    response.data.email,
                                    response.data.phone_number,
                                    response.data.address,
                                    response.data.business_category_name,
                                    response.data.firm_name,
                                    response.data.city_name,
                                    response.data.chapter_name,
                                    response.data.membership_type,
                                    response.data.join_date,
                                    response.data.gst_in,
                                    response.data.added_user,
                                    response.data.added_date,
                                    '<i class="fa fa-edit edit_memberships" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                    '<i class="fa fa-trash delete_memberships" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
                                ]).draw(false);
                            } else {
                                swal("Error", response.message, {
                                    icon: "error",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-danger",
                                        },                                        
                                    },
                                });
                            }
                        },

                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                            swal("Error", "An unexpected error occurred. Please try again.", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-danger",
                                    },
                                },
                            });
                        }
                    });
                });

                $(document).on('click', '.delete_memberships', function() {
                    var membershipsId = $(this).data('id');
                    var rowSelector = '#row' + membershipsId; 

                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('memberships.destroy') }}", 
                                method: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}", 
                                    "id": membershipsId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        var table = $('#memberships-datatable').DataTable();
                                        table.row(rowSelector).remove().draw(false);
                                        swal("Deleted!", response.message, {
                                            icon: "success",
                                        });
                                    } else {
                                        swal("Error", response.message, {
                                            icon: "error",
                                        });
                                    }
                                },
                                
                                error: function(xhr, status, error) {
                                    console.error('AJAX error:', xhr.responseText);
                                    swal("Error", "An unexpected error occurred. Please try again.", {
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).on("change", "#city_id", function() {
                var city_id=$(this).val();
                $('#chapter_id').prop('disabled', true).html('<option value="">Loading...</option>');
                if (city_id) 
                {
                    $.ajax({
                        url: "{{ route('cities.getchapters') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "city_id": city_id
                        },
                        success: function(response) 
                        {
                            $('#chapter_id').prop('disabled', false).html('<option value="">Select One</option>');
                            if (response.success) 
                            {
                                $.each(response.chapters, function(index, chapt) {
                                    $('#chapter_id').append('<option value="' +chapt.id+'">'+chapt.chapter_name+'</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                        }
                    });
                }
                else 
                {
                    $('#add_district_id').html('<option value="">Select One</option>').prop('disabled', true);
                }
            });
            $(document).on("change", "#edit_city_id", function() {
                var city_id=$(this).val();
                $('#edit_chapter_id').prop('disabled', true).html('<option value="">Loading...</option>');
                if (city_id) 
                {
                    $.ajax({
                        url: "{{ route('cities.getchapters') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "city_id": city_id
                        },
                        success: function(response) 
                        {
                            $('#edit_chapter_id').prop('disabled', false).html('<option value="">Select One</option>');
                            if (response.success) 
                            {
                                $.each(response.chapters, function(index, chapt) {
                                    $('#edit_chapter_id').append('<option value="' +chapt.id+'">'+chapt.chapter_name+'</option>');
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                        }
                    });
                }
                else 
                {
                    $('#add_district_id').html('<option value="">Select One</option>').prop('disabled', true);
                }
            });
        </script>
    @endpush    
</x-admin1-layout>