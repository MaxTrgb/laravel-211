<div class="bg-gray-700 text-white rounded-lg shadow-lg overflow-hidden">
    <div class="p-4">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
        
        <div class="mb-3">
            <a href="{{ route('shop.product', $product->slug) }}">
                <h5 class="text-xl font-semibold text-gray-100 hover:text-primary transition-colors">{{ $product->name }}</h5>
            </a>
        </div>
        
        <div class="flex justify-between items-center">
            <p class="text-lg font-bold text-gray-300">${{ $product->price }}</p>
            <a href="{{ route('shop.product', $product->slug) }}" class="text-primary hover:text-gray-100 transition-colors">View</a>
        </div>
    </div>
</div>
