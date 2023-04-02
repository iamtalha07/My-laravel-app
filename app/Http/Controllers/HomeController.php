<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function adminDashboard()
    {
        return view('home');
    }

    public function customerDashboard()
    {
        $products = Product::all();
        return view('customer-home',[
            'products' => $products
        ]);
    }


}
