@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-gray-800 text-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Todo</h1>

        <div class="mb-4">
            <a href="{{ route('todo.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                CREATE
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-700 border border-gray-600 rounded-lg">
                <thead class="bg-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">TITLE</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">CATEGORY</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">STATUS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ACTION</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach ($todos as $todo)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $todo->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $todo->category ? $todo->category->name : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $todo->is_complete ? 'bg-green-500' : 'bg-blue-500' }}">
                                {{ $todo->is_complete ? 'Completed' : 'Ongoing' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <form action="{{ route('todo.toggle', $todo->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-blue-600 dark:text-blue-400">
                                    {{ $todo->is_done ? 'Mark as Incomplete' : 'Complete' }}
                                </button>
                            </form>
                            <a href="{{ route('todo.edit', $todo) }}" class="text-blue-400 hover:text-blue-600 mr-3">
                                Edit
                            </a>
                            <form action="{{ route('todo.destroy', $todo) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this todo?')">
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
