<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Count user's courses
        $totalCourses = $user->courses()->count();

        // Count user's tasks
        $totalTasks = Task::where('user_id', $user->id)->count();

        // Count pending tasks
        $pendingTasks = Task::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Count completed tasks
        $completedTasks = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        // Get latest tasks
        $recentTasks = Task::where('user_id', $user->id)
            ->with('course')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'user',
            'totalCourses',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'recentTasks'
        ));
    }
}
