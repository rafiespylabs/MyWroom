<?php
namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tbl_mw_invoice_trans;
use App\Models\Tbl_mw_invoices;
use App\Models\Tbl_chapter;
use App\Models\Tbl_mw_hsncodes;
use App\Models\Tbl_membership;
use Carbon\Carbon;
use Response;
use Redirect;
class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index');
    }
    public function list(Request $request)
    {
        $limit = $request->input('length', 10); 
        $start = $request->input('start', 0);   
        $searchValue = $request->input('search.value');
        $query =Tbl_mw_invoices::query();
        if (!empty($searchValue)) {
            $query->where('invoice_num', 'like', '%' . $searchValue . '%')
                ->orWhere('invoice_date', 'like', '%' . $searchValue . '%');
        }
        $totalRecords = $query->count();
        $invoices= $query->skip($start)
                    ->take($limit)
                    ->with(['added_user','chapter','member'])
                    ->latest('id') 
                    ->get();
        $data = [];
        $slNo = $start + 1;
        foreach ($invoices as $invoice) {
            $created_user =$invoice->added_user->name ?? '';
            $created_date = $invoice->added_date
                ? Carbon::parse($invoice->added_date)->format('d/m/Y h:i A') : '';
            $invoice_date= $invoice->invoice_date
                ? Carbon::parse($invoice->invoice_date)->format('d/m/Y') : '';
            $data[] = [
                'sl_no' => $slNo++,
                'invoice_num' => $invoice->invoice_num,
                'invoice_date' =>$invoice_date ,
                'chapter'=>$invoice->chapter->chapter_name ??"N/A",
                'member'=>$invoice->member->first_name.'&nbsp;'.$invoice->member->last_name ??"N/A",
                'total_qty' =>$invoice->total_qty ,
                'total_taxable_amount' =>$invoice->total_taxable_amount,
                'total_cgst' =>$invoice->total_cgst ,
                'total_sgst' =>$invoice->total_sgst ,
                'total_igst' =>$invoice->total_igst ,
                'grand_total' =>$invoice->grand_total,
                'created_by' =>  $created_user,
                'created_date' => $created_date,
                'items'=>'<a href="/invoiceitem/addItems/'.$invoice->id.'">Items</a>',
                'action' => '<i class="fa fa-edit edit_sale" data-id="' .$invoice->id . '" data-rowid="'. $invoice->id . '" data-bs-toggle="modal" data-bs-target="#EditModal"></i>
                &nbsp;&nbsp;<a href="/invoice/generate/'.$invoice->id.'" target="blank"><i class="fa fa-print"></i></a>',
                'id' => $invoice->id
            ];
        }
        return response()->json([
            'draw' => intval($request->input('draw')), 
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $searchValue ? $query->count() : $totalRecords,
            'data' => $data,
        ]);
    }
    public function create()
    {
        $chapters=Tbl_chapter::all();
        $hsncodes=Tbl_mw_hsncodes::all();
        $latest_id=Tbl_mw_invoices::latest('id')->value('id');
        $invoice_id=$latest_id+1;
        return view('invoice.create',['chapters'=>$chapters,'invoice_id'=>$invoice_id]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'invoice_num' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'chapter_id' => 'required|integer|exists:tbl_chapters,id',
            'member_id' => 'required|integer|exists:tbl_memberships,id',
            'gst_type' => 'required|integer|in:1,2',
            'total_taxable_amount' => 'required|numeric|min:0',
            'total_cgst' => 'required|numeric|min:0',
            'total_sgst' => 'required|numeric|min:0',
            'total_igst' => 'required|numeric|min:0',
            'total_qty' => 'required|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
        ]);
        try 
        {
            $existInvoiceNum =Tbl_mw_invoices::where('invoice_num',$validatedData['invoice_num'] )->exists();
            if( $existInvoiceNum)
            {
                return Response::json(['success' => false,'message'=>'Invoice Number Already Exist']);
            }
            $created_by=Auth::user()->id;
            $currentdate=Carbon::now()->format('Y-m-d H:i:s');
            $invoice=new Tbl_mw_invoices;
            $invoice->invoice_num=$validatedData['invoice_num'];
            $invoice->invoice_date=$validatedData['invoice_date'];
            $invoice->chapter_id=$validatedData['chapter_id'];
            $invoice->member_id=$validatedData['member_id'];
            $invoice->gst_type=$validatedData['gst_type'];
            $invoice->total_qty=$validatedData['total_qty'];
            $invoice->total_taxable_amount=$validatedData['total_taxable_amount'];
            $invoice->total_cgst=$validatedData['total_cgst'];
            $invoice->total_sgst=$validatedData['total_sgst'];
            $invoice->total_igst=$validatedData['total_igst'];
            $invoice->grand_total=$validatedData['grand_total'];
            $invoice->added_by=$created_by;
            $invoice->added_date=$currentdate;
            $invoice->save();
            return response()->json([
                'success' => true,
                'message' => 'Invoice Record Added Successfully',
                'invoice_id' =>   $invoice->id,
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Invoice: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function getMembers(Request $request)
    {
       $chapter_id=$request->chapter_id;
       $memberships=Tbl_membership::where('chapter_id',$chapter_id)->get();
       return response()->json([
        'success' => true,
        'members' =>  $memberships,
        ]);
    }
    public function invoice($invoiceid)
    {
        $invoice =Tbl_mw_invoices::with(['added_user','chapter','member'])->find($invoiceid);
        $grandtotal_words=$this->getIndianCurrency($invoice->grand_total);
        $invoice_items=Tbl_mw_invoice_trans::with(['invoice_title','hsn'])->where('invoice_id',$invoiceid)->get();
        return view('invoice.invoice',['invoice'=>$invoice,'invoice_items'=>$invoice_items,'grandtotal_words'=>$grandtotal_words]);
    }
    public function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = ucwords(implode('', array_reverse($str)));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . ucwords($paise);
    }
}
