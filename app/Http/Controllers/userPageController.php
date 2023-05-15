<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class userPageController extends Controller
{
    public function SubcategoryProduct($id){
        $category = Category::findorFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('subcategoryProduct', compact('category', 'products' ));
    }

    public function SingleProduct($id){
        $product = Product::findorFail($id);
        $subcatId = Product::where('id', $id)->value('product_subcategory_id');
        $relatedProducts = Product::where('product_subcategory_id', $subcatId)->latest()->get();
        return view('singleProduct', compact('product', 'relatedProducts'));
    }
}
