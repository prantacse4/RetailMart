<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\customer;
use App\Models\supplier;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function customer()
    {
        $customers = customer::orderBy('id','DESC')->get();
        return view('customer', compact('customers'));
        
    }

    public function add_customer()
    {
    
        
        return view('addcustomer');
    }


   
    public function store(Request $request)
    {

 
        //Validation
        $request->validate([
            'cus_name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255'
        ]);

        $data = $request->input();

        $cus_name = $data['cus_name'];
        $balance = 0;

        customer::create($request->all());
        Balance::create(['cus_name'=>$cus_name, 'balance'=>$balance]);
        return redirect(route('customer'))->with('message','Supplier added successfully!');
    }


    public function edit_supplier($id)
    {
        $supplier = supplier::where('id', $id)->get();
        return view('editsupplier', compact('supplier'));
    }

    public function updatesupplier(Request $request, supplier $supplier)
    {
        $request->validate([
            'sup_name' => 'required',

        ]);
        $supplier->update($request->all());
        return redirect('supplier')->with('message', 'Updated Successfully!');
    }

    public function delete(supplier $supplier)
    {
        $supplier->delete();
        return redirect(route('supplier'))->with('message','Deleted Successfully');
    }
}
