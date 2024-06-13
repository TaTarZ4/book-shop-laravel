<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderBook;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class OrderController extends Controller
{
    public function store(Request $request){
        $newOrder = new Order;
        if($request->customer){
            $customer = Customer::where('phone' , $request->customer)->first();
            if($customer){
                $newOrder->customer_id = $request->customer_id;
            }
        }
        $newOrder->cash = $request->cash;
        $newOrder->save();

        for($i = 0 ; $i < count($request->id); $i++){
            $newOrderBook = new OrderBook;
            $newOrderBook->order_id = $newOrder->id;
            $newOrderBook->book_id = $request->id[$i];
            $newOrderBook->qty = $request->qty[$i];
            $newOrderBook->save();
        }

        return view('order.create')->with([
            'id' => $newOrder->id
        ]);
    }

    public function show(Request $request)
    {
        $order = Order::find($request->id);
        $orderBooks = OrderBook::where('order_id' , $request->id)->get();

        // dd($orderBooks[1]->order);

        return view('order.show')->with([
            'order' => $order,
            'orderBooks' => $orderBooks
        ]);
    }
}
