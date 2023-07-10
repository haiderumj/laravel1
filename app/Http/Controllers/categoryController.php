<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
 use Illuminate\Support\Carbon;
 class categoryController extends Controller
 {
     public function AllCat()
     {
         $categories = Category::latest()->get();
         return view('admin.category.index', compact('categories'));
     }
 
     public function AddCat(Request $request)
     {
         $validatedData = $request->validate([
             'category_name' => 'required|unique:categories|max:255',
         ], [
             'category_name.required' => 'Please input Category Name',
         ]);
 
         Category::insert([
             'category_name' => $request->category_name,
             'user_id' => Auth::user()->id,
             'created_at' => Carbon::now()
         ]);
 
         return redirect()->back()->with('success', 'Category inserted successfully');
     }
 }
 
