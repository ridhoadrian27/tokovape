@extends('layouts.member.layout')
@section('header', 'Tambah Alamat')

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

                <form role="form" action="{{ route('alamat.store') }}" method="post">
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

                    <div class="form-group">
                      <label for="exampleInputEmail1">Propinsi</label>
                      <div class="col-md-5">
                        <select class="form-control select2me" name="data_propinsi" id="data_propinsi" >
  		                    <option value=''>-- Pilih Propinsi --</option>
  		                    <?php
  		                    $datapropinsi = json_decode($datapropinsi);
  		                    foreach($datapropinsi->{'rajaongkir'}->{'results'} as $key0 => $value0) {
  		                        $province_id = $value0->{'province_id'};
  		                        $province = $value0->{'province'};
  		                    ?>
  		                        <option value="<?php echo  $province_id; ?>">
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
                      <label for="exampleInputEmail1">Kota</label>
                      <div id="datakota" class="col-md-5">
                        <select title="kota" class="form-control select2me" name="data_kota" id="data_kota">
  		                    <option value=''>-- Pilih Kota --</option>
  		                  </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="nama_alamat" id="nama_alamat" maxlength="90">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Detail Alamat</label>
                      <div class="col-md-5">
                        <textarea class="form-control" id='detail' name="detail"></textarea>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
          $("#spinner").hide();
          $("#data_propinsi").change(function(){
              var propinsi = $("#data_propinsi").val();
              //alert(propinsi);
              $.ajax({
                      type: "GET",
                      url : "/alamat/kota/"+propinsi,
                      beforeSend: function() {
                            // setting a timeout
                            $("#datakota").hide();
                            $("#spinner").show();
                      },
                      success: function(data){
                          $("#spinner").hide();
                          $("#datakota").show();
                          $('#datakota').html(data.html);
                      }
              });
          });

        });


        </script>

@endsection
