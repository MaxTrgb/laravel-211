<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    function category(Category $category)
    {
        $products = $category->products()->paginate(12);
        return view('shop.category', compact('category', 'products'));
    }
    function product(Product $product)
    {
        $product->load(['reviews' => function ($query) {
            $query->latest()->paginate(5);
        }]);
        return view('shop.product', compact('product'));
    }
    public function storeReview(Request $request, Product $product)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to leave a review.');
        }

        $request->validate([
            'review' => 'required|string',
        ]);

        $product->reviews()->create([
            'name' => auth()->user()->name,
            'review' => $request->review,
        ]);

        return redirect()->route('shop.product', ['product' => $product->slug])->with('success', 'Review added successfully!');
    }
}
