@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Từ vựng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Từ vựng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
      <a href="/admin/tuvungs/create" class="btn btn-primary btn-flat">Thêm Từ vựng</a>
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
                      <th>Từ vựng</th>
                      <th>Dịch</th>
                      <th>Giải thích</th>
                      <th>Trạng thái</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($stt = 0)
                    @foreach($tuvungs as $tuvung)
                      @php($stt++)
                    <tr>
                      <td>{{ $stt }}</td>
                      <td><a href="/admin/tuvungs/{{ $tuvung->id }}/edit">{{ $tuvung->name }}</a></td>
                      <td>{{ $tuvung->content }}</td>
                      <td>{!! $tuvung->note !!}</td>
                      <td><input type="checkbox" name="" @checked($tuvung->state) onchange="state({{ $tuvung->id }})"></td>

                      <td>
                        <a href="/admin/tuvungs/{{ $tuvung->id }}/edit">Edit</a> |
                        <form action="/admin/tuvungs/{{ $tuvung->id }}" method="POST" style="display: inline;" class="form-delete">
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
        {{ $tuvungs->links('pagination') }}
      </div>
      
    </section>
  </div>

@endsection
@section('content_js')
<script>
  function state (id) {
    // alert('run');
    $.ajax({
    url: '/admin/tuvungs/change',
    data: {
      id: id
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