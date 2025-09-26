<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //
    public function index() {
    	$title = 'Đây là tiêu đề';
    	$description = 'Đây là mô tả';
    	$copyright = 'Học web chuẩn';
    	return view('test')->with(['title'=>$title, 'description'=>$description, 'copyright'=>$copyright]);
    }
}
