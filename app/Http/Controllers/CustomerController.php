<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function checkId(Request $request)
    {
        $customer = Customer::where('phone' , $request->phone)->first();

        if($customer){
            return response()->json([
                'status' => 'Member'
            ]);
        }else{
            return response()->json([
                'status' => 'Not Member'
            ]);
        }
    }

    public function index()
    {
        // $customers = Customer::all();
        return view('customer.index');
    }

    public function getCustomer()
    {
        $customers = Customer::all();

        return response()->json([
            'customers' => $customers
        ]);
    }

    public function store(Request $request)
    {
         $newCustomer = new Customer;
         $newCustomer->name = $request->name;
         $newCustomer->phone = $request->phone;
         $newCustomer->save();
         
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function update(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->save();

        return response()->json([
            'status' => 'success',
            'data' => $customer
        ]);
    }

    public function destroy(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
