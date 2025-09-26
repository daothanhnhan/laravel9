@extends('admin.layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thông tin đơn hàng</h1>
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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Nhớ check cho kỹ rồi hãy chốt đơn
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: {{ $cart->created_at }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Admin, Inc.</strong><br>
                    {{ $config->content_home_1 }}<br>

                    Phone: {{ $config->content_home_7 }}<br>
                    Email: {{ $config->content_home_4 }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $cart->name }}</strong><br>
                    {{ $cart->address }}<br>

                    Phone: {{ $cart->phone }}<br>
                    Email: {{ $cart->email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{ $cart->id }}</b><br>
                  <br>
                  <b>Order ID:</b> {{ $cart->id }}<br>
                  <b>Payment Due:</b> {{ collect($cart->created_at)->date_10()[0] }}<br>
                  <b>Account:</b> demo
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Image</th>
                      <th>Product</th>
                      <th>Size</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody id="list-cart-item">
                      @php($total = 0)
                    @foreach ($cartItems as $item)
                      <?php $product = $productModel->where('id', $item->product_id)->first(); ?>
                      <?php $total += $item->product_price*$item->product_quantity; ?>
                    <tr>
                      <td><img src="/storage/uploads/product/{{ $product->image }}" width="100"></td>
                      <td><a href="/admin/products/{{ $item->product_id }}/edit">{{ $product->title }}</a></td>
                      <td>{{ $item->size }}</td>
                      <td>{{ number_format($item->product_price) }} đ</td>
                      <td>
                        <input type="number" name="" style="width: 50px;" onkeyup="change_qty(<?= $item->id ?>, this.value)" onchange="change_qty(<?= $item->id ?>, this.value)" value="<?= $item->product_quantity ?>">
                      </td>
                      <td>{{ number_format($item->product_price*$item->product_quantity) }} đ</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due {{ collect($cart->created_at)->date_10()[0] }}</p>

                  <div class="table-responsive" id="total">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Total:</th>
                        <td>{{ number_format($total) }} đ</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{ number_format($total) }} đ</td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              

              <!-- this row will not appear when printing -->
              <div class="row no-print d-none">
                <div class="col-12">
                  <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->


            <div class="callout callout-info">
              <!-- <h5><i class="fas fa-info"></i> Trạng thái đơn hàng:</h5> -->
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Trạng thái đơn hàng</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/carts/{{ $cart->id }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ghi chú khách hàng</label>
                    <textarea class="form-control" name="note">{{ $cart->note }}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Trạng thái đơn hành</label>
                <select class="form-control" name="state">
                  <option value="1">Chờ xác nhận</option>
                  <option value="2" @selected($cart->state == 2) >Đã xác nhận</option>
                  <option value="3" @selected($cart->state == 3) >Chờ thanh toán</option>
                  <option value="4" @selected($cart->state == 4) >Đã thanh toán</option>
                  <option value="5" @selected($cart->state == 5) >Chờ gửi hành</option>
                  <option value="6" @selected($cart->state == 6) >Hủy đơn hành</option>
                  <option value="7" @selected($cart->state == 7) >Đã chuyển hàng</option>
                </select>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              </form>
            </div>
            </div>
              
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('content_js')
<script>
function change_qty (cart_item_id, qty) {
  // alert(cart_item_id);
  // alert(qty);
  $.ajax({
    url: '/admin/cart-item/edit/'+cart_item_id,
    data: {
      qty: qty
    },
    dataType: 'html',
    success: function(response) {
      $('#list-cart-item').html(response);
      get_total(cart_item_id);
    }
  });
}

function get_total (cart_item_id) {
  $.ajax({
    url: '/admin/cart-item/edit-total/'+cart_item_id,
    data: {
      qty: cart_item_id
    },
    dataType: 'html',
    success: function(response) {
      $('#total').html(response);
    }
  });
}
</script>
@endsection
