<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\Category;

class CategoryController extends Controller
{
    public function search()
    {
        $id = request('id');
        $category = Category::where('parent_id', $id)->orderBy('sort_by');

        if($category->count() > 0) {
            $categories = $category->get();
            return response()->json([
                'status' => true,
                'categories' => $categories,
            ]);
        } else {
            $category = Category::where('id', $id)->first();
            return response()->json([
                'status' => false,
                'category' => $category,
            ]);
        }
    }
}
