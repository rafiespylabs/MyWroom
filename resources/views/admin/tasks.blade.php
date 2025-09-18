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
                            <table id="tasks-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Task</th>                                    
                                        <th>Department</th>                                    
                                        <th>Staff</th>                                    
                                        <th>Task Days</th>
                                        <th>Added By</th>                                    
                                        <th>Added Date</th>                                    
                                        <th>Edited By</th>                                    
                                        <th>Edited Date</th>                                     
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($tasks as $task)
                                    @php $addedby = $task->addedByUser->name ?? ''; @endphp
                                    @php $added_date = \Carbon\Carbon::parse($task->added_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') ; @endphp
                                    @php $editedby = $task->editedByUser->name ?? ''; @endphp
                                    @php $edited_date = $task->edited_date ? \Carbon\Carbon::parse($task->edited_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') : ''; @endphp
                                        <tr id="row{{ $task->id }}">
                                            <td>{{ $i }}</td>  
                                            <td>{{ $task->task }}</td>                               
                                            <td>{{ $task->department->department ?? 'N/A'}}</td>                                          
                                            <td>{{ $task->staff->name ?? 'N/A'}}</td>                                          
                                            <td><a href="{{route('taskdays',$task->id)}}">Task Days</a></td> 
                                            <td>{{ $addedby}}</td>
                                            <td>{{ $added_date}}</td>                                           
                                            <td>{{ $editedby ?? ' '}}</td> 
                                            <td>{{ $edited_date ?? ' '}}</td>                                            
                                            <td>
                                                <i class="fa fa-edit edit_tasks"
                                                    data-id="{{ $task->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>
                                                    <i class="fa fa-trash delete_tasks"
                                                    data-id="{{ $task->id }}">
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
                    <h5 class="modal-title">Create Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_tasks_form" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="task">Task</label>
                            <textarea name="task" id="task" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="dep_id" id="dep_id" class="form-control" required>
                                <option value="">Select One </option>
                                @foreach ($department as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->department }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="user">Staff</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">Select One </option>
                                @foreach ($user as $use)
                                    <option value="{{ $use->user->id }}">{{ $use->user->name }}</option>
                                @endforeach
                            </select>
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
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_tasks_form" class="form">
                        @csrf
                        

                        <input type="hidden" name="rowid" id="row_id">
                            <input type="hidden" name="id" id="tasks_id">
                            <div class="form-group">
                            <label for="task">Task</label>
                            <textarea  name="task" id="edit_task" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="dep_id" id="edit_dep_id" class="form-control" required>
                                <option value="">Select One </option>
                                @foreach ($department as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->department }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="user">Staff</label>
                            <select name="user_id" id="edit_user_id" class="form-control" required>
                                <option value="">Select One </option>
                                @foreach ($user as $use)
                                    <option value="{{ $use->user->id }}">{{ $use->user->name }}</option>
                                @endforeach
                            </select>
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
                $('#tasks-datatable').DataTable();
                $('#create_tasks_form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData($(this)[0]);  
                    $.ajax({
                        url: "{{ route('tasks.store') }}", 
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#CreateModal').modal('hide');  
                                $('#create_tasks_form')[0].reset(); 
                                swal("Success!", "Task added successfully!", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#tasks-datatable').DataTable();
                                var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 1;

                                var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';
                                var taskdays='<a href="/taskdays/'+response.data.id+'">Task Days</a>';
                                var newRow = table.row.add([
                                    lastRowNumber,
                                    response.data.task,
                                    response.data.department,
                                    response.data.staff_name,
                                    taskdays,
                                    response.data.added_user,
                                    formattedAddedDate,
                                    response.data.editedby,
                                    formattedEditedDate,
                                    '<i class="fa fa-edit edit_tasks" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>'+
                                    '<i class="fa fa-trash delete_tasks" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '"></i>'
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

                $(document).on("click", ".edit_tasks", function() {
                    var tasks_id = $(this).data('id');
                    var row_id = $(this).data('rowid');
                    var dep_id = $(this).data('dep_id');
                    var user_id = $(this).data('user_id');

                    $('#tasks_id').val(tasks_id);
                    $('#row_id').val(row_id);
                    $('#dep_id').val(dep_id);
                    $('#user_id').val(user_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('tasks.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": tasks_id
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#edit_dep_id').val(response.data.dep_id);
                                $('#edit_user_id').val(response.data.user_id);                                              
                                $('#edit_task').val(response.data.task);                                              
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });

                $('#edit_tasks_form').submit(function(event) {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 

                    $.ajax({
                        url: "{{ route('tasks.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#EditModal').modal('hide');
                                $('#edit_tasks_form')[0].reset();
                                swal("Success!", "Task updated successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#tasks-datatable').DataTable();
                                var row = table.row('#row' + response.data.id); 

                                var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';
                                var taskdays='<a href="/taskdays/'+response.data.id+'">Task Days</a>';
                                row.data([
                                    rowId, 
                                    response.data.task,
                                    response.data.department,
                                    response.data.staff_name,
                                    taskdays,
                                    response.data.added_user,
                                    formattedAddedDate,
                                    response.data.editedby,
                                    formattedEditedDate, 
                                    '<i class="fa fa-edit edit_tasks" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                    '<i class="fa fa-trash delete_tasks" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
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

                $(document).on('click', '.delete_tasks', function() {
                    var tasksId = $(this).data('id');
                    var rowSelector = '#row' + tasksId; 

                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('tasks.destroy') }}", 
                                method: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}", 
                                    "id": tasksId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        var table = $('#tasks-datatable').DataTable();
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