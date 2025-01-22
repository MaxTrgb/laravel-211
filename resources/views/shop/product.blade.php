@extends('templates.main')

@section('content')
    <div class="container my-5">
        <div class="d-flex flex-row gap-5">
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
                    <button class="btn btn-primary add-to-cart-btn" data-id="{{ $product->id }}">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
        <div class="my-5 d-flex align-items-center justify-content-center">
            <h2>Reviews</h2>
        </div>

        <div>
            @if ($product->reviews->isEmpty())
                <p class="text-muted">No reviews yet for this product.</p>
            @else
                @foreach ($product->reviews as $review)
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $review->name }}</h5>
                            <p class="card-text">{{ $review->review }}</p>
                            <small class="text-muted">Reviewed on {{ $review->created_at->format('F d, Y') }}</small>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        @auth
            <div class="my-5">
                <h3>Leave a Review</h3>
                <form action="{{ route('reviews.store', $product) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="review">Your Review</label>
                        <textarea id="review" name="review" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                </form>
            </div>
        @else
            <p class="text-muted">You must be logged in to leave a review.</p>
        @endauth
    </div>
@endsection
