<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{{$data->name}}</title>
<!-- Stylesheets -->
{{-- <link href="{{ asset('tilawatipusat/landing/css/bootstrap.css') }}" rel="stylesheet"> --}}
<link href="{{ asset('tilawatipusat/landing/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('tilawatipusat/landing/css/responsive.css') }}" rel="stylesheet">
<meta property="og:title" content="Download E-Certificate"/>
<meta property="og:description" content="Selamat datang para pecinta Al-Qur'an, terimakasih telah ikut serta
     dalam diklat tilawati. download e-certificate anda disini"/>
<meta property="og:image" itemprop="image" content="{{ asset('assets/images/tumb.jpeg') }}">
@yield('head')

{{-- <link href="https://fonts.googleapis.com/css2?family=Niconne&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Tangerine:wght@400;700&display=swap" rel="stylesheet"> --}}

<link rel="shortcut icon" href="{{ asset('corak/nf.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('corak/nf.png') }}" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body class="hidden-bar-wrapper">
<div class="page-wrapper">
    <!-- Preloader -->
    {{-- <div class="preloader"></div> --}}