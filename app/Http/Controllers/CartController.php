<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProduct(Product $product)
    {
        $qty = 1;

        if (Session::has("cart.$product->id")) {
            $qty += Session::get("cart.{$product->id}")['quantity'];
        }

        if (Auth::check()) {
            $cartItem = CartItem::firstOrNew([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);

            $cartItem->quantity = ($cartItem->quantity ?? 0) + 1;
            $cartItem->created_at = $cartItem->created_at ?? now();
            $cartItem->updated_at = now();
            $cartItem->save();

            $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        } else {
            Session::put("cart.{$product->id}", [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $qty,
                'img' => $product->image,
            ]);

            $cartItems = Session::get('cart', []);
        }

        $this->totalSum();
        return view('shop._cart_mini', ['cartItems' => $cartItems]);
    }


    function removeProduct(Product $product)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->delete();
        } else {
            Session::forget("cart.{$product->id}");
        }

        $this->totalSum();
        return view('shop._cart_mini');
    }

    function clear(Product $product)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            Session::forget("cart");
        }

        Session::forget("totalSum");
        return view('shop._cart_mini');
    }

    private function totalSum()
    {
        $sum = 0;

        if (Auth::check()) {
            $sum = CartItem::where('user_id', Auth::id())
                ->get()
                ->sum(fn($item) => $item->product->price * $item->quantity);
        } else {
            foreach (Session::get('cart', []) as $item) {
                $sum += $item['price'] * $item['quantity'];
            }
        }

        Session::put('totalSum', $sum);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('id');
        $action = $request->input('action');

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                if ($action === 'increase') {
                    $cartItem->quantity += 1;
                } elseif ($action === 'decrease' && $cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                }
                $cartItem->updated_at = now();
                $cartItem->save();
            }
        } else {
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
        }

        return response()->json([
            'cart' => view('shop._cart_mini')->render(), // Render the updated cart HTML
            'totalSum' => session('totalSum')
        ]);
    }
}
