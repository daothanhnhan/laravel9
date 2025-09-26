<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;

class StorePageRequest extends FormRequest
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
                // 'required',
                // File::types(['mp3', 'wav'])
                    // ->min(1024)
                    // ->max(12 * 1024),
                File::image(),
            ],
            'title' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'Ảnh page',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => ':attribute phải là ảnh.',
        ];
    }

    // sử lý input trước khi validate.
    // phải khớp tên
    // code dưới không chạy.
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title),
        ]);
    }
}
