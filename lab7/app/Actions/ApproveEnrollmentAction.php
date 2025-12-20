<?php
namespace App\Actions;

use App\Models\Enrollment;

class ApproveEnrollmentAction
{
    public function execute(Enrollment $enrollment)
    {
        abort_if($enrollment->status !== 'pending', 400);

        $course = $enrollment->course;

        abort_if(
            $course->seats < $enrollment->seats_requested,
            400,
            'Not enough seats'
        );

        $course->decrement('seats', $enrollment->seats_requested);

        $enrollment->update([
            'status' => 'approved'
        ]);

        return $enrollment;
    }
}
