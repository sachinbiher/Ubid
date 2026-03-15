<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
	<!-- BEGIN: Head-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
		<meta name="description"
			content="UBID">
		<meta name="keywords"
			content="UBID">
		<meta name="author" content="UBID">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>UBID</title>
		<link rel="apple-touch-icon" href="{{url('partner-assets/app-assets/images/ico/apple-icon-120.png')}}">
		<link rel="shortcut icon" type="image/x-icon" href="{{url('partner-assets/app-assets/images/favicon.ico')}}">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
			rel="stylesheet">
		<!-- BEGIN: Vendor CSS-->
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/vendors/css/vendors.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/vendors/css/extensions/nouislider.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/vendors/css/extensions/toastr.min.css')}}">
		<!-- END: Vendor CSS-->
		<!-- BEGIN: Theme CSS-->
		
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/bootstrap.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/bootstrap-extended.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/colors.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/components.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/themes/dark-layout.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/themes/bordered-layout.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/themes/semi-dark-layout.css')}}">
		<!-- BEGIN: Page CSS-->
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/plugins/extensions/ext-component-sliders.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/pages/app-ecommerce.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/vendors/css/forms/select/select2.min.css')}}">
		<!-- END: Page CSS-->
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-chat-list.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-chat.min.css') }}">
		


		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- BEGIN: Custom CSS-->
		<link rel="stylesheet" type="text/css" href="{{ url('assets/css/seller-style.css') }}">
		<link rel="stylesheet" type="text/css" href="{{url('partner-assets/assets/css/style.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/fonts/font-awesome/css/font-awesome.css')}}">
		<style>
			.header-navbar .navbar-container ul.navbar-nav li.dropdown-user .dropdown-menu {
				width: 13rem!important;
			}

		
		</style>
		<!-- END: Custom CSS-->
	</head>
	<!-- END: Head-->
	<!-- BEGIN: Body-->
	<body class="vertical-layout vertical-menu-modern content-detached-left-sidebar menu-hide navbar-floating footer-static  "
		data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-left-sidebar">
		<!-- BEGIN: Header-->
		<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
			<div class="navbar-container d-flex content">
				<div class="bookmark-wrapper d-flex align-items-center">
					<ul class="nav navbar-nav d-xl-none">
						<li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
							data-feather="menu"></i></a></li>
					</ul>
					<ul class="nav navbar-nav">
						<li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"> {{$activeMenu}}</a></li>
					</ul>					 
				</div>
				<ul class="nav navbar-nav align-items-center ml-auto">
					<div class="search-input">
						<div class="search-input-icon"><i data-feather="search"></i></div>
						<input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1"
							data-search="search">
						<div class="search-input-close"><i data-feather="x"></i></div>
						<ul class="search-list search-list-main"></ul>
					</div>
					@php $wishlistcount = App\Models\Vendor_Wishlist::where('vendor_id',$vendor->id)->count(); @endphp
					<li class="nav-item dropdown dropdown-cart mr-25">
					
            
						<a class="nav-link" @if($vendor->status==1 && $subscriptiontype->period_months <> '0' ) href="{{route('ppanel.wishlist')}}"  @elseif($vendor->status==1 && $subscriptiontype->period_months == '0') href="javascript:changestatus(4);" @else href="javascript:changestatus(1);"  @endif ><i class="ficon" data-feather="heart"></i><span
							class="badge badge-pill badge-success badge-up cart-item-count">{{$wishlistcount}}</span></a>
					</li>
					<li class="nav-item dropdown dropdown-notification mr-25">
						<a class="nav-link" href="javascript:void(0);"
							data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span
							class="badge badge-pill badge-danger badge-up">{{$notification_count}}</span></a>
						<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
							<li class="dropdown-menu-header">
								<div class="dropdown-header d-flex">
									<h4 class="notification-title mb-0 mr-auto">Notifications</h4>
								</div>
							</li>
							<li class="scrollable-container media-list">
								@foreach($notifications as $notification)
								<a class="d-flex" href="{{route('ppanel.notification')}}">
									<div class="media d-flex align-items-start">
										<div class="media-left">
											<div class="avatar"><img src="{{url('partner-assets/app-assets/images/avatars/profile.png')}}" alt="avatar" width="32" height="32"></div>
										</div>
										<div class="media-body">
											<p class="media-heading"><span class="font-weight-bolder">{{$notification->title}}</span></p>
										</div>
										<p class="media-heading" style="color: #6E6B7B;margin-bottom: 0;line-height: 1.2;"><small class="notification-text" style="margin-bottom: .5rem;font-size: smaller;color: #B9B9C3;">{{date('d M, Y h:i A', strtotime($notification->created_at))}}</small></p>
									</div>
								</a>
								@endforeach
							</li>
							@if($notification_count==0)
							<p style="text-align: center; margin-top: 3%;">No New Notifications!</p>
							<li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{route('ppanel.notification')}}">Read all notifications</a></li>
							@else
							<li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{route('ppanel.notification')}}">Read all notifications</a></li>
							@endif
						</ul>
					</li>
					<li class="nav-item dropdown dropdown-user">
						<a class="nav-link dropdown-toggle dropdown-user-link"
							id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">
							
							<div class="user-nav d-md-flex d-none"><span class="user-name font-weight-bolder">{{$vendor->company}}</span>
								<!-- <span class="user-status">Sample</span> -->
							</div> 

							
								@if($vendor->photo !='')
									<span class="avatar"><img
									class="round" src="{{url($vendor->photo)}}"
									alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
								@else
									<span class="avatar"><img
										class="round" src="{{url('partner-assets/app-assets/images/portrait/small/profile.png')}}"
										alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
								@endif
									
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
							<a class="dropdown-item" href="{{route('ppanel.vprofile')}}"><i class="mr-50" data-feather="user"></i>Profile</a>
							<a class="dropdown-item" href="{{route('ppanel.changepassword')}}"><i class="mr-50" data-feather="lock"></i>Change Password</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{route('logout')}}"><i
								class="mr-50" data-feather="power"></i> Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<!-- END: Header-->
		<!-- BEGIN: Main Menu-->
		<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
		<span class="nav-item nav-toggle">
			<a class="nav-link modern-nav-toggle pe-0 dm-none" data-bs-toggle="collapse"><i data-feather="x"></i></a></span>
			<div class="navbar-header">

		
				<ul class="nav navbar-nav flex-row">
					<li class="nav-item mr-auto"><a class="navbar-brand"
						href="javascript:;"><span class="brand-logo">
						<a href="{{route('ppanel.vprofile')}}">
							<img src="{{url('app-assets\images\logo\UBID-Logo-1X.png')}}" alt="" height="28" /> &nbsp;
							<img src="{{url('app-assets\images\logo\ubid-text-logo.png')}}" alt="" height="23" />
						</a>
					</li>
						</ul>
			</div>
			<div class="shadow-bottom"></div>
            @include('partnerpanel.sidebar')
		</div>
		<!-- END: Main Menu-->
		<!-- BEGIN: Content-->
		<div class="app-content content ecommerce-application">
	
            @yield('content')
		</div>
		<!-- View Status -->
		<div class="modal fade text-left" id="viewdetail" tabindex="-1" role="dialog" aria-labelledby="viewdetailLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
				<div class="modal-content file-manager-application">
					<div class="modal-header">
						<h4 class="modal-title text-dark" id="viewdetailLabel"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-2">
						<div class="row">
							<div class="form-group col-md-12" id='textchangemsg'>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- END: Content-->
		<div class="sidenav-overlay"></div>
		<div class="drag-target"></div>
		<!-- BEGIN: Footer-->
		<!-- <footer class="footer footer-static footer-light">
			<p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{date('Y')}}<a
				class="ml-25" href="javascript:;" target="_blank">UBID</a><span
				class="d-none d-sm-inline-block">, All Rights Reserved</span></span></p>
		</footer> -->
		<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
		<!-- END: Footer-->
		<!-- BEGIN: Vendor JS-->
		<script src="{{url('partner-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
		
		<script src="{{ url('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>

		<!-- BEGIN Vendor JS-->
		<!-- BEGIN: Page Vendor JS-->
		<script src="{{url('partner-assets/app-assets/vendors/js/extensions/wNumb.min.js')}}"></script>
		<script src="{{url('partner-assets/app-assets/vendors/js/extensions/nouislider.min.js')}}"></script>
		<script src="{{url('partner-assets/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
		<script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
		<!-- END: Page Vendor JS-->
		<!-- BEGIN: Theme JS-->
		<script src="{{url('partner-assets/app-assets/js/core/app-menu.js')}}"></script>
		<script src="{{url('partner-assets/app-assets/js/core/app.js')}}"></script>
		<!-- END: Theme JS-->
		<!-- BEGIN: Page JS-->
		<script src="{{url('partner-assets/app-assets/js/scripts/pages/app-ecommerce.js')}}"></script>
		<script src="{{url('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
		<script src="{{url('app-assets/js/scripts/forms/form-select2.js')}}"></script>
		<script  src="{{url('app-assets/js/scripts/slick.js')}}"></script>
		<script src="{{url('app-assets/js/scripts/pages/app-chat.min.js')}}"></script>
		<!-- END: Page JS-->
		<script>

			function changestatus(n)
			{
				// alert(n)
				$("#viewdetail").modal('show');
				if(n==2)
				{
					$("#textchangemsg").html('Please Add Services First Before adding the Project');
					$("#viewdetailLabel").html('Upload Images');
				}	
				else if(n==1)
				{
					$("#textchangemsg").html('Profile Not Approved Yet.');
					$("#viewdetailLabel").html('Profile Status');
				}
				else if(n==3)
				{
					$("#textchangemsg").html('Testimonials Under Development');
					$("#viewdetailLabel").html('Testimonials');
				}	
				else if(n==4)
				{
					$("#textchangemsg").html('No Subscription found<br>Upgrade to a <a  href="{{route('subscriptionDetails')}}">membership plan</a> to place bids on unlimited projects. ');
					$("#viewdetailLabel").html('Subscription');
				}	
			}


        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
        toastr.options = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-right", //toast-top-full-width
			"onclick": null,
			"showDuration": "15000",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut",
			"progressBar": true
		}

		@if (Session::has('status') && Session::has('toast'))
		toastr["{{session('status')}}"]("{{session('message')}}", "{{session('title')}}");
		@endif
		// toastr["success"]("sadasdasd", "sadasdasd");

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
		</script>
		<script>
$('.slider-for').slick({
   slidesToShow: 5,
   slidesToScroll: 1,
   infinite: false,
   prevArrow: '<button class="slide-arrow prev-arrow"></button>',
    nextArrow: '<button class="slide-arrow next-arrow"></button>',
	responsive: [
      {
        breakpoint: 980,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
    ],
	
 });
	</script>
	</body>
	<!-- END: Body-->
	<script>
		
		$('.menu-toggle, .nav-toggle').on("click", function() {
     
			$('body').toggleClass('menu-open');
			$('.sidenav-overlay').toggleClass('show');
	   
   })
   $('.sidenav-overlay').on('click', function(e) {
        // Hide menu
		$('body').toggleClass('menu-open');
  
    });
   </script>
</html>