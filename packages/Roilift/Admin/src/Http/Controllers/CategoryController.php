<?php

namespace Roilift\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Roilift\Admin\Models\Category;
use Illuminate\Support\Facades\Auth;
use Roilift\Admin\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function index()
    {
        view()->share('title', 'Category');
        $search = [];
        if(request('name')) {
            $search['name'] = request('name');
        }

        if(request()->has('status')) {
            $search['status'] = request('status');
        }

        $categories = $this->categoryRepository->paginate(20, ['*'], 'page', null, [], [['field' => 'id', 'dir' => 'desc']], $search, $search);
        return view('admin::category.index', compact('categories'));
    }

    public function create()
    {
        view()->share('title', 'Create Category');
        $backUrl = request()->headers->get('referer');
        $categories = $this->categoryRepository->all();
        return view('admin::category.create', compact('backUrl', 'categories'));
    }

    public function edit()
    {
        view()->share('title', 'Edit Category');
        $category = $this->categoryRepository->find(request('id'));
        $backUrl = request()->headers->get('referer');
        return view('admin::category.create', compact('category', 'backUrl'));
    }

    public function store()
    {
        $category = request()->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . request('id'),
            'description' => 'nullable',
            'status' => 'required',
            'parent_id' => 'nullable'
        ]);

        if(request('id')) {
            $this->categoryRepository->update($category, request('id'));
        } else {
            $this->categoryRepository->create($category);
        }

        return redirect()->route('admin.category');
    }

    public function destroy()
    {
        Category::find(request('id'))->delete();
        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
}

?>