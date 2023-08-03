@extends('layouts.admin.layout')
@section('header', 'Edit Waktu')

@section('content')

  <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  {{-- <h3 class="card-waktu">Quick Example</h3> --}}
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form role="form" action="{{ route('modultime.update', $time->id) }}" method="post">
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
                      <label for="exampleInputEmail1">Waktu</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="waktu" maxlength="90" value="{{ $time->waktu }}" placeholder="Waktu">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Konten</label>
                      <div class="col-md-5">
                        <textarea name="konten" class="form-control" rows="5" placeholder="Konten">{{ $time->konten }}</textarea>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/modultime" class="btn btn-secondary">Kembali</a>
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
