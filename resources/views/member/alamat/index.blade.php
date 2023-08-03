@extends('layouts.member.layout')
@section('header', 'Alamat')

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

                  <a href="{{ route('alamat.create') }}" class="btn btn-info btn-sm">Tambah Alamat</a>
                  <br><br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Edit</th>
                      <th>Hapus</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no='1'; ?>
                    @foreach ($alamat as $result)
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $result->nama_alamat }}</td>
                      <td>{{ $result->detail }}</td>
                      <td><a href="{{ route('alamat.edit', $result->id_alamat) }}" class="btn btn-primary">Edit</a></td>
                      <td>
                        <form action="{{ route('alamat.destroy', $result->id_alamat) }}" method="post">
                          @csrf
                          @method('delete')
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
