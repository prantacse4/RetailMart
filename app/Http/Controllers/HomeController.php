<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\purchase;
use App\Models\Sale;
use App\Models\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales = Sale::take(10)->orderBy('id','DESC')->get();
        $purchases = purchase::take(10)->orderBy('id','DESC')->get();
        $products = Products::all();
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $total_sale = Sale::all()->sum('pro_sell');
        $total_purchase = purchase::all()->sum('pro_pur');
        return view('home', compact('total_sale','total_purchase','sales', 'purchases','products', 'customers','suppliers'));
    }
}
