@extends('templates.main')

@section('content')
    <h1 class="text-5xl text-center my-3">{{ $category->name }}</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($products as $product)
            @include('shop._product_card')
        @endforeach
    </div>


    {{ $products->links() }}
@endsection
