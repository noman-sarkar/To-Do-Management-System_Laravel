<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Add Task</h2>
            <form method="POST" action="{{ route('todos.store') }}">
                @csrf
                <input type="text" name="title" placeholder="Title"
                    class="w-full p-2 rounded-lg border mb-2" required>
                <textarea name="description" placeholder="Description"
                    class="w-full p-2 rounded-lg border mb-2"></textarea>
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Add Task</button>
            </form>
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mt-6 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Task List</h2>
            @forelse($tasks as $task)
                <div class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 rounded-lg p-3 mb-2">
                    <div>
                        <p class="font-medium">{{ $task['title'] }} ({{ $task['status'] }})</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $task['description'] }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('todos.edit', $task['id']) }}"
                           class="px-3 py-1 bg-yellow-500 text-white rounded-lg">Edit</a>
                        <form method="POST" action="{{ route('todos.destroy', $task['id']) }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded-lg">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No tasks yet.</p>
            @endforelse
        </div>

        <form method="POST" action="{{ route('theme.toggle') }}" class="mt-6 text-center">
            @csrf
            <button class="px-4 py-2 rounded-lg bg-gray-900 text-white">
                Toggle Theme
            </button>
        </form>
    </div>
</x-app-layout>
