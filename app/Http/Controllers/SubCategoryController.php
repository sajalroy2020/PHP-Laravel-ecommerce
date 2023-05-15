<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategory(){
        $categorys = Category::latest()->get();
        return view('admin.sub_category', compact('categorys'));
    }

    public function AllSubCategory(){
        $allSubCategoryes = SubCategory::latest()->get();
        return view('admin.all_sub_category', compact('allSubCategoryes'));
    }

    public function SubCategoryStore(Request $request){
        $request->validate([
            'subCatName'=>'required|unique:sub_categories',
            'catId'=>'required',
        ]);

        $category_id = $request->catId;
        $category_name = Category::where('id', $category_id)->value('catName');

        SubCategory::insert([
            'subCatName'=> $request->subCatName,
            'slug'=> strtolower(str_replace('','-',$request->subCatName)),
            'catId'=> $category_id,
            'catName'=> $category_name,
        ]);

        Category::where('id', $category_id)->increment('subCatCount', 1);
        return redirect()->route('allSubcategory')->with('message', 'sub category added successfully');
    }

    public function SubCategoryEdit($id){
        $editSubCatData = SubCategory::findOrFail($id);
        return view('admin.edit_subCategory', compact('editSubCatData'));
    }

    public function SubCategoryUpdate(Request $request, $id){
        $request->validate([
            'subCatName'=>'required|unique:sub_categories',
        ]);
        SubCategory::findOrFail($id)->update([
            'subCatName'=> $request->subCatName,
            'slug'=> strtolower(str_replace('','-',$request->subCatName)),
        ]);
        return redirect()->route('allSubcategory')->with('message', 'sub category updated successfully');
    }

    public function SubCategoryDelete($id){
        $catId = SubCategory::where('id', $id)->value('catId');
        SubCategory::findOrFail($id)->delete();
        Category::where('id', $catId)->decrement('subCatCount', 1);

        if (Category::where('id', $catId)->value('subCatCount') == -1) {
            Category::where('id', $catId)->increment('subCatCount', 1);
        }

        return redirect()->route('allSubcategory')->with('message', 'sub category deleted successfully');
    }
}
