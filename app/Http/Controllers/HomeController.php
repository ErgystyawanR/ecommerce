<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $totalOrders = Order::where('user_id', $user->id)->count();
        // Assuming you have a Cart model and a method to get the count of items
        $cartItemCount = Cart::count(); // Adjust this based on your implementation

        return view('dashboard', compact('user', 'products', 'totalOrders', 'cartItemCount'));
    }
}
