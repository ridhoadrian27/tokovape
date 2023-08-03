@extends('layouts.web')

<?php $seo = DB::table('seo')->where('id_seo', '1')->first(); ?>
@section('title')
  {{ $seo->title ? $seo->title : 'Jasa Pembuatan Website | websitetangguh.com' }}
@endsection

@section('description')
  {{ $seo->deskripsi ? $seo->deskripsi : 'Jasa Pembuatan Website | websitetangguh.com' }}
@endsection

@section('keyword')
  {{ $seo->keyword ? $seo->keyword : 'Jasa Pembuatan Website | websitetangguh.com' }}
@endsection

@section('content')

  @include('web.components.header')

  <!-- PAGE-CONTENT START -->

    <!-- SLIDER-AREA START -->
    @include('web.components.sliders')
    <!-- SLIDER-AREA END -->

    <!-- BANNER-AREA START -->
    @include('web.components.bestseller')

    {{-- @include('web.components.categories') --}}

    @include('web.components.productarea')

    {{-- @include('web.components.productcount') --}}

    {{-- @include('web.components.history') --}}

    {{-- @include('web.components.banner') --}}

    {{-- @include('web.components.testimoni') --}}

    {{-- @include('web.components.newsletter') --}}

    {{-- @include('web.components.blog') --}}

    {{-- @include('web.components.brand') --}}
  <!-- PAGE-CONTENT END -->

  @include('web.components.footer')

@endsection
