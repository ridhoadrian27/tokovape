@extends('layouts.web')

<?php $seo = DB::table('seo')->where('id_seo', '1')->first(); ?>
@section('title')
  {{ $seo->title ? $seo->title : 'Qnanz Official' }}
@endsection

@section('description')
  {{ $seo->deskripsi ? $seo->deskripsi : 'Qnanz Official' }}
@endsection

@section('keyword')
  {{ $seo->keyword ? $seo->keyword : 'Qnanz Official' }}
@endsection

@section('content')
    <div class="animsition">
        <div class="full-box">
            <main>
                @include('web.components.header')
                @component('web.components.page_title')
                    Frequently Asked Question
                @endcomponent

                <div class="container">
                    <div class="box">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="list-group">

                                    @for ($i = 0; $i < 10; $i++)
                                        <div class="list-group-item">
                                            <h4 class="list-group-item-heading">Lorem Ipsum Dolor ?</h4>
                                            <p class="list-group-item-text">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            </p>
                                        </div>
                                    @endfor

                                </div>
                            </div>
                        </div>

                        <hr />

                        @include('web.components.contact_section')

                    </div>
                </div>

            </main>


            @include('web.components.footer')

        </div>
    </div>
@endsection
