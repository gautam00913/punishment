<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class TeacherRequest extends FormRequest
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
        $matricule_rule = 'required|string';
        if(strtoupper($this->_method) != 'PUT' && strtoupper($this->_method) != 'PATCH') $matricule_rule .= '|unique:users,matricule';
        return [
            'matter_id' => 'required',
            'is_principal' => 'required|boolean',
            'matricule' => $matricule_rule,
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
