<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\userPageController;
use App\Http\Controllers\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(userPageController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'SubcategoryProduct')->name('subcategoryProduct');
    Route::get('/singleProduct/{id}/{slug}', 'SingleProduct')->name('singleProduct');
});

// user route
Route::group(['middleware' => ['auth']], function() {
    Route::controller(ClientController::class)->group(function () {
        Route::post('/add-to-cart', 'AddCartProduct')->name('addCartProduct');
        Route::get('/add-to-cart-product', 'CartProduct')->name('cartProduct');
        Route::get('/remove-cart-product/{id}', 'CartRemove')->name('cartRemove');
        Route::get('/add-sheeping-address', 'SheepingAddressAdd')->name('sheepingAddressAdd');
        Route::post('/shipping-store', 'ShippingStore')->name('shippingStore');
        Route::get('/cart-checkOut', 'CheckOut')->name('checkOut');
        Route::post('/cart-checkOut-store', 'CheckOutStore')->name('checkOutStore');
        Route::get('/order-pending', 'OrderPending')->name('orderPending');
        Route::get('/order-compleate', 'orderCompleate')->name('orderCompleate');
    });
});


// admin route
Route::group(['middleware' => ['auth', 'isAdmin']], function() {
    Route::get("/admin/dashboard", function(){
        return view('admin.index');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/category', 'Category')->name('category');
        Route::get('/admin/all-category', 'AllCategory')->name('allcategory');
        Route::post('/admin/categoryStore', 'CategoryStore')->name('categoryStore');
        Route::get('/admin/categoryEdit/{id}', 'CategoryEdit')->name('categoryEdit');
        Route::post('/admin/categoryUpdate/{id}', 'CategoryUpdate')->name('categoryUpdate');
        Route::get('/admin/categoryDelete/{id}', 'CategoryDelete')->name('categoryDelete');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/sub-category', 'SubCategory')->name('subCategory');
        Route::get('/admin/all-sub-category', 'AllSubCategory')->name('allSubcategory');
        Route::post('/admin/subCategoryStore', 'SubCategoryStore')->name('subCategoryStore');
        Route::get('/admin/subCategoryEdit/{id}', 'SubCategoryEdit')->name('subCategoryEdit');
        Route::post('/admin/subCategoryUpdate/{id}', 'SubCategoryUpdate')->name('subCategoryUpdate');
        Route::get('/admin/subCategoryDelete/{id}', 'SubCategoryDelete')->name('subCategoryDelete');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/product', 'Product')->name('product');
        Route::get('/admin/all-product', 'AllProduct')->name('allProduct');
        Route::post('/admin/productStore', 'ProductStore')->name('productStore');
        Route::get('/admin/editProduct/{id}', 'EditProduct')->name('editProduct');
        Route::post('/admin/productUpdate/{id}', 'ProductUpdate')->name('productUpdate');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'PendingOrder')->name('pendingOrder');
        Route::get('/admin/compleate-order', 'CompleateOrder')->name('compleateOrder');
        Route::post('/admin/compleated-order-status/{id}', 'CompleatedOrderStatus')->name('compleatedOrderStatus');
    });

});
