<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_to_cart(Product $product, Request $request)
    {
        $user_id = Auth::id();
        $product_id = $product->id;

        $availableStock = $product->stock; // Mengambil stok tersedia untuk produk dalam keranjang

        $request->validate(
            [
                'amount' => 'required|numeric|gte:1|lte:' . $availableStock,
            ],
            [
                'amount.lte' => 'The requested quantity exceeds the available stock for this product.',
            ],
        );

        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount,
        ]);

        // Set pesan flash
        Session::flash('success', 'add to cart successfully.');

        return redirect()->route('show_cart');
    }

    public function show_cart()
    {
        $user_id = Auth::id();
        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        // Inisialisasi total harga
        $grandTotal = 0;

        // Iterasi melalui setiap item di keranjang
        foreach ($carts as $cart) {
            // Mengalikan harga produk dengan jumlahnya
            $totalItemPrice = $cart->product->price * $cart->amount;

            // Menambahkan total harga item ke total harga keseluruhan
            $grandTotal += $totalItemPrice;
        }

        return view('show_cart', compact('carts', 'grandTotal'));
    }

    public function update_cart(Cart $cart, Request $request)
    {
        // Mengambil stok tersedia untuk produk dalam keranjang
        $availableStock = $cart->product->stock;

        $request->validate([
            'amount' => [
                'required',
                'numeric',
                'gte:1',
            ],
        ], [
            'amount.gte' => 'The requested quantity must be at least 1.',
        ]);

        // Validasi apakah jumlah yang diminta melebihi stok yang tersedia
        if ($request->amount > $availableStock) {
            // Jika melebihi stok yang tersedia, kembalikan dengan pesan kesalahan
            return redirect()->back()->withErrors(['amount' => 'The requested quantity exceeds the available stock for this product.']);
        }

        // Memperbarui jumlah barang pada keranjang
        $cart->update([
            'amount' => $request->amount,
        ]);

        // Set a success flash message
        session()->flash('success', 'Cart item updated successfully.');

        // Mengirim kembali data keranjang ke tampilan
        return redirect()->back();
    }



    public function delete_cart(Cart $cart)
    {
        $cart->delete();

        // Set a success flash message
        session()->flash('success', 'Cart item deleted successfully.');

        // Redirect back to the show_cart method to reload the cart data
        return redirect()->route('show_cart');
    }
}
