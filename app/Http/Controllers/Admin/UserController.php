<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Together;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index () {
    	$users = User::all();

    	$data = [
            'users' => $users,
        ];
        $data['menu_active'] = Together::check_url_menu();

    	return view('admin.user.list', $data);
    }

    public function create () 
    {
    	$data['menu_active'] = Together::check_url_menu();
    	return view('admin.user.create', $data);
    }

    public function store (Request $request) 
    {
    	$messages = [
		    'name.required' => 'Bạn phải nhận tên của bạn.',
		    'email.required' => 'Bạn phải nhập email',
		    'password.required' => 'Bạn phải nhập mật khẩu',
		    'password_confirmation.required' => 'Bạn phải nhập mật khẩu xác nhận',
		    'password.min' => 'Mật khẩu phải nhập ít nhất 8 ký tự',
		    'password.confirmed' => 'Mật khẩu bạn nhập không khớp',
		    'email.unique' => 'Email đã tồn tại, bạn hãy dùng email khác.',
		    'email.email' => 'Email phải là địa chỉ email',
		];
    	$validated = $request->validate([
	        'name' => 'required',
	        'email' => 'required|unique:users,email|email',
	        'password' => 'required|min:8|confirmed',
	        'password_confirmation' => 'required',
	    ], $messages);

	    // if ($validated->fails()) {
     //        return redirect('admin/users/create')
     //                    ->withErrors($validated)
     //                    ->withInput();
     //    }


        $password = Hash::make($validated['password']);

        $data = [
        	'name' => $validated['name'],
        	'email' => $validated['email'],
        	'password' => $password,
        ];

        $user = User::create($data);

        $errors = ['thêm mới thành công'];
        return redirect('admin/users/'.$user->id.'/edit')
                        ->withErrors($errors);
    }

    public function show (User $user) 
    {
    	return redirect('admin/users/'.$user->id.'/edit');
    }

    public function edit (User $user) 
    {
    	$data = [
    		'user' => $user,
    	];
    	$data['menu_active'] = Together::check_url_menu();
    	return view('admin.user.update', $data);
    }

    public function update (Request $request, User $user) 
    {
    	$messages = [
		    'name.required' => 'Bạn phải nhận tên của bạn.',
		    'email.required' => 'Bạn phải nhập email',
		    'email.unique' => 'Email đã tồn tại, bạn hãy dùng email khác.',
		    'email.email' => 'Email phải là địa chỉ email',
		];

		$rules = [
			'name' => 'required',
	        'email' => 'required|email|unique:users,email,'.$user->id,
		];


		if (!empty($request->input('password'))) {
			$messages['password.min'] = 'Mật khẩu phải nhập ít nhất 8 ký tự';
			$messages['password.confirmed'] = 'Mật khẩu bạn nhập không khớp';

			$rules['password'] = 'min:8|confirmed';
		}

    	$validated = $request->validate($rules, $messages);

    	if (!empty($request->input('password'))) {
    		$user->password = Hash::make($validated['password']);
    	}
    	$user->name = $validated['name'];
    	$user->email = $validated['email'];

    	$user->save();

    	$errors = ['Cập nhật thành công'];
        return redirect('admin/users/'.$user->id.'/edit')
                        ->withErrors($errors);
    }

    public function destroy (User $user) 
    {
    	$user->delete();
        return redirect('admin/users');
    }
}
