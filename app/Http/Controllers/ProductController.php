<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function Product(){
        $categorys = Category::latest()->get();
        $subCategorys = SubCategory::latest()->get();
        return view('admin.product', compact('categorys', 'subCategorys'));
    }

    public function AllProduct(){
        $products_all = Product::latest()->get();
        return view('admin.all_product', compact('products_all'));
    }

    public function ProductStore(Request $request){
        $request->validate([
            'product_name'=>'required|unique:products',
            'product_short_des'=>'required',
            'product_long_des'=>'required',
            'price'=>'required',
            'product_img'=>'required|image|mimes:jpg,png,jpeg,svg',
        ]);
        $category_id = $request->product_category_id;
        $sub_category_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('catName');
        $sub_category_name = SubCategory::where('id', $sub_category_id)->value('subCatName');

        $imgPath = '';
         if($image = $request->file('product_img')){
            $imgPath = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('storage/images/products'), $imgPath);
         }
        DB::beginTransaction();
        Product::insert([
            'product_name'=>$request->product_name,
            'product_short_des'=>$request->product_short_des,
            'product_long_des'=>$request->product_long_des,
            'price'=>$request->price,
            'product_category_id'=>$category_id,
            'product_category_name'=> $category_name,
            'product_subcategory_id'=>$sub_category_id,
            'product_subcategory_name'=>$sub_category_name,
            'product_img'=>$imgPath,
            'slug'=>strtolower(str_replace('','-',$request->product_name)),
        ]);
        Category::where('id', $category_id)->increment('productCount', 1);
        SubCategory::where('id', $sub_category_id)->increment('productCount', 1);
        DB::commit();
        return redirect()->route('allProduct')->with('message', 'product added successfully');
    }

    public function EditProduct($id){
        $editProduct = Product::findOrFail($id);
        return view('admin.edit_product', compact('editProduct'));
    }


    public function ProductUpdate(Request $request, $id){

        $updateData = Product::findOrFail($id);
        $imgPath = '';
        $deleteOldImg = 'storage/images/products/'.$updateData->product_img;

        if($image = $request->file('product_img')){
           if (File::exists($deleteOldImg)) {
              File::delete($deleteOldImg);
           }
           $imgPath = time().'.'.$image->getClientOriginalExtension();
           $image->move('storage/images/products', $imgPath);
        }else{
           $imgPath = $updateData->product_img;
        }

        Product::findOrFail($id)->update([
            'product_name'=>$request->product_name,
            'product_short_des'=>$request->product_short_des,
            'product_long_des'=>$request->product_long_des,
            'price'=>$request->price,
            'product_img'=>$imgPath,
            'slug'=>strtolower(str_replace('','-',$request->product_name)),
        ]);
        return redirect()->route('allProduct')->with('message', 'product updade successfully');
    }

}
