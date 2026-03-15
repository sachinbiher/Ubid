<!DOCTYPE html>
<html lang="en" data-textdirection="ltr">
	<!-- BEGIN: Head-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
		<meta name="description" content="UBID">
		<meta name="keywords" content="UBID">
		<meta name="author" content="UBID">
		<title>UBID  {{ $title ?? '' }} </title>
		<link rel="apple-touch-icon" href="{{url('partner-assets/app-assets/images/ico/apple-icon-120.png')}}">
		<link rel="shortcut icon" type="image/x-icon" href="{{url('partner-assets/app-assets/images/favicon.ico')}}">
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/vendors/css/vendors.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/bootstrap-extended.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/colors.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/components.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/themes/dark-layout.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/themes/bordered-layout.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/owl.theme.default.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/owl.carousel.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/plugins/forms/form-validation.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/css/pages/page-auth.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/seller-style.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('assets/css/custom.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('app-assets/vendors/css/forms/select/select2.min.css')}}">
        <link href="{{url('app-assets/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
		<style>
		.required {
			color:red;
		}
		</style>

        @stack('PAGE_ASSETS_CSS')

	</head>
	<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
		<div class="app-content content ">
			<div class="content-overlay"></div>
			<div class="header-navbar-shadow"></div>
			<div class="content-wrapper">
				<div class="content-header row"></div>
				<div class="content-body">

                    @yield('content')

				</div>
			</div>
		</div>
		<script src="{{url('app-assets/vendors/js/vendors.min.js')}}"></script>
		<script src="{{url('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
		<script src="{{url('app-assets/js/core/app-menu.min.js')}}"></script>
		<script src="{{url('app-assets/js/core/app.js')}}"></script>
		<script src="{{url('app-assets/js/scripts/owl.carousel.min.js')}}"></script>
		<script src="{{url('app-assets/js/scripts/pages/authentication_validation.js')}}"></script>
		<script src="{{url('app-assets/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
		<script src="{{url('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
		<script src="{{url('app-assets/js/scripts/forms/form-select2.js')}}"></script>

        @stack('PAGE_ASSETS_JS')

        <!-- END: Page JS-->
		<script>
        $(window).on('load',  function(){
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        })
		</script>
		<script>
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
		</script>
        {{-- Page level scripts starts --}}
        @stack('PAGE_SCRIPTS')
        {{-- Page level scripts ends --}}
	</body>
	<!-- END: Body-->
</html>