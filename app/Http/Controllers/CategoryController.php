<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function category()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('category', compact('categories'));
    }

    public function add_category()
    {

        return view('addcategory');
    }

    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'cat_name' => 'required|max:255|unique:categories,cat_name'

        ],[
            'cat_name.unique' => 'Name should be unique',
        ]);

        Category::create($request->all());
        return redirect(route('category'))->with('message','Category added successfully!');
    }

    public function edit_category($id)
    {
        $category = Category::where('id', $id)->get();
        return view('editcategory', compact('category'));
    }

    public function updatecategory(Request $request, Category $category)
    {
        $request->validate([
            'cat_name' => 'required',

        ]);
        $category->update($request->all());
        return redirect('category')->with('message', 'Updated Successfully!');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect(route('category'))->with('message','Deleted Successfully');
    }
}
