<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	@yield('head')
	<title>LinksTree Lite</title>
</head>
<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header wrapper-->	
		<div class="header-wrapper">
			<!--start header -->
			<header>
				<div class="topbar d-flex align-items-center">
					<nav class="navbar navbar-expand">
						<div class="topbar-logo-header">
							<div class="">
								<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
							</div>
							<div class="">
								<h4 class="logo-text">BE LINKTREE LITE</h4>
							</div>
						</div>
						<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
						<div class="top-menu-left d-none d-lg-block ps-3">
						</div>
						<div class="top-menu ms-auto">
							<ul class="navbar-nav align-items-center">
								<li class="nav-item dropdown dropdown-large">
									<div class="dropdown-menu dropdown-menu-end">
										<div class="header-notifications-list">
										</div>
									</div>
								</li>
								<li class="nav-item dropdown dropdown-large">
									<div class="dropdown-menu dropdown-menu-end">
										<div class="header-message-list">
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="user-box dropdown">
							<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="{{ asset('corak/nf.png') }}" class="user-img" alt="user avatar">
								<div class="user-info ps-3">
									<p class="user-name mb-0">{{auth()->user()->name}}</p>
									<p class="designattion mb-0">{{auth()->user()->role}}</p>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								{{-- <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
								</li> --}}
								<li>
									<div class="dropdown-divider mb-0"></div>
								</li>
								<li>
									@auth
									<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
												  document.getElementById('logout-form').submit();">
									 <i class='bx bx-log-out-circle'></i>
									 {{ __('Logout') }} 
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
									</form>
									</a>
									@else
										
									@endauth
									
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
			<!--end header -->

            <div class="nav-container">
				<div class="mobile-topbar-header">
					<div>
						<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
					</div>
					<div>
						<h4 class="logo-text">BE LINKTREE</h4>
					</div>
					<div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
					</div>
				</div>
				<nav class="topbar-nav">
					<ul class="metismenu" id="menu">
						{{-- <li>
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class='bx bx-home-circle'></i>
								</div>
								<div class="menu-title">Dashboard</div>
							</a>
							<ul>
								<li> <a href="index.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
								</li>
							</ul>
						</li> --}}
						<li>
							<a href="javascript:;" class="has-arrow">
								<div class="parent-icon"><i class="bx bx-category"></i>
								</div>
								<div class="menu-title">Application</div>
							</a>
							<ul>
								<li> <a href="{{route('be_link.page')}}"><i class="bx bx-right-arrow-alt"></i>Manage Social Media</a>
								</li>
								<li> <a href="{{route('be_bg.page')}}"><i class="bx bx-right-arrow-alt"></i>Manage Background</a>
								</li>
							</ul>
						</li>
						
						{{-- <li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
								</div>
								<div class="menu-title">Components</div>
							</a>
							<ul>
								<li> <a href="widgets.html"><i class="bx bx-right-arrow-alt"></i>Widgets</a>
								</li>
							</ul>
						</li> --}}
						<li>
							<a class="has-arrow" href="javascript:;">
								<div class="parent-icon"><i class="bx bx-lock"></i>
								</div>
								<div class="menu-title">Authentication</div>
							</a>
							<ul>
								<li> <a href="{{route('be_user.page')}}"><i class="bx bx-right-arrow-alt"></i>User</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
			</div>