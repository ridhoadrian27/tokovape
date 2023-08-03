@extends('layouts.admin.layout')
@section('header', 'Edit User')

@section('content')
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- konten -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add User</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/settinguser/update" role="form" id="updateform" method="POST" enctype="multipart/form-data">
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
                <label class="control-label col-md-2">Nama Lengkap</label>
                <div class="col-md-5">
                  <input type="text" name="name" id="name" data-required="1" class="form-control" maxlength="90" value="{{ $datauser->name }}"/>
                </div>
              </div>

              <div class="form-group" id="row_nama">
                <label class="control-label col-md-2">Email</label>
                <div class="col-md-5">
                  <input type="text" name="email" id="email" data-required="1" class="form-control" maxlength="90" value="{{ $datauser->email }}"/>
                </div>
              </div>

              <div class="form-group" id="row_nama">
                <label class="control-label col-md-2">Image</label>
                <div class="col-md-5">
                  <img src="{{$datauser->getUser()}}" style="max-height: 100px;"/>
                </div>
              </div>

              <div class="form-group" id="row_nama">
                <label class="control-label col-md-2">Foto</label>
                <div class="col-md-5">
                  <input type="file"  name="foto" id="foto" data-required="1" class="form-control"/>
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
        nama: {
          required: true,
        },
        email: {
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
