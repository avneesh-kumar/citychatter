<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Roilift\Admin\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        view()->share('title', 'Category');
        $categories = Category::all();
        return view('admin::category.index', compact('categories'));
    }

    public function create()
    {
        view()->share('title', 'Create Category');
        return view('admin::category.create');
    }

    public function edit()
    {
        view()->share('title', 'Edit Category');
        $category = Category::find(request('id'));
        return view('admin::category.edit', compact('category'));
    }

    public function store()
    {
        $category = request()->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            // 'description' => 'required'
            'status' => 'required'
        ]);

        if(request('id')) {
            Category::find(request('id'))->update($category);
        } else {
            Category::create($category);
        }

        return redirect()->route('admin.category');
    }
}

?>