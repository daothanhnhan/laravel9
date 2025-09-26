@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách sản phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
      <a href="/admin/products/create" class="btn btn-primary btn-flat">Thêm sản phẩm</a>
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách</h3>

                <div class="card-tools">
                  <form action="/admin/products/search" method="get">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="q" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tiêu đề</th>
                      <th>Người tạo</th>
                      <th>Giá</th>
                      <th>Trạng thái</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($stt = 0)
                    @foreach($products as $product)
                      @php($stt++)
                    <tr>
                      <td>{{ $stt }}</td>
                      <td><a href="/admin/products/{{ $product['id'] }}/edit">{{ $product['title'] }}</a></td>
                      <td><x-get-user-name :creator-id="$product['creator_id']" /></td>
                      <td>{{ number_format($product['price']) }} đ</td>
                      <td><x-get-state :state="$product['state']" /></td>

                      <td>
                        <a href="/admin/products/{{ $product['id'] }}/edit">Edit</a> |
                        <form action="/admin/products/{{ $product['id'] }}" method="POST" style="display: inline;" class="form-delete">
                          @csrf
                          @method('DELETE')
                          <button type="submit">Delete</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>

      <div class="text-center">
        {{ $products->links('pagination') }}
      </div>
      
    </section>
  </div>

@endsection
 