@extends('templates.main')

@section('content')
    <div class="container mx-auto my-10">
        <h1 class="text-4xl font-bold text-center text-gray-100 mb-10">{{ $category->name }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($products as $product)
                @include('shop._product_card')
            @empty
                <p class="text-center text-gray-400 col-span-full">No products available in this category.</p>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
