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
                            <table id="mytasks-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Task</th>                                    
                                        <th>Work Time</th>                                    
                                        <th>Staff</th>                                    
                                        <th>Task Status</th> 
                                        <th>Task Status Date</th> 
                                        <th>View Details</th> 
                                        <th>Added By</th>                                    
                                        <th>Added Date</th>                                    
                                        <th>Edited By</th>                                    
                                        <th>Edited Date</th>                                     
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($mytasks as $mytask)
                                    @php $addedby = $mytask->addedByUser->name ?? ''; @endphp
                                    @php $added_date = \Carbon\Carbon::parse($mytask->added_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') ; @endphp
                                    @php $editedby = $mytask->editedByUser->name ?? ''; @endphp
                                    @php $edited_date = $mytask->edited_date ? \Carbon\Carbon::parse($mytask->edited_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') : ''; @endphp
                                    @php $task_status_date = $mytask->status->added_date ? \Carbon\Carbon::parse($mytask->status->added_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') : ''; @endphp
                                        <tr id="row{{ $mytask->id }}">
                                            <td>{{ $i }}</td>  
                                            <td>{{ $mytask->task->task ?? 'N/A'}}</td>  
                                            <td>{{ $mytask->worktime->worktime ?? 'N/A'}}</td> 
                                            <td>{{ $mytask->user->user_id ?? 'N/A'}}</td>                             
                                            <td>{{ $mytask->status->status ?? 'N/A'}}</td>                                          
                                            <td>{{ $task_status_date ?? 'N/A'}}</td>                                                                                                         
                                            <td><a href="{{route('mytasktrans',$mytask->id)}}">View Details</a></td> 
                                            <td>{{ $addedby}}</td>
                                            <td>{{ $added_date}}</td>                                           
                                            <td>{{ $editedby ?? ' '}}</td> 
                                            <td>{{ $edited_date ?? ' '}}</td>                                            
                                            <td>
                                                <i class="fa fa-edit edit_mytasks"
                                                    data-id="{{ $mytask->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>
                                                    <i class="fa fa-trash delete_mytasks"
                                                    data-id="{{ $mytask->id }}">
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
                    <h5 class="modal-title">Create My Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_mytasks_form" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="task">Task</label>
                            <select name="task_id" id="task_id" class="form-control" required>
                                @foreach ($task as $tas)
                                    <option value="{{ $tas->id }}">{{ $tas->task }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="worktime">Work Time</label>
                            <select name="worktime_id" id="worktime_id" class="form-control" required>
                                @foreach ($worktime as $work)
                                    <option value="{{ $work->id }}">{{ $work->worktime }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="user">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($user as $use)
                                    <option value="{{ $use->id }}">{{ $use->user_id }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="task_status">Task Status</label>
                            <select name="task_status_id" id="task_status_id" class="form-control" required>
                                @foreach ($status as $sta)
                                    <option value="{{ $sta->id }}">{{ $sta->status }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="task_status_date">Task Status Date</label>                           
                            <input type="text" id="task_status_date" name="task_status_date" class="form-control" readonly>
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
                    <h5 class="modal-title">Edit My Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_mytasks_form" class="form">
                        @csrf                       

                        <input type="hidden" name="rowid" id="row_id">
                            <input type="hidden" name="id" id="mytasks_id">
                            <div class="form-group">
                            <label for="task">Task</label>
                            <select name="task_id" id="edit_task_id" class="form-control" required>
                                @foreach ($task as $tas)
                                    <option value="{{ $tas->id }}">{{ $tas->task }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="worktime">Work Time</label>
                            <select name="worktime_id" id="edit_worktime_id" class="form-control" required>
                                @foreach ($worktime as $work)
                                    <option value="{{ $work->id }}">{{ $work->worktime }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="user">User</label>
                            <select name="user_id" id="edit_user_id" class="form-control" required>
                                @foreach ($user as $use)
                                    <option value="{{ $use->id }}">{{ $use->user_id }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="task_status">Task Status</label>
                            <select name="task_status_id" id="edit_task_status_id" class="form-control" required>
                                @foreach ($status as $sta)
                                    <option value="{{ $sta->id }}">{{ $sta->status }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">                                
                            <div class="mb-3">
                                <label for="edit_task_status_date" class="form-label">Task Status Date</label>
                                <input type="text" class="form-control" id="edit_task_status_date" name="task_status_date">
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
                $('#mytasks-datatable').DataTable();
                $('#create_mytasks_form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData($(this)[0]);  
                    $.ajax({
                        url: "{{ route('mytasks.store') }}", 
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#CreateModal').modal('hide');  
                                $('#create_mytasks_form')[0].reset(); 
                                swal("Success!", "My Task added successfully!", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#mytasks-datatable').DataTable();
                                var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 0;

                                var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';                                
                                var task_status_date = response.data.status && response.data.status.added_date 
                                    ? new Date(response.data.status.added_date).toLocaleString('en-GB', { hour12: true }) 
                                    : '';

                                var newRow = table.row.add([
                                    lastRowNumber ,
                                    response.data.task,
                                    response.data.worktime,
                                    response.data.user_id,
                                    response.data.status?? ' ',
                                    response.data.status ? response.data.status.added_date : ' ',                                   
                                    response.data.addedby,
                                    formattedAddedDate,
                                    response.data.editedby ?? ' ',
                                    formattedEditedDate ?? ' ',
                                    '<i class="fa fa-edit edit_mytasks" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>'+
                                    '<i class="fa fa-trash delete_mytasks" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '"></i>'
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

                $(document).on("click", ".edit_mytasks", function() {
                    var mytasks_id = $(this).data('id');
                    var row_id = $(this).data('rowid');
                    var task_id = $(this).data('task_id');
                    var task_status_id = $(this).data('task_status_id');
                    var user_id = $(this).data('user_id');
                    var worktime_id = $(this).data('worktime_id');

                    $('#mytasks_id').val(mytasks_id);
                    $('#row_id').val(row_id);
                    $('#task_id').val(task_id);
                    $('#task_status_id').val(task_status_id);
                    $('#user_id').val(user_id);
                    $('#worktime_id').val(worktime_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('mytasks.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": mytasks_id
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#edit_task_id').val(response.data.task_id);
                                $('#edit_task_status_id').val(response.data.task_status_id);
                                $('#edit_task_status_date').val(response.data.task_status_date);
                                $('#edit_user_id').val(response.data.user_id);                                              
                                $('#edit_worktime_id').val(response.data.worktime_id);                                                                                          
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });

                $('#edit_mytasks_form').submit(function(event) {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 

                    $.ajax({
                        url: "{{ route('mytasks.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#EditModal').modal('hide');
                                $('#edit_mytasks_form')[0].reset();
                                swal("Success!", "My Task updated successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#mytasks-datatable').DataTable();
                                var row = table.row('#row' + response.data.id); 

                                var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';

                                row.data([
                                    rowId, 
                                    response.data.task,
                                    response.data.worktime,
                                    response.data.user_id,
                                    response.data.status.status ?? ' ',
                                    response.data.status ? response.data.status.added_date : ' ',                                   
                                    response.data.addedby,                                   
                                    formattedAddedDate,
                                    response.data.editedby,
                                    formattedEditedDate, 
                                    '<i class="fa fa-edit edit_mytasks" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                    '<i class="fa fa-trash delete_mytasks" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
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

                $('#task_status_id').change(function() {
                    var task_status_id = $(this).val();

                    if (task_status_id) {
                        $.ajax({
                            url: "{{ route('get.task.date') }}", 
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                task_status_id: task_status_id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    $('#task_status_date').val(response.task_status_date);
                                } else {
                                    $('#task_status_date').val('');
                                    alert(response.message);
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        $('#task_status_date').val('');
                    }
            });

            $(document).on("change", "#edit_task_status_id", function () {
                var task_status_id = $(this).val();

                if (task_status_id) {
                    $.ajax({
                        url: "{{ route('get.task.date') }}", 
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            task_status_id: task_status_id
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                $('#edit_task_status_date').val(response.task_status_date);
                            } else {
                                $('#edit_task_status_date').val('');
                                alert(response.message);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#edit_task_status_date').val('');
                }
            });

            $(document).on('click', '.delete_mytasks', function() {
                var mytasksId = $(this).data('id');
                var rowSelector = '#row' + mytasksId; 

                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('mytasks.destroy') }}", 
                            method: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}", 
                                 "id": mytasksId
                            },
                            success: function(response) {
                                if (response.success) {
                                    var table = $('#mytasks-datatable').DataTable();
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
    @endpush    
</x-admin1-layout>