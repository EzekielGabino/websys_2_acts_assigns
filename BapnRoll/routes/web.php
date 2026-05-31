<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('login.login');
});
//login & Validations
Route::get('/login', [UserController::class, 'index']);
Route::post('/login', [UserController::class, 'UserLoginValidation'])->name('login.UserLoginValidation');
Route::middleware('auth')->group( function(){
    Route::get('/dashboard/',[UserController::class, 'dashboard']) ->name('admin.dashboard');

    Route::get('/manager/', [UserController::class, 'dashboard'])->name('manager.dashboard');

    Route::get('/staff/', [ProductController::class, 'viewAdminProducts'])->name('staff.products');
});

//logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// example for signin of users
Route::post('/signin', [UserController::class, 'storeUser'])->name('users.add');



//admin page
Route::middleware('auth')->group( function(){

    //add product
    Route::get('/products/foods', [ProductController::class, 'viewAdminProducts'])->name('products');
    Route::post('/products/foods', [ProductController::class, 'store'])->name('products.store');
    
    //update product
    Route::put('/products/update/{id?}', [ProductController::class, 'update'])->name('products.update');

    //delete product
    Route::delete('/products/delete/{id?}', [ProductController::class, 'delete'])->name('products.delete');

    //export product
    Route::get('/products/export/pdf', [ProductController::class, 'exportProductsPdf'])->name('products.export.pdf');

    //export completed orders
    Route::get('/orders/export/pdf', [OrdersController::class, 'exportOrdersPdf'])->name('orders.export.pdf');

    //for beverage
    Route::get('/products/beverages', [ProductController::class, 'viewAdminBeverages'])->name('beverages');
    Route::post('/products/beverages', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/discounts', [ProductController::class, 'viewAdminDiscounts'])->name('discounts');
    Route::post('/products/discounts', [ProductController::class, 'store'])->name('products.store');

    //add to orders preview
    Route::post('/addOrders/',[OrdersController::class, 'addtoOrders'])->name('orders.create');
    Route::post('/cancelOrders', [OrdersController::class, 'cancelOrders'])->name('order.cancel');

    //add to orders
    Route::post('/orders/', [OrdersController::class, 'store'])->name('orders.store');
    
    //update orders to completed
    Route::get('/orders/done', [OrdersController::class, 'viewOrdersCompleted'])->name('orders.done');
    Route::put('/orders/completed/{id?}', [OrdersController::class, 'orderComplete'])->name('orders.complete');
    
    //update orders to cancelled
    Route::get('/orders/cancel', [OrdersController::class, 'viewOrdersCancelled'])->name('orders.cancel');
    Route::put('/orders/cancelled/{id?}', [OrdersController::class, 'orderCancelled'])->name('orders.cancelled');

    //view pending orders
    Route::get('/orders/pending',[OrdersController::class, 'viewOrdersPending'])->name('orders.pending');

    //delete orders
    Route::post('/orders/delete/{id?}', [OrdersController::class, 'destroy'])->name('orders.delete');
    
    //view users
    Route::get('/users', [UserController::class, 'showUsers'])->name('users');

    //add users
    Route::get('/users/add', [UserController::class, 'addUser'])->name('user.add');

    //update users
    Route::put('/users/update/{id?}', [UserController::class, 'updateUser'])->name('user.update');

    //delete users
    Route::delete('/users/delete/{id?}', [UserController::class, 'deleteUser'])->name('user.delete');
});

// //manager page
// Route::middleware('auth')->group( function(){
//     //add product
//     Route::get('/admin/products/foods', [ProductController::class, 'viewAdminProducts'])->name('manager.products');
//     Route::post('/admin/products/foods', [ProductController::class, 'store'])->name('manager.products.store');

//     //update product
//     Route::put('/admin/products/update/{id?}', [ProductController::class, 'update'])->name('manager.products.update');

//     //delete product
//     Route::delete('/admin/products/delete/{id?}', [ProductController::class, 'delete'])->name('admin.products.delete');

//     //export product
//     Route::get('/products/export/pdf', [ProductController::class, 'exportProductsPdf'])->name('admin.products.export.pdf');

//     //for beverage
//     Route::get('/admin/products/beverages', [ProductController::class, 'viewAdminBeverages'])->name('admin.beverages');
//     Route::post('/admin/products/beverages', [ProductController::class, 'store'])->name('admin.products.store');

//     //add to orders preview
//     Route::post('/admin/addOrders/',[OrdersController::class, 'addtoOrders'])->name('admin.orders.create');
//     Route::post('/admin/cancelOrders', [OrdersController::class, 'cancelOrders'])->name('admin.order.cancel');

//     //add to orders
//     Route::post('/admin/orders/', [OrdersController::class, 'store'])->name('admin.orders.store');
    
//     //update orders to completed
//     Route::get('/orders/done', [OrdersController::class, 'viewOrdersCompleted'])->name('admin.orders.done');
//     Route::put('/orders/completed/{id?}', [OrdersController::class, 'orderComplete'])->name('admin.orders.complete');
    
//     //update orders to cancelled
//     Route::get('/orders/cancel', [OrdersController::class, 'viewOrdersCancelled'])->name('admin.orders.cancel');
//     Route::put('/orders/cancelled/{id?}', [OrdersController::class, 'orderCancelled'])->name('admin.orders.cancelled');

//     //view pending orders
//     Route::get('/orders/pending',[OrdersController::class, 'viewOrdersPending'])->name('admin.orders.pending');

//     //delete orders
//     Route::post('/orders/delete/{id?}', [OrdersController::class, 'destroy'])->name('admin.orders.delete');
// });

// Route::middleware('auth')->group( function(){
//     Route::get('/staff/products', [ProductController::class, 'viewStaffProducts'])->name('staff.products');
// });




