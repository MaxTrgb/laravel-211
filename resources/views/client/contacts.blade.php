@extends('templates.main')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-100 mb-6">Contacts</h1>

        @include('templates._errors')

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('sendEmail') }}" method="post" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-lg font-medium text-gray-200 mb-2">Name:</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full p-3 bg-gray-700 text-white rounded-lg border border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-lg font-medium text-gray-200 mb-2">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                    class="w-full p-3 bg-gray-700 text-white rounded-lg border border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div class="mb-6">
                <label for="message" class="block text-lg font-medium text-gray-200 mb-2">Message:</label>
                <textarea name="message" rows="6" 
                    class="w-full p-3 bg-gray-700 text-white rounded-lg border border-gray-600 focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="px-8 py-3 bg-primary text-white rounded-lg shadow-md hover:bg-primary-dark transition-colors">Send</button>
            </div>
        </form>
    </div>
@endsection
