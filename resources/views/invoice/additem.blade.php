<x-admin1-layout>
    @push('styles')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <style>
        label {
            font-weight: 500;
        }

        #addItemForm {
            border: 0.5px solid #dfd4d4;
            padding: 15px;
        }

        .dropdown-toggle {
            border: 1px solid #00000040;
        }

        .amount-spacer {
            padding: 0px 5px;
        }

        .amount-value {
            color: darkgreen;
            font-size: 16px;
        }

        .total-block {
            padding: 5px;
            border: 1px solid #d9e3ef;
            background: #d9e3ef;
            margin: -8px -18px;

        }

        .total-block label {
            color: black !important;
        }
    </style>
    @endpush
    <div class="page-inner">
        <div class="page-header"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h2 style="float:left">Add Payments</h2>
                    <div class="card-header">
                        <div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addItemModal"  id="addItem">Add
                                Payment</button>
                            <button class="btn btn-info btn-round ms-auto btn-sm" onclick="window.history.back();" style="float:right">Go Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row total-block mb-5">
                            <div class="col-3 d-flex align-items-center">
                                <label>Total Taxable Amount</label>
                                <span class="amount-spacer"> : </span>
                                <span class="amount-value" id="total_taxable_amount">0</span>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label>Total Cgst</label>
                                <span class="amount-spacer"> : </span>
                                <span class="amount-value" id="total_cgst">0</span>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label>Total Sgst</label>
                                <span class="amount-spacer"> : </span>
                                <span class="amount-value" id="total_sgst">0</span>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label>Total Igst</label>
                                <span class="amount-spacer"> : </span>
                                <span class="amount-value" id="total_igst">0</span>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label>Total Quantity</label>
                                <span class="amount-spacer"> : </span>
                                <span class="amount-value" id="total_qty">0</span>
                            </div>
                            <div class="col-3 d-flex align-items-center">
                                <label>Grand Total</label>
                                <span class="amount-spacer"> : </span>
                                <span class="amount-value" id="grand_total">0</span>
                            </div>
                        </div>
                        <table id="InvoiceItemsTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Description</th>
                                    <th>HSN</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub Taxable Amount</th>
                                    <th>Cgst</th>
                                    <th>Sgst</th>
                                    <th>Igst</th>
                                    <th>SubTotal Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addItemForm">
                        @csrf
                        <input id="invoice_id_title" name="invoice_id" value="{{$invoiceId}}" hidden />
                        <input id="gst_type" name="gst_type" value="{{$gst_type}}" hidden />
                        <div id="itemRows" class="mb-3">
                            <div class="item-row">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Invoice Title</label>
                                        <div class="d-flex align-items-center">
                                            <select class="form-control item-select selectpicker with-ajax"
                                                style="border: 1px solid !important;" data-live-search="true"
                                                name="invoice_title_id" id="invoice_title_id">
                                                <option value="">Invoice Title</option>
                                                @foreach ($invoicetitles as $title)
                                                <option value="{{ $title->id }}">{{ $title->description }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>HSN Code</label>
                                        <div class="d-flex align-items-center">
                                            <select class="form-control hsn-select selectpicker with-ajax"
                                                style="border: 1px solid !important;" data-live-search="true"
                                                name="hsn_id" id="hsn_id">
                                                <option value="">Select Hsncode</option>
                                                @foreach ($hsncodes as $hsncode)
                                                <option value="{{ $hsncode->id }}">{{ $hsncode->hsncode }} --
                                                    {{$hsncode->hsnvalue}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control qty-input" name="qty" min="1"
                                            placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Price</label>
                                        <input type="number" class="form-control price-input" name="price" id="add_price"
                                            min="0" step="0.01" placeholder="Price">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Sub Taxable Amount</label>
                                        <input type="number" class="form-control subtaxable_amount-input" name="subtaxable_amount" min="0" id="add_subtaxable_amount"
                                            step="0.01" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label>CGST</label>
                                        <input type="number" class="form-control cgst_input" name="cgst" min="0" id="add_cgst"
                                            step="0.01" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>SGST</label>
                                        <input type="number" class="form-control sgst_input" name="sgst" min="0" id="add_sgst"
                                            step="0.01" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label>IGST</label>
                                        <input type="number" class="form-control igst_input" name="igst" min="0" id="add_igst"
                                            step="0.01" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Subtotal Amount</label>
                                        <input type="number" class="form-control subtotal-input" name="subtotal" min="0" id="add_subtotal"
                                            step="0.01" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/ajax-bootstrap-select@1.4.4/dist/js/ajax-bootstrap-select.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".selectpicker").selectpicker({
    });
    var invoiceId={{$invoiceId}}
    getTotalValues(invoiceId);
    var table = $('#InvoiceItemsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('invoiceitem.list') }}", 
                type: "GET",
                data: function (d) {
                    d.invoice_id = invoiceId; 
                }
            },
            columns: [
                { data: 'sl_no', name: 'sl_no', orderable: false, searchable: false },
                { data: 'invoice_title', name: 'invoice_title' },
                { data: 'hsn', name: 'hsn' },
                { data: 'quantity', name: 'quantity' },
                { data: 'price', name: 'price' },
                { data: 'subtaxable_amount', name: 'subtaxable_amount' },
                { data: 'cgst', name: 'cgst' },
                { data: 'sgst', name: 'sgst' },
                { data: 'igst', name: 'igst' },
                { data: 'subtotal', name: 'subtotal' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

    function getTotalValues(invoiceId){
        $.ajax({
            url: "{{ route('invoiceitem.calculateTotals') }}", 
            method: "POST",
            data: { "_token": "{{ csrf_token() }}",invoice_id: invoiceId },
            success: function(response) {
                $('#total_taxable_amount').html(response.total_taxable_amount.toFixed(2));
                $('#total_cgst').html(response.total_cgst);
                $('#total_sgst').html(response.total_sgst);
                $('#total_igst').html(response.total_igst);
                $('#total_qty').html(response.total_qty);
                $('#grand_total').html(response.grand_total);
            },
            error: function(xhr) {
                alert("Error: " + xhr.responseJSON.message);
            }
        });
    }
    $(document).on('keyup', '.qty-input, .price-input', function() 
    {
        let row = $(this).closest('.item-row');
        let quantity = row.find('.qty-input').val();
        let price = row.find('.price-input').val();
        let hsn_id=row.find('.hsn-select option:selected').val();
        let gst_type=$('#gst_type').val();
        let subtotal_amount=0;
        let cgst_per=0;
        let sgst_per=0;
        let cgst_value=0;
        let sgst_value=0;
        let igst_per=0;
        let  igst_value=0;
       let amount = quantity * price;
        $.ajax({ type: "POST",
            url: "{{route('invoiceitem.getHsn')}}",
            data: { "_token": "{{ csrf_token() }}",
                    hsn_id:hsn_id,
                },
            success: function(res) 
            {
                if(res.success)
                {
                    if(gst_type==1)
                    {
                            cgst_per=res.cgst;
                            sgst_per=res.sgst;
                            cgst_value=(amount*cgst_per)/100;
                            sgst_value=(amount*sgst_per)/100;
                            row.find('.cgst_input').val(cgst_value.toFixed(2));
                            row.find('.sgst_input').val(sgst_value.toFixed(2));
                            row.find('.igst_input').val(0);
                            subtotal_amount=(amount+cgst_value+sgst_value);
                    }
                    else if(gst_type==2)
                    {
                            igst_per=res.igst;
                            igst_value=(amount*igst_per)/100;
                            row.find('.cgst_input').val(0);
                            row.find('.sgst_input').val(0);
                            row.find('.igst_input').val(igst_value);
                            subtotal_amount=(amount+igst_value);
                    }
                    row.find('.subtaxable_amount-input').val(amount.toFixed(2));
                    row.find('.subtotal-input').val(subtotal_amount.toFixed(2));
                }
            },
        });
    });  
    $("#addItemForm").on("submit", function (e) {
            e.preventDefault(); 
            let formData = new FormData(this); 
            // formData.append("purchase_id", $("#purchase_id_item").val());
            $.ajax({
                url: "{{ route('invoiceitem.store') }}", 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") 
                },
                beforeSend: function () {
                    $("#addItemForm button[type='submit']").prop("disabled", true).text("Saving...");
                },
                success: function (response) {
                    if (response.success) {
                        alert("Item added successfully!");
                        $("#addItemModal").modal("hide");
                        $("#addItemForm")[0].reset();
                        $(".selectpicker").selectpicker("refresh");
                        location.reload();
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = "";
                    $.each(errors, function (key, value) {
                        errorMessages += value[0] + "\n";
                    });
                    alert("Validation Error:\n" + errorMessages);
                },
                complete: function () {
                    table.ajax.reload();
                    $("#addItemForm button[type='submit']").prop("disabled", false).text("Save Item");
                }
            });
        });
    });
    </script>
    @endpush
</x-admin1-layout>