@extends('layouts.admin.layout')
@section('header', 'Setting Profile')

@section('content')
  <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- konten -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Website</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/profile/update" role="form" id="updateform" method="POST">
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
                    <label class="control-label col-md-2">Nama Toko : </label>
                    <div class="col-md-5">
                      <input type="text" name="nama" id="nama" data-required="1" class="form-control" maxlength="90" value="{{ $settingwebsite->nama }}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Profile Toko : </label>
                    <div class="col-md-8">
                      <textarea name="profile" id="profile" class="form-control ckeditor" rows="3">{{ $settingwebsite->profile }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Email : </label>
                    <div class="col-md-5">
                      <input type="text" name="email" id="email" data-required="1" class="form-control" maxlength="90" value="{{ $settingwebsite->email }}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Alamat : </label>
                    <div class="col-md-5">
                      <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ $settingwebsite->alamat }}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Propinsi : </label>
                    <div class="col-md-5">
                      <select title="propinsi" class="form-control" name="propinsi" id="propinsi">
                        <option value='0'>-- Pilih Propinsi --</option>
                        <?php
                        $datapropinsi = json_decode($datapropinsi);
                        foreach($datapropinsi->{'rajaongkir'}->{'results'} as $key0 => $value0) {
                          $province_id = $value0->{'province_id'};
                          $province = $value0->{'province'};
                          ?>
                          <option value="<?php echo  $province_id; ?>" <?php echo $settingwebsite->propinsi==$province_id?"selected":"";?>>
                            <?php
                            echo $province;
                            ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Kota : </label>
                    <div class="col-md-5" id="kontenkota">
                      <select title="kota" class="form-control" name="kota" id="data_kota">
                        <option value='0'>-- Pilih Kota --</option>
                      </select>
                      <!-- <span class="glyphicon glyphicon-refresh glyphicon-spin" id="spinner"></span> -->

                      <div class="sr-only" id="spinner">Loading...</div>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Telepon : </label>
                    <div class="col-md-5">
                      <input type="text" name="telepon" id="telepon" data-required="1" class="form-control" maxlength="90" value="{{ $settingwebsite->telepon }}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Handphone : </label>
                    <div class="col-md-5">
                      <input type="text" name="handphone" id="handphone" data-required="1" class="form-control" maxlength="90" value="{{ $settingwebsite->handphone }}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Whatsapp : </label>
                    <div class="col-md-5">
                      <input type="text" name="whatsapp" id="whatsapp" data-required="1" class="form-control" maxlength="90" value="{{ $settingwebsite->whatsapp }}"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Google Maps : </label>
                    <div class="col-md-5">
                      <textarea name="maps" id="maps" class="form-control" rows="5">{{ $settingwebsite->maps }}</textarea>
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

    $("#telepon").keypress(function(data){
      if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
      {
        return false;
      }
    });

    $("#handphone").keypress(function(data){
      if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
      {
        return false;
      }
    });

    $("#whatsapp").keypress(function(data){
      if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
      {
        return false;
      }
    });

    $("#spinner").hide();

    //data kota
    var propinsi = $("#propinsi").val();
    //var token = $("input[name='_token']").val();
    //alert(propinsi);
    $.ajax({
      type: "GET",
      url : "/profile/kota/"+propinsi,
      beforeSend: function() {
        $("#kontenkota").hide();
        $("#spinner").show();
      },
      success: function(data){
        $("#spinner").hide();
        $("#kontenkota").show();
        $('#kontenkota').html(data.html);
      }
    });
    //data kota

    $("#propinsi").change(function(){
      var propinsi = $("#propinsi").val();
      //alert(propinsi);
      $.ajax({
        type: "GET",
        url : "/profile/kotabaru/"+propinsi,
        beforeSend: function() {
          $("#kontenkota").hide();
          $("#spinner").show();
        },
        success: function(data){
          $("#spinner").hide();
          $("#kontenkota").show();
          $('#kontenkota').html(data.html);
        }
      });
      //data kota
    });

    $("#submit").click(function(){

      var dataform = $("#updateform").serialize();
      //tinymce.triggerSave();
      var id_pengaturanwebsite = '1';
      var token = $("input[name='_token']").val();
      var nama = $("#nama").val();
      var profile = $("#profile").val();
      var email = $("#email").val();
      var alamat = $("#alamat").val();
      var propinsi = $("#propinsi").val();
      var kota = $("#data_kota").val();
      var telepon = $("#telepon").val();
      var handphone = $("#handphone").val();
      var whatsapp = $("#whatsapp").val();
      var maps = $("#maps").val();
      var user = $("#user").val();

      if(nama.length == 0){
        alert("Maaf, Nama tidak boleh kosong");
        $("#nama").focus();
        return (false);
      }

      if(profile.length == 0){
        alert("Maaf, Profile singkat tidak boleh kosong");
        $("#nama").focus();
        return (false);
      }

      if(email.length == 0){
        alert("Maaf, Email tidak boleh kosong");
        $("#email").focus();
        return (false);
      }

      if(alamat.length == 0){
        alert("Maaf, Alamat tidak boleh kosong");
        $("#alamat").focus();
        return (false);
      }

      if(propinsi == 0){
        alert("Maaf, Propinsi belum dipilih");
        $("#data_propinsi").focus();
        return (false);
      }

      if(kota == 0){
        alert("Maaf, Kota belum dipilih");
        $("#data_kota").focus();
        return (false);
      }

      if(telepon.length == 0){
        alert("Maaf, Telepon tidak boleh kosong");
        $("#telepon").focus();
        return (false);
      }

      if(handphone.length == 0){
        alert("Maaf, Handphone tidak boleh kosong");
        $("#handphone").focus();
        return (false);
      }

      if(whatsapp.length == 0){
        alert("Maaf, Whatsapp tidak boleh kosong");
        $("#whatsapp").focus();
        return (false);
      }

      $.ajax({
        type: "POST",
        url : "/profile/update",
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
