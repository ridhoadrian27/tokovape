@extends('layouts.admin.layout')
@section('header', 'Edit Produk')

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

                <form role="form" action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('patch')
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
                        <input type="text" class="form-control" name="nama" maxlength="90" placeholder="Nama Produk" value="{{ $product->nama }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori</label>
                      <div class="col-md-5">
                        <select class="form-control" name="kategori">
                          <option value="" holder>Pilih Kategori</option>
                          @foreach ($productcat as $result)
                            <option value="{{ $result->id }}"
                              @if ($product->kategoriproduk_id == $result->id)
                                selected
                              @endif
                              >{{ $result->nama }}</option>
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
                            <option value="{{ $result->id }}"
                              @if ($product->brand == $result->id)
                                selected
                              @endif
                              >{{ $result->nama }}</option>
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
                            <option value="{{ $result->id }}"
                              @if ($product->jenisproduk == $result->id)
                                selected
                              @endif
                              >{{ $result->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Berat</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="berat" id="berat" maxlength="6" value="{{ $product->berat }}" placeholder="Berat (gram)">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Stok</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="stok" id="stok" maxlength="5" value="{{ $product->stok }}" placeholder="Stok">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="harga" id="harga" maxlength="10" value="{{ $product->harga }}" placeholder="Harga">
                      </div>
                    </div>

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Harga Coret</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="harga_coret" id="harga_coret" maxlength="10" value="{{ $product->harga_coret }}" placeholder="Harga Coret">
                      </div>
                    </div> --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Deskripsi Singkat</label>
                      <div class="col-md-8">
                        <textarea name="deskripsi1" class="form-control ckeditor">{{ $product->deskripsi1 }}</textarea>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Deskripsi Lengkap</label>
                      <textarea name="deskripsi2" class="form-control ckeditor">{{ $product->deskripsi2 }}</textarea>
                    </div> -->

                    <?php
                      $gambar1 = $product->gambar1;
                      if($gambar1){
                    ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 1</label>
                      <div class="col-md-5">
                        <img src="{{$product->getGambar1()}}" style="max-height: 50px;"/>
                        <input type="hidden" class="form-control" name="gambar_lama1" value="{{ $product->gambar1 }}">
                      </div>
                    </div>
                    <?php }else{} ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 1 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                        <input type="file" class="form-control" name="gambar1" placeholder="Gambar">
                      </div>
                    </div>

                    <!-- <?php
                      $gambar2 = $product->gambar2;
                      if($gambar2){
                    ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 2</label>
                      <div class="col-md-5">
                      <img src="{{$product->getGambar2()}}" style="max-height: 50px;"/>
                      <input type="hidden" class="form-control" name="gambar_lama2" value="{{ $product->gambar2 }}">
                      </div>
                    </div>
                    <?php }else{} ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 2 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                      <input type="file" class="form-control" name="gambar2" placeholder="Gambar 2">
                      </div>
                    </div>

                    <?php
                      $gambar3 = $product->gambar3;
                      if($gambar3){
                    ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 3</label>
                      <div class="col-md-5">
                      <img src="{{$product->getGambar3()}}" style="max-height: 50px;"/>
                      <input type="hidden" class="form-control" name="gambar_lama3" value="{{ $product->gambar3 }}">
                      </div>
                    </div>
                    <?php }else{} ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 3 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                      <input type="file" class="form-control" name="gambar3" placeholder="Gambar 3">
                      </div>
                    </div>

                    <?php
                      $gambar4 = $product->gambar4;
                      if($gambar4){
                    ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 4</label>
                      <div class="col-md-5">
                      <img src="{{$product->getGambar4()}}" style="max-height: 50px;"/>
                      <input type="hidden" class="form-control" name="gambar_lama4" value="{{ $product->gambar4 }}">
                      </div>
                    </div>
                    <?php }else{} ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 4 (Rekomendasi width: 400px, height: 400px)</label>
                      <div class="col-md-5">
                      <input type="file" class="form-control" name="gambar4" placeholder="Gambar 4">
                      </div>
                    </div> -->

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 5</label>
                      <img src="{{$product->getGambar5()}}" style="max-height: 50px;"/>
                      <input type="hidden" class="form-control" name="gambar_lama5" value="{{ $product->gambar5 }}">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar 5</label>
                      <input type="file" class="form-control" name="gambar5" placeholder="Gambar 5">
                    </div> --}}

                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Meta Title</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="meta_title" maxlength="150" value="{{ $product->meta_title }}"  placeholder="Kategori Produk">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Deskripsi</label>
                      <div class="col-md-8">
                          <textarea name="meta_deskripsi" class="form-control">{{ $product->meta_deskripsi }}</textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Keyword</label>
                      <div class="col-md-8">
                          <textarea name="meta_keyword" class="form-control">{{ $product->meta_keyword }}</textarea>
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
