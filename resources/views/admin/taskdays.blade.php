<x-admin1-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">     
    @endpush

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Task Day</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#CreateModal">
                                <i class="fa fa-plus"></i> Create
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="preloader" style="display:none;">
                            <img src="{{ asset('web/preloader.gif') }}">
                        </div>
                        <div class="table-responsive">
                            <table id="taskdays-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Task</th>                                                    
                                        <th>Worktime</th>                                                                                                            
                                        <th>Added By</th>                                    
                                        <th>Added Date</th>                                    
                                        <th>Edited By</th>                                    
                                        <th>Edited Date</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="taskdays">
                               
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_taskdays_form" class="form" enctype="multipart/form-data">
                        @csrf    
                        @if($task_id)   
                        <input type="hidden" name="task_id" value="{{$task_id}}">
                        @else                      
                        <div class="form-group mb-3">
                            <label for="task_id">Task</label>
                            <select name="task_id" id="add_task_id" class="form-control" required>
                                <option value="">Select Task</option>
                                @foreach($tasks as $task)
                                <option value="{{$task->id}}">{{$task->task}}</option>
                                @endforeach
                            </select>
                        </div> 
                        @endif
                        <div class="form-group mb-3">
                            <label for="worktime_id">Worktime</label>
                            <select name="worktime_id" id="add_worktime_id" class="form-control" required>
                                <option value="">Select Worktime</option>
                                @foreach($worktimes as $worktime)
                                <option value="{{$worktime->id}}">{{$worktime->worktime}}</option>
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
    <!-- End Create Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_taskdays_form" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="rowid" id="row_id">
                        <input type="hidden" name="id" id="taskdays_id">  
                        @if($task_id)   
                        <input type="hidden" name="task_id" value="{{$task_id}}">
                        @else                       
                        <div class="form-group mb-3">
                            <label for="task_id">Task</label>
                            <select name="task_id" id="edit_task_id" class="form-control" required>
                                <option value="">Select Task</option>
                            </select>
                        </div> 
                        @endif
                        <div class="form-group mb-3">
                            <label for="worktime_id">Worktime</label>
                            <select name="worktime_id" id="edit_worktime_id" class="form-control" required>
                                <option value="">Select Worktime</option>
                            </select>
                        </div>    
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#taskdays-datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            ajax: {
                url: "{{ route('taskdays.list') }}",
                type: "POST",
                data: function (d) {
                    d._token = "{{ csrf_token() }}",
                    d.task_id="{{$task_id}}"  
                }
            },
            columns: [
                { 
                    data: null, 
                    name: "sl_no", 
                    orderable: false, 
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1 + meta.settings._iDisplayStart; 
                    }
                },
                { data: "task", name: "task" },
                { data: "worktime", name: "worktime" },
                { data: "added_by", name: "added_by" },
                { data: "added_date", name: "added_date" },
                { data: "edited_by", name: "edited_by" },
                { data: "edited_date", name: "edited_date" },
                { 
                    data: "action", 
                    name: "action", 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        return data ? data : 'No Actions';
                    }
                }
            ],
            rowCallback: function(row, data, index) {
                $(row).attr('id', 'row' + data.id);
            }
        });    
        
            
        $('#create_taskdays_form').submit(function(event)
        {
                event.preventDefault();
                var formData = new FormData($(this)[0]); 
                $.ajax({
                    url: "{{route('taskdays.store')}}",
                    method: "POST",
                    data: formData,
                    contentType: false, 
                    processData: false,
                    success: function(response) {
                        if (response.success) 
                        {
                            $('#CreateModal').modal('hide');
                            $('#create_taskdays_form')[0].reset();
                            swal("Good job!", response.message, {
                                icon: "success",
                                buttons: {
                                    confirm: {
                                    className: "btn btn-success",
                                    },
                                },
                            });
                            var table = $('#taskdays-datatable').DataTable();
                            var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 1;

                            var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                            var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';

                            var newRow = table.row.add([
                                lastRowNumber,
                                        response.data.task || ' ',
                                        response.data.worktime || ' ',
                                        response.data.added_by,
                                        formattedAddedDate,
                                        response.data.edited_by || ' ',
                                        formattedEditedDate || ' ',                                    
                                ]).draw(false);
                                table.page('first').draw(false);  
                                $(newRow.node()).attr('id', 'row' + response.data.id);  
                                } 
                                else 
                                {
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
            
        });
    </script>
    <script>  

    function edittaskdays(taskdaysId) {
        var url = "{{ route('taskdays.edit', ':id') }}"; 
        url = url.replace(':id', taskdaysId);

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {         
                if (response) {                   
                    $('#taskdays_id').val(response.taskdays.id);                 

                    var taskSelect = $('#edit_task_id');
                    taskSelect.empty(); 
                    taskSelect.append('<option value="">Select Task</option>');

                    $.each(response.task, function(index, task) {
                        var selected = (task.id == response.taskdays.task_id) ? "selected" : "";
                        taskSelect.append('<option value="'+task.id+'" '+selected+'>'+task.task+'</option>');
                    });
                   
                    var worktimeSelect = $('#edit_worktime_id');
                    worktimeSelect.empty(); 
                    worktimeSelect.append('<option value="">Select Worktime</option>');

                    $.each(response.worktime, function(index, worktime) {
                        var selected = (worktime.id == response.taskdays.worktime_id) ? "selected" : "";
                        worktimeSelect.append('<option value="'+worktime.id+'" '+selected+'>'+worktime.worktime+'</option>');
                    });

                    $('#EditModal').modal('show');
                } else {
                    alert("Error: No data received.");
                }
            },
            error: function(xhr) {
                console.error("Error fetching task day:", xhr.responseText);
                alert("Error fetching task day details.");
            }
        });
    }


    $('#update_taskdays_form').submit(function(event) {
        event.preventDefault();
    
        var taskdaysId = $('#taskdays_id').val();
        var url = "{{ route('taskdays.update', ':id') }}";
        url = url.replace(':id', taskdaysId);
        var update_task_id=';';
        var task_id="{{$task_id}}" ;
        if(task_id)
        {
            update_task_id=task_id;
        }
        else{
            update_task_id=$('#edit_task_id').val();
        }
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                task_id: update_task_id,
                worktime_id: $('#edit_worktime_id').val(),               
            },

            success: function(response) {
                if (response.success) {
                    $('#EditModal').modal('hide');
                    $('#create_taskdays_form')[0].reset();
        
                    swal("Good job!", response.message, {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    }).then(() => {
                        location.reload(); 
                    });
                } else {
                    swal("Oops!", response.message, {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: "btn btn-danger",
                            },
                        },
                    });
                }
            },

        });
    });


    $.ajax({
        url: "{{ route('tasks.getlist') }}",
        type: "GET",
        success: function(response) {
            if (response.length > 0) {
                $('#add_task_id').html('<option value="">Select Task</option>');
                $.each(response, function(index, task) {
                    $('#add_task_id').append('<option value="'+task.id+'">'+task.task+'</option>');
                });
            } else {
                $('#add_task_id').html('<option value="">No Task Found</option>');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching task:", error);
        }
    });


    $.ajax({
        url: "{{ route('worktimes.getlist') }}",
        type: "GET",
        success: function(response) {
            if (response.length > 0) {
                $('#add_worktime_id').html('<option value="">Select Worktime</option>');
                $.each(response, function(index, worktime) {
                    $('#add_worktime_id').append('<option value="'+worktime.id+'">'+worktime.worktime+'</option>');
                });
            } else {
                $('#add_worktime_id').html('<option value="">No Worktime Found</option>');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching worktime:", error);
        }
    });

    
    function deletetaskdays(taskdaysId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    visible: true,
                    className: "btn btn-secondary",
                },
                confirm: {
                    text: "Yes, Delete it!",
                    className: "btn btn-danger",
                },
            },
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/taskdays/' + taskdaysId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        swal("Deleted!", response.success, {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        }).then(() => {
                            location.reload(); 
                        });
                    },
                    error: function(response) {
                        swal("Oops!", response.responseJSON.error, {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: "btn btn-danger",
                                },
                            },
                        });
                    }
                });
            }
        });
    }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ajax-bootstrap-select@1.4.4/dist/js/ajax-bootstrap-select.min.js"></script>
    @endpush
</x-admin1-layout>