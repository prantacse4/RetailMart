<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function balance()
    {
        $balances = Balance::orderBy('id','DESC')->get();
        return view('payments', compact('balances'));
        
    }

    public function add_balance()
    {
        $balances = Balance::orderBy('id','DESC')->get();
        return view('addbalance',compact('balances'));
    }


   
    public function store(Request $request)
    {

        $data = $request->input();
        $id = $data['cus_id'];
        $balance = $data['balance'];
        $be_balance = Balance::where('id', $id)->get();
        $before_balance = 0;
        foreach ($be_balance as $be_balance) {
            $before_balance = $be_balance->balance;
        }
        $new_balance = $before_balance+$balance;
        $balance = Balance::find($id);
        $balance->balance = $new_balance;
        $balance->save();


        return redirect(route('balance'))->with('message','Payment added successfully!');
    }
}
