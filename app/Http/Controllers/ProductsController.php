<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   


    public function products()
    {
        $products = Products::orderBy('id','DESC')->get();
        return view('products', compact('products'));
    }

    public function add_products()
    {
        $categories = Category::all();
        return view('addproducts',compact('categories'));
    }







    public function store(Request $request)
    {


        //Validation
        $request->validate([
            'pro_name' => 'required|max:255'

        ]);
        $data = $request->input();
        $bar_code = $data['bar_code'];
        $product = Products::where('bar_code', $bar_code)->get();
        $i = 0;
        foreach ($product as $pro) {
           $i=$i+1;
        }
        if ($i==1) {
            return redirect(route('products'))->with('message','Already available! Try to edit the product.');
        }
       else{
        Products::create($request->all());
        return redirect(route('products'))->with('message','Product added successfully!');
       }
    }








    public function edit_products($id)
    {
        $product = Products::where('id', $id)->get();
        $categories = Category::all();
        $products = Products::where('id', $id)->get();
        return view('editproducts' , compact('product', 'categories'));
    }

    public function updateproducts(Request $request, Products $products)
    {
        $products->update($request->all());
        return redirect('products')->with('message', 'Updated Successfully!');
    }

    public function delete(Products $products)
    {
        $products->delete();
        return redirect(route('products'))->with('message','Deleted Successfully');
    }
}
