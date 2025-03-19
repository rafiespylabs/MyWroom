<x-admin1-layout>
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <form id="select_chapters_form" class="form">
                         @csrf
                        @foreach($chapeters as $key=>$chap)
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" type="checkbox" name="select_chapter" id="flexSwitchCheckDefault{{$key}}" value="{{$chap->id}}">
                                <label class="form-check-label"  for="flexSwitchCheckDefault{{$key}}">{{$chap->chapter_name}}</label>
                            </div>
                        @endforeach
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{route('dashboard')}}"><button type="button" class="btn btn-deafult btn-sm">Skip To Dashboard</button></a>
                        </div>
                    </form>
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
              <form id="create_branch_form" class="form" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                    <label>Branch</label>
                    <input type="text"  name="branch" class="form-control">
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
            <form id="update_branch_form" class="form" enctype="multipart/form-data">
              @csrf
               <input type="hidden" name="branch_id" id="branch_id" value="">
                <div class="form-group">
                    <label>Branch</label>
                    <input type="text"  name="branch" id="branch" class="form-control">
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
 @push('scripts')
<script>
$(document).ready(function() {
  $('input[type="checkbox"]').change(function() {
    let $checkboxes = $('input[type="checkbox"]'); 
    let $checkedCheckboxes = $checkboxes.filter(':checked'); 
    if ($checkedCheckboxes.length > 1) { 
      $(this).prop('checked', false); 
      alert("You Can Only Select one Chapeter At A time."); 
    }
  });
});
$('#select_chapters_form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData($(this)[0]);  
    $.ajax({
        url: "{{ route('chapters.selection') }}", 
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.success) { 
                $('#select_chapters_form')[0].reset(); 
                swal("Success!", response.message, {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: "btn btn-success",
                        },
                    },
                });
                window.location.href = "{{route('chapter.dashboard')}}";
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
</script>
@endpush
</x-admin1-layout>
