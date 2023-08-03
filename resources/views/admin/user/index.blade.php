@extends('layouts.admin.layout')
@section('header', 'Setting User')

@section('content')
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- konten -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Data User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                {{-- <div class="btn-group"><a href="/settinguser/add" class="btn btn-success" style="margin-bottom:10px;">
										Tambah Data&nbsp;&nbsp;<i class="fa fa-plus"></i>
									</a>
								</div> --}}
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($datauser as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{$user->getUser()}}" style="max-height: 50px;"/></td>
                        <td class="center">

												<div style="margin-bottom:5px;">
													<a href="/settinguser/edit/{{ $user->id }}" class="btn btn-sm btn-success" style="width: 100%;"><i class="fa fa-edit"></i> Edit &nbsp;&nbsp;&nbsp;</a>
												</div>
												<div style="margin-bottom:5px;">
													<a href="/settinguser/changepass/{{ $user->id }}" class="btn btn-sm btn-warning filter-submit margin-bottom" style="width: 100%;"><i class="fa fa-edit"></i> Ganti Password &nbsp;&nbsp;&nbsp;</a>
												</div>
                        {{-- <div style="margin-bottom:5px;">
													<a href="/settinguser/delete/{{ $user->id }}" class="btn btn-sm btn-danger filter-submit margin-bottom" style="width: 100%;" onclick="return confirm('Yakin mau dihapus ?')"><i class="fa fa-edit"></i> Hapus &nbsp;&nbsp;&nbsp;</a>
												</div> --}}
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
        <!-- konten -->
      </div>
      <!-- /.row -->
      <!-- Main row -->

      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <script type="text/javascript">
    $(document).ready(function() {

      $("#submit").click(function(){

        var dataform = $("#updateform").serialize();
        //tinymce.triggerSave();
        var token = $("input[name='_token']").val();
        var twitter = $("#twitter").val();

        if(twitter.length == 0){
          alert("Maaf, Silakan masukan link Twitter");
          $("#twitter").focus();
          return (false);
        }

        $.ajax({
          type: "POST",
          url : "/twitter/update",
          data: dataform,
          beforeSend: function() {
            $.LoadingOverlay("show");
          },
          success: function(msg){
            location.reload();
          }
        });

      });

    });
    </script>
  <!-- /.content -->

@endsection
