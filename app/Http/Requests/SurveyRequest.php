<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "q1" => "required|string",
            "q2" => "required|string",
            "q3" => "required|string",
            "q4" => "required|string",
            "q5" => "required|string",
            "q6" => "required|string",
            "q7" => "required|string",
        ];
    }
}
