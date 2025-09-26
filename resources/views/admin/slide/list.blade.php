@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Slide</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slide</li>
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
      <a href="/admin/slides/create" class="btn btn-primary btn-flat">Thêm Slide</a>
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách</h3>

                <div class="card-tools d-none">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Name file</th>
                      <th>Sắp xếp</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($stt = 0)
                    @foreach($slides as $slide)
                      @php($stt++)
                    <tr>
                      <td>{{ $stt }}</td>
                      <td><img src="/storage/uploads/slide/{{ $slide['image'] }}" style="width: 100px;"></td>
                      <td>
                        <input type="number" name="" value="{{ $slide['sort'] }}" onkeyup="change_sort({{ $slide['id'] }}, this.value)"  onchange="change_sort({{ $slide['id'] }}, this.value)">
                      </td>
                      <td>
                        <a href="/admin/slides/{{ $slide['id'] }}/edit">Edit</a> |
                        <form action="/admin/slides/{{ $slide['id'] }}" method="POST" style="display: inline;" class="form-delete">
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
        <?= $slides->links() ?>
      </div>
      
    </section>
  </div>

@endsection

@section('content_js')
<script>
function change_sort (id, sort) {
  // alert(id + '-' + sort);
  $.ajax({
    url: '/admin/slide-sort',
    data: {
      id: id,
      sort: sort
    },
    dataType: 'json',
    success: function(response) {
      console.log(response);
      // $('#result').html(response);
    }
  });
}
</script>

@endsection
 