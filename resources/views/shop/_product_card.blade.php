<div class="card bg-dark text-white border-white">
    <div class="card bg-dark text-white border-white">
        <div class="card-body">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img-top"
                style="width: 100px; height: auto;">
            <div class="my-3">
                <a href="{{ route('shop.product', $product->slug) }}">
                    <h5 class="card-title text-primary">{{ $product->name }}</h5>
                </a>
            </div>

            <div>
                <p class="card-text">${{ $product->price }}</p>
            </div>
        </div>
    </div>

</div>
