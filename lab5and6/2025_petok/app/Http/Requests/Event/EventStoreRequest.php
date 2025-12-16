<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'type' => 'required|string',
            'date' => 'required|date|after:today',
            'coordinator_id' => 'required|exists:coordinators,id',
        ];
    }
}
