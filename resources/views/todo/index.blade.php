<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <x-create-button href="{{ route('todo.create') }}" />
                    </div>

                    <div class="mt-4">
                        @if (session('success'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                               x-init="setTimeout(() => show = false, 5000)"
                               class="text-sm text-green-600 dark:text-green-400">
                                {{ session('success') }}
                            </p>
                        @endif

                        @if (session('danger'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                               x-init="setTimeout(() => show = false, 5000)"
                               class="text-sm text-red-600 dark:text-red-400">
                                {{ session('danger') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase text-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($todos) > 0)
                                @foreach($todos as $todo)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <a href="{{ route('todo.edit', $todo->id) }}" class="hover:underline">
                                                {{ $todo->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (!$todo->is_complete)
                                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                    Ongoing
                                                </span>
                                            @else
                                                <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    Completed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="inline-flex space-x-2">
                                                {{-- Action button --}}
                                                @if ($todo->is_complete == false)
                                                    <form action="{{ route('todo.complete', $todo) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 dark:text-green-400">
                                                            Complete
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('todo.uncomplete', $todo) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-blue-600 dark:text-blue-400">
                                                            Uncomplete
                                                        </button>
                                                    </form>
                                                @endif

                                                {{-- Tombol Delete Todo --}}
                                                <form action="{{ route('todo.destroy', $todo) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 dark:text-red-400">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-white">
                                        Empty
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Tombol Delete Semua Completed Task --}}
                @if (isset($todosCompleted) && $todosCompleted > 1)
                    <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                        <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-primary-button>
                                Delete All Completed Task
                            </x-primary-button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>

</x-app-layout>
