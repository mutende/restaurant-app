<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\InvoiceDetail;
use App\Invoice;
use Str;
use Illuminate\Http\Request;

class InvoiceDetailController extends Controller
{
    //
    public function store(Request $request){

      $cart = json_decode($request->getContent('data','details'),true);

      $data = $cart['data'];
      $details = $cart['details'];


      foreach($details as $d){

        $inv = new Invoice;
        $inv->invoice_no = Str::random(5).time();
        $inv->total_quantity = $d['quantity'];
        $inv->grand_total = $d['total'];
        $inv->amount_recieved = $d['amount'];
        $inv->due = $d['due'];

        $inv->save();
      }

      foreach($data as $x){
        foreach($x as $k){
          $det = new InvoiceDetail;
          $det->invoice_id = $inv->id;
          $det->product_id = $k['product']['id'];
          $det->quantity = $k['quantity'];
          $det->price = $k['product']['price'];
          $det->total =  $k['product']['price'] * $k['quantity'];

          $det->save();
        }
      }

      return response()->json(['success' => 'Invoice Added'], 200);

    }
}
