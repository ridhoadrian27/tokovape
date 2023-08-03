@extends('layouts.admin.layout')
@section('header', 'Setting SEO')

@section('content')
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- konten -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Setting SEO</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/settingseo/update" role="form" id="updateform" method="POST">
              {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Title : </label>
                  <div class="col-md-5">
                    <input type="text" name="title" id="title" data-required="1" class="form-control" maxlength="90" value="{{ $settingseo->title }}"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Deskripsi : </label>
                  <div class="col-md-5">
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5">{{ $settingseo->deskripsi }}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Keyword : </label>
                  <div class="col-md-5">
                    <textarea name="keyword" id="keyword" class="form-control" rows="5">{{ $settingseo->keyword }}</textarea>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" id="submit" class="btn btn-primary">Submit</button>
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
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
      var title = $("#title").val();
      var deskripsi = $("#deskripsi").val();
      var keyword = $("#keyword").val();

      // if(title.length == 0){
      //   alert("Maaf, Silakan masukan title");
      //   $("#title").focus();
      //   return (false);
      // }
      //
      // if(keyword.length == 0){
      //   alert("Maaf, Silakan masukan deskripsi");
      //   $("#keyword").focus();
      //   return (false);
      // }
      //
      // if(keyword.length == 0){
      //   alert("Maaf, Silakan masukan Keyword");
      //   $("#keyword").focus();
      //   return (false);
      // }

      $.ajax({
        type: "POST",
        url : "/settingseo/update",
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

@endsection
