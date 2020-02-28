<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');


    }

    public function index()
    {
        return Product::with('category')->paginate(7);
    }

    public function getItems()
    {
        return Product::with('category')->get();
    }


    public function store(Request $request)
    {

        $this->validate($request,[
            'product_name' => 'required|unique:products',
              'category' => 'required',
                'price' => 'required',

        ]);

        return Product::create([
           'product_name' => $request->product_name,
            'category_id' => $request->category,
             'price' => $request->price,

        ]);
    }



    public function update(Request $request, $id)
    {
      $prod = Product::findOrFail($id);
      $this->validate($request,[
          'product_name' => 'required|unique:products,product_name,'.$id,
            'category_id' => 'required',
              'price' => 'required',

      ]);
      $prod->update($request->all());

      return $request;
        //
    }


    public function destroy($id)
    {
        //
        $prod = Product::findOrFail($id);

        $prod->delete();

        return ['message'=> 'Hotel deleted'];
    }

    public function filterproducts()
    {

        if ($search = \Request::get('q')) {
            $products = Product::where(function ($query) use ($search) {
                $query->where('product_name', 'LIKE', "%$search");
            })->with('category')->paginate(7);

        }else{
            $products =  Product::with('category')->paginate(7);
        }

        return $products;
    }
}
