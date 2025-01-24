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
                                <i class="fa fa-plus"></i> Create
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="preloader" style="display:none;">
                            <img src="{{ asset('web/preloader.gif') }}">
                        </div>
                        <div class="table-responsive">
                            <table id="districts-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Country</th>                                    
                                        <th>State</th>                                    
                                        <th>District</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($districts as $district)
                                        <tr id="row{{ $district->id }}">
                                            <td>{{ $i }}</td>  
                                            <td>{{ $district->country->country_name ?? 'N/A'}}</td>                                          
                                            <td>{{ $district->state->state_name ?? 'N/A'}}</td>                                          
                                            <td>{{ $district->district_name }}</td>                                        
                                            <td>
                                                <i class="fa fa-edit edit_districts"
                                                    data-id="{{ $district->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>
                                                    <i class="fa fa-trash delete_districts"
                                                    data-id="{{ $district->id }}">
                                                </i>
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
        <div class="modal-dialog modal-lg" role="document">            
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create District</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_districts_form" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($country as $count)
                                    <option value="{{ $count->id }}">{{ $count->country_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="state">State</label>
                            <select name="state_id" id="state_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($state as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->state_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="district_name">District</label>
                            <input type="text" name="district_name" id="district_name" class="form-control" required>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit District</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_districts_form" class="form">
                        @csrf
                        <input type="hidden" name="rowid" id="row_id">
                            <input type="hidden" name="id" id="districts_id">
                            <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country_id" id="edit_country_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($country as $count)
                                    <option value="{{ $count->id }}">{{ $count->country_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <label for="state">State</label>
                            <select name="state_id" id="edit_state_id" class="form-control" required>
                                <option value="">Select One</option>
                                @foreach ($state as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->state_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="district_name">District</label>
                            <input type="text" name="district_name" id="edit_district_name" class="form-control" required>
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
                $('#districts-datatable').DataTable();
                $('#create_districts_form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData($(this)[0]);  
                    $.ajax({
                        url: "{{ route('districts.store') }}", 
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#CreateModal').modal('hide');  
                                $('#create_districts_form')[0].reset(); 
                                swal("Success!", "District added successfully!", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#districts-datatable').DataTable();
                                var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 0;
                                var newRow = table.row.add([
                                    lastRowNumber,
                                    response.data.country_name,
                                    response.data.state_name,
                                    response.data.district_name,
                                    '<i class="fa fa-edit edit_districts" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>'+
                                    '<i class="fa fa-trash delete_districts" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '"></i>'
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

                $(document).on("click", ".edit_districts", function() {
                    var districts_id = $(this).data('id');
                    var row_id = $(this).data('rowid');
                    var country_id = $(this).data('country_id');
                    var state_id = $(this).data('state_id');

                    $('#districts_id').val(districts_id);
                    $('#row_id').val(row_id);
                    $('#country_id').val(country_id);
                    $('#state_id').val(state_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('districts.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": districts_id
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#edit_country_id').val(response.data.country_id);
                                $('#edit_state_id').val(response.data.state_id);                                              
                                $('#edit_district_name').val(response.data.district_name);                                              
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });

                $('#edit_districts_form').submit(function(event) {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 

                    $.ajax({
                        url: "{{ route('districts.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#EditModal').modal('hide');
                                $('#edit_districts_form')[0].reset();
                                swal("Success!", "District updated successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#districts-datatable').DataTable();
                                var row = table.row('#row' + response.data.id); 

                                row.data([
                                    rowId, 
                                    response.data.country_name, 
                                    response.data.state_name, 
                                    response.data.district_name, 
                                    '<i class="fa fa-edit edit_districts" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                    '<i class="fa fa-trash delete_districts" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
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

                $(document).on('click', '.delete_districts', function() {
                    var districtsId = $(this).data('id');
                    var rowSelector = '#row' + districtsId; 

                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('districts.destroy') }}", 
                                method: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}", 
                                    "id": districtsId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        var table = $('#districts-datatable').DataTable();
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
             $(document).on("change", "#country_id", function() {
                var country_id=$(this).val();
                $('#state_id').prop('disabled', true).html('<option value="">Loading...</option>');
                if (country_id) 
                {
                    $.ajax({
                        url: "{{ route('countries.getStates') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "country_id": country_id
                        },
                        success: function(response) 
                        {
                            $('#state_id').prop('disabled', false).html('<option value="">Select One</option>');
                            if (response.success) 
                            {
                                $.each(response.states, function(index, state) {
                                    $('#state_id').append('<option value="' +state.id+'">'+state.state_name+'</option>');
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
                    $('#state_id').html('<option value="">Select One</option>').prop('disabled', true);
                }
            });
            $(document).on("change", "#edit_country_id", function() {
                var country_id=$(this).val();
                $('#edit_state_id').prop('disabled', true).html('<option value="">Loading...</option>');
                if (country_id) 
                {
                    $.ajax({
                        url: "{{ route('countries.getStates') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "country_id": country_id
                        },
                        success: function(response) 
                        {
                            $('#edit_state_id').prop('disabled', false).html('<option value="">Select One</option>');
                            if (response.success) 
                            {
                                $.each(response.states, function(index, state) {
                                    $('#edit_state_id').append('<option value="' +state.id+'">'+state.state_name+'</option>');
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
                    $('#edit_state_id').html('<option value="">Select One</option>').prop('disabled', true);
                }
            });
        </script>
    @endpush    
</x-admin1-layout>