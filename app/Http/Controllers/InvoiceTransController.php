<?php
namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tbl_mw_invoice_trans;
use App\Models\Tbl_mw_invoicetitles;
use App\Models\Tbl_mw_invoices;
use App\Models\Tbl_mw_hsncodes;
use Carbon\Carbon;
use Response;
use Redirect;
class InvoiceTransController extends Controller
{
    public function addItems($id)
    {
        $invoicetitles=Tbl_mw_invoicetitles::all();
        $hsncodes=Tbl_mw_hsncodes::all();
        $gst_type=Tbl_mw_invoices::find($id)->gst_type;
        return view('invoice.additem', ['invoiceId'=> $id,'invoicetitles'=>$invoicetitles,
        'hsncodes'=>$hsncodes,'gst_type'=>$gst_type]);
    }
    public function list(Request $request)
    {
        $invoice_id = $request->input('invoice_id');
        $limit = $request->input('length', 10); 
        $start = $request->input('start', 0);   
        $searchValue = $request->input('search.value');
        $query =Tbl_mw_invoice_trans::query();
        if (!empty($searchValue)) {
            $query->whereHas('invoice_title', function ($q) use ($searchValue) {
                        $q->where('description', 'like', "%$searchValue%");
                    })
                    ->orWhereHas('hsn', function ($q) use ($searchValue) {
                        $q->where('hsncode', 'like', "%$searchValue%");
                    });
        }
        if(!empty($invoice_id))
        {
            $query->where('invoice_id', $invoice_id);
        }
        $totalRecords = $query->count();
        $InvoiceItems= $query->skip($start)
                    ->take($limit)
                    ->with(['invoice_title','hsn'])
                    ->latest('id') 
                    ->get();
        $data = [];
        $slNo = $start + 1;
        foreach ($InvoiceItems as $Item) {
            // $editButton = '<button class="btn btn-sm btn-primary" onclick="editItemModal('.$Item->id.')" title="Edit">
            //                 <i class="fa fa-edit"></i>';
            $editButton = '';
            $data[] = [
                'sl_no' => $slNo++,
                'invoice_title' => $Item->invoice_title->description ?? 'N/A',
                'hsn'=>$Item->hsn->hsncode.'['.$Item->hsn->hsnvalue.']' ??"N/A",
                'quantity' =>$Item->qty,
                'price' =>$Item->price ,
                'subtaxable_amount' =>$Item->subtaxable_amount,
                'cgst' =>$Item->cgst ,
                'sgst' =>$Item->sgst ,
                'igst' =>$Item->igst ,
                'subtotal' =>$Item->subtotal,
                'action' => $editButton,
                'id' => $Item->id
            ];
        }
        return response()->json([
            'draw' => intval($request->input('draw')), 
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $searchValue ? $query->count() : $totalRecords,
            'data' => $data,
            'invoice_id' => $invoice_id
        ]);
    }
    public function calculateTotals(Request $request)
    {
        $invoice_id = $request->input('invoice_id');
        $invoice =Tbl_mw_invoices::find($invoice_id);
        return response()->json([
            'total_qty' => $invoice->total_qty ?? 0,
            'total_taxable_amount' => $invoice->total_taxable_amount ?? 0,
            'total_cgst' => $invoice->total_cgst ?? 0,
            'total_sgst' => $invoice->total_sgst ?? 0,
            'total_igst' => $invoice->total_igst ?? 0,
            'grand_total' => $invoice->grand_total ?? 0,
        ]);
    }
    public function getHsn(Request $request)
    {
        $hsn_id=$request->hsn_id;
        $hsn_code=Tbl_mw_hsncodes::find($hsn_id);
        return Response::json(['success' => true,'cgst'=>$hsn_code->cgst_perc,
        'sgst'=>$hsn_code->sgst_perc,'igst'=>$hsn_code->igst_perc]);   
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_id' => 'required|exists:tbl_mw_invoices,id',
            'invoice_title_id' => 'required|exists:tbl_mw_invoicetitles,id', 
            'qty' => 'required|integer|min:1',
            'hsn_id' => 'required|exists:tbl_mw_hsncodes,id',
            'price' => 'required|numeric|min:0',
            'subtaxable_amount' => 'required|numeric|min:0',
            'cgst' => 'nullable|numeric|min:0',
            'sgst' => 'nullable|numeric|min:0',
            'igst' => 'nullable|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);
        try 
        {
            $invoice_id = $validatedData['invoice_id'];
            $invoice_title_id=$validatedData['invoice_title_id'];
            $qty=$validatedData['qty'];
            $hsn_id=$validatedData['hsn_id'];
            $price=$validatedData['price'];
            $subtaxable_amount=$validatedData['subtaxable_amount'];
            $cgst=$validatedData['cgst'];
            $sgst=$validatedData['sgst'];
            $igst=$validatedData['igst'];
            $subtotal_amount=$validatedData['subtotal'];

            $hsn_code=Tbl_mw_hsncodes::find($hsn_id);
            $tax=($qty*$price*$hsn_code->hsnvalue)/100;
            $subtotal =$qty*$price+$tax ;

            $total_cgst=($qty*$price*$hsn_code->cgst_perc)/100;
            $total_sgst=($qty*$price*$hsn_code->sgst_perc)/100;
            $total_igst=($qty*$price*$hsn_code->igst_perc)/100;

            $created_by = Auth::user()->id;
            $currentdate = Carbon::now()->format('Y-m-d H:i:s');     
            $invoice= Tbl_mw_invoices::find($invoice_id);
            $invoice->total_taxable_amount=round( $invoice->total_taxable_amount+($qty*$price),2);
            $total_tax=0;
            if($invoice->gst_type==1)
            {
                $invoice->total_cgst=($invoice->total_cgst+$total_cgst);
                $invoice->total_sgst=($invoice->total_sgst+$total_sgst);
                $total_tax=round($total_cgst+$total_sgst,2);
            }
            else if($invoice->gst_type==2)
            {
                $total_tax=round($total_igst,2);
                $invoice->total_igst=($invoice->total_igst+$total_igst);
            }
            $invoice->total_qty=($invoice->total_qty+$qty);
            $invoice->grand_total=round($invoice->grand_total+($qty*$price)+$total_tax);
            $invoice->save();

            $invoice_trans=new Tbl_mw_invoice_trans;
            $invoice_trans->invoice_id= $invoice->id;
            $invoice_trans->invoice_title_id= $invoice_title_id;
            $invoice_trans->hsn_id= $hsn_id;
            $invoice_trans->qty= $qty;
            $invoice_trans->price= $price;
            $invoice_trans->subtaxable_amount	=$subtaxable_amount;
            $invoice_trans->cgst= $cgst;
            $invoice_trans->sgst= $sgst;
            $invoice_trans->igst= $igst;
            $invoice_trans->subtotal= $subtotal_amount;
            $invoice_trans->added_by= $created_by;
            $invoice_trans->added_date= $currentdate;
            $invoice_trans->save();
            return response()->json([
                'success' => true,
                'message' => 'Invoice Details Added successfully',
            ]);
        }
        catch (\Exception $e) 
        {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Add Invoice Details: ' . $e->getMessage(),
            ], 500);
        }
    }
}
