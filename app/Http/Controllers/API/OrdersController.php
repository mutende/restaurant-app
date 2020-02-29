<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
{

    public function index()
    {
        return Order::all();
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'order_ref_no' => 'required|string',
            'item' => 'required|string',
            'quantity'=>'required'
        ]);
        $userID =  auth('api')->user()->id;

        return Order::create([
            'order_ref_no' => $request->order_ref_no,
            'item'=>$request->item,
            'quantity' =>$request->quantity,
            'received' => false,
            'user_id' =>$userID
        ]);
    }


    public function show($id)
    {
        //
    }

    public function update (Request $request, $id)
    {
        $this->validate($request,[
            'ref_id' => 'required',
        ]);

        Order::where('order_ref_no', '=', $id)
            ->update(['received' => true]);
        return ["Message" => "Success"];
    }



//    public function updateorder (Request $request, $id)
//    {
//        $this->validate($request,[
//            'refId' => 'required',
//        ]);
//        Order::where('order_ref_no', '=', $$id)
//            ->update(['received' => true]);
//        return ["Message" => "Success"];
//    }


    public function destroy($id)
    {
        //
    }
}
