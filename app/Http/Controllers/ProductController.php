<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        Product::create($request->all());
        return response()->json([
            'status' => 200
        ]);
    }

    public function fetchAllProducts()
    {
        $products = Product::all();
        $productView = view('product-view',['products' => $products])->render();
        return $productView;
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Product::find($id);
        return response()->json($emp);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->update($request->all());
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
		$id = $request->id;
		$product = Product::find($id);
		if ($product) {
			Product::destroy($id);
		}
	}
}
