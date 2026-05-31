<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function viewAdminProducts()
    {
        $userquery = Auth::user();
        $user = $userquery->role;
        $products = Products::where('category', 'Foods')->get();
        return view($user.'.products', compact('products'));
    }
    public function viewAdminBeverages(){
        $userquery = Auth::user();
        $user = $userquery->role;
        $products = Products::where('category', 'Beverages')->get();
        return view($user.'.products', compact('products'));
    }
    
    public function viewAdminDiscounts(){
        $userquery = Auth::user();
        $user = $userquery->role;
        $products = Products::where('category', 'Discounts')->get();
        return view($user.'.products', compact('products'));
    }

    // public function viewManagerProducts()
    // {
    //     $userquery = Auth::user();
    //     $user = $userquery->role;
    //     $products = Products::all();
    //     return view($user.'.products', compact('products'));
    // }

    // public function viewStaffProducts(){
    //     $userquery = Auth::user();
    //     $user = $userquery->role;
    //     $products = Products::all();
    //     return view($user.'.products', compact('products'));
    // }

    public function store(Request $request)
    {
        // Validate user input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'nullable|string|max:50',
            'stock' => 'required|numeric|min:5|max:20',
            'price' => 'required|numeric|min:0',
            'pic' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
            
        ]);

        $image = $request->file('pic');
        $name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('products'), $name);

        // Create product using Eloquent (timestamps handled automatically)
        Products::create([
            'name' => $request->name, 
            'category' => $request->category,
            'size' => $request->size,
            'stock' => $request->stock,
            'price' => $request->price,
            'pic' => $name
        ]);

        return redirect()->route('products')->with('success', 'Product added successfully.');
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'size' => 'nullable|string|max:50',
            'stock' => 'required|numeric|min:5|max:20',
            'price' => 'required|numeric|min:0',
            'pic' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $product->name = $request->name;
        $product->category = $request->category;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->price = $request->price;
        
        if($request->file('pic')){
            $oldpic = public_path('products/'.$product->pic);

            if(File::exists($oldpic)){
                File::delete($oldpic);
            }

            $newpic = $request->file('pic');
            $name = time().'_'.$newpic->getClientOriginalName();
            $newpic->move(public_path('products'), $name);

            $product->pic = $newpic;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product Updated Successfully!');
    }

    public function exportProductsPdf()
    {
        $userquery = Auth::user();
        $user = $userquery->role;

        $products = Products::all();

        $pdf = Pdf::loadView($user.'.products_pdf', compact('products'));

        return $pdf->download('products_inventory.pdf');
    }

    public function delete($id){
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('products');
    }
}
