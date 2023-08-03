@extends('layouts.admin.layout')
@section('header', 'Setting Pixel')

@section('content')
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- konten -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Setting Pixel</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/pixel/update" role="form" id="updateform" method="POST">
              {{ csrf_field() }}
              <div class="card-body">

                @if (count($errors)>0)
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                    </div>
                  @endforeach
                @endif

                <div class="form-group">
                  <label class="control-label col-md-2">Pixel Website : </label>
                  <div class="col-md-5">
                    <textarea name="pixel" id="pixel" class="form-control" rows="5">{{ $settingpixel->pixel }}</textarea>
                  </div>
                </div>
              </div>

              {{-- <div class="card-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Pixel ThankYou Page: </label>
                  <div class="col-md-5">
                    <textarea name="pixel2" id="pixel2" class="form-control" rows="5">{{ $settingpixel->pixel2 }}</textarea>
                  </div>
                </div>
              </div> --}}
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
        var pixel = $("#pixel").val();
        var pixel2 = $("#pixel2").val();

        $.ajax({
          type: "POST",
          url : "/pixel/update",
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
