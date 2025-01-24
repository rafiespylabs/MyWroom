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
                            <table id="cities-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Country</th>                                    
                                        <th>State</th>                                    
                                        <th>District</th>                                    
                                        <th>City</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($cities as $city)
                                        <tr id="row{{ $city->id }}">
                                            <td>{{ $i }}</td>  
                                            <td>{{ $city->country->country_name ?? 'N/A'}}</td>                                          
                                            <td>{{ $city->state->state_name ?? 'N/A'}}</td>                                          
                                            <td>{{ $city->district->district_name ?? 'N/A'}}</td>                                          
                                            <td>{{ $city->city_name }}</td>                                        
                                            <td>
                                                <i class="fa fa-edit edit_cities"
                                                    data-id="{{ $city->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>
                                                    <i class="fa fa-trash delete_cities"
                                                    data-id="{{ $city->id }}">
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
                    <h5 class="modal-title">Create City</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_cities_form" class="form">
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
                                <!-- @foreach ($state as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->state_name }}</option>
                                @endforeach -->
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="district">District</label>
                            <select name="district_id" id="district_id" class="form-control" required>
                                <option value="">Select One</option>
                                <!-- @foreach ($district as $dis)
                                    <option value="{{ $dis->id }}">{{ $dis->district_name }}</option>
                                @endforeach -->
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="city_name">City</label>
                            <input type="text" name="city_name" id="city_name" class="form-control" required>
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
                    <h5 class="modal-title">Edit City</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_cities_form" class="form">
                        @csrf
                        

                        <input type="hidden" name="rowid" id="row_id">
                            <input type="hidden" name="id" id="cities_id">
                            <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country_id" id="edit_country_id" class="form-control" required>
                                @foreach ($country as $count)
                                    <option value="{{ $count->id }}">{{ $count->country_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <label for="state">State</label>
                            <select name="state_id" id="edit_state_id" class="form-control" required>
                                @foreach ($state as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->state_name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="district">District</label>
                            <select name="district_id" id="edit_district_id" class="form-control" required>
                                @foreach ($district as $dis)
                                    <option value="{{ $dis->id }}">{{ $dis->district_name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="city_name">City</label>
                            <input type="text" name="city_name" id="edit_city_name" class="form-control" required>
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
                $('#cities-datatable').DataTable();
                $('#create_cities_form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData($(this)[0]);  
                    $.ajax({
                        url: "{{ route('cities.store') }}", 
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#CreateModal').modal('hide');  
                                $('#create_cities_form')[0].reset(); 
                                swal("Success!", "City added successfully!", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#cities-datatable').DataTable();
                                var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 0;
                                var newRow = table.row.add([
                                    lastRowNumber,
                                    response.data.country_name,
                                    response.data.state_name,
                                    response.data.district_name,
                                    response.data.city_name,
                                    '<i class="fa fa-edit edit_cities" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>'+
                                    '<i class="fa fa-trash delete_cities" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '"></i>'
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

                $(document).on("click", ".edit_cities", function() {
                    var cities_id = $(this).data('id');
                    var row_id = $(this).data('rowid');
                    var country_id = $(this).data('country_id');
                    var state_id = $(this).data('state_id');
                    var district_id = $(this).data('district_id');

                    $('#cities_id').val(cities_id);
                    $('#row_id').val(row_id);
                    $('#country_id').val(country_id);
                    $('#state_id').val(state_id);
                    $('#district_id').val(district_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('cities.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": cities_id
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#edit_country_id').val(response.data.country_id);
                                $('#edit_state_id').val(response.data.state_id);                                              
                                $('#edit_district_id').val(response.data.district_id);                                              
                                $('#edit_city_name').val(response.data.city_name);                                              
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });

                $('#edit_cities_form').submit(function(event) {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 

                    $.ajax({
                        url: "{{ route('cities.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#EditModal').modal('hide');
                                $('#edit_cities_form')[0].reset();
                                swal("Success!", "City updated successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#cities-datatable').DataTable();
                                var row = table.row('#row' + response.data.id); 

                                row.data([
                                    rowId, 
                                    response.data.country_name, 
                                    response.data.state_name, 
                                    response.data.district_name, 
                                    response.data.city_name, 
                                    '<i class="fa fa-edit edit_cities" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                    '<i class="fa fa-trash delete_cities" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
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

                $(document).on('click', '.delete_cities', function() {
                    var citiesId = $(this).data('id');
                    var rowSelector = '#row' + citiesId; 

                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('cities.destroy') }}", 
                                method: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}", 
                                    "id": citiesId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        var table = $('#cities-datatable').DataTable();
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
            $(document).on("change", "#state_id", function() {
                var state_id=$(this).val();
                $('#district_id').prop('disabled', true).html('<option value="">Loading...</option>');
                if (state_id) 
                {
                    $.ajax({
                        url: "{{ route('states.getDistricts') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "state_id": state_id
                        },
                        success: function(response) 
                        {
                            $('#district_id').prop('disabled', false).html('<option value="">Select One</option>');
                            if (response.success) 
                            {
                                $.each(response.districts, function(index, dist) {
                                    $('#district_id').append('<option value="' +dist.id+'">'+dist.district_name+'</option>');
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
                    $('#district_id').html('<option value="">Select One</option>').prop('disabled', true);
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
            $(document).on("change", "#edit_state_id", function() {
                var state_id=$(this).val();
                $('#edit_district_id').prop('disabled', true).html('<option value="">Loading...</option>');
                if (state_id) 
                {
                    $.ajax({
                        url: "{{ route('states.getDistricts') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "state_id": state_id
                        },
                        success: function(response) 
                        {
                            $('#edit_district_id').prop('disabled', false).html('<option value="">Select One</option>');
                            if (response.success) 
                            {
                                $.each(response.districts, function(index, dist) {
                                    $('#edit_district_id').append('<option value="' +dist.id+'">'+dist.district_name+'</option>');
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
                    $('#edit_district_id').html('<option value="">Select One</option>').prop('disabled', true);
                }
            });
        </script>
    @endpush    
</x-admin1-layout>