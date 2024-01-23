<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Roilift\Admin\Models\Category;

class CategoryController extends Controller
{
    public function search()
    {
        $id = request('id');
        $category = Category::where('parent_id', $id);

        if($category->count() > 0) {
            $categories = $category->get();
            return response()->json([
                'status' => true,
                'categories' => $categories,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
