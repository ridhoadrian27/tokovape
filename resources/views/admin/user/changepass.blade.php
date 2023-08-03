@extends('layouts.admin.layout')
@section('header', 'Change Password')

@section('content')
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- konten -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Ganti Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/settinguser/updatepass" role="form" id="updateform" method="POST">
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

                <input type="text" name="id" id="id" class="form-control" value="{{ $datauser->id }}" hidden/>
                <div class="form-group" id="row_nama">
                  <label class="control-label col-md-2">Password</label>
                  <div class="col-md-5">
                    <input type="password" name="password" id="password" class="form-control" maxlength="90"/>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                {{-- <button type="button" id="submit" class="btn btn-primary">Submit</button> --}}
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/settinguser" class="btn btn-secondary">Kembali</a>
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
    $(document).ready(function () {

      $('#updateform').validate({
        rules: {
          password: {
            required: true,
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>

@endsection
