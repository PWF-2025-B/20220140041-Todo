@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-gray-800 text-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white" required>
            </div>

            <div class="flex items-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Save
                </button>
                <a href="{{ route('categories.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
