<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'summary', 'level', 'start_date', 'seats'
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
