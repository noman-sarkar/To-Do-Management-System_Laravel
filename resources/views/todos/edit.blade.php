<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Edit Task</h2>
            <form method="POST" action="{{ route('todos.update', $task['id']) }}">
                @csrf
                @method('PUT')
                <input type="text" name="title" value="{{ $task['title'] }}"
                    class="w-full p-2 rounded-lg border mb-2" required>
                <textarea name="description"
                    class="w-full p-2 rounded-lg border mb-2">{{ $task['description'] }}</textarea>
                <select name="status" class="w-full p-2 rounded-lg border mb-2">
                    <option value="pending" @selected($task['status'] === 'pending')>Pending</option>
                    <option value="done" @selected($task['status'] === 'done')>Done</option>
                </select>
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Update Task</button>
            </form>
        </div>
    </div>
</x-app-layout>
