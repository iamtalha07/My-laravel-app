<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function store(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move('images/product-image', $fileName);
        $productData = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $fileName
        ];

        Product::create($productData);
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
        $fileName = '';
        $product = Product::find($request->product_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $image_path = "images/product-image/" . $product->image;
            $file->move('images/product-image', $fileName);

            if (File::exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $fileName = $request->product_image;
        }

        $prodData = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $fileName,
        ];

        $product->update($prodData);
        return response()->json([
            'status' => 200,
        ]);
    }

    public function delete(Request $request) {
		$id = $request->id;
		$product = Product::find($id);
		if ($product->image) {
            unlink("images/product-image/" . $product->image);
			Product::destroy($id);
		}
	}
}
