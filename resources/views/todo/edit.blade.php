@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-gray-800 text-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Edit Todo</h1>

        <form action="{{ route('todo.update', $todo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $todo->title) }}" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white" required>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium mb-2">Category</label>
                <select name="category_id" id="category_id" class="w-full bg-gray-700 border border-gray-600 rounded-md py-2 px-3 text-white">
                    <option value="">Empty</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $todo->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Save
                </button>
                <a href="{{ route('todo.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
