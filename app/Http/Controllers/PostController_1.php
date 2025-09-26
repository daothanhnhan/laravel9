<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showform () {
    	return view('admin.create');
    }

    public function validationform (Request $request) {
    	echo '<pre>';
    		print_r($request->all());
    	echo '</pre>';

        $messages = [
            'title.required' => 'Tiêu đề bắt buộc nhập',
            'title.max' => 'Tiều đề không được vượt quá 50 ký tự',
            'description.required' => 'Nội dung mô tả bắt buộc nhập',
        ];

    	

        $validated = $request->validate([
            'title' => 'required|max:50',
            'description' => 'required'
        ], $messages);

        // $errors = $validate->errors();// trường hợp báo lỗi đơn lẻ.
    }
}
