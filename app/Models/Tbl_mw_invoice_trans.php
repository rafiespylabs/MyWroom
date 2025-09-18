<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_mw_invoice_trans extends Model
{
    use HasFactory;
    public function invoice_title()
    {
        return $this->belongsTo(Tbl_mw_invoicetitles::class, 'invoice_title_id', 'id');
    }
    public function hsn()
    {
        return $this->belongsTo(Tbl_mw_hsncodes::class, 'hsn_id', 'id');
    }
}
