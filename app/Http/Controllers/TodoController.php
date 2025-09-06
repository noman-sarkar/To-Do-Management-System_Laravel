<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->session()->get('tasks', []);
        return view('todos.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable|max:255'
        ]);

        $tasks = $request->session()->get('tasks', []);

        $tasks[] = [
            'id' => uniqid(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending'
        ];

        $request->session()->put('tasks', $tasks);

        return redirect()->route('todos.index');
    }

    public function edit($id, Request $request)
    {
        $tasks = $request->session()->get('tasks', []);
        $task = collect($tasks)->firstWhere('id', $id);
        return view('todos.edit', compact('task'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable|max:255',
            'status' => 'required|in:pending,done'
        ]);

        $tasks = $request->session()->get('tasks', []);
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['title'] = $request->title;
                $task['description'] = $request->description;
                $task['status'] = $request->status;
            }
        }

        $request->session()->put('tasks', $tasks);

        return redirect()->route('todos.index');
    }

    public function destroy($id, Request $request)
    {
        $tasks = $request->session()->get('tasks', []);
        $tasks = array_filter($tasks, fn($t) => $t['id'] !== $id);

        $request->session()->put('tasks', $tasks);

        return redirect()->route('todos.index');
    }
}
