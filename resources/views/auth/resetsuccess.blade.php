<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jQuery -->
  <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Reset Password Berhasil</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan Cek Email Anda</p>

      <form action="/resetadmin" id="updateform" method="post">
        @csrf
        <div class="row">
          <div class="col-8">
            {{-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> --}}
          </div>
          <!-- /.col -->
          <div class="col-4">
            {{-- <button type="button" id="submit" class="btn btn-primary btn-block">Submit</button> --}}
            <a href="/administrator" class="btn btn-primary btn-block">Login</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <script type="text/javascript">
        $(document).ready(function() {

          $("#submit").click(function(){

            var dataform = $("#updateform").serialize();

            var token = $("input[name='_token']").val();
            var email = $("#email").val();

            if(email.length == 0){
              alert("Maaf, Email tidak boleh kosong");
              $("#email").focus();
              return (false);
            }

            $.ajax({
                type: "POST",
                url : "/cekemailadmin",
                data: "_token="+token+
                  "&email="+email,
                beforeSend: function() {
                    $.LoadingOverlay("show");
                },
                success: function(msg){
                  //alert(msg);
                  if(msg=='1'){
                    //konten
                    $.ajax({
                      type: "POST",
                      url : "/resetpassadmin",
                      data: dataform,
                      beforeSend: function() {
                        //$.LoadingOverlay("show");
                      },
                      success: function(msg){
                        //location.reload();
                        document.location.href="/resetsuccessadmin";
                      }
                    });
                    //konten
                  }else{
                    $.LoadingOverlay("hide");
                    alert('Email tidak ditemukan');
                  }
                }
            });

          });

        });
      </script>

      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="{{route('resetadmin')}}">Lupa Password</a>
      </p> --}}
      {{-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

</body>
</html>
