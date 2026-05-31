<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Support\now;

class OrdersController extends Controller
{

    public function addtoOrders( Request $request ){

        $product_id = $request->product_id;
        $quantity = $request->quantity;

        $product = Products::findOrFail($product_id);
        
        $total = $product->price * $quantity;

        $orders = session('orders', []);

        $found = false;

        foreach($orders as $key => $items){
            if($items['product_id'] == $product_id){
                $orders[$key]['quantity'] += $quantity;
                $orders[$key]['total'] = $orders[$key]['quantity'] * $orders[$key]['price'];
                $found = true;
                break;
            }
        }

        if(!$found){
            $orders[] = [
                'product_id' => $product->id,
                'product_cat' => $product->category,
                'product_name' => $product->name,
                'price' => $product->category == 'Discounts' ? $product->price * 0.80 : $product->price,
                'quantity' => $quantity,
                'total' => $product->category == 'Discounts' ? $total * 0.80 : $total,
            ];
        }
        
        session(['orders' => $orders]);

        return back();
    }
    public function cancelOrders(){

        session()->forget('orders');

        return back()->with(['success' => 'Orders Preview Cancelled']);
    }

    public function viewOrdersPending(){
        $orders = Orders::with('items')->where('status', 'pending')->get();
        return view('admin.orders', compact('orders'));
    }

    public function viewOrdersCompleted(){
        $orders = Orders::with('items')->where('status', 'completed')->get();
        return view('admin.orders', compact('orders'));
    }

    public function viewOrdersCancelled(){
        $orders = Orders::with('items')->where('status', 'cancelled')->get();
        return view('admin.orders', compact('orders'));
    }

    public function orderComplete(Request $request,$id){
        $orders = Orders::findOrFail($id);
        
        $statusNew = "Completed";
        $orders->update([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'status' => $statusNew,
            'updated_At' => time().now()
        ]);

        return redirect()->route('orders.done')->with('success', 'Order Completed!');
    }

    public function orderCancelled(Request $request, $id){
        $orders = Orders::findOrFail($id);

        $statusNew = "Cancelled";
        $orders->update([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'status' => $statusNew
        ]);
        $orderitem = OrderItem::where('orders_id', $orders->id)->get();
        
        foreach($orderitem as $item){
            $products = Products::findOrFail($item->products_id);

            $products->update([
                'stock' => $products->stock + $item->quantity
            ]);
        }
        return redirect()->route('orders.cancel')->with('success', 'Order Cancelled');
    }

   public function store(Request $request)
    {
        $orders = session('orders', []);
        $user_id = Auth::id();

        $request->validate([
            'quantity.*' => 'required|integer|min:1',
        ]);

        $order = Orders::create([
            'user_id' => $user_id,
            'total' => 0
        ]);

        $grandTotal = 0;
        $quantities = $request->input('quantity', []);
        $prices = $request->input('orders_price', []);

        foreach ($orders as $index => $item) {
            $quantity = $quantities[$index] ?? $item['quantity'];
            $price = $prices[$index] ?? $item['price'];
            $subtotal = $price * $quantity;
            $grandTotal += $subtotal;

            OrderItem::create([
                'orders_id' => $order->id,
                'products_id' => $item['product_id'],
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal,
            ]);


            $products = Products::findOrFail($item['product_id']);
            $stock = $products->stock;    

            $products->update([
                'stock' => $stock - $quantity
            ]);
        }

        $order->update(['total' => $grandTotal]);

        session()->forget('orders');

        return redirect()->route('orders.pending')
            ->with('success', 'Order placed successfully');
    }

    public function exportOrdersPdf()
    {
        $userquery = Auth::user();
        $user = $userquery->role;

        $orders = Orders::with('items')->where('status', 'completed')->get();

        $pdf = Pdf::loadView($user.'.orders_pdf', compact('orders'));

        return $pdf->download('completed_orders.pdf');
    }

    public function destroy($id)
    {
        $orders = Orders::findOrFail($id);
        $orders->delete();

        return redirect()->route('orders.pending');
    }
}
