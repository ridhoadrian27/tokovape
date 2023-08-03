@extends('layouts.admin.layout')
@section('header', 'Feature Product')

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

                <form role="form" action="/featproduct/update" method="post" enctype="multipart/form-data">
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
                      <label for="exampleInputEmail1">Title</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="title" value="{{ $featproduct->title }}" maxlength="90" placeholder="Title">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Subtitle</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="subtitle" value="{{ $featproduct->subtitle }}" maxlength="90" placeholder="Subtitle">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label>
                      <div class="col-md-5">
                        <img src="{{$featproduct->getImage()}}" style="max-height: 50px;"/>
                        <input type="hidden" class="form-control" name="gambar_lama" value="{{ $featproduct->gambar }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label>
                      <div class="col-md-5">
                        <input type="file" class="form-control" name="gambar" placeholder="Gambar">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Link</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="permalink" maxlength="90" value="{{ $featproduct->permalink }}" placeholder="Link">
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

@endsection
