<?php

namespace App\Http\Requests;

use App\Enums\ReportedType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use ReflectionClass;

class ReportedRequest extends FormRequest
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
            "title" => "required|string",
            "description" => "required|string",
            "location_latitude" => "required|numeric",
            "location_longitude" => "required|numeric",
            // "image" => "required|image",
            "type" => ["required", "string", Rule::in(array_values((new ReflectionClass(ReportedType::class))->getConstants()))],
        ];
    }
}
