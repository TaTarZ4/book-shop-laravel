<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function store(Request $request)
    {
        $newStock = new Stock();
        $newStock->book_id = $request->book_id;
        $newStock->qty = $request->qty;
        $newStock->save();

        $book = Book::find($request->book_id);
        $book->qty = $book->qty + $request->qty;
        $book->save();

        return response()->json(['success'=>'success' , 'book' => $book]);
    }
}
