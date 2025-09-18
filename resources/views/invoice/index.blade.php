<x-admin1-layout>
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Invoices</h2>
                    <div class="d-flex align-items-center">
                        <a href="{{route('invoice.create')}}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i> Add Invoice
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="invoice-datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th>Sl No</th>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Chapter</th>
                            <th>Member</th>
                            <th>Total Quantity</th>
                            <th>Total Taxable Amount</th>
                            <th>Total CGST</th>
                            <th>Total SGST</th>
                            <th>Total IGST</th>
                            <th>Grand Total</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Items</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="invoice_tbody">
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
        $.fn.dataTable.ext.errMode = 'none';
        var table = $('#invoice-datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10, 
            lengthMenu: [10, 25, 50, 100], 
            ajax: {
                url: "{{ route('invoice.list') }}",
                type: "GET"
            },
            columns: [
                {data: "sl_no",name: "sl_no", orderable: false, searchable: false  },
                {data:"invoice_num",name: "invoice_num" },
                {data: "invoice_date" ,name: "invoice_date"},
                {data: "chapter" ,name: "chapter"},
                {data: "member" ,name: "member"},
                {data: "total_qty" ,name: "total_qty"},
                {data: "total_taxable_amount" ,name: "total_taxable_amount"},
                {data: "total_cgst" ,name: "total_cgst"},
                {data: "total_sgst" ,name: "total_sgst"},
                {data: "total_igst" ,name: "total_igst"},
                {data: "grand_total" ,name: "grand_total"},
                {data: "created_by",name: "created_by" },
                {data: "created_date",name: "created_date"},
                {data: "items",name: "items"},
                { 
                    data: "action", 
                    name: "action", 
                    orderable: false, 
                    searchable: false 
                },
            ],
            rowCallback: function(row, data, index) {
                $(row).attr('id', 'row' + data.id);
            }
        });
    });
</script>
@endpush
</x-admin1-layout>