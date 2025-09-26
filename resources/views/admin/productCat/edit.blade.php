@extends('admin.layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa Danh mục sản phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa Danh mục sản phẩm</li>
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

    <section class="content-header">
      <a href="/admin/productcats/create" class="btn btn-primary btn-flat">Thêm Danh mục sản phẩm</a>
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

              <form id="quickForm" method="POST" action="/admin/productcats/{{ $productCat['id'] }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề</label>
                    <input type="text" name="title" value="{{ $productCat['title'] }}" class="form-control" id="" placeholder="" required="">
                  </div>

                  <x-product-category-select :productcatId="$productCat['id']" />
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chọn ảnh</label>
                    <input type="file" name="image" value="" class="form-control" id="fileUpload" placeholder="" >
                  </div>

                  <div class="form-control" style="height: auto;">
                    <div id="image-holder">
                      <img src="/storage/uploads/productcat/{{ $productCat['image'] }}" width="300">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <textarea class="form-control" name="description">{{ $productCat['description'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nội dung</label>
                    <textarea class="form-control" id="editor1" name="content">{{ $productCat['content'] }}</textarea>
                  </div>


                </div>

                <div class="card-header" style="background: #007bff;color: #fff;">
                  <h3 class="card-title">Thông tin <small>SEO</small></h3>
                </div>

                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề trang</label>
                    <input type="text" name="title_seo" value="{{ $productCat['title_seo'] }}" class="form-control" id="" placeholder="">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Thẻ mô tả</label>
                    <textarea class="form-control" name="des_seo">{{ $productCat['des_seo'] }}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Keyword</label>
                    <input type="text" name="keyword" value="{{ $productCat['keyword'] }}" class="form-control" id="" placeholder="">
                  </div>
                </div>

                <div class="card-header" style="background: #007bff;color: #fff;">
                  <h3 class="card-title">Trạng thái <small></small></h3>
                </div>

                <div class="card-body">
                  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="state" value="1" @checked($productCat['state'])>
                        <label class="form-check-label">Hiển thị</label>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Thứ tự</label>
                    <input type="number" name="sort" value="{{ $productCat['sort'] }}" class="form-control" id="" placeholder="" required >
                    <p class="d-none">{{ $productCat['slug'] }}</p>
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