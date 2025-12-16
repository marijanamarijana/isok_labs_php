<?php

namespace App\Models;

use App\Observers\CoordinatorObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(CoordinatorObserver::class)]
class Coordinator extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
    ];

    public function events(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Event::class);
    }
}
