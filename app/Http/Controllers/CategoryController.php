<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $items = Category::all();
        return view('settings.index', compact('items'));
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories'
        ]);


        if ($validated) {
            $store = Category::create(['name' => $request->name]);
            return back()->with('success', 'Category Added');
        } else {
            return back()->with('error', 'Fail to Add Category');
        }
    }
}
