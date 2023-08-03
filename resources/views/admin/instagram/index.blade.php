@extends('layouts.admin.layout')
@section('header', 'Setting Instagram')

@section('content')
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- konten -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Instagram</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/instagram/update" role="form" id="updateform" method="POST">
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
                  <label class="control-label col-md-2">Instagram : </label>
                  <div class="col-md-5">
                    <textarea name="instagram" id="instagram" class="form-control" rows="5">{{ $settinginstagram->instagram }}</textarea>
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
        var instagram = $("#instagram").val();

        if(instagram.length == 0){
          alert("Maaf, Silakan masukan link Instagram");
          $("#instagram").focus();
          return (false);
        }

        $.ajax({
          type: "POST",
          url : "/instagram/update",
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
