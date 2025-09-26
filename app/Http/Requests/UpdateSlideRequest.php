<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateSlideRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $post = Post::find($this->route('post'));
        // return $post && $this->user()->can('update-post', $post);
        // ví dụ mình muốn cập nhật một post 
        // mình sẽ kiểm tra xem post đó có user_id có đúng id của user hay không
        // nếu có thì sẽ cho cập nhật nếu không thì show 403
        // phải vào App\Providers\AuthServiceProvider để đăng ký Gate
        // Gate::define('update-post', [PostPolicy::class, 'update']);
        // phải tạo class Policy với method update với code như sau:
        // public function update(User $user, Post $post)
        // {
        //     return $user->id === $post->user_id;
        // }

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
