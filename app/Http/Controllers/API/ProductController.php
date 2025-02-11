<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function getProduct()
    {
        $product = Product::query();

        if ($product) {
            return ResponseFormatter::success(
                $product->get(),
                'Product fetched successfully'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Product not found',
                404
            );
        }
    }

    public function getProductByID($id)
    {
        $product = Product::find($id);

        if ($product) {
            return ResponseFormatter::success(
                $product,
                'Product fetched successfully'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Product not found',
                404
            );
        }
    }

    public function addProduct(ProductRequest $request)
    {
        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('assets/product', 'public');
            }

            $product = Product::create($data);

            return ResponseFormatter::success(
                $product,
                'Product created successfully'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage()
            ], 'Failed create product', 500);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $request->validate([
                'product_category_id' => 'nullable',
                'name' => 'nullable|string|max:255',
                'price' => 'nullable|integer',
                'image' => 'nullable|image|max:2048|mimes:jpg,png,jpeg'
            ]);

            $product = Product::findOrFail($id);

            // When update product data, user don't have to input all datas.
            // The request for product_category_id and price must convert to integer, because if we try to update from Postman with BODY(data-form), it will be sent as string.

            if ($request->has('product_category_id')) {
                $product->product_category_id = (int)$request->input('product_category_id');
            }

            if ($request->has('name')) {
                $product->name = $request->input('name');
            }

            if ($request->has('price')) {
                $product->price = (int)$request->input('price');
            }

            // Check if the request have image file
            if ($request->hasFile('image')) {
                // If the data already have an image file, the old image file will be deleted 
                if ($product->image) {
                    File::delete($product->image);
                }

                // The data will store the new image path
                $product['image'] = $request->file('image')->store('assets/product', 'public');
            }

            $product->save();

            return ResponseFormatter::success(
                $product,
                'Product updated successfully'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage()
            ], 'Failed update product', 500);
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}