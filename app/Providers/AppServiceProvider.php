<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
// use Illuminate\View\View;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('toUpper', function () {
            return $this->map(function ($value) {
                return Str::upper($value);
            });
        });

        Collection::macro('remove_extension_file', function () {
            return $this->map(function ($filename) {
                // $var = "testfile.php"; 
                $var = $filename; 
                $explode = explode( '.', $var ); 
                array_pop( $explode); 
                $var = implode( '.', $explode ); 
                // var_dump( $var );
                return $var;
            });
        });

        Collection::macro('get_user_name', function () {
            return $this->map(function ($id) {
                 $user = User::find($id);

                  if ($user) {
                    return $user->name;
                  } else {
                    return '';
                  }
            });
        });

        Collection::macro('get_state', function () {
            return $this->map(function ($state) {
                 if ($state == 1) {
                    return 'Hiện';
                 }
                 return 'Ẩn';
            });
        });

        Collection::macro('date_10', function () {
            return $this->map(function ($date_in) {
                 $date = new \DateTime($date_in);
                $date->modify('+10 day');
                return $date->format('Y-m-d');
            });
        });

        Blade::directive('showVar', function ($state) {
            // nếu là số thì sử lý được bình thường
            // nếu là chữ thì chỉ dùng được vào convert text
            // không thể chuyền biến vào được.
            return "<?php echo $state ?>";
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });

        Collection::macro('check_variable', function () {
            return $this->map(function ($var) {
                if (is_array($var)) {
                    return 'là mảng';
                }

                if (is_numeric($var)) {
                    return 'là số';
                }

                if (is_string($var)) {
                    return 'là chuỗi';
                }

                if (is_bool($var)) {
                    return 'là boolean';
                }

                if (is_object($var)) {
                    return 'là đối tượng';
                }

                return 'không xác định';
            });
        });

        Collection::macro('vi_to_en', function () {
            return $this->map(function ($str) {
                $unicode = array(
         
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                 
                'd'=>'đ',
                 
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                 
                'i'=>'í|ì|ỉ|ĩ|ị',
                 
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                 
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                 
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
                 
                'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                 
                'D'=>'Đ',
                 
                'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                 
                'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
                 
                'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                 
                'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                 
                'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                 
                );
                 
                foreach($unicode as $nonUnicode=>$uni){
                 
                    $str = preg_replace("/($uni)/i", $nonUnicode, $str);
             
                }
                $str = str_replace(' ','-',$str);

                $str = strtolower($str);

                $str = preg_replace("/[^A-Za-z0-9\-]/", "",$str);
             
                return $str;
            });
        });

        // View::composer('*', function ($view) {
        //     $view->with('footer_name_1', 'tuan');
        // });
    }
}
