@extends('layouts.auth') @push('PAGE_ASSETS_CSS') <style>
        .spacer {
            margin: 0px 5px;
        }

        .child-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
            padding: 10px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .main-content h3,
        .main-content h2 {
            font-size: 2.8rem;
            font-weight: 500;
            color: #000;
        }

        .main-content p {
            font-size: 1.4rem;
            color: #000;
        }

        .main-content .free-plan {
            text-decoration: none;
            color: black;
            border: 1px solid #adb5bd;
            border-radius: 5rem;
            padding: 0px 15px;
            margin: 10px 0;
            background: #2eeab7;
            font-size: 20px;
            height: 50px;
        }
        }

        .main-content .power-img {
            width: 200px;
            position: absolute;
            top: -36px;
            right: -100px;
            z-index: -1;
        }

        /*radios*/
        /* Hide the browser's default radio button */
        .form-check input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        [type="radio"]:checked+label,
        [type="radio"]:not(:checked)+label {
            position: relative;
            padding-left: 28px;
            cursor: pointer;
            line-height: 20px;
            display: inline-block;
            color: #000;
        }

        [type="radio"]:checked+label:before,
        [type="radio"]:not(:checked)+label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 18px;
            height: 18px;
            border: 1px solid #ddd;
            border-radius: 100%;
            background: #fff;
        }

        [type="radio"]:checked+label:after,
        [type="radio"]:not(:checked)+label:after {
            content: '';
            width: 12px;
            height: 12px;
            background: #2eeab7;
            position: absolute;
            top: 3px;
            left: 3px;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        [type="radio"]:not(:checked)+label:after {
            opacity: 0;
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        [type="radio"]:checked+label:after {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        /* cards */
        .description {
            height: 50px;
            display: flex;
            align-items: end;
            justify-content: center;
            text-align: center;
            margin-bottom: 12px;
            font-size: 15px;
            color: #000;
            position: relative;
        }

        .desc-main {
            position: relative;
        }

        .desc-main-monthly::after {
            content: "";
            position: absolute;
            height: 1px;
            width: 80%;
            z-index: -1;
            background: #00000099;
            opacity: 0.2;
            bottom: -11%;
            right: -29%;
        }

        .desc-main::before {
            content: '';
            /* background: #b35b25; */
            background-image: url('./app-assets/images/subscription-page/ellipse.png');

            position: absolute;
            top: 49px;
            /* left: -2px; */
            background-size: 13px;
            background-repeat: no-repeat;
            width: 14px;
            height: 14px;
            border-radius: 50%;

        }

        .desc-main-yearly::after {
            content: "";
            position: absolute;
            height: 1px;
            width: 50%;
            z-index: -1;
            background: #00000099;
            opacity: 0.2;
            bottom: -11%;
            left: 8px;
        }

        .card {
            padding: 12px 12px 0;
        }

        .card-blue {
            background: linear-gradient(20deg, #5809a0, #a8c0ff) !important;
            border: none;
            border-radius: 0;
        }

        .price-o {
            font-size: 13px;
            margin-left: 46px;
            padding: 6px 8px 0;
            text-decoration: line-through;
            color: #000;
            position: relative;
        }

        .card-blue .card-content .col-12>a {
            font-size: 11px;
            text-decoration: underline;
        }

        .subscribe-btn {
            position: relative;
            top: 10px;
            border: 1px solid #adb5bd;
            background: #fff;
            font-size: 14px;
            color: #000;
            text-decoration: none;
            outline: none;
            padding: 3px 20px;
            border-radius: 30px;
        }

        .cost {
            text-align: center;
            color: #fff;
            font-size: 34px;
            display: block;
            position: relative;
        }

        /*
    .month::before {
        content: 'mo';
        font-size: 10px;
        position: absolute;
        top: 23%;
        left: 59%;
        color: #fff;
    } */
        .card-content .col-12>a {
            display: block;
            font-size: 14px;
            margin: 8px 0;
            color: #fff;
            text-decoration: underline;
        }

        /* 2nd card */
        .orange-bg::before {
            background-image: url('./app-assets/images/subscription-page/orange_bg.png') !important;
            background-repeat: no-repeat;
            background-position: 110% 50%;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background-size: 100%;
            height: 100%;
            width: 100%;
        }

        .orange-bg a {
            font-size: 15px !important;
        }

        .blue-bg::before {
            background-image: url('./app-assets/images/subscription-page/blue_bg.png') !important;
            background-repeat: no-repeat;
            background-position: 110% 34%;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            background-size: 100%;
            height: 100%;
            width: 100%;
        }

        .card-content {
            padding-top: 40px;
            margin-bottom: 50px;
        }

        .card {
            padding: 0 !important;
            border: 0 !important;
        }

        .cost-goldcard2 {
            font-size: 1.2rem;
            color: #fff;
            margin-right: 5px;
            margin-bottom: 0;
        }

        .price2 {
            text-decoration: none;
        }

        .card2-month::before {
            left: 62%;
            top: 21%;
        }

        /* 3nd & 4th card */
        .cost-bluecard2 {
            font-size: 1.2rem;
            text-decoration: line-through;
            color: #fff;
            margin-right: 5px;
            margin-bottom: 0;
        }

        .price-active {
            position: relative;
            display: flex;
            justify-content: center;
        }

        .yearly-subscription {
            font-size: 9px !important;
            margin-top: 0;
            color: #fff !important;
        }

        .card3-month::before {
            top: 22%;
            left: 82%;
        }

        .card4-month::before {
            left: 87%;
            top: 19%;
        }

        /*END cards */
        .widget-line {
            position: relative;
        }

        .subscribestyleyearly {
            height: 137px;
        }

        .subscribestylemonth {
            height: 137px;
        }

        .widget-line::before {
            content: '';
            /* background: #b35b25; */
            background-image: url('./app-assets/images/subscription-page/ellipse.png');
            position: absolute;
            top: 40px;
            background-size: contain;
            left: -2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        .widget-line p {
            position: absolute;
            top: 80px;
            left: -80px;
            transform: rotate(270deg);
        }

        .widget-line .yearly {
            position: absolute;
            top: 65px;
            left: -65px;
        }

        .widget-line::after {
            content: "";
            position: absolute;
            height: 108%;
            width: 1px;
            z-index: -1;
            background: #00000099;
            opacity: 0.2;
            top: 15%;
            left: 8px;
        }

        .w-none::after {
            content: none;
        }

        @media (max-width:600px) {
            .main-content p {
                font-size: 1rem;
            }

            .main-content h2 {
                font-size: 1.8rem;
            }

            .main-content .power-img {
                position: absolute;
                left: 80px;
                top: -40px;
                width: 150px;
            }

            .description {
                font-size: 15px;
                margin-left: 30px;
            }

            .card-blue {
                width: 130px;
            }

            .card-gold {
                width: 160px;
            }

            .widget-line::before {
                left: 16px;
            }

            .widget-line::after {
                left: 24px;
            }

            .widget-line p {
                transform: rotate(270deg);
                position: absolute;
                top: 65px;
                left: -30px;
            }

            .widget-line .yearly {
                position: absolute;
                top: 60px;
                left: -20px;
            }
        }

        @media (max-width:1024px) {
            .main-content .power-img {
                position: absolute;
                top: -30px;
                right: 100px;
            }
        }

        @media (max-width:768px) {
            .main-content .power-img {
                width: 170px;
                height: 170px;
                float: right;
                top: -30px;
                position: absolute;
                right: 10px;
            }

            .widget-line::after {
                height: 320px !important;
                top: 50px !important;
            }
        }

        .navbar-brand img {
            width: 211px;
        }

        .month {
            position: absolute;
            font-size: 12px;
            top: 25px;
            right: 6px;
        }

        body {
            background: #fff !important
        }

        /* .cost-first .month {
            right: 43PX;
        }

        .cost-second .month {
            right: 61px;
        } */
        .p-t70 {
            padding-top: 70px;
        }

        .pt-36 {
            padding-top: 36px;
        }

        #toast-container .toast-success {
            background-color: #28c76f !important;
        }

        #toast-container .toast-error {
            background-color: #ea5455 !important;
        }

        .noclick_links {
            pointer-events: none;
            cursor: default;
        }
        #merchant-desc{
            overflow: visible!important;
        }

    </style>
    <!--font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @endpush @section('content') <div class="col-xl-8 col-lg-6">
        <div class="pt-2">
            <a class="navbar-brand" href="{{ route('login') }}">
                <img src="./app-assets/images/UBID-logo.png">
            </a>
        </div>
    </div>
    <div class="">
        <div class="main-content col-lg-6 col-md-6 offset-lg-3 offset-md-4">
            <h3>UBID is FREE!</h3>
            <p>As long as you want to View all Projects!</p>
            <form method="post" action="{{ route('profile_review') }}"> {!! csrf_field() !!} <input type="hidden"
                    class="form-control" name="id" id="id" value="{{ Session::get('id') }}">
                <input type="hidden" class="form-control" name="subscription_id" id="subscription_id" value="1">
                <button type="submit" class="free-plan">Continue with Free Plan!</button>
            </form>
            <div class="position-relative">
                <h2 style="z-index: 3">To have more Power!</h2>
                <p class='text-center'>Subscribe to anyone of our plans!</p>
                <div class="power-img" style='position: absolute;    top: -47px;     right: -179px;     z-index: -1;'>
                    <img src="{{ url('app-assets\images\subscription-page\Power_Illustration.png') }}" alt="" />
                </div>
            </div>
            <div class="">
                <h3>34% OFF</h3>
                <p>on All Subscriptions!</p>
            </div>
        </div>
        <br>
        <!--plans--> @php
            $monthly = \App\Models\Subscription::where('period_months', 1)
                ->where('status', 1)
                ->get();
            $yearly = \App\Models\Subscription::where('period_months', 12)
                ->where('status', 1)
                ->get();
        @endphp <div class='container'>
            <div class='col-lg-12'>
                <div class='row' style="width: 100%; margin-bottom:25%;">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id='monthly' style="width: 100%;    margin-left:5%;">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class='desc-main description desc-main-monthly'>MONTHLY</p>
                            </div>
                            @if (isset($monthly))
                                @foreach ($monthly as $month)
                                    <div class="col-lg-6 ">
                                        <form id="form{{ $month->id }}" method="post" action="{{ route('profile_review') }}"> {!! csrf_field() !!} <input type="hidden"
                                                class="form-control" name="id" id="id" value="{{ Session::get('id') }}">
                                                <input type="hidden" class="form-control" name="transaction_id" id="transaction_id" value="">
                                            <input type="hidden" class="form-control" name="subscription_id"
                                                id="subscription_id" value="{{ $month->id }}">
                                                <input type="hidden" class="form-control" name="price{{ $month->id }}"
                                                id="price" value="{{ $month->finalprice }}">
                                            <h5 class="description"><br />{{ $month->name }}</h5>
                                            <div class="col-lg-12  p-a0 @if ($month->gopro_type == 'no') blue-bg @elseif($month->gopro_type=='yes') orange-bg @endif ">
                                                <div>
                                                    <h6 class="price-o">{{ $month->price }}/-*</h6>
                                                    <div class="price-active">
                                                        <h4 class="cost cost-first">{{ $month->finalprice }}/-* <span
                                                                class="month">mo</span></h4>
                                                    </div>
                                                </div>
                                                <div class="card-content text-center">
                                                    <div class="col-12 subscribestylemonth"> @if ($month->viewall == 'yes') <a href="#" class="noclick_links">View all projects</a> @endif @if ($month->placebids == 'yes') <a href="#" class="noclick_links">Place Unlimited Bids</a> @endif @if ($month->viewcontact_bidaccepted == 'yes') <a href="#" class="noclick_links">Contact Customers-When <br />Bid is accepted</a> @endif @if ($month->viewaccepted_pro == 'yes') <a href="#" class="noclick_links">Directly Contact Customers</a> @endif </div>
                                                    <button id="{{ $month->id }}"  onclick="showModal(this)"

                                                        class="subscribe-btn">Subscribe</button>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 offset-lg-1 col-sm-12 col-xs-12" id='yearly'>
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="desc-main description desc-main desc-main-yearly">YEARLY
                            </div>
                            </p>
                            @if (isset($yearly))
                                @foreach ($yearly as $year)
                                    <div class="col-lg-6 ">
                                        <form id="form{{ $year->id }}" method="post" action="{{ route('profile_review') }}"> {!! csrf_field() !!} <input type="hidden"
                                                class="form-control" name="id" id="id" value="{{ Session::get('id') }}">
                                                <input type="hidden" class="form-control" name="transaction_id" id="transaction_id" value="">
                                            <input type="hidden" class="form-control" name="subscription_id"
                                                id="subscription_id" value="{{ $year->id }}">
                                                <input type="hidden" class="form-control" name="price{{ $year->id }}"
                                                id="price" value="{{ ($year->finalprice)*12 }}">
                                            <h5 class="description"><br />{{ $year->name }}</h5>
                                            <div class="col-lg-12  p-a0 @if ($year->gopro_type == 'no') blue-bg @elseif($year->gopro_type=='yes') orange-bg @endif ">
                                                <!-- style="background-image: url({{ $year->image }}) !important;" -->
                                                <div>
                                                    <h6 class="price-o">{{ $year->price }}/-*</h6>
                                                    <div class="price-active">
                                                        <h4 class="cost cost-first">{{ $year->finalprice }}/-* <span
                                                                class="month">mo</span></h4>
                                                    </div>
                                                </div>
                                                <div class="card-content text-center">
                                                    <div class="col-12 subscribestyleyearly"> @if ($year->viewall == 'yes') <a href="#" class="noclick_links">View all projects</a> @endif @if ($year->placebids == 'yes') <a href="#" class="noclick_links">Place Unlimited Bids</a> @endif @if ($year->viewcontact_bidaccepted == 'yes') <a href="#" class="noclick_links">Contact Customers-When <br />Bid is accepted</a> @endif @if ($year->viewaccepted_pro == 'yes') <a href="#" class="noclick_links">Directly Contact Customers</a> @endif
                                                    </div>
                                                    <button data-toggle="modal"
                                                         onclick="showModal(this)" id="{{ $year->id }}" class="subscribe-btn">Subscribe</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <p style="color:black;width: 100%;margin-right: 5%;text-align: right;">*All subscription plans are Excluding GST-18%</p>
                </div>
            </div>
        </div>
    </div>
    <!--END plans-->
    </div>
    </div>
    <!-- modal 2 for pay -->
    <div class="modal fade" id="payNowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Subscription</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="text-align:center">
              
              <p style='color:black;'> Thanks for selecting the package. <br> We understand you may need sometime to create a strong  <br>  and appealing profile. If yes, we suggest to continue with Free Plan, until then. <br> <br>
            If you are ready, and would like to go ahead with subscription. <br> Please click on "Pay Now" button </p>
                
            </div>
            <div class="modal-footer"  style="text-align:center; margin:0 auto;">

              <button type="button" id="paymentSubmitButton"  class="btn btn-primary">Pay Now</button>
            </div>
          </div>
        </div>
      </div>


    {{-- <div class="modal" id="payNowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pay_now">Pay Now </h5>
                    <button type="button" class="close" aria-label="Close"
                        style="left: -4%; margin-top: -4px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center" style='margin-bottom:5%;'>
                    <button class='btn btn-success' type="button" onclick="location.href='{{ route('login') }}'">Click
                        Here to Log In</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Subscription </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="left: -4%; margin-top: -4px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-end" style='color:black;'>
                    <p style='color:black;'> Thanks for showing your interest. <br> You would require time to create a
                        strong and appealing profile. <br> <br> Hence, please continue with Free Plan as of now, and we will
                        let you know when is the best time to subscribe! </p>
                </div>
                <div class="text-center" style='margin-bottom:5%;'>
                    <button class='btn btn-success' type="button" onclick="location.href='{{ route('login') }}'">Click
                        Here to Log In</button>
                </div>
            </div>
        </div>
    </div> @stop @push('PAGE_ASSETS_JS') @endpush @push('PAGE_SCRIPTS')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
         var actual_price = '';
        var options = {
            "key": "{{ RAZORPAY_API_KEY }}", // Enter the Key ID generated from the Dashboard
            "amount": actual_price, // For testing
            "currency": "INR",
            "name": "UBID India Pvt Ltd",
            "description": `Subscription Fee Including GST`,
        //    /"description": "<pre>" + 'Subscription Fee' + "\n" + 'Subscription Fee'+ "</pre>";
            "image": "{{ url ('app-assets/images/UBID-logo.png') }}",
            "handler": function(response) {
                $("input[name=transaction_id]").val(response.razorpay_payment_id);
                console.log(response);
                $("#paymentSubmitButton").attr('type', 'submit');
                $("#paymentSubmitButton").trigger('click');
                $('#payNowModal').modal('hide');
                $("#form" +sub_id).submit();
            },
            "prefill": {
                "name": "{{ isset($vendor_detail) ? $vendor_detail->company : '' }}",
               "email": "{{ isset($vendor_detail) ? $vendor_detail->email : '' }} ",
               "contact": "{{ isset($vendor_detail) ? $vendor_detail->mobile : '' }} "
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        function showModal(subscription_id) {
            event.preventDefault();
            globalThis.sub_id = subscription_id.id;
            price = $("input[name=price" +sub_id+ "]").val();
            globalThis.actual_price = price * 100;
            options.amount = actual_price + ((actual_price*18)/100);
            globalThis.rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function(response) {
            console.log(response);
            });
            $('#payNowModal').modal('show');
        }

        document.getElementById('paymentSubmitButton').onclick = function(e) {
            // alert(actual_price);
            if ($("input[name=transaction_id]").val() == "" ) {
                rzp1.open();
                e.preventDefault();
            }
        }
        $('#inlineRadio1').on('click', function() {
            $('body,html').animate({
                scrollTop: $('#' + $(this).val()).position().top
            });
        });
        $('#inlineRadio2').on('click', function() {
            $('body,html').animate({
                scrollTop: $('#' + $(this).val()).position().top
            });
        });

        function prev() {
            document.getElementById('slider-container').scrollLeft -= 270;
        }

        function next() {
            document.getElementById('slider-container').scrollLeft += 270;
        }
    </script>
<!-- Bootstrap JS--> @endpush
