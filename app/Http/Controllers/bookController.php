<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Category_book;
use Illuminate\Database\Eloquent\Builder;

class bookController extends Controller
{
    public function dashboard() 
    {
        $books = Book::all();
        // dd($books);
        return view('dashboard')->with([
            'books' => $books
        ]);
    }

    public function get() 
    {
        $books = Book::all();
        // dd($books);
        return response()->json([
            'books' => $books
        ]);
    }

    public function index() 
    {
        $books = Book::all();
        // dd($books);
        return view('book.index')->with([
            'books' => $books
        ]);
    }
    
    public function show(Request $request) 
    {
        $book = Book::find($request->id);
        $category_book = Category::whereHas('category_book' , function($query) use ($request){
            $query->where('book_id' , $request->id);
        })->get('name');
        $book->categories = $category_book;
    // dd($book->category[1]->name);
        return view('book.show')->with([
            'book' => $book
        ]);
    }

    public function create() 
    {
        return view('book.create');
    }

    public function store(Request $request) 
    {
        $newBook = new Book;
        $newBook->name = $request->name;
        $newBook->image = $request->image;
        $newBook->price = $request->price;
        $newBook->description = $request->description;
        $newBook->save();

        return redirect()->route('book.dashboard');
    }

    public function edit(Request $request) 
    {
        $book = Book::find($request->id);

        return view('book.edit')->with([
            'book' => $book
        ]);
    }

    public function update(Request $request) 
    {
        $updateBook = Book::find($request->id);
        $updateBook->name = $request->name;
        $updateBook->image = $request->image;
        $updateBook->price = $request->price;
        $updateBook->description = $request->description;
        $updateBook->save();

        // dd($updateBook);
        return redirect()->route('book.dashboard');
    }

    
    public function delete(Request $request) 
    {
        $book = Book::find($request->id);
        $book->delete();
        return redirect()->back();
    }

}
