@extends('layouts.member.layout')
@section('header', 'Ubah Password')

@section('content')

  <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  {{-- <h3 class="card-title">Quick Example</h3> --}}
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form role="form" action="/member/updatepass" method="post">
                  @csrf

                  <div class="card-body">

                    @if (count($errors)>0)
                      @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $error }}
                        </div>
                      @endforeach
                    @endif

                    @if (Session::has('success'))
                      <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {{ Session('success') }}
                      </div>
                    @endif

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Password Lama</label>
                      <input type="password" class="form-control" name="passwordlama" id="passwordlama">
                    </div> --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Password Baru</label>
                      <div class="col-md-5">
                        <input type="password" class="form-control" name="passwordbaru" id="passwordbaru" maxlength="90">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Ulangi Password</label>
                      <div class="col-md-5">
                        <input type="password" class="form-control" name="ulangipassword" id="ulangipassword" maxlength="90">
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="button" id="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->

        <script type="text/javascript">


        $(document).ready(function() {

        	$("#submit").click(function(){
            var token = $("input[name='_token']").val();
        		// var passwordlama = $("#passwordlama").val();
        		var passwordbaru = $("#passwordbaru").val();
            	var ulangipassword = $("#ulangipassword").val();

        		// if(passwordlama.length == 0){
        		//  alert("Maaf, Password lama tidak boleh kosong");
        		//  $("#passwordlama").focus();
        		//  return (false);
        		// }

        		if(passwordbaru.length == 0){
        		 alert("Maaf, Password baru tidak boleh kosong");
        		 $("#passwordbaru").focus();
        		 return (false);
        		}

        		if(ulangipassword.length == 0){
        		 alert("Maaf, Password tidak boleh kosong");
        		 $("#ulangipassword").focus();
        		 return (false);
        		}

        		if(passwordbaru!=ulangipassword){
        		 alert("Maaf, password tidak sama");
        		 $("#passwordbaru").val('');
        		 $("#ulangipassword").val('');
        		 $("#passwordbaru").focus();
        		 return (false);
        		}

        		//update password
        		      //konten
        					$.ajax({
        		 			type: "POST",
        		 			url : "/member/updatepass",
        		 			data: "_token="+token+
                    "&passwordbaru="+passwordbaru,
        			 			beforeSend: function() {
        			         		//$.LoadingOverlay("show");
        			 	    	},
        			 			success: function(msg){
        				 				alert('Update password berhasil');
        				 				location.reload();
        					 			}
        					});
        		      //konten


        		});
        		//update password

        });


        </script>

@endsection
