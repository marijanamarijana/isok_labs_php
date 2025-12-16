<?php

namespace App\Models;

use App\Enums\EventTypeEnum;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(EventObserver::class)]
class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'type',
        'date',
        'coordinator_id',
    ];

    protected $casts = [
        'type' => EventTypeEnum::class,
    ];

    public function coordinator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coordinator::class);
    }
}
