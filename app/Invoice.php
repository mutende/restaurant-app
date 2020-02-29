<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function category(){
        return $this->hasMany(InvoiceDetail::class);
    }
}
