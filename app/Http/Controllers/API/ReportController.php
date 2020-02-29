<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\InvoiceDetail;
use App\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');


    }
    public function menu()
    {
        return Product::with('category')->get();
    }

    public function sales()
    {
        return InvoiceDetail::with('product','invoice')->get();
    }






}
