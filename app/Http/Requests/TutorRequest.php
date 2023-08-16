<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class TutorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('administration');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'students' => 'nullable|array',
            'address' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|string|size:1',
            'age' => 'required|integer',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'grade' => 'nullable|string',
            'picture' => 'sometimes|file|mimes:png,jpg',
        ];
    }
}
