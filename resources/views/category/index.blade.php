@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-gray-800 text-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Todo Category</h1>

        <div class="mb-4">
            <a href="{{ route('categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                CREATE
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-700 border border-gray-600 rounded-lg">
                <thead class="bg-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">NAME</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">TODOS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->todos_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this category?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
