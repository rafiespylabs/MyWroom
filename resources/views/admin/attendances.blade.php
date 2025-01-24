<x-admin1-layout>
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Attendances</h4>
            </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="start_date" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="col-md-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="end_date" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="col-md-3">
                        <button id="filterButton" class="btn btn-primary mt-3">Filter</button>
                    </div>
                </div>
                <div id="preloader" style="display:none;">
                    <img src="{{asset('web/preloader.gif')}}">
                </div>
                <div class="table-responsive">
                    <table id="attendance-datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th>Sl No</th>
                            <th>Staff</th>
                            <th>Punchin Time</th>
                            <th>Punchin Location</th>
                            <th>Punchin Image</th>
                            <th>Punchout Time</th>
                            <th>Punchout Location</th>
                            <th>Punchout Image</th>
                            <th>Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="attendance_tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
 @push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        function fetch_attendanceData()
        {
            $('#attendance_tbody').html('');
            $.ajax({ type: "GET",
                    url: "{{route('attendance.list')}}",
                    beforeSend: function() 
                    {
                        $('#preloader').show();
                    },
                    success: function(res) 
                    {
                        $('#preloader').hide();
                        $('#attendance-datatable').DataTable().destroy();
                        $('#attendance_tbody').html(res);
                        $('#attendance-datatable').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                 'csv', 'excel', 'pdf'
                            ]
                        });
                    },
                });
        }   
        fetch_attendanceData();
    });
</script>
<script>
$('#filterButton').click(function() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    if (!start_date  || !end_date) {
        alert('Please enter both start and end dates.');
        return;
    }
    $.ajax({
            url: "{{route('attendance.filter')}}",
            type: 'POST',
            data: {  "_token": "{{ csrf_token() }}",start_date: start_date, end_date: end_date},
            beforeSend: function() 
            {
                $('#preloader').show();
            },
            success: function(res) 
            {
                $('#attendance_tbody').empty();
                $('#preloader').hide();
                $('#attendance-datatable').DataTable().destroy();
                $('#attendance_tbody').html(res);
                $('#attendance-datatable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                            'csv', 'excel', 'pdf'
                    ]
                });
            }
        });
});
</script>
@endpush
</x-admin1-layout>