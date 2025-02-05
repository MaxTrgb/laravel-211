@if (isset($cartItems) && $cartItems)
    <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="py-3 px-4 text-left">Image</th>
                    <th class="py-3 px-4 text-left">Product</th>
                    <th class="py-3 px-4 text-left">Price</th>
                    <th class="py-3 px-4 text-left">QTY</th>
                    <th class="py-3 px-4 text-left">Total</th>
                    <th class="py-3 px-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $product)
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4"><img src="{{ asset($product['img'] ?? $product->product->image) }}"
                                alt="" class="w-16 h-auto"></td>
                        <td class="py-3 px-4">{{ $product['name'] ?? $product->product->name }}</td>
                        <td class="py-3 px-4">{{ $product['price'] ?? $product->product->price }}</td>
                        <td class="py-3 px-4">{{ $product['quantity'] ?? $product->quantity }}</td>
                        <td class="py-3 px-4">
                            {{ ($product['price'] ?? $product->product->price) * ($product['quantity'] ?? $product->quantity) }}
                        </td>
                        <td class="py-3 px-4">
                            <button class="px-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 update-cart-btn"
                                data-id="{{ $product['id'] ?? $product->product_id }}" data-action="decrease">-</button>
                            {{ $product['quantity'] ?? $product->quantity }}
                            <button class="px-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 update-cart-btn"
                                data-id="{{ $product['id'] ?? $product->product_id }}" data-action="increase">+</button>
                        </td>

                        <td>
                            <button
                                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 remove-product-btn"
                                data-id="{{ $product['id'] ?? $product->product_id }}">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="border p-2 text-right font-bold">Total:</td>
                    <td class="border p-2 text-right font-bold">${{ session('totalSum') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@else
    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md text-center">
        <h1 class="text-3xl">Cart is empty</h1>
    </div>
@endif
