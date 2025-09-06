<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // List tasks
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get(); // only current user's tasks
        return view('todos.index', compact('tasks'));
    }


    // Show create form
    public function create()
    {
        return view('todos.create');
    }

    // Store task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'Pending';

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show edit form
    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('todos.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable|max:255',
            'status' => 'required|in:Pending,Completed',
        ]);

        $task->update($validated);

        return redirect()->route('todos.index')->with('success', 'Task updated successfully.');
    }

    // Delete task
    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();

        return redirect()->route('todos.index')->with('success', 'Task deleted successfully.');
    }

    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
