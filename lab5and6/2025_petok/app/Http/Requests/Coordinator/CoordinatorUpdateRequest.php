<?php
namespace App\Http\Requests\Coordinator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CoordinatorUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('coordinators')->ignore($this->coordinator->id),
            ],
            'phone' => 'required|string',
        ];
    }
}
