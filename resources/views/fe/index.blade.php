@extends('layouts.fe.master')

@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta property="og:site_name" content="E-Certificate">
    <meta property="og:title" content="Download E-Certificate"/>
    <meta property="og:description" content="Selamat datang para pecinta Al-Qur'an, terimakasih telah ikut serta
     dalam diklat tilawati. download e-certificate anda disini"/>
     <meta property="og:image" itemprop="image"
	 @if ($data !== null)
	 content="{{ asset('be_img_aplikasi_thumb/'.$data->img) }}"
	 @else
	 content="{{ asset('be_img_aplikasi_thumb/1637900067.jpeg') }}"
	 @endif 
	  >
@endsection

@section('content')
    
    <!--Daftar Diklat-->
    <section class="faq-section">
		
		{{-- <div class="pattern-layer" style="background-image: url({{ asset('tilawatipusat/landing/images/background/7.jpg') }});"></div> --}}
		<div class="pattern-layer"
		@if ($data->bg->first() == null)
		style="background-image: url({{ asset('corak/5.jpg') }});"	
		@else
		<?php $background = $data->bg->first()?>
		style="background-image: url({{ asset('bg_img_ori/'.$background->bg) }});"
		@endif
		></div>
		<div class="auto-container" style="min-height: 650px">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<img src="{{asset('be_img_aplikasi/'.$data->img)}}" style="border-radius: 50%; width: 100px" alt="">
				<div class="text-bold text-white mt-2">
					<h5 style="margin-top: 25px">{{$data->name}}</h5>
					<p>{{$data->deskripsi}}</p>
				</div>
				<h2>
					@foreach ($data->user->subsosmed as $item)
						<i class="text-white fa fa-{{$item->sosmed->icon}} mr-2 ml-2"></i> 
					@endforeach
				</h2>
				<div class="separate text-white"></div>
			</div>
			
			<div class="row clearfix">
				@foreach ($data->user->link as $item)
					<!-- Accordion Column -->
					<a href="{{$item->link}}" target="_blank" style="text-decoration: none" class="accordion-column col-sm-6">
						<!-- Accordian Box -->
						<ul class="accordion-box">	
							<li class="accordion block">
								<div class="acc-btn" style="text-transform: capitalize; text-align: right"> {{$item->name}}</div>
							</li>
						</ul>
					</a>
				@endforeach
			</div>
		</div>
	</section>
    <!--End Daftar Diklat-->


@endsection