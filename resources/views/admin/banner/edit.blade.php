@extends('layouts.admin.layout')
@section('header', 'Edit Banner')

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

                <form role="form" action="{{ route('modulbanner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
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

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="nama" value="{{ $banner->nama }}" placeholder="Nama Banner" maxlength="90">
                      </div>
                    </div> --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Text 1</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="text1" value="{{ $banner->text1 }}" placeholder="Text 1">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Text 2</label>
                      <div class="col-md-8">
                        <textarea name="text2" id="text2" class="form-control" rows="3">{{ $banner->text2 }}</textarea>
                      </div>
                    </div>

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Text 3</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="text3" value="{{ $banner->text3 }}" placeholder="Text 3">
                      </div>
                    </div> --}}

                    <div class="form-group">
                      <label for="exampleInputEmail1">Button Text</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="button_text" value="{{ $banner->button_text }}" placeholder="Button Text">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Link</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="customlink" value="{{ $banner->customlink }}" placeholder="Custom Link">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar (Rekomendasi width: 1920px, height: 896px)</label>
                      <div class="col-md-5">
                        <img src="{{$banner->getBanner()}}" style="max-height: 50px;"/>
                        <input type="hidden" class="form-control" name="gambar_lama" value="{{ $banner->gambar }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label>
                      <div class="col-md-5">
                        <input type="file" class="form-control" name="gambar" placeholder="Gambar">
                      </div>
                    </div>

                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Foto</label>
                      <div class="col-md-5">
                        <img src="{{$banner->getFoto()}}" style="max-height: 50px;"/>
                        <input type="hidden" class="form-control" name="foto_lama" value="{{ $banner->foto }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Foto</label>
                      <div class="col-md-5">
                        <input type="file" class="form-control" name="foto" placeholder="Foto">
                      </div>
                    </div> --}}

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/modulbanner" class="btn btn-secondary">Kembali</a>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->

@endsection
