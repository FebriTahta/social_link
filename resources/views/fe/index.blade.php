@extends('layouts.fe.master')

@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta property="og:site_name" content="E-Certificate">
    <meta property="og:title" content="Download E-Certificate"/>
    <meta property="og:description" content="Selamat datang para pecinta Al-Qur'an, terimakasih telah ikut serta
     dalam diklat tilawati. download e-certificate anda disini"/>
     <meta property="og:image" itemprop="image" content="{{ asset('assets/images/tumb.jpeg') }}">
@endsection

@section('content')
    
    <!--Daftar Diklat-->
    <section class="faq-section">
		<div class="pattern-layer" style="background-image: url({{ asset('tilawatipusat/landing/images/background/7.jpg') }});"></div>
		<div class="auto-container" style="min-height: 600px">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<img src="{{asset('be_img_aplikasi/'.$data->img)}}" style="border-radius: 50%; width: 100px" alt="">
				<div class="title mt-2">{{$data->name}}</div>
				<h2>
					@foreach ($data->user->subsosmed as $item)
						<i class="fa fa-{{$item->sosmed->icon}} mr-2 ml-2"></i> 
					@endforeach
				</h2>
				<div class="separate"></div>
			</div>
			
			<div class="row clearfix">
				@foreach ($data->user->link as $item)
					<!-- Accordion Column -->
					<a href="#{{$item->link}}" style="text-decoration: none" class="accordion-column col-xl-6 col-sm-12 col-sm-12">
						<!-- Accordian Box -->
						<ul class="accordion-box">	
							<li class="accordion block">
								<div class="acc-btn" style="text-transform: capitalize; text-align: right"><div class="icon-outer"></div><span style="text-transform: capitalize"> {{$item->name}}</span></div>
							</li>
						</ul>
					</a>
				@endforeach
			</div>
		</div>
	</section>
    <!--End Daftar Diklat-->


@endsection