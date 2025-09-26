<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreSlideRequest extends FormRequest
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
            'image' => [
                'required',
                // File::types(['mp3', 'wav'])
                    // ->min(1024)
                    // ->max(12 * 1024),
                File::image(),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'Silde',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => ':attribute phải là ảnh.',
        ];
    }
}
