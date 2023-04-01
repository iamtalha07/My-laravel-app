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
        $output = '';

        if ($products->count() > 0) {
            $output .= '<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($products as $product) {
                $output .= '<tr>
                    <td>' . $product->id . '</td>
                    <td><img src="' . asset('images/product-image/' . $product->image) . '" width="50" alt="" class="img-thumbnail rounded-circle"></td>
                    <td>' . $product->name . '</td>
                    <td>' . $product->price . '</td>
                    <td>
                    <a href="#" id="' . $product->id . '" class="editIcon" data-toggle="modal" data-target="#editProductModal"><i class="fa fa-edit"></i></a>

                    <a href="#" id="' . $product->id . '" class="deleteIcon"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<div class="card-body">
                <p>No records found</p>
            </div>';
        }
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
