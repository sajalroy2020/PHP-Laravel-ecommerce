<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Category(){
        return view('admin.category');
    }

    public function AllCategory(){
        $categoryes = Category::latest()->get();
        return view('admin.all_category', compact('categoryes'));
    }

    public function CategoryStore(Request $request){
        $request->validate([
            'catName'=>'required|unique:categories',
        ]);
        Category::insert([
            'catName'=> $request->catName,
            'slug'=> strtolower(str_replace('','-',$request->catName)),
        ]);
        return redirect()->route('allcategory')->with('message', 'Category added successfully');
    }

    public function CategoryEdit($id){
        $categoryInfo = Category::findOrFail($id);
        return view('admin.category_edit', compact('categoryInfo'));
    }

    public function CategoryUpdate(Request $request, $id){
        $request->validate([
            'catName'=>'required|unique:categories',
        ]);
        Category::findOrFail($id)->update([
            'catName'=> $request->catName,
        ]);
        return redirect()->route('allcategory')->with('message', 'Category updated successfully');
    }

    public function CategoryDelete($id){
        Category::findOrFail($id)->delete();
        return redirect()->route('allcategory')->with('message', 'Category deleted successfully');

    }
}
