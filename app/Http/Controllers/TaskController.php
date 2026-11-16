<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Course;

class TaskController extends Controller
{
    // Display all tasks
public function index()
{
    $tasks = Task::where('user_id', Auth::id())
        ->with('course')
        ->latest()
        ->get();

    $totalTasks = $tasks->count();

    $pendingTasks = $tasks->where('status', 'pending')->count();

    $completedTasks = $tasks->where('status', 'completed')->count();

    return view('tasks.index', compact(
        'tasks',
        'totalTasks',
        'pendingTasks',
        'completedTasks'
    ));
}

    // Show add task form
    public function create()
    {
        $courses = Course::all();

        return view('tasks.create', compact('courses'));
    }

    // Save new task
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task added successfully!');
    }

    // Show edit form
    public function edit(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $courses = Course::all();

        return view('tasks.edit', compact('task', 'courses'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed',
        ]);

        $task->update($request->only([
            'course_id',
            'title',
            'description',
            'due_date',
            'status',
        ]));

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    // Delete task
    public function destroy(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    // Mark task as completed
    public function complete(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $task->update([
            'status' => 'completed',
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task completed!');
    }
}
