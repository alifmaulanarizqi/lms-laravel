<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileUpdatePasswordRequest extends FormRequest
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
            "current_password" => [
                "required",
                "string",
                "max:255",
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                }
            ],
            "new_password" => [
                "required",
                "string",
                "max:255",
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, Auth::user()->password)) {
                        $fail('The new password must be different from the current password.');
                    }
                }
            ],
            "confirm_password" => "required|string|max:255|same:new_password",
        ];
    }
}
