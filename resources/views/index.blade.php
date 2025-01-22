@extends('templates.main')

@section('content')
    <div class="container mx-auto py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
            @foreach ($categories as $category)
                <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg hover:bg-gray-600">
                    <h3 class="text-2xl font-semibold text-primary mb-3">{{ $category->name }}</h3>
                    <p class="text-gray-300">{{ $category->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
