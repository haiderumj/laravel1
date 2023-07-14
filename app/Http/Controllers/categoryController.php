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
        $categories = Category::latest()->paginate(4); // Assuming you want 10 categories per page
        $trachCat = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories','trachCat'));
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

     public function Edit($id){
        $categories = Category::find($id);
          return view('admin.category.edit',compact('categories'));
     }

     public function Update(Request $request, $id)
{
    $update = Category::find($id)->update([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id
    ]);

    return redirect()->route('all.category')->with('success', 'Category inserted successfully');

}
public function SoftDelete($id){
    $delete = Category::find($id)->delete();

    return Redirect()->back()->with('success', 'Category Delete successfully');
     } 

public function Restore($id)
{
    $restore = Category::withTrashed()->find($id)->restore();
    return redirect()->back()->with('success', 'Category restored successfully');
}

public function Pdelete($id)
{
    $restore = Category::onlyTrashed()->find($id)->forceDelete();
    return redirect()->back()->with('success', 'Category Permenently delete successfully');
}


    }
 
