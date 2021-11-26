@extends('layouts.fe.master')

@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta property="og:site_name" content="E-Certificate">
    <meta property="og:title" 
	@if ($data !== null)
	content="{{$data->name}}"
	@else
	content="Media NF"
	@endif  
	 />
    <meta property="og:description"
	@if ($data !== null)
	content="{{$data->deskripsi}}"
	@else
	content="Kumpulan media nurul falah"
	@endif
    />
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
					<h5 style="margin-top: 25px;">{{$data->name}}</h5>
					<p>{{$data->deskripsi}}</p>
				</div>
				<h2>
					@foreach ($data->user->subsosmed as $item)
						<a href="{{$item->link}}" target="_blank" style="box-shadow: 10px"><i class="text-white fa fa-{{$item->sosmed->icon}} mr-2 ml-2"></i></a>
					@endforeach
				</h2>
				<div class="separate text-white"></div>
			</div>
			
			<div class="row clearfix">
				@foreach ($data->user->link as $item)
					<!-- Accordion Column -->
					<a href="{{$item->link}}" target="_blank" style="text-decoration: none;" class="accordion-column col-sm-6 text-muted text-bold">
						<!-- Accordian Box -->
						<ul class="accordion-box" style="text-align: center">	
							<div class="card" style="padding: 10px; border-radius: 25px">
								<div class="acc-btn" style="text-transform: capitalize; text-align: center"> {{$item->name}}</div>
							</div>
						</ul>
					</a>
				@endforeach
			</div>
		</div>
	</section>
    <!--End Daftar Diklat-->


@endsection