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
                            <table id="mytasktrans-datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Task Date</th>                                    
                                        <th>Work Time</th>                                    
                                        <th>Chapter</th> 
                                        <th>Remarks</th> 
                                        <th>Status</th> 
                                        <th>Added By</th>                                    
                                        <th>Added Date</th>                                    
                                        <th>Edited By</th>                                    
                                        <th>Edited Date</th>                                     
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($mytasktrans as $mytasktran)
                                    @php $addedby = $mytasktran->addedByUser->name ?? ''; @endphp
                                    @php $added_date = \Carbon\Carbon::parse($mytasktran->added_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') ; @endphp
                                    @php $editedby = $mytasktran->editedByUser->name ?? ''; @endphp
                                    @php $edited_date = $mytasktran->edited_date ? \Carbon\Carbon::parse($mytasktran->edited_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') : ''; @endphp                                   
                                        <tr id="row{{ $mytasktran->id }}">
                                            <td>{{ $i }}</td>  
                                            <td>{{ $mytasktran->mytask->task->added_date ?? 'N/A'}}</td>
                                            <td>{{ $mytasktran->worktime->worktime ?? 'N/A'}}</td> 
                                            <td>{{ $mytasktran->chapter->chapter_name ?? 'N/A'}}</td> 
                                            <td>{{ $mytasktran->remarks ?? 'N/A'}}</td> 
                                            <td>{{ $mytasktran->mytask->status->status ?? 'N/A'}}</td>
                                            <td>{{ $addedby}}</td>
                                            <td>{{ $added_date}}</td>                                           
                                            <td>{{ $editedby ?? ' '}}</td> 
                                            <td>{{ $edited_date ?? ' '}}</td>                                            
                                            <td>
                                                <i class="fa fa-edit edit_mytasktrans"
                                                    data-id="{{ $mytasktran->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>
                                                    <i class="fa fa-trash delete_mytasktrans"
                                                    data-id="{{ $mytasktran->id }}">
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
                    <h5 class="modal-title">Create My Task Trans</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create_mytasktrans_form" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="row form-group">
                            <input type="hidden" name="mytask_id" value="{{$mytask_id}}">
                            <div class="col-6">
                                <label for="task_date">Task Date</label>                           
                                <input type="date" id="task_date" name="task_date" class="form-control" value="{{date('Y-m-d')}}">
                            </div> 
                            <div class="col-6">
                                <label for="worktime">Work Time</label>
                                <select name="worktime_id" id="worktime_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($worktime as $work)
                                        <option value="{{ $work->id }}">{{ $work->worktime }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div> 
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="chapter">Chapter</label>
                                <select name="chapter_id" id="chapter_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach ($chapter as $chapt)
                                        <option value="{{ $chapt->id }}">{{ $chapt->chapter_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="remarks">Remark</label>
                                <textarea name="remarks" id="remarks" class="form-control"></textarea>
                            </div> 
                        </div>  
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="sub_task_status_id">Task Status</label>     
                                <select name="sub_task_status_id" id="sub_task_status_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->status}}</option>
                                    @endforeach
                                </select>                      
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit My Task Trans</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_mytasktrans_form" class="form">
                        @csrf                       

                        <input type="hidden" name="rowid" id="row_id">
                            <input type="hidden" name="id" id="mytasktrans_id">
                            <div class="form-group">
                            <label for="task">Task</label>
                            <select name="mytask_id" id="edit_mytask_id" class="form-control" required>
                                @foreach ($mytask as $tas)
                                    <option value="{{ $tas->id }}">{{ $tas->task->task }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="task_date">Task Date</label>                           
                            <input type="text" id="edit_task_date" name="task_date" class="form-control" readonly>
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
                            <label for="chapter">Chapter</label>
                            <select name="chapter_id" id="edit_chapter_id" class="form-control" required>
                                @foreach ($chapter as $chapt)
                                    <option value="{{ $chapt->id }}">{{ $chapt->chapter }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="form-group">
                            <label for="remarks">Remark</label>
                            <input type="text" name="remarks" id="edit_remarks" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="sub_task_status_id">Task Status</label>                           
                            <input type="text" id="edit_sub_task_status_id" name="sub_task_status_id" class="form-control" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="user">User</label>
                            <select name="user_id" id="edit_user_id" class="form-control" required>
                                @foreach ($user as $use)
                                    <option value="{{ $use->id }}">{{ $use->user_id }}</option>
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
                $('#mytasktrans-datatable').DataTable();
                $('#create_mytasktrans_form').submit(function(event) {
                    event.preventDefault();
                    var formData = new FormData($(this)[0]);  
                    $.ajax({
                        url: "{{ route('mytasktrans.store') }}", 
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#CreateModal').modal('hide');  
                                $('#create_mytasktrans_form')[0].reset(); 
                                swal("Success!", "My Task added successfully!", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#mytasktrans-datatable').DataTable();
                                var lastRowNumber = table.data().count() > 0 ? parseInt(table.row(':last').data()[0]) + 1 : 0;

                                var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';                                

                                var newRow = table.row.add([
                                    lastRowNumber ,
                                    response.data.task_date,
                                    response.data.worktime,
                                    response.data.chapter_name || '',
                                    response.data.remarks,
                                    response.data.status,
                                    response.data.addedby,
                                    formattedAddedDate,
                                    response.data.editedby || ' ',
                                    formattedEditedDate || ' ',
                                    '<i class="fa fa-edit edit_mytasktrans" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>'+
                                    '<i class="fa fa-trash delete_mytasktrans" data-rowid="'+ lastRowNumber +'" data-id="' + response.data.id + '"></i>'
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

                $(document).on("click", ".edit_mytasktrans", function() {
                    var mytasktrans_id = $(this).data('id');
                    var row_id = $(this).data('rowid');
                    var task_id = $(this).data('task_id');
                    var sub_task_status_id = $(this).data('sub_task_status_id');
                    var mytask_id = $(this).data('mytask_id');
                    var worktime_id = $(this).data('worktime_id');
                    var chapter_id = $(this).data('chapter_id');
                    var user_id = $(this).data('user_id');

                    $('#mytasktrans_id').val(mytasktrans_id);
                    $('#row_id').val(row_id);
                    $('#task_id').val(task_id);
                    $('#sub_task_status_id').val(sub_task_status_id);
                    $('#mytask_id').val(mytask_id);
                    $('#chapter_id').val(chapter_id);
                    $('#user_id').val(user_id);
                    $('#worktime_id').val(worktime_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('mytasktrans.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": mytasktrans_id
                        },
                        success: function(response) {
                            if (response.success) {
                                
                                $('#edit_mytask_id').val(response.data.mytask_id);
                                $('#edit_task_date').val(response.data.task_date);
                                $('#edit_worktime_id').val(response.data.worktime_id);
                                $('#edit_chapter_id').val(response.data.chapter_id);                                              
                                $('#edit_remarks').val(response.data.remarks);                                                                                          
                                $('#edit_sub_task_status_id').val(response.data.status);                                                                                          
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });

                $('#edit_mytasktrans_form').submit(function(event) {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 

                    $.ajax({
                        url: "{{ route('mytasktrans.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#EditModal').modal('hide');
                                $('#edit_mytasktrans_form')[0].reset();
                                swal("Success!", "My Task Trans updated successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });

                                var table = $('#mytasktrans-datatable').DataTable();
                                var row = table.row('#row' + response.data.id); 

                                var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';

                                row.data([
                                    rowId, 
                                    response.data.mytask.task,
                                    response.data.mytask.added_date,
                                    response.data.worktime,
                                    response.data.chapter,
                                    response.data.remarks,
                                    response.data.status.status,
                                    response.data.user_id,                                    
                                    response.data.addedby,                                   
                                    formattedAddedDate,
                                    response.data.editedby,
                                    formattedEditedDate, 
                                    '<i class="fa fa-edit edit_mytasktrans" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                    '<i class="fa fa-trash delete_mytasktrans" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
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


                function fetchTaskDetails(selector) {
                    var mytaskId = $(selector).val();

                    if (mytaskId) {
                        $.ajax({
                            url: "{{ route('get.task.details') }}", 
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                mytask_id: mytaskId
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    var formattedDate = response.task_date ? new Date(response.task_date).toLocaleString('en-GB', { 
                                        day: '2-digit', month: '2-digit', year: 'numeric', 
                                        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true 
                                    }) : '';
                                   
                                    $(selector === '#mytask_id' ? '#task_date' : '#edit_task_date').val(formattedDate);
                                    $(selector === '#mytask_id' ? '#sub_task_status_id' : '#edit_sub_task_status_id').val(response.task_status);
                                } else {
                                    $(selector === '#mytask_id' ? '#task_date' : '#edit_task_date').val('');
                                    $(selector === '#mytask_id' ? '#sub_task_status_id' : '#edit_sub_task_status_id').val('');
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    } else {
                        $(selector === '#mytask_id' ? '#task_date' : '#edit_task_date').val('');
                        $(selector === '#mytask_id' ? '#sub_task_status_id' : '#edit_sub_task_status_id').val('');
                    }
                }


                $('#mytask_id, #edit_mytask_id').change(function() {
                    fetchTaskDetails('#' + $(this).attr('id'));
                });


                $('#editTaskModal').on('show.bs.modal', function() {
                    fetchTaskDetails('#edit_mytask_id');
                });


                $(document).on('click', '.delete_mytasktrans', function() {
                    var mytasktransId = $(this).data('id');
                    var rowSelector = '#row' + mytasktransId; 

                    swal({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('mytasktrans.destroy') }}", 
                                method: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}", 
                                    "id": mytasktransId
                                },
                                success: function(response) {
                                    if (response.success) {
                                        var table = $('#mytasktrans-datatable').DataTable();
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