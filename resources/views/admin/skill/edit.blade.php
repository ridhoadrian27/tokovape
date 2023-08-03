@extends('layouts.admin.layout')
@section('header', 'Edit Skill')

@section('content')

  <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  {{-- <h3 class="card-keahlian">Quick Example</h3> --}}
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <form role="form" action="{{ route('modulskill.update', $skill->id) }}" method="post">
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
                      <label for="exampleInputEmail1">Keahlian</label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="keahlian" maxlength="90" value="{{ $skill->keahlian }}" placeholder="Keahlian">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Value</label>
                      <div class="col-md-5">
                        <textarea name="value" class="form-control" rows="5" placeholder="Value">{{ $skill->value }}</textarea>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/modulskill" class="btn btn-secondary">Kembali</a>
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
