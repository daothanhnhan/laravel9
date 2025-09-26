<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use App\Models\Page;

class Tuan extends Controller
{
    public function index () 
    {
        $pages = DB::table('pages')->get();
        // $pages = DB::table('posts')->get();
        if ($pages->isEmpty()) {
            echo 'không';
        } else {
            echo 'có';
        }
        // dd((array)$pages[0]);//run

        $pages = Page::get();
        foreach ($pages as $page) {
            $page = $page->toArray();//run //duy nhất có toArray()
            // dd($page);
        }
        // phân trang dùng dạng object
        // create model dùng array
        // find(1) stdClass
        // first() stdClass
        // echo '<pre';
        $page = DB::table('pages')->find(3);// là NULL hoặc stdClass
        // $page = Page::find(3); // là NULL hoặc object
        // var_dump($page);

        $page = DB::table('pages')->first();// stdClass
        $page = Page::first();// object // dùng model sẽ hỗ trợ được nhiều hơn table
        dd($page);
    }

    public function session_test (Request $request) {
        $arr['tuan'][] = 'test 1';
        session($arr);
        $request->session()->get('tuan')[] = 'test 2';// không chạy
        // dd($_SESSION);
        dd(session('tuan'));
    }

    public function toan_tu () {
        $a = 1;
        $b = '1';
        $a_type = gettype($a);
        $b_type = gettype($b);

        if ($a == $b && $a_type == $b_type) {
            echo 'cùng giá trị và cùng kiểu<br>';
        } else {
            echo 'khác giá trị hoặc khác kiểu<br>';
        }

        if ($a === $b) {
            echo 'cùng giá trị và cùng kiểu<br>';
        } else {
            echo 'khác giá trị hoặc khác kiểu<br>';
        }

        if ($a !== $b) {
            echo 'khác giá trị hoặc khác kiểu<br>';
        } else {
            echo 'cùng giá trị và cùng kiểu<br>';
        }

        // $a == $b , $a != $b    
        //   true       false


        //                      $a == $b , $a != $b    
        //                       
        // $a_type == $b_type     true      false
        // $a_type != $b_type     false     false
        
    }

    public function ajax (Request $request) {
    	$name = $request->input('name');
    	if ($name) {
    		return json_encode($name);
    	} else {
    		return view('test.ajax');
    	}
    }

    public function lang () {
    	App::setLocale('es');
		$locale = App::currentLocale();
		// dd($locale);
		// $a = check_variable('tuấn');dd($a);// là chuỗi
    }

    public function logout (Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }

    public function lang1 () {
        Collection::macro('toLocale', function ($locale) {
            return $this->map(function ($value) use ($locale) {
                return Lang::get($value, [], $locale);
            });
        });
         
        $collection = collect(['first', 'second']);
         
        $translated = $collection->toLocale('es');
        dd($translated);
    }

    public function tuan_text () {
        $collection = collect(['first', 'second']);
 
        $upper = $collection->toUpper();
        // dd($upper);
        $collection = collect(['first', 'second'])->check_variable();
        $collection = collect('text')->check_variable()[0];
        dd($collection);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequest()
    {
        return view('test.ajaxRequest');
    }
     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();
          
        // Log::info($input);
     
        return response()->json(['success'=>$input['name']]);
        // return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
