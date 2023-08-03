@extends('layouts.admin.layout')
@section('header', 'Gambar Footer')

@section('content')
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- konten -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Background Footer</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/footerimage/update" role="form" id="updateform" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              @if($settingfooterimage->gambar)
              <div class="form-group">
                <label class="control-label col-md-6">Background Footer<span class="required">
                  * </span>
                </label>
                <div class="col-md-4">
                  <img src="{{$settingfooterimage->getGambar()}}" style="max-height: 50px;"/>
                </div>
              </div>
              {{-- <div class="col-md-4"><a href="/hapusfooterimage" class="btn btn-sm btn-danger">Hapus</a></div><br> --}}
              @else @endif

              <div class="form-group" id="upload_gambar_utama">
                <label class="control-label col-md-6">Background Footer  (Rekomendasi width: 155px, height: 36px)<span class="required">
                  * </span>
                </label>
                <div class="col-md-4">
                  <input type="file"  name="upload_utama" id="upload_utama" class="form-control"/>
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
        url : "/footerimage/update",
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
