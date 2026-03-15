<!DOCTYPE html>
<html  lang="en" data-textdirection="ltr">
	<!-- BEGIN: Head-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
		<meta name="description" content="online shopping for kids, baby products online, kids dress online shopping, best online shopping for kids,  kids toys online shopping.">
		<meta name="keywords" content="aonline shopping for kids, baby products online, kids dress online shopping, best online shopping for kids,  kids toys online shopping">
		<meta name="author" content="UBID">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? '' }}</title>
		<style>
			
		</style>
		<link rel="apple-touch-icon" href="{{ url('app-assets/images/ico/apple-icon-120.png') }}">
		<!-- <link rel="shortcut icon" type="image/x-icon" href="{{ url('app-assets/images/ico/favicon.png') }}"> -->
		<!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet"> -->
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
		<!-- BEGIN: Vendor CSS-->
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/vendors.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/charts/apexcharts.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/extensions/toastr.min.css') }}">

        @stack('PAGE_VENDOR_CSS')
		<!-- END: Vendor CSS-->
		<!---FONTS-->
		<!-- <link rel="stylesheet" type="text/css" href="{{ url('app-assets/fonts/fontfamily/font.css') }}"> -->
		<link rel="stylesheet" href="{{ url('app-assets/vendors/css/tables/datatable/fixedHeader.bootstrap4.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/forms/select/select2.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/form-validation.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/form-wizard.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-file-manager.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/fonts/font-awesome/css/font-awesome.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/owl.theme.default.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/owl.carousel.min.css') }}">
		<!-- BEGIN: Theme CSS-->
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bootstrap-extended.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/colors.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/components.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/dark-layout.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/bordered-layout.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/themes/semi-dark-layout.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/extensions/ext-component-ratings.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/extensions/jquery.rateyo.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/page-profile.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/dashboard-ecommerce.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/charts/chart-apex.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-chat-list.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/app-chat.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/bs-stepper.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/image-uploader.min.css') }}">

        @stack('PAGE_ASSETS_CSS')

        <!---custom CSS-->
		<link rel="stylesheet" type="text/css" href="{{ url('assets/css/seller-style.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('assets/css/custom.css') }}">
        <!---custom CSS-->
		<style>
			        #merchant-desc{
            overflow: visible!important;
        }
		</style>

	</head>
	<body data-theme-version="light" data-layout="vertical" data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="mini" data-sibebarbg="color_1" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1">
		<div id="main-wrapper">

            <!-- BEGIN: Header-->
            @include('components.header')
            <!-- END: Header-->

            <!-- BEGIN: Side Navbar-->
            @include('components.sidebar')
            <!-- END: Side Navbar-->

			<div class="app-content content content-ps-stl">

                @yield('content')

			</div>
			<div class="sidenav-overlay"></div>
			<div class="drag-target"></div>

			<!-- BEGIN: Footer-->
            @include('components.footer')
            <!-- END: Footer-->

		</div>
		<!-- BEGIN: Vendor JS-->
		<script src="{{ url('app-assets/vendors/js/vendors.min.js') }}"></script>
        <script src="{{ url('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
        <script src="{{ url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
		<!-- END: Vendor JS-->

		<!-- BEGIN: Page Vendor JS-->
		<script src="{{ url('app-assets/js/scripts/charts/chart-chartjs.min.js') }}"></script>
        @stack('PAGE_VENDOR_JS')
		<!-- END: Page Vendor JS-->

		<!-- BEGIN: Theme JS-->
		<script src="{{ url('app-assets/js/core/app-menu.min.js') }}"></script>
		<script src="{{ url('app-assets/js/core/app.js') }}"></script>
		<script src="{{ url('app-assets/js/core/JsUtility.js') }}"></script>
		<script src="{{ url('assets/js/scripts.js') }}"></script>
		<!-- END: Theme JS-->
		<!-- BEGIN: Page JS-->
		<!-- BEGIN Vendor JS-->
		<!-- BEGIN: Page Vendor JS-->
		<script src="{{ url('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/forms/form-select2.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/forms/form-wizard.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/charts/chart.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/owl.carousel.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/extensions/ext-component-ratings.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/extensions/jquery.rateyo.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/customizer.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/tables/datatable/dataTables.fixedHeader.min.js') }}"></script>
		<script src="{{ url('app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/tables/table-datatables-basic.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/pages/app-file-manager.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/pages/app-chat.min.js') }}"></script>
		<script src="{{ url('app-assets/js/scripts/image-uploader.min.js') }}"></script>


        @stack('PAGE_ASSETS_JS')
		<!-- END: Page JS-->
		<script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
		</script>
		<script>
        $('.carousel').carousel({
			interval: 30000,
			duration:10000
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

			$("#ajaxModal").on("show.bs.modal", function(e) {
			$(this).find('.modal-dialog').html('');
			
			var link = $(e.relatedTarget);
			$(this).find('.modal-dialog').load(link.attr("href"));
                   
        });
        });
		
		</script>
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
        @stack('PAGE_SCRIPTS')
	</body>
	<!-- END: Body-->
</html>