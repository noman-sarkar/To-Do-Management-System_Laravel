@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900 py-6">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 w-full max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white text-center">Your Tasks</h1>

        <div class="mb-4 text-right">
            <a href="{{ route('todos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Add Task</a>
        </div>

        <table id="tasks-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-auto">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-4 py-2">{{ $task->id }}</td>
                    <td class="px-4 py-2">{{ $task->title }}</td>
                    <td class="px-4 py-2">{{ $task->description }}</td>
                    <td class="px-4 py-2">{{ $task->status }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('todos.edit', $task) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>

                        <form action="{{ route('todos.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
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

<script>
    $(document).ready(function() {
        $('#tasks-table').DataTable();
    });
</script>
@endsection