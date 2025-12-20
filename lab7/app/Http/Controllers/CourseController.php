<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('enrollments');
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateCourse($request);
        Course::create($data);

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $this->validateCourse($request);
        $course->update($data);

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        abort_if(
            $course->enrollments()->where('status', 'approved')->exists(),
            400,
            'Course has approved enrollments'
        );

        $course->delete();

        return redirect()->route('courses.index');
    }

    private function validateCourse(Request $request)
    {
        return $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'required|date',
            'seats' => 'required|integer|min:1',
        ]);
    }
}
