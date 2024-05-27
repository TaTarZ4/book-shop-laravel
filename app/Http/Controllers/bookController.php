<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Category_book;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\CssSelector\Node\FunctionNode;

class bookController extends Controller
{
    public function stocks() 
    {
        $books = Book::all();
        // dd($books);
        return view('stocks')->with([
            'books' => $books
        ]);
    }

    public function pos()
    {   
        $books = Book::all();
        // dd($books);
        return view('pos')->with([
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
        // $category_book = Category::whereHas('category_book' , function($query) use ($request){
        //     $query->where('book_id' , $request->id);
        // })->get('name');
        // $book->categories = $category_book;
        // dd($book->category_book);
        return view('book.show')->with([
            'book' => $book
        ]);
    }

    public function create() 
    {   
        $categories = Category::all();
        return view('book.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request) 
    {
        $newBook = new Book;
        $newBook->name = $request->name;
        $newBook->image = $request->image;
        $newBook->price = $request->price;
        $newBook->qty = $request->qty;
        $newBook->description = $request->description;
        $newBook->save();
        
        $stocks = new Stock;
        $stocks->qty = $request->qty;
        $stocks->save();

        $newBook->category_book()->attach($request->categories);
        // dd($categories);
        // foreach($categories as $category){
        //     $newCategory_book = new Category_book;
        //     $newCategory_book->book_id = $newBook->id;
        //     $newCategory_book->category_id = $category;
        //     $newCategory_book->save();
        // }
        return redirect()->route('book.index');
    }

    public function edit(Request $request) 
    {
        $book = Book::find($request->id);
        $categories = Category::all();

        return view('book.edit')->with([
            'book' => $book,
            'categories' => $categories
        ]);
    }

    public function update(Request $request) 
    {
        $updateBook = Book::find($request->id);
        $updateBook->name = $request->name;
        $updateBook->image = $request->image;
        $updateBook->price = $request->price;
        $updateBook->qty = $request->qty;
        $updateBook->description = $request->description;
        $updateBook->category_book()->sync($request->categories);
        $updateBook->save();

        // dd($updateBook);
        return redirect()->route('book.index');
    }

    
    public function delete(Request $request) 
    {
        $book = Book::find($request->id);
        $book->category_book()->detach();
        $book->delete();
        return redirect()->back();
    }

}
