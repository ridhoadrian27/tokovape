@extends('layouts.admin.layout')
@section('header', 'Tambah Rekening')

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

                <form role="form" action="{{ route('rekening.store') }}" method="post" enctype="multipart/form-data">
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
                      <label for="exampleInputEmail1">Bank</label>
                      <div class="col-md-5">
                        <select class="form-control" name="bank">
                            <option value="" holder>Pilih Bank</option>
                            @foreach ($dbbank as $result)
                            <option value="{{ $result->id_bank }}">{{ $result->nama_bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Rekening</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="rekening" id="rekening" maxlength="90" placeholder="Rekening">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Atas Nama</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="atasnama" maxlength="90" placeholder="Atas Nama">
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/rekening" class="btn btn-secondary">Kembali</a>
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

          $("#rekening").keypress(function(data){
        		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
        		{
        			return false;
        		}
        	});

        });


        </script>

@endsection
