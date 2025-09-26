<?php foreach ($cartItems as $item) : ?>
  <?php $product = $productModel->where('id', $item->product_id)->first(); ?>
<tr>
  <td><img src="/storage/uploads/product/{{ $product->image }}" width="100"></td>
  <td><a href="/admin/products/{{ $product->id }}/edit">{{ $product->title }}</a></td>
  <td>{{ $item->size }}</td>
  <td>{{ number_format($item->product_price) }} đ</td>
  <td>
    <input type="number" name="" style="width: 50px;" onkeyup="change_qty(<?= $item->id ?>, this.value)" onchange="change_qty(<?= $item->id ?>, this.value)" value="<?= $item->product_quantity ?>">
  </td>
  <td>{{ number_format($item->product_price*$item->product_quantity) }} đ</td>
</tr>
<?php endforeach ?>