<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $category = Category::query();

        if ($category) {
            return ResponseFormatter::success(
                $category->get(),
                'Category fetched successfully'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Category not found',
                code: 404
            );
        }
    }

    public function addCategory(CategoryRequest $request)
    {
        try {
            $data = $request->all();

            $category = Category::create($data);

            return ResponseFormatter::success(
                $category,
                'Category created successfully'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage()
            ], 'Failed create category', 500);
        }
    }

    public function getCategoryByID($id)
    {
        $category = Category::find($id);

        if ($category) {
            return ResponseFormatter::success(
                $category,
                'Category fetched successfully'
            );
        } else {
            return ResponseFormatter::error(
                null,
                'Category not found',
                404
            );
        }
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'nullable|string|max:255'
            ]);

            $category = Category::findOrFail($id);

            if ($request->has('name')) {
                $category->name = $request->input('name');
            }

            $category->save();

            return ResponseFormatter::success(
                $category,
                'Category updated successfully'
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error->getMessage()
            ], 'Failed update category', 500);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}