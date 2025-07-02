<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'city' => ['nullable', 'string', 'max:255'],
            'student_id' => ['nullable', 'string', 'max:50'],
            'department' => ['nullable', 'string', 'max:255'],
            'graduation_year' => ['nullable', 'string', 'max:4'],
            'address' => ['nullable', 'string', 'max:500'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:20'],
        ];
    }
}
