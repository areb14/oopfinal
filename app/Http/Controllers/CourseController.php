<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // View Course
    public function show($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $course = $user->courses()
            ->with('tasks')
            ->findOrFail($id);

        return view('view-course', compact('course'));
    }

    // Show Add Course Form
    public function create()
    {
        return view('courses.create');
    }

   
    // Save New Course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Generate automatic course code
        $nextNumber = (Course::max('id') ?? 0) + 1;

        $courseCode = 'COURSE-' .
            str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Create new course
        $course = Course::create([
            'title' => $validated['title'],
            'code' => $courseCode,
            'description' => $validated['description'] ?? null,
        ]);

        // Attach course to logged-in student
        $user->courses()->attach($course->id);

        return redirect()->route('my-courses')
            ->with('success', 'Course created successfully!');
    }


    // Edit Course
    public function edit($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $course = $user->courses()->findOrFail($id);

        return view('courses.edit', compact('course'));
    }

    // Update Course
    public function update(Request $request, $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $course = $user->courses()->findOrFail($id);

       $validated = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
]);
        $course->update($validated);

        return redirect()->route('my-courses')
            ->with('success', 'Course updated successfully!');
    }
    // Delete Course
public function destroy($id)
{
    /** @var User $user */
    $user = Auth::user();

    $course = $user->courses()->findOrFail($id);

    // Detach course from student
    $user->courses()->detach($course->id);

    // Delete course
    $course->delete();

    return redirect()->route('my-courses')
        ->with('success', 'Course deleted successfully!');
}
}
