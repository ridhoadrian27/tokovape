@extends('layouts.admin.layout')
@section('header', 'Banner')

@section('content')

  <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  {{-- <h3 class="card-title">DataTable with default features</h3> --}}
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session('success') }}
                    </div>
                  @endif

                  <a href="{{ route('modulbanner.create') }}" class="btn btn-info btn-sm">Tambah Banner</a>
                  <br><br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th style="width:2%;">No</th>
                      <th>Gambar</th>
                      {{-- <th>Nama</th> --}}
                      <th>Text1</th>
                      <th>Text2</th>
                      {{-- <th>Text3</th> --}}
                      <th>Button Text</th>
                      <th>Link</th>
                      {{-- <th>Foto</th> --}}
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no='1'; ?>
                    @foreach ($banner as $result)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>
                        @if ($result->gambar)
                            <img src="{{asset('assets/banner/'.$result->gambar)}}" style="max-height: 50px;"/>
                        @else
                          {{ "Tidak ada gambar" }}
                        @endif
                      </td>
                      {{-- <td>{{ $result->nama }}</td> --}}
                      <td>{{ $result->text1 }}</td>
                      <td>{!! $result->text2 !!}</td>
                      {{-- <td>{{ $result->text3 }}</td> --}}
                      <td>{{ $result->button_text }}</td>
                      <td>{{ $result->customlink }}</td>
                      {{-- <td>
                        @if ($result->foto)
                            <img src="{{asset('assets/banner/'.$result->foto)}}" style="max-height: 50px;"/>
                        @else
                          {{ "Tidak ada foto" }}
                        @endif
                      </td> --}}
                      <td>
                        <form action="{{ route('modulbanner.destroy', $result->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <a href="{{ route('modulbanner.edit', $result->id) }}" class="btn btn-primary">Edit</a>
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus ?')">Delete</button>
                        </form>
                      </td>
                    </tr>
                    <?php $no++;?>
                    @endforeach
                  </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>

        <!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
