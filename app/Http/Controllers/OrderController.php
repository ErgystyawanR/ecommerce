<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Transient;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if ($carts == null) {
            return redirect()->route('products');
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);
            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product->id,
            ]);

            $cart->delete();
        }

        // Set pesan flash
        Session::flash('success', 'Product checked out successfully');
        return redirect()->route('order');
    }

    public function index_order()
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if ($is_admin) {
            $orders = Order::latest()->get();
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->get();
        }

        return view('index_order', compact('orders'));
    }

    public function show_order(Order $order)
    {
        $user = Auth::user();
        $is_admin = $user->is_admin;
        if ($is_admin || $order->user_id == $user->id) {
            return view('show_order', compact('order'));
        }

        return redirect()->route('order');
    }

    public function submit_payment_receipt(Order $order, Request $request)
    {
        $file = $request->file('payment_receipt');

        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $order->update([
            'payment_receipt' => $path,
        ]);

        // Set pesan flash
        Session::flash('success', 'Wait for admin confirmation.');
        return redirect()->back();
    }

    public function confirm_payment(Order $order)
    {
        $order->update([
            'is_paid' => true,
        ]);
        // Set pesan flash
        Session::flash('success', 'Order has been confirm.');
        return redirect()->back();
    }

    public function delete_order($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        // Check if the order exists and belongs to the logged-in user
        if ($order && $order->user_id === Auth::id()) {
            // Delete the order
            $order->delete();
            return redirect()->route('order')->with('success', 'Order deleted successfully.');
        }

        // Redirect back with an error message if the order doesn't exist or doesn't belong to the user
        return redirect()->route('order')->with('error', 'Unable to delete order.');
    }
}
