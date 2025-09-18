<x-admin1-layout>
    <div class="page-inner">
        <div class="page-header"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <a href="#" id="get_my_task" data-href="{{route('staffs.getCurrentDayTask',auth()->user()->id)}}">
                                <button class="btn btn-info btn-round ms-auto" >
                                <i class="fa fa-plus"></i> Open My Task
                                </button>
                            </a>
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
                                        <th>Task Date</th>                 
                                        <th>Task</th>                                    
                                        <th>Work Time</th>                                    
                                        <th>Staff</th>                                    
                                        <th>Task Status</th> 
                                        <th>Task Status Date</th> 
                                        <th>View Details</th> 
                                        <!-- <th>Added By</th>                                    
                                        <th>Added Date</th>                                    
                                        <th>Edited By</th>                                    
                                        <th>Edited Date</th>                                      -->
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
                                    @php $task_status_date = $mytask->task_status_date ? \Carbon\Carbon::parse($mytask->task_status_date)->timezone('Asia/Kolkata')->format('d/m/Y h:i A') : ''; @endphp
                                    @php $role_id=auth()->user()->role_id; @endphp
                                        <tr id="row{{ $mytask->id }}">
                                            <td>{{ $i }}</td>  
                                            <td>{{ $mytask->added_date}}</td>
                                            <td>{{ $mytask->task->task ?? 'N/A'}}</td>  
                                            <td>{{ $mytask->worktime->worktime ?? 'N/A'}}</td> 
                                            <td>{{ $mytask->user->name ?? 'N/A'}}</td>                             
                                            <td><span class="badge badge-primary task_status" data-id="{{$mytask->id}}" data-rowid="{{$i}}" data-bs-toggle="modal"
                                            data-bs-target="#TaskStatusModal">{{ $mytask->status->status ?? 'N/A'}}</span></td>                                          
                                            <td>{{ $task_status_date ?? 'N/A'}}</td>                                                                                                         
                                            <td><a href="{{route('mytasktrans',$mytask->id)}}">View Details</a></td> 
                                            <!-- <td>{{ $addedby}}</td>
                                            <td>{{ $added_date}}</td>                                           
                                            <td>{{ $editedby ?? ''}}</td> 
                                            <td>{{ $edited_date ?? ''}}</td>                                             -->
                                            <td>
                                                @if($role_id==1)
                                                <i class="fa fa-edit edit_mytasks"
                                                    data-id="{{ $mytask->id }}" data-rowid="{{ $i }}" data-bs-toggle="modal"
                                                    data-bs-target="#EditModal"></i>
                                                    <i class="fa fa-trash delete_mytasks"
                                                    data-id="{{ $mytask->id }}">
                                                </i>
                                                @endif
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
    <div class="modal fade" id="TaskStatusModal" tabindex="-1" role="dialog" aria-labelledby="TaskStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Do You Want To Change Your Status?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_task_status_form" class="form">
                        @csrf                       
                        <input type="hidden" name="rowid" id="row_id">
                        <input type="hidden" name="id" id="mytask_id">
                        <div class="form-group">
                            <label for="task_status">Task Status</label>
                            <select name="task_status_id" id="change_task_status_id" class="form-control" required>
                                @foreach ($status as $sta)
                                    <option value="{{ $sta->id }}">{{ $sta->status }}</option>
                                @endforeach
                            </select>
                        </div>          
                        <div class="form-group">                                
                            <div class="mb-3">
                                <label for="edit_comment" class="form-label">Comment</label>
                                <textarea id="edit_comment" class="form-control" name="comment"></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
        <script>
            $(document).ready(function() 
            {
                $('#mytasks-datatable').DataTable();
                $(document).on("click", ".task_status", function() 
                {
                    var mytasks_id = $(this).data('id');
                    var row_id = $(this).data('rowid');
                    $('#mytask_id').val(mytasks_id);
                    $('#row_id').val(row_id);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('mytasks.edit') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "mytasks_id": mytasks_id
                        },
                        success: function(response) 
                        {
                            if (response.success) 
                            {
                                $('#change_task_status_id').val(response.data.task_status_id);
                                $('#edit_comment').val(response.data.comment);
                                let task_status_date = moment(response.data.task_status_date).format('YYYY-MM-DD');
                                $('#edit_task_status_date').val(task_status_date);                                              
                            } else {
                                alert('Error fetching data: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', error);
                        }
                    });
                });
                $('#update_task_status_form').submit(function(event) 
                {
                    event.preventDefault(); 
                    var formData = new FormData($(this)[0]);
                    var rowId = $('#row_id').val(); 
                    $.ajax({
                        url: "{{ route('mytasks.status.update') }}", 
                        method: "POST", 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success) {
                                $('#TaskStatusModal').modal('hide');
                                $('#update_task_status_form')[0].reset();
                                swal("Success!", "My Task Status Updated Successfully", {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },
                                    },
                                });
                                location.reload();
                                // var table = $('#mytasks-datatable').DataTable();
                                // var row = table.row('#row' + response.data.id); 

                                // var formattedAddedDate = response.data.added_date ? new Date(response.data.added_date).toLocaleString() : ' ';
                                // var formattedEditedDate = response.data.edited_date ? new Date(response.data.edited_date).toLocaleString() : ' ';
                                // row.data([
                                //     rowId, 
                                //     response.data.task,
                                //     response.data.worktime,
                                //     response.data.user || '',
                                //     response.data.task_status || '',
                                //     response.data.task_status_date || '',
                                //     response.data.addedby,                                   
                                //     formattedAddedDate,
                                //     response.data.editedby,
                                //     formattedEditedDate, 
                                //     ''
                                //     // '<i class="fa fa-edit edit_mytasks" data-rowid="' + rowId + '" data-id="' + response.data.id + '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>' +
                                //     // '<i class="fa fa-trash delete_mytasks" data-rowid="' + rowId + '" data-id="' + response.data.id + '"></i>'
                                // ]).draw(false);
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
        });
            
        </script>
        <script>
            $(document).on("click", "#get_my_task", function () {
                var Url= $(this).data('href');
                    $.ajax({
                        url: Url, 
                        type: "GET",
                        dataType: "json",
                        success: function (response) 
                        {
                            if (response.success) 
                            {
                                swal("Success", response.message, {
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            className: "btn btn-success",
                                        },                                        
                                    },
                                });
                                location.reload();
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
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    }); 
            });
        </script>
    @endpush    
</x-admin1-layout>