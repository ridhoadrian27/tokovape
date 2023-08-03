@extends('layouts.admin.layout')
@section('header', 'Edit Link')

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

                <form role="form" action="{{ route('modulmarketplace.update', $marketplace->id) }}" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="nama" maxlength="90" value="{{ $marketplace->nama }}" placeholder="Nama Marketplace">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label>
                      <div class="col-md-5">
                        <img src="{{$marketplace->getImage()}}" style="max-height: 50px;"/>
                        <input type="hidden" class="form-control" name="gambar_lama" value="{{ $marketplace->gambar }}">
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
                        <input type="text" class="form-control" name="permalink" maxlength="90" value="{{ $marketplace->permalink }}" placeholder="Link">
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/modulmarketplace" class="btn btn-secondary">Kembali</a>
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
