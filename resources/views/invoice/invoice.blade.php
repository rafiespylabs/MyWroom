<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
            color: #000;
        }

        .container {
            width: 100%;
            /* Full width */
            margin: 0;
            /* Remove auto margin */
            border: 1px solid #000;
            padding: 15px 20px;
            box-sizing: border-box;
            /* Include padding in width calculation */
        }

        .header,
        .section,
        .table-container,
        .totals,
        .footer {
            margin-bottom: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header .title {
            font-size: 30px;
            font-weight: bold;
        }

        .header .subtitle {
            font-size: 16px;
            font-weight: bold;
            margin-top: 6px;
        }

        .details-invoice-row {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .details {
            width: 65%;
            padding-right: 20px;
            border-right: 1px solid #ccc;
        }

        .invoice-info {
            width: 30%;
            padding-left: 20px;
        }

        .details div,
        .invoice-info div {
            margin: 5px 0;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            padding-bottom: 2px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            border: 1px solid #000;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 20px;
            border: 1px solid #000;
        }

        .items-table th,
        .items-table td {
            padding: 4px 6px;
            text-align: center;
            border-right: 1px solid #000;
            border-left: 1px solid #000;
            border-top: none;
            border-bottom: none;
        }

        .items-table th:first-child,
        .items-table td:first-child {
            border-left: none;
        }

        .items-table th:last-child,
        .items-table td:last-child {
            border-right: none;
        }

        .items-table thead th {
            background-color: #f0f0f0;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        .items-table tfoot td {
            font-weight: bold;
            text-align: right;
            border-top: 1px solid #000;
            border-bottom: none;
        }

        .items-table tfoot tr td:last-child {
            text-align: center;
        }

        .items-table tbody tr td[colspan="9"] {
            border-right: none;
        }

        thead {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }

        th,
        td {
            padding: 4px;
            text-align: left;
            vertical-align: top;
        }

        .totals,
        .footer {
            margin-top: 10px;
        }

        .totals table {
            width: 100%;
        }

        .totals td {
            padding: 4px;
            border: 1px solid #000;
        }

        .footer {
            font-size: 14px;
        }

        .bank-details {
            margin-top: 10px;
            font-weight: bold;
        }

        .bank-info {
            font-weight: normal;
            font-size: 11px;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
        .print-btn
        {
            background-color: green;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            margin-left: 3px;
        }
        .back-btn
        {
            padding: 10px 20px; 
            background-color: #1897cb; border: 1px solid #ccc; 
            cursor: pointer;
        }
    </style>
</head>
<body>
<button type="button" class="print-btn" onclick="printDiv('print-content-only')">Print Invoice</button>
<button onclick="window.history.back()" class="back-btn">Go Back</button>
    <div class="container" id="print-content-only">
        <div class="header">
            <div class="title">WROOM BUSINESS CONCLAVES (OPC) PVT.LTD</div>
            <div class="subtitle">
                GROUND FLOOR, F-360A, PHASE-VI,<br>
                ENCLAVE, AYA NAGAR EXTENSION, NEW DELHI,<br>
                PIN : 110047<br>
                GSTIN : 07AACCW9922G1Z3<br>
            </div>
            <h3>INVOICE</h3>
        </div>
        <div class="details-invoice-row">
            <div class="details">
                <div class="section-title">Customer Details</div>
                <div><strong>Name :</strong> {{$invoice->member->firm_name ?? ''}}</div>
                <div><strong>Phone :</strong> {{$invoice->member->phone_number ?? ''}}</div>
                <div><strong>Address :</strong> {{$invoice->member->address ?? ''}}</div>
                @if($invoice->member->gst_in)
                <div><strong>GSTIN :</strong> {{$invoice->member->gst_in ?? ''}}</div>
                @endif
            </div>
            <div class="invoice-info">
                <div><strong>Date :</strong>{{$invoice->invoice_date}}</div>
                <div><strong>Invoice No :</strong> {{$invoice->invoice_num}}</div>
                <!-- <div><strong>Place Of Sale :</strong> Kerala - 32</div>
                <div><strong>TaxType :</strong> GSTR1 B2B</div> -->
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="table-container">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Description</th>
                        <th>HSNC/SAC</th>
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>Tax(%)</th>
                        <th>Tax Value</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                    $i=1;
                    $totalqty=0;
                  @endphp
                  @foreach($invoice_items as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->invoice_title->description ?? ''}} </td>
                        <td>{{$item->hsn->hsncode}}[{{$item->hsn->hsnvalue}}]</td>
                        @php 
                            $totalqty+=$item->qty;
                        @endphp
                        <td>{{$item->price}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->hsn->hsnvalue}}(%)</td>
                        <td>{{$item->cgst+$item->sgst+$item->igst}}</td>
                        <td>{{$item->subtotal}}</td>
                    </tr>
                    @php
                      $i++;
                    @endphp
                    @endforeach
                    <tr class="empty-row">
                        <td style="height: 100px;"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{$totalqty}}</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($invoice->grand_total) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="totals">
            <table>
                <tr>
                    <!-- <td><strong>Tax Per</strong></td> -->
                    <td><strong>Taxable</strong></td>
                    <td><strong>SGST</strong></td>
                    <td><strong>CGST</strong></td>
                    <td><strong>IGST</strong></td>
                    <td rowspan="3" style="width: 40%; text-align: right; vertical-align: top;">
                        <div><strong>Taxable Amount :</strong> {{$invoice->total_taxable_amount}}</div>
                        <div><strong>Tax Total :</strong>{{$invoice->total_cgst+$invoice->total_sgst+$invoice->total_igst}}</div>
                        <div><strong>CGST Total :</strong> {{$invoice->total_cgst}}</div>
                        <div><strong>SGST Total :</strong>{{$invoice->total_sgst}}</div>
                        <div><strong>IGST Total :</strong>{{$invoice->total_igst}}</div>
                        <div style="margin-top: 10px; font-size: 16px;">
                            <strong>BillAmount : {{ number_format($invoice->grand_total) }}</strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <!-- <td>18%</td> -->
                    <td>{{$invoice->total_taxable_amount}}</td>
                    <td>{{$invoice->total_cgst}}</td>
                    <td>{{$invoice->total_sgst}}</td>
                    <td>{{$invoice->total_igst}}</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <div><strong>{{$grandtotal_words}}</strong></div>
            <!-- <div class="bank-details">BANK DETAILS</div>
            <div class="bank-info">
                THE SOUTH INDIAN BANK LIMITED<br>
                TOWN BRANCH MUVATTUPUZHA<br>
                A/C No: 0342073000000364<br>
                IFSC: SIBL000342
            </div> -->
            <div class="right">
                <h4>FOR WROOM BUSINESS CONCLAVES</h4>
                <img src="{{asset('admin1/assets/img/sign.jpeg')}}"height="50">
             </div>
            <div class="right" style="margin-top: 40px;">Authorised Signatory</div>
        </div>
    </div>
</body>
<script>
function printDiv(divName) 
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
}
</script>
</html>