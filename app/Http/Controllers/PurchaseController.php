<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function purchase()
    {
        $purchases = purchase::orderBy('id','DESC')->get();
        $products = Products::all();
        $suppliers = Supplier::all();
        return view('purchase', compact('purchases', 'products', 'suppliers'));
    }

    public function add_purchase()
    {
        $products = Products::all();
        $suppliers = Supplier::all();
        return view('addpurchase',compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        
        $data = $request->input();
        $pro_id = $data['pro_id'];
        $pro_quantity = $data['pro_quantity'];
        $pro_pur = $data['pro_pur'];


        $product = Products::where('id', $pro_id)->get();
        $pro_old_qty = 0;
        foreach ($product as $pro ) {
            $pro_old_qty = $pro->pro_quantity;
        }
        if ($pro_pur>0) {
            $new_quantity = $pro_old_qty + $pro_quantity;
            $request['total_pur'] = $pro_quantity*$pro_pur;
            purchase::create($request->all());
            $product = Products::find($pro_id);
            $product->pro_quantity = $new_quantity;
            $product->save();
            return redirect(route('purchase'))->with('message','Sale Successfull');
        }
        else{
            return redirect(route('add_sale'))->with('message','Quantity invalid!');

        }





    }
}
