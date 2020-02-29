<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function invoice(){
        return $this->belongsTo(InvoiceDetail::class);
    }
}
