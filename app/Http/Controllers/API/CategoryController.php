<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;
use function foo\func;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');


    }

    public function index()
    {
      return Category::all();
    }


    public function store(Request $request)
    {
      $this->validate($request,[
          'category' => 'required|unique:categories',

      ]);

      return Category::create([
         'category' => $request->category,

      ]);
    }



    public function update(Request $request, $id)
    {
        //

                $cat = Category::findOrFail($id);
                $this->validate($request,[
                    'category' => 'required',

                ]);
                $cat->update($request->all());

                return $request;
    }


    public function destroy($id)
    {
        //
        $cat = Category::findOrFail($id);

        $cat->delete();

        return ['message'=> 'Hotel deleted'];
    }

    public function filterCategories()
    {

        if ($search = \Request::get('q')) {
            $categories = Category::where(function ($query) use ($search) {
                $query->where('category', 'LIKE', "%$search");
            })->get();

        }else{
            $categories = Category::all();
        }

        return $categories;
    }
}
