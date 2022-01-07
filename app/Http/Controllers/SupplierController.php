<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function supplier()
    {
        $suppliers = supplier::orderBy('id','DESC')->get();
        return view('supplier', compact('suppliers'));
        
    }

    public function add_supplier()
    {
    
        
        return view('addsupplier');
    }


   
    public function store(Request $request)
    {

 
        //Validation
        $request->validate([
            'sup_name' => 'required|max:255',
            'sup_add' => 'required|max:255'

        ]);

        supplier::create($request->all());
        return redirect(route('supplier'))->with('message','Supplier added successfully!');
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


}