<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function sale()
    {
        $sales = Sale::orderBy('id','DESC')->get();
        $products = Products::all();
        $customers = Customer::all();
        return view('sale', compact('sales', 'products', 'customers'));
    }

    public function add_sale()
    {
        $products = Products::all();
        $customers = Customer::all();
        return view('addsale',compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        
        $data = $request->input();
        $pro_id = $data['pro_id'];
        $pro_quantity = $data['pro_quantity'];
        $pro_sell = $data['pro_sell'];


        $product = Products::where('id', $pro_id)->get();
        $pro_old_qty = 0;
        foreach ($product as $pro ) {
            $pro_old_qty = $pro->pro_quantity;
        }
        if ($pro_old_qty >= $pro_quantity &&  $pro_sell>0) {
            $new_quantity = $pro_old_qty - $pro_quantity;
            $request['total_sell'] = $pro_quantity*$pro_sell;
            Sale::create($request->all());
            $product = Products::find($pro_id);
            $product->pro_quantity = $new_quantity;
            $product->save();
            return redirect(route('sale'))->with('message','Sale Successfull');


        }
        else{
            return redirect(route('add_sale'))->with('message','Quantity invalid!');

        }





    }


    public function getProductDetails($id)
    {
        $productsdetails = Products::where('id',$id)->get();
        return json_encode($productsdetails);
    }


}
