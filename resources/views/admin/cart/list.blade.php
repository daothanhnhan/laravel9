@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách đơn hàng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Đơn hàng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- <section class="content-header">
      <a href="/admin/page/add" class="btn btn-primary btn-flat">Thêm Page</a>
    </section> -->

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách</h3>

                <div class="card-tools">
                  <form action="/admin/carts/search" method="GET">
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
                      <th>Đơn hang</th>
                      <th>Khách hàng</th>
                      <th>Số điện thoại</th>
                      <th>Ngày đặt</th>
                      <th>Tổng tiền</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($stt = 0)
                    @foreach ($carts as $cart)
                      @php($stt++)
                    <tr>
                      <td>{{ $stt }}</td>
                      <td><a href="/admin/carts/{{ $cart->id }}/edit">#{{ $cart->id }}</a></td>
                      <td>{{ $cart->name }}</td>
                      <td>{{ $cart->phone }}</td>
                      <td>{{ $cart->updated_at }}</td>
                      <td>{{ number_format($cart['total_price']) }} đ</td>

                      <td>
                        <a href="/admin/carts/{{ $cart->id }}/edit">Edit</a> |
                        <form action="/admin/carts/{{ $cart->id }}" method="POST" style="display: inline;" class="form-delete">
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
        {{ $carts->links('pagination') }}
      </div>
      
    </section>
  </div>

@endsection
 