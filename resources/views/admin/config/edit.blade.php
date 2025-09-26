@extends('admin.layout')

@section('content_css')
<style>
#image-holder img {
  width: 300px;
}
.image-config {
  height: auto !important;
}
.image-config img {
  width: 200px;
}
</style>
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa thông tin website</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa thông tin website</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
      @if ($errors->any())
          <div class="alert alert-danger" role="alert">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Lấp đầy <small>Thông tin</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form id="quickForm" method="POST" action="/admin/config" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên website</label>
                    <input type="text" name="title" value="{{ $config['title'] }}" class="form-control" id="" placeholder="" required="">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Keyword</label>
                    <input type="text" name="keyword" value="{{ $config['keyword'] }}" class="form-control" id="" placeholder="">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <textarea class="form-control" name="description">{{ $config['description'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Giới thiệu</label>
                    <textarea class="form-control" name="intro">{{ $config['intro'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh logo</label>
                    <input type="file" name="logo" class="form-control" id="fileUpload" >
                  </div>

                  <div class="form-control" style="height: auto;">
                    <div id="image-holder">
                      <img src="/storage/uploads/config/{{ $config['logo'] }}" width="300">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh icon</label>
                    <input type="file" name="icon" value="" class="form-control" id="fileUpload_icon" placeholder="" >
                  </div>

                  <div class="form-control" style="height: auto;">
                    <div id="image-holder-icon" class="image-config">
                      <img src="/storage/uploads/config/{{ $config['icon'] }}" width="200">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh banner 1</label>
                    <input type="file" name="banner_1" value="" class="form-control" id="fileUpload_banner1" placeholder="" >
                  </div>

                  <div class="form-control" style="height: auto;">
                    <div id="image-holder-banner1" class="image-config">
                      <img src="/storage/uploads/config/{{ $config['banner_1'] }}" width="200">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh banner 2</label>
                    <input type="file" name="banner_2" value="" class="form-control" id="fileUpload_banner2" placeholder="" >
                  </div>

                  <div class="form-control" style="height: auto;">
                    <div id="image-holder-banner2" class="image-config">
                      <img src="/storage/uploads/config/{{ $config['banner_2'] }}" width="200">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh banner 3</label>
                    <input type="file" name="banner_3" value="" class="form-control" id="fileUpload_banner3" placeholder="" >
                  </div>

                  <div class="form-control" style="height: auto;">
                    <div id="image-holder-banner3" class="image-config">
                      <img src="/storage/uploads/config/{{ $config['banner_3'] }}" width="200">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ liên hệ 1</label>
                    <textarea class="form-control" name="content_home_1">{{ $config['content_home_1'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ liên hệ 2</label>
                    <textarea class="form-control" name="content_home_2">{{ $config['content_home_2'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ liên hệ 3</label>
                    <textarea class="form-control" name="content_home_3">{{ $config['content_home_3'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email liên hệ 1</label>
                    <textarea class="form-control" name="content_home_4">{{ $config['content_home_4'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email liên hệ 2</label>
                    <textarea class="form-control" name="content_home_5">{{ $config['content_home_5'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email liên hệ 3</label>
                    <textarea class="form-control" name="content_home_6">{{ $config['content_home_6'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Điện thoại liên hệ 1</label>
                    <textarea class="form-control" name="content_home_7">{{ $config['content_home_7'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Điện thoại liên hệ 2</label>
                    <textarea class="form-control" name="content_home_8">{{ $config['content_home_8'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Điện thoại liên hệ 3</label>
                    <textarea class="form-control" name="content_home_9">{{ $config['content_home_9'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Bản đồ</label>
                    <textarea class="form-control" name="content_home_10">{{ $config['content_home_10'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã nhúng head</label>
                    <textarea class="form-control" name="embed_code_header">{{ $config['embed_code_header'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã nhúng footer</label>
                    <textarea class="form-control" name="embed_code_footer">{{ $config['embed_code_footer'] }}</textarea>
                  </div>

                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('content_js')
<script>
    CKEDITOR.replace( 'editor1' );
</script>
@endsection