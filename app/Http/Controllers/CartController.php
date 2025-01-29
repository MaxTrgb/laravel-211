<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function addProduct(Product $product)
    {
        $qty = 1;

        if (Session::has("cart.$product->id")) {
            $qty += Session::get("cart.{$product->id}")['quantity'];
        }

        Session::put("cart.{$product->id}", [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $qty,
            'img' => $product->image,
        ]);

        $this->totalSum();
        return view('shop._cart_mini');
    }

    function removeProduct(Product $product)
    {
        Session::forget("cart.{$product->id}");
        $this->totalSum();
        return view('shop._cart_mini');
    }

    function clear(Product $product)
    {
        Session::forget("cart");
        Session::forget("totalSum");
        return view('shop._cart_mini');
    }

    private function totalSum()
    {
        $sum = 0;
        foreach (Session::get('cart') as $item) {
            $sum += $item['price'] * $item['quantity'];
        }
        Session::put('totalSum', $sum);
    }
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->input('id');
        $action = $request->input('action');

        if (isset($cart[$productId])) {
            if ($action === 'increase') {
                $cart[$productId]['quantity'] += 1;
            } elseif ($action === 'decrease' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity'] -= 1;
            }
            session()->put('cart', $cart);
        }
        
        $totalSum = array_reduce($cart, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
        session()->put('totalSum', $totalSum);

        return response()->json(['cart' => $cart, 'totalSum' => $totalSum]);
    }
}
