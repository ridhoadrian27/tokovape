@extends('layouts.member.layout')
@section('header', 'Profile User')

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

                <form role="form" action="/member/updateprofile" method="post">
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

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="name" id="name" maxlength="90" value="{{ $member->name }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="email" id="email" maxlength="90" value="{{ $member->email }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Telepon</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="telepon" id="telepon" maxlength="15" value="{{ $member->telepon }}">
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
