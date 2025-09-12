<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateInformationRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email," . auth()->user()->id,
            "gender" => "nullable|string|in:male,female",
            "headline" => "nullable|string|max:255",
            "bio" => "nullable|string|max:6000",
            "image" => "nullable|image|max:5000"        ];
    }
}
