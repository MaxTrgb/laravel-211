@extends('admin.templates.main')

@section('content')
    <h1>Create Category</h1>

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="mb-3">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection