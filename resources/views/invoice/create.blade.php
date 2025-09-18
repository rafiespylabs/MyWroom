<x-admin1-layout>
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<style>
    .item-select{
        border:1px solid #000 !important;
    }
</style>
@endpush
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Add Invoice</h2>
                </div>
                <div class="card-body">
                    <form id="InvoiceForm" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="invoice_id" name="invoice_id" value="">
                        <!-- Step 1: Sale Details -->
                        <div id="step1" class="form-step form-step-active">
                            <h3>Step 1: Invoice Details</h3>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label>Invoice Number<span>*</span></label>
                                    <input type="text"  name="invoice_num" id="add_invoice_num" class="form-control" value="MW{{$invoice_id}}" readonly>
                                    <span class="error-message" id="invoiceError"></span>
                                </div>
                                <div class="col-6">
                                    <label>Invoice Date<span>*</span></label>
                                    <input type="date"  name="invoice_date" id="add_invoice_date" class="form-control">
                                    <span class="error-message" id="invoice_dateError"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label>Chapter</label>
                                    <div class="d-flex align-items-center">
                                        <select  name="chapter_id"  id="add_chapter_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach($chapters as $chapter)
                                            <option value="{{$chapter->id}}">{{$chapter->chapter_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message" id="chapterError"></span>
                                        <button type="button" class="btn btn-primary ms-1" id="addChapterModal">
                                                    <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label>Members</label>
                                    <select  name="member_id"  id="add_member_id" class="form-control">
                                        <option value="">Select One</option>
                                    </select>
                                    <span class="error-message" id="memberError"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label>Gst Type</label>
                                    <select  name="gst_type"  id="add_gst_type" class="form-control" required>
                                        <option value="">Select One</option>
                                        <!-- <option value="1">Kerala</option> -->
                                        <option value="2">Other </option>
                                    </select>
                                    <span class="error-message" id="gst_typeError"></span>
                                </div>
                            </div>
                            <div class="form-actions form-group mt-5">
                                <button type="button" class="btn btn-primary btn-lg" id="nextStep1">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>   
<!-- Create Client Modal -->
<div class="modal fade" id="CreateClientModal" tabindex="-1" role="dialog" aria-labelledby="CreateClientModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Client</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="create_client_form" class="form">
                    @csrf
                    <div class="form-group">
                        <label for="client_name">Client Name</label>
                        <input type="text" name="client_name"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="client_gst">Client GST</label>
                        <input type="text" name="client_gst"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="client_address">Client Address</label>
                        <input type="text" name="client_address"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="client_contact_number">Client Contact Number</label>
                        <input type="number" name="client_contact_number"  class="form-control" required>
                    </div>
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Create Client Modal -->
@push('scripts')
<script>
     $('#nextStep1').click(function() {
        if(validateStep1()) {
            var formData = {
                    'invoice_num': $('#add_invoice_num').val(),
                    'invoice_date': $('#add_invoice_date').val(),
                    'chapter_id': $('#add_chapter_id').val(),
                    'member_id': $('#add_member_id').val(),
                    'gst_type': $('#add_gst_type').val(),
                    "_token": "{{ csrf_token() }}",
                    "total_taxable_amount":0.0,
                    "total_cgst":0.0,
                    "total_sgst":0.0,
                    "total_igst":0.0,
                    "total_qty":0,
                    "grand_total":0.0
                };
                $.ajax({
                    url: "{{ route('invoice.store') }}", 
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#invoice_id').val(response.invoice_id);
                            window.location.href = "{{ url('/invoiceitem/addItems') }}/" + response.invoice_id;
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
        }
    });
    function validateStep1() {
        let isValid = true;
        if ($('#add_invoice_num').val() === "") {
            $('#invoiceError').text("Invoice Number is required.");
            isValid = false;
        }
        if ($('#add_invoice_date').val() === "") {
            $('#invoice_dateError').text("Invoice Date is required.");
            isValid = false;
        }
        if ($('#add_chapter_id').val() === "") {
            $('#chapterError').text("Chapter is required.");
            isValid = false;
        }
        if ($('#add_member_id').val() === "") {
            $('#memberError').text("Member is required.");
            isValid = false;
        }
        if ($('#add_gst_type').val() === "") {
            $('#gst_typeError').text("GST Type is required.");
            isValid = false;
        }
        return isValid;
    }
</script>
<script>
$("#add_chapter_id").on("change", function () {
        let chapter_id = $(this).val();
        $('#add_member_id').prop('disabled', true).html('<option value="">Loading...</option>');
        if (chapter_id) {
            $.ajax({
                url: "{{ route('invoice.getMembers') }}",
                type: "POST",
                data: { "_token": "{{ csrf_token() }}",chapter_id: chapter_id },
                success: function (response) {
                    $('#add_member_id').prop('disabled', false).html('<option value="">Select One</option>');
                    if (response.success) 
                    {
                        $.each(response.members, function(index, member) {
                            $('#add_member_id').append('<option value="' + member.id+'">'+  member.first_name+'&nbsp;'+  member.last_name+'</option>');
                        });
                    }
                },
                error: function () {
                    alert("Failed to fetch Member details.");
                }
            });
        }
    });
</script>
<script>
 $('#addClientModal').on('click', function () {
    $('#CreateClientModal').modal('show');
});
$('#create_client_form').submit(function(event) {
    event.preventDefault(); 
    var formData = new FormData($(this)[0]);  
    $.ajax({
        url: "",  
        method: "POST",
        data: formData,
        contentType: false,  
        processData: false,  
        success: function(response) {
            let ClientNewId = $('#add_client_id');
            ClientNewId.append(new Option(response.data.client_name, response.data.id, true, true));
            ClientNewId.val(response.data.id).change();
            $("#create_client_form")[0].reset();
            ClientNewId.selectpicker("refresh");
            $('#CreateClientModal').modal('hide');
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessages = "";
            $.each(errors, function (key, value) {
                errorMessages += value[0] + "\n";
            });
            swal("Error", errorMessages, {
                icon: "error",
                buttons: {
                    confirm: {
                        className: "btn btn-danger",
                    },
                },
            });
        },
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ajax-bootstrap-select@1.4.4/dist/js/ajax-bootstrap-select.min.js"></script>
<script>
$(document).ready(function(){
    $(".selectpicker").selectpicker({
    });
});
</script>
@endpush
</x-admin1-layout>