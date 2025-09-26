<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo' => [
                File::image(),
            ],
            'icon' => [
                File::image(),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'logo' => 'Logo',
            'icon' => 'Icon',
        ];
    }

    public function messages()
    {
        return [
            'logo.image' => ':attribute phải là ảnh.',
            'icon.image' => ':attribute phải là ảnh.',
        ];
    }
}
