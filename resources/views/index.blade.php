@extends('templates.main')

@section('content')
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4">
                <div class="category-card text-center mb-4 p-3 border">
                    <h3 class="mb-3 text-primary">{{ $category->name }}</h3>
                    <p>{{ $category->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
