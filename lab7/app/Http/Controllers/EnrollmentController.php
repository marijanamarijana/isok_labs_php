<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Actions\ApproveEnrollmentAction;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function create(Course $course)
    {
        return view('enrollments.create', compact('course'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required|string',
            'seats_requested' => 'required|integer|min:1',
        ]);

        Enrollment::create($data);

        return redirect()->route('courses.show', $data['course_id']);
    }

    public function approve(Enrollment $enrollment, ApproveEnrollmentAction $action)
    {
        $action->execute($enrollment);
        return redirect()->route('courses.show', $enrollment->course_id);
    }

    public function drop(Enrollment $enrollment)
    {
        abort_if($enrollment->status !== 'approved', 400);

        $enrollment->update(['status' => 'dropped']);

        return redirect()->route('courses.show', $enrollment->course_id);
    }
}
