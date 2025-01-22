@extends('templates.main')

@section('content')
    <div class="container mx-auto my-5">
        <div class="flex flex-row justify-evenly">
            <div>
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="rounded max-w-md">
            </div>
            <div class="flex flex-col justify-between text-center">
                <div>
                    <h1 class="text-5xl text-center my-3 text-gray-100">{{ $product->name }}</h1>
                </div>
                <div>
                    <p class="text-lg text-gray-300">${{ $product->price }}</p>
                </div>
                <div>
                    <p class="text-gray-400">{{ $product->description }}</p>
                </div>
                <div>
                    <button class="btn bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md mt-3 add-to-cart-btn" data-id="{{ $product->id }}">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>

        <div class="my-10 flex justify-center items-center">
            <h2 class="text-2xl text-gray-100 my-10">Reviews</h2>
        </div>

        <div>
            @if ($product->reviews->isEmpty())
                <p class="text-gray-400 italic">No reviews yet for this product.</p>
            @else
                @foreach ($product->reviews as $review)
                    <div class="bg-gray-600 shadow-md rounded-lg p-5 my-3">
                        <h5 class="text-xl text-gray-200">{{ $review->name }}</h5>
                        <p class="text-gray-300">{{ $review->review }}</p>
                        <small class="text-gray-500">Reviewed on {{ $review->created_at->format('F d, Y') }}</small>
                    </div>
                @endforeach
            @endif
        </div>

        @auth
            <div class="my-10">
                <h3 class="text-xl text-gray-100">Leave a Review</h3>
                <form action="{{ route('reviews.store', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                    <div>
                        <label for="review" class="block text-gray-300">Your Review</label>
                        <textarea id="review" name="review" class="w-full rounded-lg bg-gray-900 text-gray-100 border border-gray-700 p-3" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Submit Review
                    </button>
                </form>
            </div>
        @else
            <p class="text-gray-400 italic">You must be logged in to leave a review.</p>
        @endauth
    </div>
@endsection
