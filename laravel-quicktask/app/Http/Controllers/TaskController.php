<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index', [
            'tasks' => Task::with('user')->get(),
            'users' => User::all()
        ]);
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        DB::table('tasks')->insert([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'],
            'user_id' => $validated['user_id'],
            'status' => 'pending', 
            'priority' => 'medium', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validated();

        DB::table('tasks')->where('id', $task->id)->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'user_id' => $validated['user_id'],
            'status' => $validated['status'],
            'updated_at' => now(),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Task update successfully.');
    }

    public function destroy(Task $task)
    {
        DB::table('tasks')->where('id', $task->id)->delete();
        return back()->with('success', 'Task deleted successfully.');
    }
}
