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

  @include('web.components.header')

  <!-- PAGE-CONTENT START -->
		<section class="page-content">
			<!-- PAGE-BANNER START -->
			<div class="page-banner-area photo-2 margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-banner-menu">
								<h2 class="page-banner-title">Subscribe Berhasil</h2>
								<ul>
									<li><a href="/home">home</a></li>
									<li>Subscribe Berhasil</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PAGE-BANNER END -->
			<!-- ABOUT-AREA START -->
			<div class="about-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<div class="about-us">
								<div>
                  <!-- konten -->
                    <div style="text-align: center;">
                      <h2>Terima kasih sudah melakukan subscribe</h2><br>
                    </div>
                      <hr>
                      <div class="add-to-box" style="text-align: center; margin-top:20px;">
                        <div class="add-to-cart">
                          <button onclick="location.href='/home'" style="float: none; padding: 10px; margin:0px;background-color: #1c95d1; color: white; font-weight: normal; cursor: pointer;" class="button" title="Home" type="button"><span style="font-size: 20px;">Kembali ke Home</span></button>
                        </div>
                      </div>
                  <!-- konten -->
                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- ABOUT-AREA END -->
		</section>
		<!-- PAGE-CONTENT END -->

  @include('web.components.footer')

@endsection
