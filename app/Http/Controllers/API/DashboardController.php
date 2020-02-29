<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Hotel;
use App\InvoiceDetail;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');


    }

    private function menu()
    {
        return Product::with('category')->get();
    }

    private function sales()
    {
        return InvoiceDetail::with('product','invoice')->get();
    }

    private function categories()
    {
        return Category::count();
    }

    private function hotels()
    {
        return Hotel::count();
    }

    private function users()
    {
        return User::count();
    }

    public function index ()
    {
        $dashboard = array(
            "menu"=> $this->menu(),
            "sales" => $this->sales(),
            "categories" => $this->categories(),
            "hotels" => $this->hotels(),
            "users" => $this->users()
        );

        return $dashboard;


    }



}
