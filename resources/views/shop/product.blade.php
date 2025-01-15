@extends('templates.main')

@section('content')
    <div class="grid grid-cols-3 gap-4">
        <div>
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img-top">
        </div>
        <div>
            <div>
                <h1 class="text-5xl text-center my-3">{{ $product->name }}</h1>
            </div>
            <div>
                <p class="card-text">${{ $product->price }}</p>
            </div>
            <div>
                <p class="card-text">{{ $product->description }}</p>
            </div>
            <div>
                <button class="btn btn-primary add-to-cart-btn" data-id="{{$product->id}}">
                    Add to Cart
                </button>
            </div>

        </div>
    </div>
@endsection
