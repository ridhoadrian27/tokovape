@extends('layouts.admin.layout')
@section('header', 'Setting Logo')

@section('content')
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- konten -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Logo Website</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/logo/update" role="form" id="updateform" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              @if($settinglogo->logo)
              <div class="form-group">
                <label class="control-label col-md-6">Gambar Logo<span class="required">
                  * </span>
                </label>
                <div class="col-md-4">
                  <img src="{{$settinglogo->getLogo()}}" style="max-height: 50px;"/>
                </div>
              </div>
              <div class="col-md-4"><a href="/hapuslogo" class="btn btn-sm btn-danger">Hapus</a></div><br>
              @else @endif

              <div class="form-group" id="upload_gambar_utama">
                <label class="control-label col-md-6">Gambar Logo  (Rekomendasi width: 155px, height: 36px)<span class="required">
                  * </span>
                </label>
                <div class="col-md-4">
                  <input type="file"  name="upload_utama" id="upload_utama" class="form-control"/>
                </div>
              </div>

              <!-- Gambar Favicon -->
              @if($settinglogo->favicon)
              <div class="form-group">
                <label class="control-label col-md-3">Gambar Favicon<span class="required">
                  * </span>
                </label>
                <div class="col-md-4">
                  <img src="{{$settinglogo->getFavicon()}}" width="16"/>
                </div>
              </div>
              <div class="col-md-4"><a href="/hapusfavicon" class="btn btn-sm btn-danger">Hapus</a></div><br>
              @else @endif

              <div class="form-group" id="upload_gambar_utama">
                <label class="control-label col-md-6">Gambar Favicon (Rekomendasi width: 38px, height: 44px)<span class="required">
                  * </span>
                </label>
                <div class="col-md-4">
                  <input type="file"  name="upload_icon" id="upload_icon" class="form-control"/>
                </div>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              {{-- <button type="button" id="submit" class="btn btn-primary">Submit</button> --}}
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
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

      $.ajax({
        type: "POST",
        url : "/logo/update",
        data: dataform,
        beforeSend: function() {
          $.LoadingOverlay("show");
        },
        success: function(msg){
          //location.reload();
        }
      });

    });
  });
  </script>
  <!-- /.content -->

@endsection
