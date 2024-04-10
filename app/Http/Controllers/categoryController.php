<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('book/categories/categories');
    }
    public function get() 
    {
        $categories = Category::all();
        // $data = [
        //     'id' => $categories->id,
        //     'name' => $categories->name
        // ];
        
        return response()->json([
            'data' => $categories
        ]);
    }

    public function show(Request $request) 
    {
        $category = Category::find($request->id);
        
        return response()->json([
            'data' => $category
        ]);
    }

    public function store(Request $request)
    {
        $categories = new Category;
        $categories->name = $request->name;
        $categories->save();

        return response()->json([
            'status' => 'success' ,
            'data' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $categories = Category::find($request->id);
        $categories->name = $request->name;
        $categories->save();

        return response()->json([
            'status' => 'success' ,
            'data' => $categories
        ]);
    }

    public function delete(Request $request)
    {   
        $categories = Category::find($request->id);
        $categories->delete();

        if($categories){
            return response()->json([
                'status' => 'success' ,
                'data' => $categories
            ]);
        }else{
            return response()->json([
                'status' => 'not have categories this'
            ]);
        }
    }
}
