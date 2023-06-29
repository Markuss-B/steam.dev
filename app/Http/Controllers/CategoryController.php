<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function index()
    {
        // get user categories
        $categories = auth()->user()->categories;

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // public function createCategory(User $user, $categoryName)
        // {
        //     $category = new Category;
        //     $category->name = $categoryName;
        //     $category->user_id = $user->id;
        //     $category->save();
    
        //     return $category;
        // }
        // validate
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $categoryName = $request->name;
        
        // create category
        $category = Category::createCategory($user, $categoryName);

        return Response::json($category);
    }
}
