@extends('layouts.admin.layout')
@section('header', 'Tambah Produk')

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

                <form role="form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
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
                      <label for="exampleInputEmail1">Nama</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="nama" maxlength="90" placeholder="Nama Produk">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori</label>
                      <div class="col-md-5">
                        <select class="form-control" name="kategori">
                            <option value="" holder>Pilih Kategori</option>
                            @foreach ($productcat as $result)
                            <option value="{{ $result->id }}">{{ $result->nama }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Brand</label>
                      <div class="col-md-5">
                        <select class="form-control" name="brand">
                            <option value="" holder>Pilih Brand</option>
                            @foreach ($brand as $result)
                            <option value="{{ $result->id }}">{{ $result->nama }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Jenis Produk</label>
                      <div class="col-md-5">
                        <select class="form-control" name="jenisproduk">
                            <option value="" holder>Pilih Jenis Produk</option>
                            @foreach ($jenisproduk as $result)
                            <option value="{{ $result->id }}">{{ $result->nama }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Berat</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="berat" id="berat" maxlength="6" placeholder="Berat (ml)">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Stok</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="stok" id="stok" maxlength="5" placeholder="Stok">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="harga" id="harga" maxlength="10" placeholder="Harga">
                      </div>
                    </div>

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Harga Coret</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="harga_coret" id="harga_coret" maxlength="10" placeholder="Harga Coret">
                      </div>
                    </div> --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Deskripsi Singkat</label>
                      <div class="col-md-8">
                        <textarea name="deskripsi1" class="form-control ckeditor"></textarea>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Deskripsi Lengkap</label>
                      <textarea name="deskripsi2" class="form-control ckeditor"></textarea>
                    </div> -->

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 1 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                        <input type="file" class="form-control" name="gambar1" placeholder="Gambar">
                      </div>
                    </div>
<!-- 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 2 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                      <input type="file" class="form-control" name="gambar2" placeholder="Gambar 2">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 3 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                      <input type="file" class="form-control" name="gambar3" placeholder="Gambar 3">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 4 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                      <input type="file" class="form-control" name="gambar4" placeholder="Gambar 4">
                      </div>
                    </div> -->

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 5</label>
                      <input type="file" class="form-control" name="gambar5" placeholder="Gambar 5">
                    </div> --}}

                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Meta Title</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="meta_title" maxlength="150">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Deskripsi</label>
                      <div class="col-md-8">
                          <textarea name="meta_deskripsi" class="form-control"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Keyword</label>
                      <div class="col-md-8">
                          <textarea name="meta_keyword" class="form-control"></textarea>
                      </div>
                    </div> -->

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/product" class="btn btn-secondary">Kembali</a>
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

          $("#harga").keypress(function(data){
        		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
        		{
        			return false;
        		}
        	});

        	$("#harga_coret").keypress(function(data){
        		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
        		{
        			return false;
        		}
        	});

        	$("#stok").keypress(function(data){
        		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
        		{
        			return false;
        		}
        	});

        	$("#berat").keypress(function(data){
        		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
        		{
        			return false;
        		}
        	});


        });


        </script>

@endsection
